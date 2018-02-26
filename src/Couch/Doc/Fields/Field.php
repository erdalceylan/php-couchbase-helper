<?php
/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 19.02.2018
 * Time: 16:36
 */

namespace Couch\Doc\Fields;


/**
 * Class Field
 * @package Couch\Doc
 */
abstract class Field
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string
     * @return $this
     */
    public function setName($name)
    {
        $this->name = preg_replace("/[^0-9a-zA-Z\-\_]/", "", $name);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value mixed
     * @return $this
     */
    public abstract function setValue($value);
}