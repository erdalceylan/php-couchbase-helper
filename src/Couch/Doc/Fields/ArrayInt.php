<?php
/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 19.02.2018
 * Time: 16:37
 */

namespace Couch\Doc\Fields;


/**
 * Class ArrayInt
 * @package Couch\Doc
 */
class ArrayInt extends Field
{

    /**
     * @param $value array
     * @return $this
     */
    public function setValue($value)
    {
        $value = is_array($value) ? $value : [];

        $this->value = array_map(function ($item) {
            return (int)$item;
        }, $value);

        return $this;
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return parent::getValue();
    }
}