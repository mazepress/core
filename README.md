# WordPress Plugin - Skeleton
A custom code template for creating a standards-compliant [WordPress](https://wordpress.org) plugin.

### Installation
Install this plugin into your Wordpress instance by:

1. Download latest plugin archive file from the [Releases](../../releases) page.
2. Go to your WordPress admin area and visit **Plugins » Add New**.
3. Click on the **Upload Plugin** button on top of the page and select the plugin archive file.
4. After you have selected the file, you need to click on the **Install Now** button.
5. Once installed, go to the **Plugins** page in WordPress admin and activate the installed plugin.

## Development
Following are the minimum requirements for the development and package dependency management.

- [PHP](https://php.net) version: 7.4 or higher
- [Composer](https://getcomposer.org/) version: 2.0 or higher
- [Node](https://nodejs.org) version: 18.0 or higher

### Environment
Clone or fork the repository and install the dependencies by running the following commands.

Install the [Composer](https://getcomposer.org/) dependency packages.
```shell
composer install
```

Install the [Node](https://nodejs.org) dependency packages.
```shell
npm install
```

### CLI Commands
Following are the available CLI commands tailored with this app development.

Check code quality for PHP files based on [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/).
```shell
composer run phpcs
```

Check PHP codebase for any obvious or tricky bugs and errors with [PHPStan](https://phpstan.org).
```shell
composer run phpstan
```

Run unit testing against all the PHP codebase with [PHPUnit](https://phpunit.de).
```shell
composer run phpunit
```

Build and compile all the SCSS and JS files.
```shell
npm run build
```

Style fix all the SCSS, CSS and JS files based on [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/)
```shell
npm run fix
```

Check code quality for all the SCSS, CSS and JS files based on [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/)
```shell
npm run check
```

### Structure
The files and directories structure for this project development is as follows.

| Name | Description |
| --- | --- |
| `.github` | Directory contains all the [GitHub Action](https://github.com/features/actions) scripts. |
| `languages` | Directory contains all language files |
| `assets` | Directory contains all the SCSS, CSS, JS and Image files |
| `packages` | Addon packages for the plugin |
| `src` | Directory contains all the PHP Class files. |
| `templates` | Directory contains all the PHP and HTML template files. |
| `tests` | Directory contains all the PHP Test Class files. |
| `CHANGELOG(.*)` | A log of changes between releases. |
| `LICENSE(.*)` | Licensing information. |
| `README(.*)` | Information about the package itself. |

## Changelog
All the notable changes to this project will be documented in [CHANGELOG.md](CHANGELOG.md) file.

## License
This project is licensed under the MIT License. See [LICENSE](LICENSE.md) for more information.
