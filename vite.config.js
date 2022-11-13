// View your website at your own local server
// for example http://vite-php-setup.test

// http://localhost:3000 is serving Vite on development
// but accessing it directly will be empty

// IMPORTANT image urls in CSS works fine
// BUT you need to create a symlink on dev server to map this folder during dev:
// ln -s {path_to_vite}/src/assets {path_to_public_html}/assets
// on production everything will work just fine

import themeConfig from './common_config.json';
import liveReload from 'vite-plugin-live-reload';
import SVGSpriter from 'svg-sprite';
import glob from 'glob';
import path from 'path';
import fs from 'fs';

const isDev = process.env.GENERATE_ASSETS_FOR_DEV && process.env.GENERATE_ASSETS_FOR_DEV === 'true';

if (isDev) {
  console.log(themeConfig.lando_vite_port, 'Vite config loaded');
}

function getLandoProxyURL() {
  if (process.env.LANDO_INFO) {
    const landoInfo = JSON.parse(process.env.LANDO_INFO);
    if (landoInfo.node.urls[0]) {
      return new URL(landoInfo.node.urls[0]).host;
    }
  }
  return false;
}

const landoProxyURL = getLandoProxyURL();

if (isDev) {
  console.log(landoProxyURL ? `Lando proxy URL is: ${landoProxyURL}` : 'Lando proxy URL is not found');
}

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
            sprite: `${outputPath}/sprite.svg`
            // prefix: '.u-svg-%s',
            // dimensions: '-size',
            // render: {
            //   css: {
            //     dest: `${cssPath}/svg-sprite.css`
            //   }
            // }
          }
        }
      });
      if (files.length) {
        files.forEach((file) => {
          spriter.add(file, null, fs.readFileSync(file, 'utf-8'));
        });
        spriter.compile((_, result) => {
          for (const type in result.symbol) {
            fs.mkdirSync(outputPath, { recursive: true });
            const symbolType = result.symbol[type];
            fs.writeFileSync(symbolType.path, symbolType.contents);
          }
        });
      }
    }
  };
}

/** @type {import('vite').UserConfig} */
export default {
  plugins: [
    liveReload([`${__dirname}/**/*.php`, `${__dirname}/**/*.twig`]),
    svgSprite({
      inputDir: './assets/images/svg-sprite-source',
      outputDir: './dist/assets'
      // cssDir: './assets/css/generated',
    })
  ],

  root: '',
  base: isDev ? '/' : '/dist/',

  // production build
  build: {
    outDir: path.resolve(__dirname, './dist'),
    emptyOutDir: true,

    // Emit manifest so PHP can find the hashed files
    manifest: true,
    target: 'es2018',
    rollupOptions: {
      input: {
        main: path.resolve(`${__dirname}/main.js`)
      }
    },
    minify: true,
    write: true
  },

  // local HMR server
  server: {
    // Required to load scripts from custom host
    cors: true,
    // We need a strict port to match on PHP side
    strictPort: true,
    port: landoProxyURL ? themeConfig.lando_vite_port : 3000,
    host: landoProxyURL ? true : 'localhost',
    https: false,
    hmr: {
      host: landoProxyURL ? landoProxyURL : 'localhost'
    }
  }
};
