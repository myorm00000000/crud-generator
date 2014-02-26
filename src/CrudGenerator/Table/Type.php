<?php

namespace CrudGenerator\Table;


class Type implements TypeInterface
{

    CONST INTEGER = 1;
    CONST TINYINT = 11;
    CONST VARCHAR = 2;
    CONST ENUM = 3;
    CONST TEXT = 4;
    CONST DOUBLE = 6;
    CONST FLOAT = 7;
    CONST REAL = 77;
    CONST BOOL = 8;
    CONST CHAR = 9;
    CONST DATE = 10;
    CONST DATETIME = 11;
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
     * @inheritdoc
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @inheritdoc
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @inheritdoc
     */
    public function setName($type)
    {
        $this->name = $type;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @inheritdoc
     */
    public function getOptions()
    {
        return $this->options;
    }

}