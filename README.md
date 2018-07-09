# The Laravel WordPress Multilingual Plugin (Powered by @corcel/corcel)

> This package allows you to use Corcel WordPress plugin with The WordPress Multilingual Plugin that allow you to easily build multilingual sites and run them. It’s powerful enough for corporate sites, yet simple for blogs.

[![Travis branch](https://img.shields.io/travis/peakhmr/wpml/master.svg?style=flat-square)](https://travis-ci.org/peakhmr/wpml)
[![GitHub issues](https://img.shields.io/github/issues/peakhmr/wpml.svg?style=flat-square)](https://github.com/peakhmr/wpml/issues)

## <span style="color: #EE6352;">NOTE:</span>
> @peakhmr/wpml is currently under new development. The future version will use a completely different approch by using `trait` instead of extending @corcel/corcel models.

## Installation
> This package is still in development

To install Corcel WPML, just run the following command:
```sh
composer require peakhmr/wpml
```
[![Packagist](https://img.shields.io/packagist/dt/peakhmr/wpml.svg?style=flat-square)](https://packagist.org/packages/peakhmr/wpml)
[![GitHub release](https://img.shields.io/github/release/peakhmr/wpml.svg?style=flat-square)](https://github.com/peakhmr/wpml/releases)


## Usage
---

### Posts
> Every time you see Post::method(), if you're using your own Post class (where you set the connection name), like App\Post you should use App\Post::method() and not Post::method(). All the examples are assuming you already know this difference.

```php
// All published posts
$posts = Post::published()->get();
$posts = Post::status('publish')->get();

// A specific post
$post = Post::find(31);
echo $post->post_title;

// Filter by meta/custom field
$posts = Post::published()->hasMeta('field')->get();
$posts = Post::hasMeta('acf')->get();
```

### Pages
> Pages are like custom post types. You can use Post::type('page') or the Page class.

```php
// Find a page by slug
$page = Page::slug('about')->first(); // OR
$page = Post::type('page')->slug('about')->first();
echo $page->post_title;
```

For documentation please visit [jgrossi/corcel](https://github.com/corcel/corcel#usage) for Corcel's usage and then come back here for how to use wpml plugin.

### Translations
> By using the `$post` object, we can access to the translation created by WPML.

Instead of using `Corcel\Post`, we use `Wpml\Post` to Override few variables. The plugin will look for `wp_posts.ID` in `icl_translations.element_id` and return a collection of `icl_translations.trid`.

```php
// Find a translation collection by post id or slug
$post = Post::find(31)->translation(); \\ OR
$post = Post::slug('about')->translation();

\\ Result
TranslationCollection {#1855 ▼
  #changedKeys: []
  #items: array:2 [▼
    0 => Translation {
      #original: array:6 [▼
        "translation_id" => 38
        "element_type" => "post_page"
        "element_id" => 31
        "trid" => 19
        "language_code" => "en"
        "source_language_code" => null
      ]
    }
    1 => Translation {#1853 ▶}
  ]
}
```

### Translate Post or Page
If you want to get the translated post object, use `translate()` scope and passing the `icl_translations.language_code` as parameter. This will return `Corcel\Post` object as expected.

```php
// Find a translation collection by post id or slug

$lang = 'en'; \\ OR
$lang = config('app.locale');

$post = Post::slug('about')->translate($lang);

\\ Result
Page {#1847 ▼
  #postType: "page"
  #original: array:23 [▼
    "ID" => 6
    "post_author" => 1
    "post_date" => "2017-06-12 04:49:06"
    "post_date_gmt" => "2017-06-12 04:49:06"
    "post_content" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod."
    "post_title" => "Lorem ipsum dolor sit amet"
    ...
  ]
}
```

### Advanced Custom Field, Field Keys

Add the follwing PHP script to your WordPress theme's `function.php`. This script will append a button `Transfer Advanced Custom Field Accessor Keys` to the `Multilingual Content Seup` section. This action button will toggle all `_field_key` as `copy` for you.

![Multilingual Content Seup](docs/images/multilingual_content_seup.png)

```php
  function acf_admin_script()
  { ?>

    <!-- Update Admin Script For Advanced Custom Field -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">

      /**
      * Advanced Custom Field Accessor key copy tools
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

### License
[![license](https://img.shields.io/github/license/peakhmr/wpml.svg?style=flat-square)](LICENSE)
<!-- [![Packagist](https://img.shields.io/packagist/v/peakhmr/wpml.svg?style=flat-square)](https://github.com/peakhmr/wpml/releases) -->
