<?php

/**
 *  Post Model
 *
 * @author Socheat <https://github.com/socheatsok78>
 */

namespace Wpml;

use Corcel\Post as Corcel;

class Post extends Corcel
{

  /** @var array */
  protected $with = ['meta', 'wpml'];

  /**
   * Post Translations relationship.
   *
   * @return WPML\Core\WPMLPost
   */
  public function wpml()
  {
    return $this->hasMany('Wpml\Translation\Translation', 'element_id');
  }

}
