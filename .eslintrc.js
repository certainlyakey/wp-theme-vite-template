// eslint-disable-next-line no-undef
module.exports = {
  env: {
    browser: true,
    es2021: true
  },
  extends: ['eslint:recommended', 'plugin:prettier/recommended'],
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module'
  },
  globals: {
    scriptData: 'readonly'
  },
  rules: {
    'prettier/prettier': ['warn'],
    'no-var': ['error'],
    'no-constant-binary-expression': ['error'],
    'no-duplicate-imports': ['error'],
    'no-use-before-define': ['error'],
    'no-unreachable-loop': ['error'],
    'block-scoped-var': ['error'],
    'dot-notation': ['error'],
    'no-alert': ['error'],
    'no-bitwise': ['error'],
    'no-confusing-arrow': ['error'],
    'no-console': ['warn'],
    'no-else-return': ['error'],
    'no-eval': ['error'],
    'no-implicit-coercion': ['error'],
    'no-invalid-this': ['error'],
    'no-lonely-if': ['error'],
    'no-mixed-operators': ['error'],
    'no-multi-assign': ['error'],
    'no-multi-str': ['error'],
    'no-negated-condition': ['error'],
    'no-nested-ternary': ['error'],
    'no-new-wrappers': ['error'],
    'no-param-reassign': ['error'],
    'no-shadow': ['error'],
    'no-undef-init': ['error'],
    'no-unneeded-ternary': ['error'],
    'no-unused-expressions': ['error'],
    'no-useless-concat': ['error'],
    'no-useless-return': ['error'],
    'no-warning-comments': ['warn'],
    'no-empty-function': ['error'],
    'prefer-const': ['error'],
    'prefer-arrow-callback': ['error'],
    'prefer-template': ['error'],
    'operator-assignment': ['error', 'never'],
    'quote-props': ['warn', 'consistent-as-needed'],
    'eqeqeq': ['error'],
    'vars-on-top': ['error'],
    'curly': ['error'],
    'spaced-comment': ['error'],
    'camelcase': ['error']
  },
  overrides: [
    {
      files: ['vite.config.js', 'postcss.config.js', 'assets/css/preprocessed/*.js', 'assets/utils/postcss/*.js'],
      env: {
        node: true,
        es2021: true
      },
      rules: {
        'no-console': 'off'
      }
    }
  ]
};
