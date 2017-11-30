<?php

namespace Fewbricks\ACF;

/**
 * Class Item
 *
 * Generic ACF item used for anything that has a label, name, key and settings
 *
 * @package Fewbricks\ACF
 */
class Item
{

    /**
     * @var The key of the brick, if any, that this item is part of.
     */
    protected $brickKey;

    /**
     * @var The key required by ACF. Must be unique across the site.
     */
    protected $key;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|boolean A place to store the original key before we merge it
     * with parent field groups, bricks etc.
     */
    protected $originalKey;

    /**
     * The array that makes up the field.
     * https://www.advancedcustomfields.com/resources/register-fields-via-php/#field-settings
     *
     * @var array
     */
    protected $settings;

    /**
     * Field constructor.
     *
     * @param string $label    The label of the field
     * @param string $name     The name of the field
     * @param string $key      The key of the field. Must be unique across the
     *                         entire app
     * @param array  $settings Array where you can pass all the possible
     *                         settings for the field.
     *                         https://www.advancedcustomfields.com/resources/register-fields-via-php/#field-type%20settings
     */
    public function __construct($label, $name, $key, $settings = [])
    {

        // Lets keep these crucial settings as class vars to make them easier
        // and nicer to access.
        $this->label = $label;
        $this->name  = $name;
        $this->key   = $key;

        // ACF states that keys must start with field_ but let's wait with
        // ensuring that until the key has been prepended with keys of
        // field groups, bricks etc.

        $this->setSettings($settings);

        $this->originalKey = $key;

        $this->brickKey = false;

    }

    /**
     * @param $key
     *
     * @return $this
     */
    public function setBrickKey($key)
    {

        $this->brickKey = $key;

        return $this;

    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function setKey($key)
    {

        $this->key = $key;

        return $this;

    }

    /**
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function setSetting($name, $value)
    {

        $classVars = ['key', 'label', 'name', 'type'];

        // Make sure to keep any crucial setting class vars up to date
        if (in_array($name, $classVars)) {
            $this->{$name} = $value;
        }

        $this->settings[$name] = $value;

        return $this;

    }

    /**
     * Allows you to set multiple settings at once.
     *
     * @param $settings
     *
     * @return $this
     */
    public function setSettings($settings)
    {

        foreach ($settings AS $name => $value) {

            $this->setSetting($name, $value);

        }

        return $this;

    }

    /**
     * Enables you to set a bunch of ACF settings at once.
     *
     * @param array $settings Associative array with settings name as key and
     *                        value as value.
     *
     * @return $this
     */
    public function addSettings($settings)
    {

        foreach ($settings as $name => $value) {

            $this->setSetting($name, $value);

        }

        return $this;

    }

    /**
     * @return string|boolean
     */
    public function getBrickKey()
    {

        return $this->brickKey;

    }

    /**
     * @return string The key of the field
     */
    public function getKey()
    {

        return $this->key;

    }

    /**
     * @return string
     */
    public function getOriginalKey()
    {

        return $this->originalKey;

    }

    /**
     * Get the value of a specific setting. Please note that you can only
     * get the settings that you have set when creating the instance.
     * Any default values that are set by ACF and that has not been overridden
     * in this instance will return the $defaultValue
     *
     * @param string $name         The name of the setting to get
     * @param bool   $defaultValue Value to return if setting is not set
     *
     * @return mixed $defaultValue if value was not found, otherwise the value
     */
    public function getSetting($name, $defaultValue = false)
    {

        $value = $defaultValue;

        if (isset($this->settings[$name])) {

            $value = $this->settings[$name];

        }

        return $value;

    }

    /**
     * @return array
     */
    public function getSettings()
    {

        // Put the crucial settings into the settings array
        $tmp_settings          = $this->settings;
        $tmp_settings['key']   = $this->key;
        $tmp_settings['label'] = $this->label;
        $tmp_settings['name']  = $this->name;

        return $tmp_settings;

    }

    /**
     * @param $prepend
     */
    public function prependKey($prepend)
    {

        $this->key = $prepend . $this->key;

    }

}
