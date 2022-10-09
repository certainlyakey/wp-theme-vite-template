module.exports = {
  plugins: {
    // 'postcss-import': {}, // imports are already handled by Vite
    'autoprefixer': {},
    'postcss-mixins': {
      mixinsFiles: './assets/css/preprocessed/mixins.css'
    },
    'postcss-nested': {},
    'postcss-normalize': {},
    'postcss-pxtorem': {
      unitPrecision: 2,
      minPixelValue: 2,
    },
  }
}
