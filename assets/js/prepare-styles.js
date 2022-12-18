document.addEventListener('DOMContentLoaded', () => {
  document.getElementsByClassName('no-js')[0].classList.add('js-enabled');
  document.getElementsByClassName('no-js')[0].classList.remove('no-js');
});

window.addEventListener('load', () => {
  document.getElementsByClassName('is-page-loading')[0].classList.remove('is-page-loading');
});
