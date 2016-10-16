<?php

<<<<<<< HEAD
require_once(Rules.class.php);
require_once(Fact.class.php);
=======
require_once('KnowledgeBase/Rule.class.php');
require_once('KnowledgeBase/Fact.class.php');
>>>>>>> 0017cbb5b9054f5930d7b3b7252856659d347bbf

function logicalAnd($exp)
{
	$pos = strpos($exp, "+");
<<<<<<< HEAD
=======
	$newFacts = array();
>>>>>>> 0017cbb5b9054f5930d7b3b7252856659d347bbf
	if ($pos === false)
	{
		echo "This is not an and expression";
	}
	else
	{
		//explode the expression read
<<<<<<< HEAD
		$token = explode("+", $exp);
		//take the number of tokens created
		$result = $count($token);
		//loop control variable
		$loop = 0;

=======
		$new = preg_replace('/\s+/', '', $exp);
		$token = explode("+", $new);
		//take the number of tokens created
		$result = count($token);

		//loop control variable
		$loop = 0;
		$initialFacts = array("A" => 1, "B" => 1, "C" => 1);
>>>>>>> 0017cbb5b9054f5930d7b3b7252856659d347bbf
		//go through tokens created and compare with initial facts array
		while ($loop < $result)
		{
			foreach($initialFacts as $key => $value)
			{
<<<<<<< HEAD
=======
				//echo $key." => ".$value."". PHP_EOL;
>>>>>>> 0017cbb5b9054f5930d7b3b7252856659d347bbf
				/*remember to explode for the not sign
				$smallToken = explode("!", $token[$loop]);*/

				//compare initial facts keys with those you exploded
				if ($key == $token[$loop])
				{
<<<<<<< HEAD
					//if found on the initial array store it and its state
					$state = [[$token[$loop]][$value]];
=======
					if (($loop + 1) == $result)
					{
							$val = $initialFacts[$key] && $initialFacts[$key];
							echo $exp." => ". $val."". PHP_EOL;
					}
					$state = array($token[$loop] => 1);
					array_push($newFacts, $state);
>>>>>>> 0017cbb5b9054f5930d7b3b7252856659d347bbf
				}
				else
				{
					//recursion
				}
<<<<<<< HEAD
			}//end foreach
			$loop++;
		}//end while
	}
=======
			}
			$loop++;
		}
	}
	//echo "\n+++++++++newFacts+++++++". PHP_EOL;
	//print_r($newFacts);
>>>>>>> 0017cbb5b9054f5930d7b3b7252856659d347bbf
}

?>
