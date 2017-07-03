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


    /**
     * Scope a query for translated posts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTranslation()
    {
      // Find Translation Group ID
      $element = Translation::where('element_id', $this->ID)->first();

      // Find Translation collection
      $translations = Translation::where('trid', $element->trid)->get();

      return $translations;
    }

    public function scopeTranslate($query, $lang = '')
    {
      # code...
    }

}
