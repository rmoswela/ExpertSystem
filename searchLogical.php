<?php

function searchLogical($exp)
{
	//array of rules of precedence
	$order = array(
		"(" => 0,
		"!" => 1,
		"+" => 2,
		"|" => 3,
		"^" => 4,
		"=>" => 5,
		"<=>" => 6,);

	//explode array of expression by space
	$token = explode(" ", $exp);
	//count number of token produce after explode
	$result = count($token);

	foreach($order as $key => $value)
	{	
		//initial loop control variable
		$loop = 0;
		//loop to check equality of key and token
		while ($loop < $result)
		{
			if ($key == $token[$loop])
			{
				if ($key == "+")
				{
				   	$expression = [$token[$loop - 1], $value, $token[$loop + 1]];
					logicalAnd($expression);
				}
				else if ($key == "|")
				{
					$expression = [$token[$loop - 1], $value, $token[$loop + 1]];
					logicalOr($expression)
				}
				else if ($key == "^")
				{
				 	$expression = [$token[$loop - 1], $value, $token[$loop + 1]];
					logicalAnd($expression)
				}
				else if ($key == "=>")
				{
				 	$expression = [$token[$loop - 1], $value, $token[$loop + 1]];
					logicalAnd($expression)
				}
			}
		}
	}
}

?>
