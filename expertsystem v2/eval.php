<?PHP
function single($one, $data)
{
    echo "to check:" . $one . "<br><br>";
    foreach($data as $key => $val)
    {
        if ($one === $key)
        {
            if ($val === 1)
                echo "True<br>";
            elseif ($val === 0)
                echo "False<br>";
            else
                echo "Indecisive<br>";
        }
    }
}

function pos_and($left, $right, $data)
{
    echo "to check:" . $left . "<br><br>";
    foreach($data as $key => $val)
    {
        if ($left === $key)
        {
            if ($val === 1)
                echo "True<br>";
            elseif ($val === 0)
                echo "False<br>";
            else
                echo "Indecisive<br>";
        }
    }
}

function pipe($left, $right, $data)
{
    echo "to check:" . $left . "<br><br>";
    foreach($data as $key => $val)
    {
        if ($left === $key)
        {
            if ($val === 1)
                echo "True<br>";
            elseif ($val === 0)
                echo "False<br>";
            else
                echo "Indecisive<br>";
        }
    }
}

function pos_xor($left, $right, $data)
{
    echo "to check:" . $left . "<br><br>";
    foreach($data as $key => $val)
    {
        if ($left === $key)
        {
            if ($val === 1)
                echo "True<br>";
            elseif ($val === 0)
                echo "False<br>";
            else
                echo "Indecisive<br>";
        }
    }
}
?>