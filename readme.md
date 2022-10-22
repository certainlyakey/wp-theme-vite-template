# Boilerplate Wordpress theme with Vite

## Main features

- fast auto browser refresh/sync on file change/save
- keep your local domain while developing
- PostCSS built-in
- linting of CSS, JS, PHP, Prettier
- `npm run build` for production packing Javascript and CSS


## Installation

Clone the folder to your Wordpress installation `/wp-content/themes/` folder and activate the theme.
Then from your console or command prompt go to the theme folder and run **npm install**.


## Setup

Entry point file **main.js** is where you include all your scripts and styles. It can be changed via **vite.config.js** and **register-vite-assets.php**.

```bash
# get styles
import "./assets/css/styles.css"

# get scripts
import "./assets/js/scripts.js"
```

## Development with live preview/refresh

Ensure `IS_VITE_DEVELOPMENT` environment variable exists, is available and loaded to PHP and is set to `true`. Just run **npm run dev** and refresh your development website.

```bash
npm run dev
```
After Vite dev server is started open your installed Wordpress website in any browser or refresh it. Then you can start editing index.php, or any other php file in your theme. After saving changes your browser page eg your site should refresh immediately. You can freely edit asset files like styles.css, scripts.js too.


## Production build

Just run **npm run build**, make sure `IS_VITE_DEVELOPMENT` is not set and refresh local website.

```bash
npm run build
```
Wordpress should load now production generated assets.
