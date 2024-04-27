# NXTYOU Filament Starter

Here lives a beautiful starting point to quickly bootstrap your next [TALL stack](https://tallstack.dev/) application utilizing [Filament](https://filamentphp.com/) for the admin panel.

## Features

- 🧑‍💻 Fully pre-configured and [customized](#plugins-used) Filament panel with best practices in place.
- 🎨 Clean, minimally styled frontend powered by [Livewire](https://livewire.laravel.com/).
- 💄 [TailwindCSS](https://tailwindcss.com/) and [Vite](https://vitejs.dev/) ready for immediate use.
- 👷 Pre-bundled Livewire and [Alpine](https://alpinejs.dev/) for easy extendability.
- ⚡️ SPA-ready in both Filament and the frontend.
- 🔨 GitHub Actions workflows for [Pint](https://github.com/laravel/pint) with pre-configured Dependabot for dependencies.
- 🔍️ Easy programmatic SEO using [romanzipp/laravel-seo](https://github.com/romanzipp/Laravel-SEO).

## Requirements

Make sure all dependencies have been installed before moving on:

- [PHP](https://secure.php.net/manual/en/install.php) >= 8.1
- [Composer](https://getcomposer.org/download/)
- [Node.js](http://nodejs.org/) >= 18
- [Yarn](https://yarnpkg.com/en/docs/install)

## Getting Started

Start by configuring the `.env` file:

```sh
cp .env.example .env
```

After `.env` is configured, you can install dependencies by running:
```sh
composer install
```
Generate a new app key:
```sh
php artisan key:generate
```
You can proceed to migrate & seed the database:
```sh
php artisan migrate:fresh --seed
```

### Build Assets

The project assets are compiled using Vite. This can be done by installing the dependencies and running the build command with Yarn.

```sh
yarn install
yarn build
```

### Useful commands
Filament Shield: Generate Permissions and/or Policies for Filament entities
```sh
php artisan shield:generate --all
```

## Plugins Used

The following [Filament plugins](https://filamentphp.com/plugins) come fully implemented and configured out of the box:

| **Plugin**                                                          | **Description**                                    |
| :------------------------------------------------------------------ | :------------------------------------------------- |
| [Curator](https://github.com/awcodes/filament-curator)              | A beautiful media library.                         |
| [Gravatar](https://github.com/awcodes/filament-gravatar)            | Easy avatar integration powered by Gravatar.       |
| [Breezy](https://github.com/jeffgreco13/filament-breezy)            | Customizable user profile pages and 2FA support.   |
| [Shield](https://github.com/bezhanSalleh/filament-shield)           | Add access management to your Filament Admin       |  
| [Peek](https://github.com/pboivin/filament-peek)                    | Quick & efficient front-end previews of resources. |
| [Pest](https://pestphp.com/)                                        | An elegent PHP testing framework                   |
| [Flare](https://flareapp.io/)                                       | An easy-to-use beautiful error tracker for PHP and JS |
| [Telescope](https://laravel.com/docs/10.x/telescope)                | Provides insight into the requests coming into your application |
