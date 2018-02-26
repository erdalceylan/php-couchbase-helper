<?php
/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 19.02.2018
 * Time: 16:36
 */

namespace Couch\Doc\Fields;


/**
 * Class Date
 * @package Couch\Doc
 */
class Date extends Field
{
    /**
     * @param $value int|string value string for strtotime like ('now', '2018-01-01 23:01:45') or timestamp int 10 or 13 digits
     * @return $this
     */
    public function setValue($value)
    {
        $tmpVal = $value;
        if (is_string($tmpVal) && strtotime($tmpVal)) {
            $tmpVal = strtotime($tmpVal);
        }

        $tmpVal = is_numeric($tmpVal) ? $tmpVal : "0";
        $tmpVal = str_pad($tmpVal, 13, "0");

        $this->value = (int)$tmpVal;

        return $this;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return parent::getValue();
    }

    /**
     * @param string $format
     * @return false|string
     */
    public function format($format = "Y-m-d H:i:s")
    {
        return date($format, substr((string)$this->getValue(), 0, 10));
    }
}