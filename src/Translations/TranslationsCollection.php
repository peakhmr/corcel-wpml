<?php

namespace Wpml\Translations;

use Illuminate\Database\Eloquent\Collection;

/**
 *  WPML TranslationsCollection
 *
 * @author Socheat <https://github.com/socheatsok78>
 */
class TranslationsCollection extends Collection
{
   protected $changedKeys = [];


  /**
   * Search for the desired key and return only the row that represent it.
   *
   * @param string $key
   *
   * @return string
   */
  public function getAttribute($key)
  {
    foreach ($this->items as $item) {
      if ($item->language_code == $key) {
        return $item->value;
      }
    }
  }

  /**
   * Shortcut for the getAttribute method, by passing an object attribute
   *
   * @param string $key
   *
   * @return string
   */
  public function __get($key)
  {
    return $this->getAttribute($key);
  }

}
