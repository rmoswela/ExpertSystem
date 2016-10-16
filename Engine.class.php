<?php

require_once('KnowledgeBase.class.php');
require_once('Query.class.php');
require_once('Fact.class.php');
require_once('Rule.class.php');

class Engine
{
	private $knowledge;
	private $leftSide;

	public function __construct($filename)
	{
		$this->knowledge = new KnowledgeBase($filename);
	}

	public function Logic($query, $provenFacts , $initialFacts, &$rules)
	{
		foreach ($initialFacts as $value)
		{
			if ($value->__get("variable") === $query)
			{
				echo $query.": query is initialFact\n";
				return true;
			}
		}

		foreach($provenFacts as $value)
		{
			if ($value->__get("variable") === $query)
			{
				echo "query is provenFact\n";
				return $value->__get("answer");
			}
		}                             

		foreach ($rules as $value)
		{
			if (trim($value->__get('right')) == trim($query))
			{
				echo "query needs further evaluation\n";
				$operator = "";
				$leftOperand = "";
				$rightOperand = "";
				$leftSide = $value->__get('left');
				if (strlen($leftSide === 1)){
					$ans = Logic($leftSide, $query, $provenFacts, $initialFacts, $rules);
					return $ans;
				}
				else
				{
					$res = $this->solveQuery($leftSide, $leftOperand, $rightOperand, $operator);
					$leftAns = $this->Logic($res[0], $provenFacts, $initialFacts, $rules);
					$rightAns = $this->Logic($res[1], $provenFacts, $initialFacts, $rules);
					$var = $this->callop($leftAns, $rightAns, $res[2]);
					$this->knowledge->addFact(new Fact($var, true));
					echo "";
				}
			}
		}
	}
		public function solveQuery($exp, $leftOperand, $rightOperand, $operator)
		{

			$order = array(
				"(" => 0,
				"!" => 1,
				"+" => 2,
				"|" => 3,
				"^" => 4,
				"=>" => 5,
				"<=>" => 6,);

			$token = explode(" ", $exp);
			$result = count($token);
			foreach($order as $key => $value)
			{
				$loop = 0;
				while ($loop < $result)
				{
					if ($key == $token[$loop])
					{
						if ($key == "+")
						{
							$operator = $key;
							$leftOperand = $token[$loop - 1];
							$rightOperand = $token[$loop + 1];
							$arr = array(0 => $leftOperand, 1 => $rightOperand, 2 => $operator);
							return ($arr);
							var_dump($rightOperand);
						}
						else if ($key == "|")
						{
							$operator = $key;
							$rightOperand = $token[$loop + 1];
							$leftOperand = $token[$loop - 1];
						}
						else if ($key == "^")
						{
							$operator = $key;
							$leftOperand = $token[$loop - 1];
							$rightOperand = $token[$loop + 1];

						}
						else if ($key == "=>")
						{
							$operator = $key;
							$leftOperand = $token[$loop - 1];
							$rightOperand = $token[$loop + 1];
						}
						else if ($key == "(")
						{
							$i = $loop + 1;
							while ($exp[$i] != ")")
							{
								$op += $exp[$i];
								$i++;
							}
							solveQuery($op, $leftOperand, $rightOperand, $operator);
						}
					}
					$loop++;
				}
			}
			echo "return from solveQuery()\n ";
		}

		function callop($left, $right, $op)
		{
			if (strcmp($op, "+") == 0)
				$this->logicalAnd($left, $right);
			if (strcmp($op, "!") == 0)
				$this->logicalNot($left, $right);
			if (strcmp($op, "|") == 0)
				$this->logicalOr($left, $right);
			if (strcmp($op, "^") == 0)
				$this->logicalXor($left, $right);
		}

		function logicalAnd($left, $right)
		{
			return ($right && $left);
		}

		function logicalOr($left, $right)
		{
			return ($right || $left);
		}

		function logicalXor($left, $right)
		{
			return ($right ^ $left);
		}

		function logicalNot($left, $right)
		{
			return (!$right);
		}
		public function theEngine()
		{
			$q = $this->knowledge->__get('queries');
			$initialFacts = $this->knowledge->__get('i_facts');
			$rules = [];
			$rules = $this->knowledge->__get('rules');
			$provenFacts = $this->knowledge->__get('p_facts');
			$value = $this->Logic($q[0]->__get('variable'), $provenFacts, $initialFacts, $rules);
			print $value. PHP_EOL;
			$this->knowledge->addFact(New Fact($q[0], $value));
		}
	}
$eng = new Engine($argv[1]);
$eng->theEngine();
?>
