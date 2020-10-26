# stagerightlabs.com

![CI](https://github.com/stagerightlabs/stagerightlabs.com/workflows/CI/badge.svg)

This repository houses the home page and blog for Stage Right Labs, LLC.

## Local Development

You can use docker to run this application locally:

1. Build the images:

```
$ docker-compose build
```

2. Install the PHP dependencies:

```
$ docker-compose run cli composer install
```

3. Install the NPM dependencies and build the frontend assets:

```
$ docker-compose run node npm install
$ docker-compose run node npm run dev
```

4. Create your `.env` file:

```
$ docker-compose run cli cp .env.example .env
```

5. Generate an application key:

```
$ docker-compose run cli php artisan key:generate
```

6. Spin up the containers:

```
$ docker-compose up -d
```

7. The database will be created automatically. You can now run the migrations:

```
$ docker-compose exec cli php artisan migrate
```

8. Generate a backstage user:

```
$ docker-compose exec cli php artisan backstage:user [email]
```

9. Add a new entry to your hosts file:

```
$ sudo bash -c "echo '127.0.0.1 stagerightlabs.test' >> /etc/hosts"
```

10.  You should now be able to view the site in your browser by going to http://stagerightlabs.test. You are now off to the races!

## Stack

This application is built on the [TALL Stack](https://tallstack.dev/):

- [Tailwind CSS](https://tailwindcss.com/)
- [Alpine.js](https://github.com/alpinejs/alpine)
- [Laravel](https://laravel.com/)
- [Livewire](https://laravel-livewire.com/)

We are also making use of these additional tools:

- [Tailwind UI](tailwindui.com/)
- [Heroicons](https://heroicons.com/)
- [Blade UI Kit Heroicons Package](https://blade-ui-kit.com/blade-icons)
- [Laravel Telescope](https://laravel.com/docs/8.x/telescope)
- [Commonmark For PHP](https://commonmark.thephpleague.com/)

## Credits

Special Thanks:

- [Kirschbaum Development Laravel Test Runner](https://kirschbaumdevelopment.com/insights/laravel-github-actions)
- [Github Actions](https://docs.github.com/en/free-pro-team@latest/actions)
- [SVG Favicon Maker](https://formito.com/tools/favicon)
