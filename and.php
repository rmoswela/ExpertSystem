<?php

require_once('KnowledgeBase/Rule.class.php');
require_once('KnowledgeBase/Fact.class.php');

function logicalAnd($exp)
{
	$pos = strpos($exp, "+");
	$newFacts = array();
	if ($pos === false)
	{
		echo "This is not an and expression";
	}
	else
	{
		//explode the expression read
		$new = preg_replace('/\s+/', '', $exp);
		$token = explode("+", $new);
		//take the number of tokens created
		$result = count($token);

		//loop control variable
		$loop = 0;
		$initialFacts = array("A" => 1, "B" => 1, "C" => 1);
		//go through tokens created and compare with initial facts array
		while ($loop < $result)
		{
			foreach($initialFacts as $key => $value)
			{
				//echo $key." => ".$value."". PHP_EOL;
				/*remember to explode for the not sign
				$smallToken = explode("!", $token[$loop]);*/

				//compare initial facts keys with those you exploded
				if ($key == $token[$loop])
				{
					if (($loop + 1) == $result)
					{
							$val = $initialFacts[$key] && $initialFacts[$key];
							echo $exp." => ". $val."". PHP_EOL;
					}
					$state = array($token[$loop] => 1);
					array_push($newFacts, $state);
				}
				else
				{
					//recursion
				}
			}
			$loop++;
		}
	}
	//echo "\n+++++++++newFacts+++++++". PHP_EOL;
	//print_r($newFacts);
}

?>
