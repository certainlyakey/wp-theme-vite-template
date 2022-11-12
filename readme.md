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

## Adding scripts and styles

Entry point file **main.js** is where you include all your scripts and styles. It can be changed via **vite.config.js** and **register-vite-assets.php**.

```bash
# get styles
import "./assets/css/styles.css"

# get scripts
import "./assets/js/scripts.js"
```

## Development with live preview/refresh

Ensure `IS_VITE_DEVELOPMENT` environment variable exists, is available and loaded to PHP and is set to `true`. Just run **npm run start** and refresh your development website.

```bash
npm run start
```
After Vite dev server is started open your installed Wordpress website in any browser or refresh it. Then you can start editing index.php, or any other php file in your theme. After saving changes your browser page eg your site should refresh immediately. You can freely edit asset files like styles.css, scripts.js too.


## Production build

Just run **npm run build**, make sure `IS_VITE_DEVELOPMENT` is not set and refresh local website.

```bash
npm run build
```
Wordpress should load now production generated assets.
