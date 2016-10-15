<?php
<<<<<<< HEAD

=======
require_once 'and.php';
>>>>>>> 0017cbb5b9054f5930d7b3b7252856659d347bbf
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
<<<<<<< HEAD

	foreach($order as $key => $value)
	{	
=======
	$anchor = array();

	foreach($order as $key => $value)
	{
>>>>>>> 0017cbb5b9054f5930d7b3b7252856659d347bbf
		//initial loop control variable
		$loop = 0;
		//loop to check equality of key and token
		while ($loop < $result)
		{
<<<<<<< HEAD
=======
			array_push($anchor, $token[$loop]);
>>>>>>> 0017cbb5b9054f5930d7b3b7252856659d347bbf
			if ($key == $token[$loop])
			{
				if ($key == "+")
				{
<<<<<<< HEAD
				   	$expression = [$token[$loop - 1], $value, $token[$loop + 1]];
=======
					echo $token[$loop - 1]." ".$key." ".$token[$loop + 1]. PHP_EOL;
				  $expression = $token[$loop - 1]." ".$key." ".$token[$loop + 1];
>>>>>>> 0017cbb5b9054f5930d7b3b7252856659d347bbf
					logicalAnd($expression);
				}
				else if ($key == "|")
				{
<<<<<<< HEAD
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

=======
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
>>>>>>> 0017cbb5b9054f5930d7b3b7252856659d347bbf
?>
