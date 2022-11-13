# Boilerplate Wordpress theme with Vite

## Main features

- fast auto browser refresh/sync on file change/save
- keep your local domain while developing
- PostCSS built-in
- linting of CSS, JS, PHP, Prettier
- `npm run build` for production packing Javascript and CSS


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


## Local development

- Running from [lando](https://lando.dev/): run `npm run start` inside your `node` container (or it add to your lando tooling), then open http://lando-wp-site-template.lndo.site/ - refresh will happen automatically.
- Running locally from OS: in `common_config.json` set `force_local_dev` to `true`, then run `npm run start` and open http://lando-wp-site-template.lndo.site/.
- To load the prod assets on local without running the `watch`/`start` command, set `IS_VITE_DEVELOPMENT` to false and run `npm run build` (you may need also to rebuild the lando app sometimes).


## Adding scripts and styles

Entry point file **main.js** is where you `import` all your scripts and styles.


## Production build

Just make sure `IS_VITE_DEVELOPMENT` is not set and run `npm run build`.


## TODO

1. Rename `IS_VITE_DEVELOPMENT` to `GENERATE_ASSETS_FOR_DEV`
2. Move `force_local_dev` from `common_config.json` to `.env`?
