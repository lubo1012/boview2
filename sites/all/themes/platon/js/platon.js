/**
 * @file
 * Define theme JS logic.
 */

;(function($, Drupal, window, undefined) {

  /**
   * Implement a dummy on(). OG and Bootstrap use it a lot. But Drupal is not compatible.
   */
  if (typeof $.fn.on === 'undefined') {
    $.fn.on = function() { return this; };
  }

  Drupal.behaviors.platon = {

    attach: function(context) {

      /**
       * Opigno Tools
       * Make the entire tool "block" clickable for a better UX.
       */
      $('.opigno-tool-block', context).each(function() {
        var $this = $(this);
        $this.click(function() {
          window.location = $this.find('a.opigno-tool-link').attr('href');
        }).addClass('platon-js-processed');
      });
    }

  };

})(jQuery, Drupal, window);