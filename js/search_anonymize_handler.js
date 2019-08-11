(function($, Drupal) {

  Drupal.behaviors.searchForm = {
    attach: function (context, settings) {
      // handle form click and stuff the domain name in front...
      $('#anonymize-search-form').unbind('submit').bind('submit', function(e) {
        var searchcri = $('#searchbox').val();
        $('#searchbox').val('site:' + $('#anonymize-search-form').data('domain') + ' ' + searchcri);
      });
    }
  };

})(jQuery, Drupal);
