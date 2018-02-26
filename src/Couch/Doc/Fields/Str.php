<?php
/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 19.02.2018
 * Time: 16:37
 */

namespace Couch\Doc\Fields;


/**
 * Class Str
 * @package Couch\Doc
 */
class Str extends Field
{
    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = (string)$value;

        return $this;
    }
}