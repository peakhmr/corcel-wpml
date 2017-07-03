# Corcel WPML

> This package allows you to use Corcel WordPress plugin with The WordPress Multilingual Plugin that allow you to easily build multilingual sites and run them. It’s powerful enough for corporate sites, yet simple for blogs.

[![GitHub issues](https://img.shields.io/github/issues/socheatsok78/wpml.svg?style=flat-square)](https://github.com/socheatsok78/wpml/issues)
[![GitHub release](https://img.shields.io/github/release/socheatsok78/wpml.svg?style=flat-square)](https://github.com/socheatsok78/wpml/releases)

## Installation
> This package is still in development

To install Corcel WPML, just run the following command:
```sh
composer require socheatsok78/wpml
```
[![Packagist](https://img.shields.io/packagist/dt/socheatsok78/wpml.svg?style=flat-square)](https://packagist.org/packages/socheatsok78/wpml)


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
// Find a translation collection by post id
$post = Post::find(31)->translation(); \\ OR
$post = Post::slug('about')->translation();

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

### Not working
- Advanced Custom Fields (ACF)
> The problem is WPML only translate the default `$post->meta->field_name` but not copy `meta_key` of `_field_name` that contain `field` key which ACF use to deserialize it and gets the content on the `type` key, and that is the reason why you cannot get the Object from ACF.

### License
[![license](https://img.shields.io/github/license/socheatsok78/wpml.svg?style=flat-square)](LICENSE)
