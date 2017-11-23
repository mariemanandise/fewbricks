<?php

namespace Fewbricks\ACF\Fields;

/**
 * Class Gallery
 * Corresponds to the gallery field type in ACF.
 * This class is more or less completely stupid and only exists
 * to accommodate quicker creation especially if you are using
 * a real IDE with auto completion. All the magic takes place in the
 * Field class.
 *
 * @package Fewbricks\ACF\Fields
 */
class Gallery extends FieldWithImages
{

    /**
     * @param string $label    The label of the field
     * @param string $name     The name of the field
     * @param string $key      The key of the field. Must be unique across the
     *                         entire app
     * @param array  $settings Array where you can pass all the possible
     *                         settings for the field.
     *                         https://www.advancedcustomfields.com/resources/register-fields-via-php/#field-type%20settings
     * @param array  $void     Not used. Exists only to match the nr of args of parent
     *                         constructor.
     */
    public function __construct(
        $label,
        $name,
        $key,
        $settings = [],
        $void = null
    ) {

        parent::__construct('gallery', $label, $name, $key, $settings);

    }

    /**
     * ACF setting. Specify where new attachments are added
     *
     * @param $insert append or prepend
     *
     * @return Gallery $this
     */
    public function setInsert($insert)
    {

        $this->setSetting('insert', $insert);

        return $this;

    }

    /**
     * ACF setting.
     *
     * @param int $maximumSelection
     *
     * @return Gallery $this
     */
    public function setMaximumSelection($maximumSelection)
    {

        $this->setSetting('max', $maximumSelection);

        return $this;

    }

    /**
     * ACF setting.
     *
     * @param int $minimumSelection
     *
     * @return Gallery $this
     */
    public function setMinimumSelection($minimumSelection)
    {

        $this->setSetting('min', $minimumSelection);

        return $this;

    }

}
