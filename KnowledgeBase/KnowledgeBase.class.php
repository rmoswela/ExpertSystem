<?php

require_once ("Fact.class.php");
require_once ("Rule.class.php");
require_once ("Query.class.php");

class KnowledgeBase
{
    private $_rules;
    private $_initial_facts;
    private $_proven_facts;
    private $_queries;

    public function __construct($filename)
    {
        if (file_exists($filename) == true)
        {
            $data = $this->GetData($filename);
            $this->_rules = $this->GetRules($data);
            $this->_initial_facts = $this->GetFacts($data);
            $this->_queries = $this->GetQueries($data);
            $this->_proven_facts = array();
        }
        else
        {
            $this->_rules = array();
            $this->_initial_facts = array();
            $this->_queries = array();
        }
    }

    private function GetData($filename)
    {
        $contents = file_get_contents($filename);
        $contents = explode("\n", trim($contents));
        $data = array();
        foreach ($contents as $line)
        {
            if ($line[0] != "#")
            {
                $info = explode("#", $line);
                array_push($data, $info[0]);
            }
        }
        return $data;
    }

    private function GetRules($data)
    {
        $rules = array();
        $count = 0;
        $op = "";
        foreach ($data as $line)
        {
            $count++;
            if ($line[0] != "=" && $line[0] != "?")
            {
                if (strpos($line, "<=>") != false)
                {
                    $op = "<=>";
                    $this->validateRule($line, $count, $op);
                }
                else if (strpos($line, "=>") != false)
                {
                    $op = "=>";
                    $this->validateRule($line, $count, $op);
                }
                if ($op == "<=>" || $op == "=>")
                {
                    //
                    $rule = explode($op, trim($line));
                    array_push($rules, new Rule($rule[0], $op, $rule[1]));
                }
            }
        }
        return $rules;
    }

    private function validateRule($rule, $count, $op)
    {
        $operator = array(0=>'+', 1=>'|', 2=>'^', 3=>'!');
        if ($op === "<=>")
        {
            $rule = preg_replace('/s/','',$rule);
            for ($i = 0; $i < strlen($rule); $i++)
            {
                $item = $rule[$i];
                if ($item >= 'A' && $item <= 'Z')
                {
                    $i++;
                    $item = $rule[$i];
                    //Check for operator
                    if (in_array($item,$operator))
                    {

                    }
                }
            }
        }
        elseif ($op === "=>")
        {

        }
        echo "Parse error on line $count" . PHP_EOL;
        exit();

    }

    private function GetFacts($data)
    {
        $facts = array();
        $count = 0;
        foreach ($data as $line)
        {
            $count++;
            if ($line[0] == "=")
            {
                $line = trim(explode("=", trim($line))[1]);
                $vars = strlen($line);
                for ($i = 0; $i < $vars; $i++)
                {
                    if (preg_match('/[A-Z]+/', $line[$i]) == false)
                    {
                        echo "Parse error on facts, line $count".PHP_EOL;
                        exit();
                    }
                    array_push($facts, new Fact($line[$i], true));
                }
            }
        }
        return $facts;
    }

    private function GetQueries($data)
    {
        $queries = array();
        foreach ($data as $line)
        {
            if ($line[0] == "?")
            {
                $line = trim(explode("?", trim($line))[1]);
                $vars = strlen($line);
                for ($i = 0; $i < $vars; $i++)
                    array_push($queries, new Query($line[$i]));
            }
        }
        return $queries;
    }

    public function __toString()
    {
        $output = "Rules =========================".PHP_EOL;
        foreach ($this->_rules as $rule)
            $output = $output.$rule.PHP_EOL;
        $output = $output."Initial Facts =================".PHP_EOL;
        foreach ($this->_initial_facts as $fact)
            $output = $output.$fact.PHP_EOL;
        $output = $output."Proven Facts ==================".PHP_EOL;
        foreach ($this->_proven_facts as $fact)
            $output = $output.$fact.PHP_EOL;
        $output = $output."Queries =======================".PHP_EOL;
        foreach ($this->_queries as $query)
            $output = $output.$query.PHP_EOL;
        return $output;
    }

    public function getQuery($var)
    {
        foreach ($this->_queries as $query) {
            
            if ($query->__get('variable') === $var) 
            {
                return ($query);
            }
        }
    }
    
    public function __get($name)
    {
        if ($name == "rules")
            return $this->_rules;
        else if ($name == "i_facts")
            return $this->_initial_facts;
        else if ($name == "p_facts")
            return $this->_proven_facts;
        else if ($name == "queries")
            return $this->_queries;
        else
            return false;
    }

    public function getQuery($var)
    {
        foreach ($this->_queries as $query) {
            
            if ($query->__get('variable') === $var) 
            {
                return ($query);
            }
        }
    }

    public function isInferred($variable)
    {
        foreach ($this->_rules as $rule)
        {
            if ($variable === $rule->__get("right"))
            {
                return ($rule->__get("left"));
            }
        }
    }

    public function addFact($fact)
    {
        array_push($this->_proven_facts, $fact);
    }
}

?>