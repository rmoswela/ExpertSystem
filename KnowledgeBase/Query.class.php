<?php

class Query
{
    private $_variable;
    private $_answer;

    public function __construct($variable)
    {
        $this->_variable = $variable;
        $this->_answer = "undetermined";
    }

    public function __get($name)
    {
        if ($name == "variable")
            return $this->_variable;
        else if ($name == "answer")
            return $this->_answer;
        else
            return "";
    }

    public function __set($name, $value)
    {
        if ($name == "variable")
            $this->_variable = $value;
        else if ($name == "answer")
            $this->_answer = $value;
    }

    public function __toString()
    {
        if ($this->_answer != "undetermined")
        {
            if ($this->_answer == "")
                return sprintf("%s is %s", $this->_variable, $this->_answer);
            else
                return sprintf("%s is %s", $this->_variable, $this->_answer ? 'true' : 'false');
        }
        else
            return sprintf("%s is not yet defined", $this->_variable);
    }
}