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

    //Prepends the Info Bar to the Body element
    var prepend = function() {
      $banner.css({ position : 'relative' }).prependTo('body');
      $banner.on('click', '.hide', setPref);
    };

    //Sets user cookie preference
    var setPref = function(e) {
      e.preventDefault();
      var pref = $(this).hasClass('allow') ? true : false;
      $.cookie('cookie-pref', pref, { path: '/' });
      hide();
    };

    return {
      init: function(el) {
        $banner = $(el);
        if ($.cookie('cookie-pref') === null) { prepend(); }
      }
    };
  }());

  $(function () {
    cookieMonster.init('.cookie-monster-banner');
  });
}(jQuery));
