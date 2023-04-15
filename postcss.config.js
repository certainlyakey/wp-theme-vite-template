const generateCSSBreakpoints = require('./assets/utils/postcss/generate-css-breakpoints.js');
const breakpoints = require('./assets/css/preprocessed/breakpoints.json');
const zIndexStack = require('./assets/css/preprocessed/z-index.js');

const isDev = process.env.GENERATE_ASSETS_FOR_DEV && process.env.GENERATE_ASSETS_FOR_DEV === 'true';

module.exports = {
  plugins: {
    // 'postcss-import': {}, // imports are already handled by Vite
    'stylelint': {},
    'postcss-reporter': {
      clearReportedMessages: true,
      plugins: ['stylelint']
    },
    'postcss-mixins': {
      mixinsFiles: './assets/css/preprocessed/mixins.css'
    },
    'postcss-simple-vars': {
      /* eslint-disable camelcase */
      variables: {
        ...generateCSSBreakpoints(breakpoints),
        _is_env_dev: isDev,
        _assets_path: isDev ? '/assets' : '../assets'
      }
    },
    'postcss-nested': {},
    'postcss-normalize': {},
    'postcss-pxtorem': {
      unitPrecision: 2,
      minPixelValue: 2
    },
    'postcss-stack': {
      list: zIndexStack,
      increment: 100
    },
    'autoprefixer': {}
  }
};
