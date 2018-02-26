<?php
/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 19.02.2018
 * Time: 16:37
 */

namespace Couch\Doc\Fields;


/**
 * Class Int
 * @package Couch\Doc
 */
class Integer_ extends Field
{

    /**
     * @param int $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = is_numeric($value) ? (int)$value : 0;

        return $this;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return parent::getValue();
    }

}