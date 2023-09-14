
jQuery(document).ready(function() {
  jQuery('a[href^="#"]').click(function() {
      var target = jQuery(this.hash);
      if (target.length == 0) target = jQuery('a[name="' + this.hash.substr(1) + '"]');
      if (target.length == 0) target = jQuery('html');
      jQuery('html, body').animate({ scrollTop: target.offset().top-95 }, 1000);
      return false;
  });
});
