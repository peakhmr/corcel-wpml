<?php

/**
 *  Translations Status Model
 *
 * @author Socheat <https://github.com/socheatsok78>
 */

namespace Wpml\Translation;

use Illuminate\Database\Eloquent\Model;
use Wpml\Translation\Translated;

class Status extends Model
{

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $connection = 'wordpress';
  protected $table = 'icl_translation_status';
  protected $primaryKey = 'translation_id';

  /**
   * Post relationship.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function post()
  {
    return $this->belongsTo(Translated::class, 'translation_id');
  }

}
