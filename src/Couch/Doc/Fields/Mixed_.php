<?php
/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 26.02.2018
 * Time: 12:03
 */

namespace Couch\Doc\Fields;


class Mixed_ extends Field
{

    public function __construct(string $name, $value)
    {
        $this->setName($name)
            ->setValue($value);
    }

    /**
     * @param $value mixed
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}