(function ($) {
  "use strict";

  //cookieMonster module
  var cookieMonster = (function() {

    //Info bar element
    var $banner;

    //Hides the Info Bar
    var hide = function() {
      $banner.animate({
        height: '0'
      }, 750);
    };

    //Detects the cookie pref
    var onPref = function(e) {
      e.preventDefault();
      var pref = $(this).hasClass('allow') ? true : false;
      setPref(pref);
      hide();
    };

    //Sets user cookie preference
    var setPref = function() {
      $.cookie('cookie-pref', pref, { path: '/' });
    };

    return {
      init: function(el) {
        $banner = $(el);
        $banner.on('click', '.hide', onPref);
      }
    };
  }());

  $(function () {
    cookieMonster.init('.cookie-monster-banner');
  });
}(jQuery));
