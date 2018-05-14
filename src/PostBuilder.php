<?php

/**
 *  PostBuilder for Post
 *
 * @author Socheat <https://github.com/socheatsok78>
 */

namespace Wpml;

use Corcel\Model\Builder\PostBuilder as Builder;
use Wpml\Translation\Translation;

class PostBuilder extends Builder
{

    public function translate($lang)
    {
      // Getting current post object
        $origin = $this->first();

      // Find Translation Group ID
        $element = Translation::where('element_id', $origin->ID)->first();

      // Find Translation collection
        $translations = Translation::where('trid', $element->trid)->where('language_code', $lang)->first();
        if (empty($translations)) {
            $translations = Translation::where('trid', $element->trid)->where('source_language_code', null)->first();
        }

      // Getting Post Object
        $post =  Post::find($translations->element_id);

        return collect([ $post ]);
    }
}
