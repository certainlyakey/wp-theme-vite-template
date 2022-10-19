// View your website at your own local server
// for example http://vite-php-setup.test

// http://localhost:3000 is serving Vite on development
// but accessing it directly will be empty

// IMPORTANT image urls in CSS works fine
// BUT you need to create a symlink on dev server to map this folder during dev:
// ln -s {path_to_vite}/src/assets {path_to_public_html}/assets
// on production everything will work just fine

import theme_config from './common_config.json';
import liveReload from 'vite-plugin-live-reload';
import SVGSpriter from 'svg-sprite';
import glob from 'glob';
const path = require('path');
const fs = require('fs');

console.log(theme_config.vite_port, 'Vite config loaded');

// https://vitejs.dev/config
export default {
  plugins: [
    liveReload([__dirname + '/**/*.php', __dirname + '/**/*.twig']),
    svgSprite({
      inputDir: './assets/images/svg-sprite-source',
      outputDir: './dist/assets',
      // cssDir: './assets/css/generated',
    }),
  ],

  // config
  root: '',
  base: process.env.NODE_ENV === 'development' ? '/' : '/dist/',

  build: {
    // output dir for production build
    outDir: path.resolve(__dirname, './dist'),
    emptyOutDir: true,

    // emit manifest so PHP can find the hashed files
    manifest: true,

    // esbuild target
    target: 'es2018',

    // our entry
    rollupOptions: {
      input: {
        main: path.resolve(__dirname + '/main.js')
      }

      /*
      output: {
          entryFileNames: `[name].js`,
          chunkFileNames: `[name].js`,
          assetFileNames: `[name].[ext]`
      }*/
    },

    // minifying switch
    minify: true,
    write: true
  },

  server: {
    // required to load scripts from custom host
    cors: true,

    // we need a strict port to match on PHP side
    // change freely, but update in your functions.php to match the same port
    strictPort: true,
    port: theme_config.vite_port,

    // serve over http
    https: false,

    // serve over https
    // to generate localhost certificate follow the link:
    // https://github.com/FiloSottile/mkcert - Windows, MacOS and Linux supported - Browsers Chrome, Chromium and Firefox (FF MacOS and Linux only)
    // installation example on Windows 10:
    // > choco install mkcert (this will install mkcert)
    // > mkcert -install (global one time install)
    // > mkcert localhost (in project folder files localhost-key.pem & localhost.pem will be created)
    // uncomment below to enable https
    //https: {
    //  key: fs.readFileSync('localhost-key.pem'),
    //  cert: fs.readFileSync('localhost.pem'),
    //},

    hmr: {
      host: 'localhost'
      //port: 443
    }
  },

  // required for in-browser template compilation
  // https://v3.vuejs.org/guide/installation.html#with-a-bundler
  resolve: {
    alias: {
      //vue: 'vue/dist/vue.esm-bundler.js'
    }
  }
};

function svgSprite({ inputDir, outputDir }) {
  const inputPath = path.resolve(inputDir);
  const outputPath = path.resolve(outputDir);
  // const cssPath = path.resolve(cssDir);

  if (!fs.existsSync(inputPath)) {
    return;
  }
  console.log('Generating SVG sprite...');
  return {
    name: 'svg-sprite',
    buildStart: () => {
      const files = glob.sync(`${inputPath}/*.svg`);
      const spriter = new SVGSpriter({
        mode: {
          symbol: {
            dest: '.',
            inline: true,
            sprite: `${outputPath}/sprite.svg`,
            // prefix: '.u-svg-%s',
            // dimensions: '-size',
            // render: {
            //   css: {
            //     dest: `${cssPath}/svg-sprite.css`
            //   }
            // }
          },
        },
      });
      if (files.length) {
        files.forEach((file) => {
          spriter.add(file, null, fs.readFileSync(file, 'utf-8'));
        });
        spriter.compile((_, result) => {
          for (const type in result.symbol) {
            fs.mkdirSync(outputPath, { recursive: true });
            fs.writeFileSync(result.symbol[type].path, result.symbol[type].contents);
          }
        });
      }
    },
  };
}