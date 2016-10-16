<?php
require_once 'and.php';
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
	$anchor = array();

	foreach($order as $key => $value)
	{
		$loop = 0;
		//loop to check equality of key and token
		while ($loop < $result)
		{
			array_push($anchor, $token[$loop]);
			if ($key == $token[$loop])
			{
				if ($key == "+")
				{
					echo $token[$loop - 1]." ".$key." ".$token[$loop + 1]. PHP_EOL;
				  $expression = $token[$loop - 1]." ".$key." ".$token[$loop + 1];
					logicalAnd($expression);
				}
				else if ($key == "|")
				{
					$expression = $token[$loop - 1]." ".$key." ".$token[$loop + 1];
					//logicalOr($expression);
				}
				else if ($key == "^")
				{
					$expression = $token[$loop - 1]." ".$key." ".$token[$loop + 1];
					//logicalAnd($expression);
				}
				else if ($key == "=>")
				{
					$expression = $token[$loop - 1]." ".$key." ".$token[$loop + 1];
					//logicalAnd($expression);
				}
			}
			$loop++;
		}
		//print_r($anchor);
	}
}
$exp = "A ^ B + C";
searchLogical($exp);
?>
