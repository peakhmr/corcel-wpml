### Advanced Custom Fields (ACF)
> The problem is WPML only translate the default `$post->meta->field_name` but not copy `meta_key` of `_field_name` that contain `field` key which ACF use to deserialize it and gets the content on the `type` key, and that is the reason why you cannot get the Object from ACF.

- Workaround tips from [Advanced Custom Fields - Multilingual Custom Fields](https://www.advancedcustomfields.com/resources/multilingual-custom-fields/)

### Field Keys Copy Tool

Add the follwing PHP script to your WordPress theme's `function.php`. This script will append a button `Transfer Advanced Custom Field Accessor Keys` to the `Multilingual Content Seup` section. This action button will toggle all `_field_key` as `copy` for you.

![Multilingual Content Seup](images/multilingual_content_seup.png)

```php
  function acf_admin_script()
  { ?>

    <!-- Update Admin Script For Advanced Custom Field -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">

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

    </script>

  <?php }
  add_action('admin_enqueue_scripts', 'acf_admin_script');

```
