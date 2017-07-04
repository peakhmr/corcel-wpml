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

  protected $with = ['meta', 'wpml'];

  /**
   * Translation data relationship.
   *
   * @return Corcel\PostMetaCollection
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
      return Translation::where('trid', $element->trid)->get();
    }

    /**
     * Overriding newQuery() to the custom PostBuilder with some interesting methods.
     *
     * @param bool $excludeDeleted
     *
     * @return Wpml\PostBuilder
     */
    public function newQuery($excludeDeleted = true)
    {
        $builder = new PostBuilder($this->newBaseQueryBuilder());
        $builder->setModel($this)->with($this->with);
        // disabled the default orderBy because else Post::all()->orderBy(..)
        // is not working properly anymore.
        // $builder->orderBy('post_date', 'desc');
        if (isset($this->postType) and $this->postType) {
            $builder->type($this->postType);
        }
        if ($excludeDeleted and $this->softDelete) {
            $builder->whereNull($this->getQualifiedDeletedAtColumn());
        }
        // dump(['newQuery ' => $this]);
        return $builder;
    }

}
