<?php

class Rule
{
    private $_left;
    private $_symbol;
    private $_right;

    public function __construct($left, $symbol, $right)
    {
        $this->_left = $left;
        $this->_symbol = $symbol;
        $this->_right = $right;
    }

    public function __get($name)
    {
        if ($name == "left")
            return $this->_left;
        else if ($name == "symbol")
            return $this->_symbol;
        else if ($name == "right")
            return $this->_right;
        else
            return "";
    }

    public function __set($name, $value)
    {
        if ($name == "left")
            $this->_left = $value;
        else if ($name == "symbol")
            $this->_symbol = $value;
        else if ($name == "right")
            $this->_right = $value;
    }

    public function __toString()
    {
        return sprintf("%s %s %s", $this->_left, $this->_symbol, $this->_right);
    }
}

?>