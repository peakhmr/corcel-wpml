<?php

/**
 *  Translations Model
 *
 * @author Socheat <https://github.com/socheatsok78>
 */

namespace Wpml\Translation;

use Illuminate\Database\Eloquent\Model;
use Wpml\Translation\Translated;
use Wpml\Translation\Status;
use Wpml\Post;

class Translation extends Model
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
  public function post()
  {
    return $this->belongsTo(Post::class);
  }

  public function status()
  {
    return $this->hasOne(Status::class, 'translation_id');
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
