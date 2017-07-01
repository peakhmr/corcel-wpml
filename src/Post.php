<?php

/**
 *  Post Model
 *
 * @author Socheat <https://github.com/socheatsok78>
 */

namespace Wpml;

use Corcel\Post as Corcel;
use Wpml\Translation\Translation;

class Post extends Corcel
{

  /** @var array */
  protected $with = ['meta', 'wpml'];

  /**
   * Post Translations relationship.
   *
   * @return Wpml\Translation\Translation
   */
  public function wpml()
  {
    return $this->hasOne(Translation::class, 'element_id');
  }

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = [
    'title',
    'slug',
    'content',
    'type',
    'mime_type',
    'url',
    'author_id',
    'parent_id',
    'created_at',
    'updated_at',
    'excerpt',
    'status',
    'image',

    // Translations
    'language',

    // Terms inside all taxonomies
    'terms',

    // Terms analysis
    'main_category',
    'keywords',
    'keywords_str',
    ];

    /**
     * Gets the value.
     * Tries to unserialize the object and returns the value if that doesn't work.
     *
     * @return value
     */
    public function getLanguageAttribute()
    {
      return $this->wpml->language_code;
    }

}
