<?php
/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 22.02.2018
 * Time: 15:21
 */

namespace Couch\Doc\Fields;


/**
 * Class Null
 * @package Couch\Doc\Fields
 */
class Null_ extends Field
{

    /**
     * @param $value null
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = null;

        return $this;
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return parent::getValue();
    }
}