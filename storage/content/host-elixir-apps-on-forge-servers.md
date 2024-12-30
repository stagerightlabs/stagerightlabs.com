---
title: Host Elixir Apps on Forge Servers
date: 2020-12-18
summary: Servers provisioned by Laravel Forge can be used for almost anything. Let's take a look at hosting an Elixir application on a server managed by Forge.
tags:
    - Elixir
    - Laravel Forge
---

Laravel [Forge](https://forge.laravel.com) is a server provisioning tool that is typically used to set up servers for hosting PHP applications. However, the basic setup it provides is a great jumping-off point. It can be used for hosting a variety of different types of applications.

Let's take a look at hosting an [Elixir](https://elixir-lang.org/) application on a server provisioned by Forge.

TLDR: [https://gist.github.com/rydurham/41904723ab07d8d60fa8295ee6f64822](https://gist.github.com/rydurham/41904723ab07d8d60fa8295ee6f64822)

## Install Elixir

Once Forge has created a new server for us, we will first need to install Elixir and Erlang. Connect to the server via SSH and then run the Elixir [installation steps](https://elixir-lang.org/install.html):

```sh
~$ wget https://packages.erlang-solutions.com/erlang-solutions_2.0_all.deb && sudo dpkg -i erlang-solutions_2.0_all.deb
~$ sudo apt update
~$ sudo apt install esl-erlang
~$ sudo apt install elixir
~$ rm erlang-solutions_2.0_all.deb
```

You could also set this task up as a [recipe](https://mattstauffer.com/blog/laravel-forge-using-recipes/) if you want to run it again on new servers down the road.

We can verify the installation by running:

```bash
~$ elixir -v
Erlang/OTP 23 [erts-11.1.4] [source] [64-bit] [smp:1:1] [ds:1:1:10] [async-threads:1] [hipe]

Elixir 1.11.2 (compiled with Erlang/OTP 23)
```

## Creating the Site

We can now create the site in our Forge management panel just like any other site. Go to the overview page for your new server and use the "Add site" tool to set up your new site. Select "Static HTML" as your project type, and the project root ("/") as your web directory. Once the site has been set up don't run a deployment just yet; we will first need to modify the nginx configuration and the deployment script to work with Elixir [releases](https://elixir-lang.org/getting-started/mix-otp/config-and-releases.html#releases).

## Releases

As noted in the Elixir documentation:

> A release is a self-contained directory that consists of your application code, all of its dependencies, plus the whole Erlang Virtual Machine (VM) and runtime.

When we create a release it contains everything needed to run our application in a single directory with a corresponding binary. This binary can then be run as a daemon process listening for requests on a system port. The only catch is that you have to build the binary on the same type of system that you will be hosting it on. In our case, we will use a forge deployment script to build our release and start it as a daemon process every time we want to update the code.

Configuring an Elixir application for release is outside the scope of this post, but the Elixir documentation covers the topic [very well](https://elixir-lang.org/getting-started/mix-otp/config-and-releases.html). If you are working with Phoenix there is also [excellent information](https://hexdocs.pm/phoenix/releases.html) about releases in that documentation as well.

## Nginx Configuration

The default nginx site configuration provided by Forge is very comprehensive; we only need to make a few small modifications to get things working the way we want. We will be using a reverse proxy to get nginx to forward web traffic to our application daemon.

First we will add the reverse proxy. Put this above the `server` block, near the top of the file:

```
upstream site {
 server localhost:4000
}
```

"site" is a shorthand name for the service we are setting up. You should use something more specific to your application. Also, I am using port 4000 here, but you can configure your Elixir release to use any port you would like.

Now we can update the `server` block itself. As of this writing, there are two `location` blocks in the default nginx configuration. One is for handling the site root at `/` and the other is specifically for handling php files. Remove the second block (`location ~ \.php$`) completely; we won't be needing it.

Update the contents of the `location /` block like so:

```
location / {
    proxy_http_version 1.1; # Required for phoenix channel websocket negotiation
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header Host $http_host;
    proxy_redirect off;
    proxy_pass http://site;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "upgrade";
}
```

Here we are configuring our proxy and then using the `proxy_pass http://site` line to forward requests to our upstream server on port 4000. Replace "site" with whatever name you used for your upstream service.

As of the time of this writing we need to enforce the use of HTTP1.1 to allow websocket negotiations to work in the way that Elixir and Phoenix expect them to. Most of the proxy configuration listed here is used for that purpose.

With those changes in place you can save the script and restart nginx. Now, on to the deployment script.

## The Deployment Script

A deployment script outlines the actions that Forge will perform whenever you request a site deployment. The default deployment script generated for new sites is geared towards PHP applications. Delete everything that is there and replace it with this:

```sh
cd /home/forge/www.example.com
# Fetch the latest version of the code
git pull origin main

# Ensure we have access to mix
if ! [ -x "$(command -v mix)" ]; then
  echo 'Error: Elixir is not installed.' >&2
  exit 1
fi

if ! [ -d /home/forge/site_logs ]; then
  mkdir -p /home/forge/site_logs
fi

# Ensure we have access to hex and rebar
mix local.hex --force
mix local.rebar --force

# Install dependencies
mix deps.get --only prod
git checkout mix.lock
MIX_ENV=prod mix compile

# Compile assets
npm install --no-save --prefix ./apps/site_web/assets
npm run deploy --prefix ./apps/site_web/assets
MIX_ENV=prod mix phx.digest /home/forge/www.example.com/apps/site_web/priv/static

# Run the migrations
# MIX_ENV=prod mix ecto.migrate

# Generate the release
MIX_ENV=prod mix release production --overwrite

# Stop the existing process if it exists
_build/prod/rel/production/bin/production stop

# Start the release as a daemon process
RELEASE_TMP=/home/forge/rcd_logs _build/prod/rel/production/bin/production daemon

# Log the new OS PID
_build/prod/rel/production/bin/production pid
```

Let's break it down into chunks:

```
cd /home/forge/www.example.com
git pull origin main
```

First we move into the project's root directory and pull in the latest version of the code with git. Make sure you specify whichever repo branch you are using for deployments here. I am using "main".

```
if ! [ -x "$(command -v mix)" ]; then
  echo 'Error: Elixir is not installed.' >&2
  exit 1
fi
```

We won't be able to get very far if we can't use the `mix` tool provided by Elixir. Here we are checking to make sure it is available. If it isn't then it is likely that something went wrong when we installed Elixir on the server.

```
if ! [ -d /home/forge/rcd_logs ]; then
  mkdir -p /home/forge/rcd_logs
fi
```

We are going to use a separate directory for storing our application logs. Here we are making sure that the directory exists. If it doesn't we will create it.

```
mix local.hex --force
mix local.rebar --force
```

We will need both `hex` and `rebar` to manage our Elixir dependencies and build our release. Here we are checking to make sure they are available to us.

```
mix deps.get --only prod
git checkout mix.lock
MIX_ENV=prod mix compile
```

Here we are fetching our production dependencies and compiling them for use in our production environment. The `mix.lock` file might drift a bit after fetching the dependencies; I am reverting the file to prevent any changed files from stopping a `git pull` in the future.

```
npm install --no-save --prefix ./apps/site_web/assets
npm run deploy --prefix ./apps/site_web/assets
MIX_ENV=prod mix phx.digest /home/forge/www.example.com/apps/site_web/priv/static
```

Now we are compiling our front end assets. You will need to update the `prefix` value to point to your own asset directory. The `phx.digest` command prepares our static assets for use with our release binary.

```
# MIX_ENV=prod mix ecto.migrate
```

If you want to automatically run new database migrations you can uncomment this line. I tend to prefer to run migrations manually, but the choice is yours.

```
MIX_ENV=prod mix release production --overwrite
```

This is where we build our new release binary. The `--overwrite` flag tells Elixir to replace the currently tagged release rather than creating a new one with a new version number. You may decide that you want to keep your old releases and tag a new build version for each release; this will require that you update your release configuration in the application for each deployment.

```
_build/prod/rel/production/bin/production stop
```

If we have an existing release running this command will stop it. If there is no existing release this command will error, but that doesn't matter for our purposes.

```
RELEASE_TMP=/home/forge/rcd_logs _build/prod/rel/production/bin/production daemon
```

Here we start up a new daemon process with the newly built binary. Note that we are setting an environment variable that tells the binary where to put its log files - this is the same folder path we created earlier.

The exact path to the binary will depend on your release configuration.

```
_build/prod/rel/production/bin/production pid
```

I like to include the newly started process ID in the deployment log; this is optional.

## Conclusion

With this deployment script in place you can now use Forge to automatically build and deploy Elixir application releases on-demand. How neat is that? Forge is a remarkable tool.

## NB

There are a couple things to keep in mind:

- If you restart the server your application process will not automatically restart; you will have to connect via SSH and start the process manually.
- This deployment script is not perfect. Occasionally it will build the release but not successfully start the daemon process. When that happens I start the process by connecting to the server via SSH and running the commands manually.
- I have [set up a gist](https://gist.github.com/rydurham/41904723ab07d8d60fa8295ee6f64822) for this deployment script. Feel free to leave a comment if you have any ideas for improvement.
