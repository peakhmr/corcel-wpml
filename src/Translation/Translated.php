<?php

/**
 *  Translations Model
 *
 * @author Socheat <https://github.com/socheatsok78>
 */

namespace Wpml\Translation;

use Illuminate\Database\Eloquent\Model;
use Wpml\Post;

class Translated extends Model
{

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $connection = 'wordpress';
  protected $table = 'icl_translations';
  protected $primaryKey = 'translation_id';

  /**
   * Post relationship.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function translate()
  {
    return $this->belongsTo(Translated::class);
  }

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = ['value'];

  /**
   * Gets the value.
   * Tries to unserialize the object and returns the value if that doesn't work.
   *
   * @return value
   */
  public function getValueAttribute()
  {
    switch ($this->element_type) {
      case 'post_page':
        $data = Post::find($this->element_id);
        break;

      default:
        $data = $this->element_id;
        break;
    }

    return $data;
  }

  /**
   * Override newCollection() to return a custom collection.
   *
   * @param array $models
   *
   * @return Wpml\Translation\TranslationsCollection
   */
  public function newCollection(array $models = [])
  {
    return new TranslationCollection($models);
  }

}
