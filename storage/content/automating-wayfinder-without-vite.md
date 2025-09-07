---
title: Automating Wayfinder Without Vite
date: 2025-09-06
summary: There are times when you might want to run Laravel Wayfinder automatially without using Vite or Node. Let's take a look at one way to set that up.
tags:
    - laravel
    - php
---

When I am working with Laravel and PHP locally I prefer to use a [docker environment](https://stagerightlabs.com/blog/starting-a-fresh-laravel-application) that runs Node and PHP in separate containers. This proved to be a bit challenging with the recent release of [Laravel Wayfinder](https://github.com/laravel/wayfinder), a tool for communicating route definitions between the front-end and the back-end of your application.  The new starter kits now ship with a [vite plugin](https://github.com/laravel/vite-plugin-wayfinder) that watches your controller and route files and runs Wayfinder automatically whenever it detects changes to those files. 

This strategy works very well and is a fantastic convenience for many local development environments. In my situation, however, my local vite process does not have the ability to trigger php commands due to the separation of concerns in my docker setup.  Fortunately, all is not lost. We can still have the convenience of automated TypeScript route defintions while keeping our container processes separate.  To accomplish this we will set up a script in PHP that will poll for changes to our controllers and route files and then call Wayfinder automatically when they are found. 

## TLDR

I have set up a [gist](https://gist.github.com/rydurham/7c6c66ea5fe7f4ca2a5d35bb75efcaa2) with the scripts I use with my local docker setup. 

## Watching for changed files

To start we will create a method that scans our target directories and returns a list of PHP files to monitor. Here we are using a `RecursiveIteratorIterator` to wrap a `RecursiveDirectoryIterator`, an PHP function that reads the contents of directories recursively (both are part of the [Standard PHP Library](https://www.php.net/manual/en/book.spl.php).)  If you are interested in this recursive iterator pattern you can find more information in [this excellent article](https://gbh.fruitbat.io/2024/06/04/php-doing-recursion-with-recursive-iteratoriterators/) from Grant Horwood. 

```php
function scan(array $directory = ['app/Http', 'routes'])
{
    $files = [];

    foreach ($directory as $dir) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir)
        );

        foreach ($iterator as $file) {
            if ($file->isDir() || $file->getExtension() !== 'php') {
                continue;
            }
            $files[$file->getPathname()] = $file->getMTime();
        }

        // Free the iterator;
        unset($iterator);
    }

    return $files;
}
```

Notice that we are returning a list of PHP files associated with their 'last modified' timestamp, which we get from `$file->getMTime()`. We can now set up our script to continously poll those files and look for updated timestamps. When we find them we know that the contents of that file has changed and it is time to trigger Wayfinder.  Here is a simplified version of our monitoring loop:

```php
// Our inital directory state 
$timestamps = scan();

while(true) {
    $changes = false;

    // Clear PHP's file stat cache
    clearstatcache(true);

    // Get current directory state
    $files = scan();

    // Check for new or modified files
    foreach ($files as $path => $time) {
        if (!isset($timestamps[$path])) {
            $changes = true; // new file 
        } elseif ($timestamps[$path] !== $mtime) {
            $changes = true; // modified file
        }
    }

    // Check for deleted files
    foreach ($timestamps as $path => $mtime) {
        if (!isset($files[$path])) {
            $changes = true; // file removed
        }
    }

    // Update our comparisson state
    $timestamps = $files;

    if ($changes) {
        runWayfinder();
    }

    // Memory clenaup
    unset($files);
    gc_collect_cycles();

    // Wait 1 second before polling the filesystme again
    sleep(1);
}
```

In this example the `runWayfinder()` function is a wrapper that uses `exec()` to trigger the Wayfinder Laravel command. We have also included some manual garbage collection because we don't know how long this script will run and it can't hurt to be extra careful about releasing resources back to the system when they are not needed. I have prepared a gist with a [more complete](https://gist.github.com/rydurham/7c6c66ea5fe7f4ca2a5d35bb75efcaa2#file-watch-php) version of this monitoring script.

## Creating an entry point for our container

We now have a script that will run Wayfinder automatically when we detect changes in the file system. Now we need to set up our PHP docker container to run this script automatically in the background whenever the container starts up. Initially our PHP container was set up to run the artisan `serve` command as it's default command. To assign multiple tasts to this container we can use an entrypoint script as our primary command and this script will then launch both the Wayfinder monitor as well as the PHP's built-in webserver (via `php artisan serve`.) This is a simplified example of an entrypoint script:

```sh
#!/bin/sh

# Start processes
echo "Starting services..."
php -d display_errors=1 -d error_reporting=E_ALL artisan serve --host 0.0.0.0 --no-ansi -vvv &
php /usr/local/bin/watch.php &

# Wait for any child to exit or signal
trap "exit" SIGTERM SIGINT SIGQUIT TERM; while true; do sleep 1; done
```

In this example we are staring the monitor and the web server in different background processes (note the `&` at the end of those commands.)  The signal traps at the end allow us to speed up the container shut-down process that occurs when we run `docker compose down`, not required for our objective but still nice to have.

## Updating our PHP Docker Image

Now that we have our monitor script and our entrypoint script we need to update our PHP container to pull in these scripts.  The key part of that change is here:

```Dockerfile
# .. ignoring the other setup steps for now

# Set the active directory
WORKDIR /var/www

# Copy utility scripts into the container
COPY watch.php /usr/local/bin/
COPY start.sh /usr/local/bin/

# Set the active user
USER ${NAME}

# Set the default command
STOPSIGNAL SIGQUIT
CMD ["/usr/local/bin/start.sh"]
```

Here we are copying our new scripts into the container and running them automatically when the container spins up. With these updates in place we have accomplished our goal and can enjoy the benefits of Wayfinder without needing to combine PHP and Node into a single docker image, which is an ideal solution for my preferred docker setup. Feel free to peruse [this gist](https://gist.github.com/rydurham/7c6c66ea5fe7f4ca2a5d35bb75efcaa2) if you want to see the complete version of the scripts I am using for local development. 

## Removing the Vite plugin

With these scripts in place you can now remove the Wayfinder Vite plugin if you want; just make sure you add a step in your deployment process that calls the Wayfinder artisan command. If you would prefer to use this plugin for deployments you will need to update your `vite.config.ts` file to ensure that wayfinder only runs in production environments.
