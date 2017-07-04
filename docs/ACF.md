### Advanced Custom Fields (ACF)
> The problem is WPML only translate the default `$post->meta->field_name` but not copy `meta_key` of `_field_name` that contain `field` key which ACF use to deserialize it and gets the content on the `type` key, and that is the reason why you cannot get the Object from ACF.

- Workaround tips from [Advanced Custom Fields - Multilingual Custom Fields](https://www.advancedcustomfields.com/resources/multilingual-custom-fields/)
