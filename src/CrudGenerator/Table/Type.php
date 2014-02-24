<?php

namespace CrudGenerator\Table;


class Type
{

    CONST INTEGER = 1;
    CONST TINYINT = 100;
    CONST VARCHAR = 2;
    CONST ENUM = 3;
    CONST TEXT = 4;
    CONST DOUBLE = 6;
    CONST FLOAT = 7;
    CONST REAL = 70;
    CONST BOOL = 8;
    CONST CHAR = 9;
    CONST DATE = 10;
    CONST DATE_TIME = 11;
    CONST TIME = 12;
    CONST TIMESTAMP = 13;
    CONST BLOB = 14;
    CONST UNKNOWN = 15;

    /**
     * @var int
     */
    private $name;

    /**
     * @var int
     */
    private $length;

    /**
     * @var array
     */
    private $options;

    /**
     * @param int $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $type
     */
    public function setName($type)
    {
        $this->name = $type;
    }

    /**
     * @return int
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

}