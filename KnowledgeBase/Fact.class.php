<?php

class Fact
{
    private $_variable;
    private $_fact;

    public function __construct($variable, $fact)
    {
        $this->_variable = $variable;
        $this->_fact = $fact;
    }

    public function __get($name)
    {
        if ($name == "variable")
            return $this->_variable;
        else if ($name == "fact")
            return $this->_fact;
        else
            return "";
    }

    public function __set($name, $value)
    {
        if ($name == "variable")
            $this->_variable = $value;
        else if ($name == "fact")
            $this->_fact = $value;
    }

    public function __toString()
    {
        return sprintf("%s is %s", $this->_variable, $this->_fact ? 'true' : 'false');
    }
}

?>