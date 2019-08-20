const env = {
  URL: 'https://www.israel-bidur.co.il',

  // В БУДУЩЕМ ПЕРЕЙТИ НА MOBILE (CAPS)
  mobile: (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1),
  MOBILE: (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1),
}

if(/localhost/.test(window.location.href)) {
  env.STAGE = 'dev';
} else {
  env.STAGE = 'prod';
}

window.env = env;

export default env;
