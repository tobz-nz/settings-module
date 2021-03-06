<?php namespace Anomaly\SettingsModule\Setting;

use Anomaly\SettingsModule\Setting\Command\GetValueFieldType;
use Anomaly\SettingsModule\Setting\Command\GetValuePresenter;
use Anomaly\SettingsModule\Setting\Command\ModifyValue;
use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Model\Settings\SettingsSettingsEntryModel;

/**
 * Class SettingModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\SettingsModule\SettingInterface
 */
class SettingModel extends SettingsSettingsEntryModel implements SettingInterface
{

    /**
     * The cache minutes.
     *
     * @var int
     */
    protected $cacheMinutes = 99999;

    /**
     * Get the key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the key.
     *
     * @param $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value attribute.
     *
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set the value.
     *
     * @param $value
     * @return $this
     */
    protected function setValueAttribute($value)
    {
        $this->attributes['value'] = $this->dispatch(new ModifyValue($this, $value));

        return $this;
    }

    /**
     * Get the value attribute.
     *
     * @return mixed
     */
    protected function getValueAttribute()
    {
        /* @var FieldType $type */
        $type = $this->dispatch(new GetValueFieldType($this));

        if (!$type) {
            return $this->attributes['value'];
        }

        return $type->getValue();
    }

    /**
     * Get the field type's presenter
     * for a given field slug.
     *
     * We're overriding this to catch
     * the "value" key.
     *
     * @param $fieldSlug
     * @return FieldTypePresenter
     */
    public function getFieldTypePresenter($fieldSlug)
    {
        if ($fieldSlug == 'value') {
            return $this->dispatch(new GetValuePresenter($this));
        }

        return parent::getFieldTypePresenter($fieldSlug);
    }
}
