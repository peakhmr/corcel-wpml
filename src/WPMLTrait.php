<?php
namespace Wpml;

/**
 * The WordPress Multilingual [WPML] Plugin for Corcel/Laravel Trait
 * 
 * @author Socheat Sok <socheatsok78@gmail.com>
 * @package peakhmr/wpml
 */

trait WPMLTrait {

  /**
   * Extend $with variable
   *
   * @var array
   */
  protected $extendWith = [];

  public function __constructor() {
    /**
     * Referencing $with from parent Model with the extended trait
     */
    $this->with = $this->extendWith;
  }

}