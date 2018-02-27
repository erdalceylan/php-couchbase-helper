<?php
/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 20.02.2018
 * Time: 09:48
 */

namespace Couch\Doc\Fields;


/**
 * Class Delete
 * @package Couch\Doc
 */
class Unset_ extends Field
{

    /**
     * Delete constructor.
     * @param string $name
     */
    public function __construct($name = "")
    {
        if ($name) {
            $this->setName($name);
        }
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return null;
    }

    /**
     * @param $value mixed
     * @deprecated
     * @return $this
     */
    public function setValue($value)
    {
        return $this;
    }
}