/**
* Advanced Custom Field Accessor key copy tools
* @author Socheat <socheatsok78@gmail.com>
*/

$(document).ready(function() {
  $('#icl_div_config #icl_mcs_details p').prepend('<a onclick="apply_acf_accessor()" class="preview button">Transfer Advanced Custom Field Accessor Keys</a>')
});

function apply_acf_accessor() {
  var table = $('#icl_div_config #icl_mcs_details table tbody');
  var expression = /^_[\d\S]+/;
  var rows = table[0].rows;

  for (var i = 0; i < rows.length; i++) {
    var element = $(rows[i]);
    var validator = $(rows[i]).find('td[id]')[0].textContent;

    if (expression.test(validator)) {
      $(element).css({
        background: 'rgba(207, 73, 68, 0.3)'
      }).find('td').css({
        color: '#333'
      });
      $(element).find('td[align] label:nth-child(2) input').prop('checked', 'checked');
    }

  }
}
