const generateCSSBreakpoints = require('./assets/utils/generate-css-breakpoints.js');
const breakpoints = require('./assets/css/preprocessed/breakpoints.json');
const zIndexStack = require('./assets/css/preprocessed/z-index.js');

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
      variables: generateCSSBreakpoints(breakpoints)
    },
    'postcss-nested': {},
    'postcss-normalize': {},
    'postcss-pxtorem': {
      unitPrecision: 2,
      minPixelValue: 2
    },
    'postcss-stack': {
      list: zIndexStack
    },
    autoprefixer: {}
  }
};
