---
title: Automatic Code Formatting with Git Hooks
date: 2021-03-05
summary: Git hooks are a powerful tool that can be leveraged for many uses. Let's examine how we can use the 'pre-commit' hook to run code formatting tools automatically.
tags:
    - Docker
    - Git
---

Automatic code formatting can be very helpful. Keeping your code consistent with a standard layout makes it much easier for new developers to step into your project and understand what is going on.  If you are like me, however, remembering to run the formatter on a periodic basis can be problematic. You may also end up with extra commits in your SCM tool that are just for formatting; which can be distracting.

There are two primary options available to us: 1) We can configure our code editor to format code automatically, or 2) We can use a git "pre-commit" hook to run a formatting script for us automatically. In this post I will be discussing the later.

[Git hooks](https://git-scm.com/book/en/v2/Customizing-Git-Git-Hooks) are configurable opportunities to run custom commands when performing common tasks with git.  Within the `.git` folder in your project there is a folder called "hooks". This folder will store our bash scripts that we want git to trigger for us.  If you take a look in that folder now you will see a handful of example files.

Give your script the name of a lifecycle hook and that script will be run when the hook is called.  There are several [lifecycle hooks](https://githooks.com/) available, each serving a slightly different purpose.  The "pre-commit" hook is the best candidate for us; it is run just before a commit is recorded.  We can use that hook to trigger our code formatter and the changes will be included in the commit record.  Let's set that up now.

The first thing to think about is where you want to keep your script.  You have the option of keeping it directly in the `.git/hooks` folder, but it won't be tracked as part of the rest of your repository.  I prefer to keep the file somewhere in the regular part of the repo and then use a symbolic link to add it to the hooks folder. This way the script is under version control and new developers can use it themselves in the future if they so desire.

Create a file called `pre-commit.sh` and store it somewhere convenient.  Then set up a symbolic link:

```bash
$ ln -s ../../pre-commit.sh .git/hooks/pre-commit
```

You will also need to make sure the file is executable:

```bash
$ chmod +x pre-commit.sh
```

Now we need to decide what we want this script to do.

For the sake of this demonstration let's assume you are working on a PHP project and you want to use the [php-cs-fixer package](https://github.com/FriendsOfPhp/PHP-CS-Fixer) to perform automatic formatting on the php files in your repository.  A very minimal version of this script could look something like this:

```sh
#!/usr/bin/env bash

vendor/bin/php-cs-fixer fix
```

This will read your `.php_cs` configuration file and apply those rules to all of the php files in your codebase before every commit. This is essentially the same as calling the tool directly from the command line - the usage is exactly the same.

I am currently working on a project using a version of php that I don't have installed on my development machine.  We can use docker to provide the same functionality without having to install multiple versions of PHP on the host machine. I have  created a set of [generic PHP docker images](https://hub.docker.com/r/stagerightlabs/php-test-runner/tags) that is ideal for this purpose.  Here is a version of that same formatting script that uses docker instead of the locally installed PHP instance:

```sh
#!/usr/bin/env bash

docker run --rm \
    -u 1000 \
    -v $(pwd):/var/www \
    -w /var/www \
    stagerightlabs/php-test-runner:7.4 /bin/bash -c "vendor/bin/php-cs-fixer fix --quiet"
```

Most of the usage here is specific to these particular docker images; your situation may be different. The `-v $(pwd):/var/www` argument mounts the current directory into the docker image at `/var/www`.  `-w /var/www` sets the active working directory.  We then call php-cs-fixer via the container, using the "quiet" flag to hide the output messages.

I find that this works very well; however the formatter is still looking at all the php files in the repo, which can be time consuming even with caching in place.  This technique, from [Sergey Protko](https://gist.github.com/fesor/1043aec3f1aeac7d801c270e0fba36cd), will limit the formatter to only the files that are going to be committed:

```sh
#!/usr/bin/env bash

CHANGED_FILES=$(git diff --cached --name-only --diff-filter=ACM -- '*.php')

if [ -n "$CHANGED_FILES" ]; then
    vendor/bin/php-cs-fixer fix $CHANGED_FILES;
    git add $CHANGED_FILES;
fi
```

With a script like this in place you will never have to worry about keeping up with formatting your codebase manually, or adding extra commits just for formatting changes.  Take a look at the other git hooks that are available as well - they can be a very powerful tool and a great addition to your tool belt.
