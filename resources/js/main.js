window.$ = window.jQuery = require('jquery');
require('magnific-popup/dist/jquery.magnific-popup.js');
require('slick-carousel/slick/slick.min.js');


$('#header_main .persons-slider').slick({
  slidesToShow: 13,
  slidesToScroll: 13,
  dots: false,
  arrows: true,
  rtl: true,
});
