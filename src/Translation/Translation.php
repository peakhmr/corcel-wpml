<?php

/**
 *  Translations Model
 *
 * @author Socheat <https://github.com/socheatsok78>
 */

namespace Wpml\Translation;

use Illuminate\Database\Eloquent\Model;
use Wpml\Translation\Translated;
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

  /** @var array */
  protected $with = ['translate'];

  /**
   * Post relationship.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function post()
  {
    return $this->belongsTo(Post::class);
  }

  public function translate()
  {
    return $this->hasMany(Translated::class, 'trid', 'trid');
  }

}
