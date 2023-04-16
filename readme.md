# Boilerplate Wordpress theme with Vite

## Main features

- fast auto browser refresh/sync on file change/save
- keep your local domain while developing
- PostCSS built-in
- linting of CSS, JS, PHP, Prettier
- `npm run build` for production packing Javascript and CSS
- optimised for usage with [lando](https://lando.dev/)-based local Wordpress development, but also can be used without it


## Installation

1. Clone the repo to your Wordpress installation `/wp-content/themes/` folder and rename the theme folder to you preferred theme name.
2. Across the theme, replace:
   1.  `themeprefix` and `theme_domain` in PHP files,
   2.  `theme_domain` in `loco.xml`,
   3.  `WordPress Theme Boilerplate`, `WordPress\Theme\Boilerplate`, `themeprefix`, and `theme_domain` in `phpcs.xml`,
   4.  `vite-wp-boilerplate` in `package.json`, `register-vite-assets.php`, and `vite.config.js`,
   5.  `Theme Name` and `Description` fields in `style.css` with the name of your theme.
3. Then from your console or command prompt go to the theme folder and run `npm install`.
4. Run `composer install` in the theme folder.
5. Activate the theme in the admin or via WP CLI.
6. For local development, ensure that both PHP and node (Vite) have an environment variable `GENERATE_ASSETS_FOR_DEV` set to `true`.


## Local development

- Running from [lando](https://lando.dev/): run `npm run start` inside your `node` container (or it add to your lando tooling), then open http://lando-wp-site-template.lndo.site/ - refresh will happen automatically.
- Running locally from OS: in `common_config.json` set `force_native_assets_build` to `true`, then run `npm run start` in the theme folder and open http://lando-wp-site-template.lndo.site/.
- To load the prod assets on local without running the `watch`/`start` command, set `GENERATE_ASSETS_FOR_DEV` environment variable to false or remove it and run `npm run build` (you may need also to rebuild the lando app sometimes if you are using it).

## Adding scripts and styles

Entry point file **main.js** is where you `import` all your scripts and styles.

## Adding fonts and images to be used in CSS

Add fonts and images (or any assets to be loaded via CSS) to the `public` folder. For resources loading on client side you will need to use a PostCSS ([postcss-simple-vars](https://github.com/postcss/postcss-simple-vars)) variable as a assets path prefix (eg `url('$(_assets_path)/images/2022-11-08.jpg')`). This is not necessary when referencing assets that will be inlined by PostCSS in build phase (eg by employing [postcss-inline-svg](https://www.npmjs.com/package/postcss-inline-svg)).

## Production build

Just make sure `GENERATE_ASSETS_FOR_DEV` is not set and run `npm run build`.


## TODO

1. Move `force_native_assets_build` from `common_config.json` to `.env`?


## Issues

### Gutenberg

1. presence of `theme.json` removes all styles from editor

### PostCSS

1. `postcss-simple-vars` with `postcss-nested` doesn't allow the same `$base` variable to be reused (silently using the previous component's class)
