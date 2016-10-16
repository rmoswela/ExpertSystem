<?php
/*
function solve($exp)
{
  if (strpos('+', $exp))
  {
    $exp = preg_replace("/\s+/", $exp);
    $res = explode('+', $exp)
    if (($l = isexp($res[0])) && ($r = isexp($res[1]))
      evaluate($res[0], $res[1]);
    else {
      $arrayName = array('' => , );
    }
  }
}*/

function callop($rule, $op)
{
  if (strcmp($op, "and") == 0)
    logigicalAnd($rule);
  if (strcmp($op, "!not") == 0)
    logigicalNot($rule);
  if (strcmp($op, "or") == 0)
    logigicalOR($rule);
  if (strcmp($op, "xor") == 0)
    logigicalXor($rule);
}

function findop($rule)
{
  if (strpos($rule, '+'))
    return ("and");
  else if (strpos($rule, '!'))
    return ("not");
  else if(strpos($rule, '^'))
    return ("xor");
  else if (strpos($rule, '|'))
    return ("or");
  else
    return ("");
}

function isexpression($rule)
{
  if (strpos($rule, '+') || strpos($rule, '!') || strpos($rule, '^') || strpos($rule, '!'))
    return (1);
  else
    return (0);
}

function evaluate($rule)
{
  if (!isexpression($rule))
  {
    if (strpos($rule, '+') > 0)
    {
      $subgoal = explode('+', $rule);
      if (strlen($subgoal[0]) > strlen($subgoal[1]))
      {
        $rule = $subgoal[0];
        $result = evaluate($rule);
        $subgoal[1] = $result.' + '.$subgoal[1];
        $result = evaluate($subgoal[1]);
      }
    }
    else if (strpos($rule, '|'))
    {
      if (strpos($rule, '|') > 0)
      {
        $subgoal = explode('|', $rule);
        if (strlen($subgoal[0]) > strlen($subgoal[1]))
        {
          $rule = $subgoal[0];
          $result = evaluate($rule);
          $subgoal[1] = $result.' | '.$subgoal[1];
          $result = evaluate($subgoal[1]);
        }
      }
    }
    else if (strpos($rule, '^'))
    {
      if (strpos($rule, '^') > 0)
      {
        $subgoal = explode('^', $rule);
        if (strlen($subgoal[0]) > strlen($subgoal[1]))
        {
          $rule = $subgoal[0];
          $result = evaluate($rule);
          $subgoal[1] = $result.' ^ '.$subgoal[1];
          $result = evaluate($subgoal[1]);
        }
      }
    }
  }
  else
  {
    $op = findop($rule);
    callop($rule, $op);
  }
}
?>
