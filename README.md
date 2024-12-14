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
$ docker-compose run php composer install
```

3. Install the NPM dependencies and build the frontend assets:

```
$ docker-compose run node yarn
$ docker-compose run node yarn dev
```

4. Create your `.env` file:

```
$ docker-compose run php cp .env.example .env
```

5. Generate an application key:

```
$ docker-compose run php php artisan key:generate
```

6. Spin up the containers:

```
$ docker-compose up -d
```

You should now be able to view the site in your browser by going to http://stagerightlabs.test. You are now off to the races!

## Stack

This application is a custom flat file blog built with these tools:

- [Laravel](https://laravel.com/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Tailwind UI](tailwindui.com/)
- [Alpine.js](https://github.com/alpinejs/alpine)
- [YAML Parsing](https://symfony.com/doc/current/components/yaml.html)
- [CommonMark For PHP](https://commonmark.thephpleague.com/)
- [Tempest Code Highlighting](https://tempestphp.com/docs/highlight/getting-started/)
- [Lucid Icons](https://lucide.dev/)

## Credits

Special Thanks:

- [Kirschbaum Development Laravel Test Runner](https://kirschbaumdevelopment.com/insights/laravel-github-actions)
- [Github Actions](https://docs.github.com/en/free-pro-team@latest/actions)
- [SVG Favicon Maker](https://formito.com/tools/favicon)
