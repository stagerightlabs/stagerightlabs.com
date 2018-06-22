---
title: Running Homestead 2.0 on Windows
date: '2014-11-17 19:30'
layout: BlogPost
categories:
    - Laravel
    - Vagrant
highlight:
    theme: tomorrow
---

I know we have just met, but I have a confession to make. I am a windows user. Sure, I have dabled with linux distros in the past, and I have some very good friends who are tried and true Mac enthusiasts, but at the end of the day I have always felt most comfortable using Windows as my primary operating system. Using [Vagrant](https://www.vagrantup.com/) opened up a whole new world of possibilites for me, and adding Laravel's [Homestead](http://laravel.com/docs/4.2/homestead) into the mix has only made my life easier. Now that Homestead 2.0 has been released, I have been eager to make the upgrade.

<!-- more -->

Here are two excellent primers on the changes to be found in Homestead 2.0:

- [Matt Stauffer's Homestead post](http://mattstauffer.co/blog/introducing-laravel-homestead-2.0)
- [Free Laracasts Video](https://laracasts.com/lessons/say-hello-to-laravel-homestead-two)

The primary reason I enjoyed using Homestead/Vagrant in the past was that I could keep my host machine free of the clutter that comes with developing websites, and I didn't have to worry about installing software in Windows that has primarily been designed to run on linux - what a headache!

However, Homestead 2.0 requires [Composer](https://getcomposer.org/) to be running on your host machine before you can use it. To make this upgrade I had to install PHP and Composer locally, which turned out to be slightly more tricky than expected.

## Setting up PHP

Conveniently it is easy to use PHP on Windows without installing a complete web stack:

1.  Download a [Windows release package](http://windows.php.net/download/). \(I ended up using [this one](http://windows.php.net/downloads/releases/php-5.6.3-Win32-VC11-x86.zip).\)
2.  Extract the contents of that zip file into a folder of your choice. I ended up using `C:\php`.
3.  Rename the `php.ini-development` file to `php.ini`. There are some [recommended edits](http://php.net/manual/en/install.windows.manual.php#install.windows.manual.phpini) you should make, but the most important thing to do is [enable the OpenSSL extension](http://www.herongyang.com/PKI/HTTPS-PHP-Configure-PHP-OpenSSL-on-Windows.html).
4.  Add the PHP directory to your path variable. I have found using an [editor](http://eveditor.com/) can make this very easy. If you are running a command line terminal (cmd or Git Bash) you will need to restart it before it will pick up the changes you have made.
5.  You should now be able to run `php -v` and see something like this:

```bash
PHP 5.6.3 (cli) (built: Nov 12 2014 17:18:08)
Copyright (c) 1997-2014 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2014 Zend Technologies
```

## Installing Composer

Composer has a [Windows Installer](https://getcomposer.org/Composer-Setup.exe) which is very easy to use. It will ask you to provide the location of your PHP installation directory. After that it will scan your PHP setup for problems and then install the Composer.phar file. If your OpenSLL extension is not enabled you will see an error message. When complete, you should be able to run `composer --version` and see something like the following:

```bash
Composer version 1.0-dev (ffffab37a294f3383c812d0329623f0a4ba45387) 2014-11-05 06:04:18
```

It is important to note that Composer will be installed in your AppData folder: `C:\users\{user-name}\AppData\Roaming\Composer`

At this point you should add Composer's `vendor\bin` folder to your path as well - this will be necessary to work with Homestead later.

```bash
C:\users\{user-name}\AppData\Roaming\Composer\vendor\bin
```

## Setting up Homestead

You can now follow the instructions provided in the Homestead documentation for installation. If you haven't already, you need to download the Homestead Vagrant box:

```bash
> vagrant box add laravel/homestead
```

After that, run

```bash
> composer global require "laravel/homestead=~2.0"
```

This will copy the Homestead repo into your global Composer vendor folder.

Now run `homestead init`. This will create a `.homestead` folder in your user directory:

```bash
C:\users\{user-name}\.homestead
```

This is where you will find your `homestead.yaml` file, which you can configure as needed. Make sure you add your SSH Key - this is critically important. When everything is ready you can run `homestead up` to boot and provision Homestead.

## Day to Day Workflow

Out of the box, Homestead has several commands that you will use day-to-day. These are just wrappers around Vagrant commands that you may already be familiar with. The most important ones are:

- homestead up
- homestead halt
- homestead ssh
- homestead update

When you are starting out your day you will need to boot the box by using `homestead up`. Then you can access the machine by using `homestead ssh`.

Currently there is no homestead wrapper for the "--provision" option, so if you add a new site to your yaml file and want to re-provision Homestead you will need to run `vagrant up --provision` from within the homestead installation folder.

```
C:\users\{user-name}\AppData\Roaming\Composer\vendor\laravel\homestead
```

There you can also find the `Vagrantfile` if you want to make changes to how the box is provisioned.

As of this writing, I have found that using `homestead ssh` to log into the homestead machine creates a SSH session which freezes up on me after a few minutes of use. For now I am just using the regular `vagrant ssh` command, which does not have the same problem.

Happy homesteading!
