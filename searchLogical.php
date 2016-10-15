<?php

function searchLogical($exp)
{
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
				return $value;
			}
		}
	}
}

?>
