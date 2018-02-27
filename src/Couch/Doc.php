<?php
/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 19.02.2018
 * Time: 17:30
 */

namespace Couch;

use Couch\Doc\Fields\ArrayInt;
use Couch\Doc\Fields\ArrayStr;
use Couch\Doc\Fields\Date;
use Couch\Doc\Fields\Unset_;
use Couch\Doc\Fields\Field;
use Couch\Doc\Fields\Integer_;
use Couch\Doc\Fields\Null_;
use Couch\Doc\Fields\Str;


/**
 * Class Doc
 * @package Couch\Doc
 */
class Doc
{

    /**
     * @var Field[]
     */
    private $fields = [];

    /**
     * @param Field $field
     */
    public function add($field)
    {
        if ($field instanceof Field) {

            $this->fields[] = $field;
        }
    }

    /**
     * @param string $name
     * @param int[] $value
     * @return $this
     */
    public function addArrayInt($name, $value)
    {
        if (is_array($value)) {

            $arrayInt = new ArrayInt();
            $arrayInt
                ->setName((string)$name)
                ->setValue($value);

            $this->add($arrayInt);
        }

        return $this;
    }

    /**
     * @param string $name
     * @param string[] $value
     * @return $this
     */
    public function addArrayStr($name, $value)
    {
        if (is_array($value)) {

            $arrayStr = new ArrayStr();
            $arrayStr
                ->setName((string)$name)
                ->setValue($value);

            $this->add($arrayStr);
        }

        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function addStr($name, $value)
    {
        if (is_string($value)) {

            $str = new Str();
            $str
                ->setName((string)$name)
                ->setValue((string)$value);

            $this->add($str);
        }

        return $this;
    }

    /**
     * @param string $name
     * @param int $value
     * @return $this
     */
    public function addInt($name, $value)
    {
        if (is_numeric($value)) {

            $int = new Integer_();
            $int
                ->setName((string)$name)
                ->setValue((int)$value);

            $this->add($int);
        }

        return $this;
    }

    /**
     * @param string $name
     * @param $value int|string value string for strtotime like ('now', '2018-01-01 23:01:45') or timestamp int 10 or 13 digits
     * @return $this
     */
    public function addDate($name, $value)
    {
        $date = new Date();
        $date
            ->setName((string)$name)
            ->setValue($value);

        $this->add($date);

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function addNull($name)
    {
        $null = new Null_();
        $null
            ->setName((string)$name)
            ->setValue(null);

        $this->add($null);

        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function addUnset($name)
    {
        $unset = new Unset_();
        $unset->setName($name);

        $this->add($unset);

        return $this;
    }

    /**
     * remove field by name
     * @param string $name
     * @return $this
     */
    public function removeField($name)
    {
        foreach ($this->fields as $key => $field) {
            if ($field->getName() === $name) {
                array_splice($this->fields, $key, 1);
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function flush()
    {
        $this->fields = [];

        return $this;
    }

    /**
     * @return Field[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param bool $ignoreDeleteField
     * @return array
     */
    public function toArray($ignoreDeleteField = false)
    {

        $tmp = [];

        foreach ($this->fields as $field) {

            if ($ignoreDeleteField && $field instanceof Unset_) {
                continue;
            }

            $tmp[$field->getName()] = $field->getValue();
        }

        return $tmp;
    }
}