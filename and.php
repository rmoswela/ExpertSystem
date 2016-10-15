<?php

require_once(Rules.class.php);
require_once(Fact.class.php);

function logicalAnd($exp)
{
	$pos = strpos($exp, "+");
	if ($pos === false)
	{
		echo "This is not an and expression";
	}
	else
	{
		//explode the expression read
		$token = explode("+", $exp);
		//take the number of tokens created
		$result = $count($token);
		//loop control variable
		$loop = 0;

		//go through tokens created and compare with initial facts array
		while ($loop < $result)
		{
			foreach($initialFacts as $key => $value)
			{
				/*remember to explode for the not sign
				$smallToken = explode("!", $token[$loop]);*/

				//compare initial facts keys with those you exploded
				if ($key == $token[$loop])
				{
					//if found on the initial array store it and its state
					$state = [[$token[$loop]][$value]];
				}
				else
				{
					//recursion
				}
			}//end foreach
			$loop++;
		}//end while
	}
}

?>
