<?php
    require_once("eval.php");
    header("Cache-Control: no-cache");
    //error_reporting(E_ALL);

   function rules_to_file($file, $rules)
   {
        if (file_exists($file) || !file_exists($file)){
            foreach ($rules as $key => $val)
            {
                if ($val == 1)
                {
                    file_put_contents($file, "\n".$key.".", FILE_APPEND); 
                }
            }
        }
        else{
            echo "ERROR\n";
        } 
   }

    function fact_to_file($file, $facts, $rules)
    {
        file_put_contents($file, "");
        file_put_contents($file, "/*Facts*/"."\n", FILE_APPEND);
        foreach ($arr as $key => $val)
        {
            if ($val == 1)
            {
               file_put_contents($file, "\n".$key.".", FILE_APPEND); 
            }
        }
        rules_to_file($file, $rules);
    }

    function create_prolog($facts, $rules)
    {
        //return var_dump($rules);
//        $file = './expert_system.pl';
//        if (file_exists($file) || !file_exists($file)){
//            fact_to_file($file, $facts, $rules);
//        }
//        else{
//            echo "ERROR\n";
//        }   
    }
    
    function alter($arr, $k, $v, $facts)
    {
        $str = str_split(preg_replace("/\s/", "", $k));
        foreach($facts as $key => $val)
        {
            foreach ($str as $alpha)
            {
                if (strcmp($key, $alpha) == 0)
                {
                    $facts[$key] = $v;
                }
            }
        }
        create_prolog($facts, $arr);
    }

    function middle($data, $flag, $arr)
    {
        foreach ($data as $key => $val)
        {
            if (strpos($val, $flag) == 0)
            {
                alter($data, $val, 1, $arr);
            }
        }
    }

    function test_alter(&$item1, $key, $prefix)
    {
        $item1 = "$prefix";
    }

    function test($da, $arr)
    {
        $len = strlen($da);
        for($j = 0; $j <= $len; $j++)
        {
            echo $da[$j];
            if ($da[$j] !== NULL && $da[$j + 1] == NULL)
            {
                echo "<br>single<br>=========<br>";
                return single($da[$j], $arr);
            }
            if ($da[$j] == "+")
            {
                echo "<br>plus<br>=========<br>";
                return pos_and($da[$j - 1], $da[$j + 1], $arr);
            }
            else if ($da[$j] == "|")
            {
                echo "<br>pipe<br>=========<br>";
                return pipe($da[$j - 1], $da[$j + 1], $arr);
            }
            else if ($da[$j] == "^")
            {
                echo "<br>xor<br>=========<br>";
                return pos_xor($da[$j - 1], $da[$j + 1], $arr);
            }
        }
    }

    function chk($data, $arr)
    {
        $len = count($data);
        for($i = 0; $i <= $len - 3; $i++ )
        {
            test($data[$i], $arr);
        }
    }

    function run()
    {
        $o = [];
        $target_dir = "uplds/";
        $target_file = $target_dir . basename($_FILES["input"]["name"]);
        $iFType = pathinfo($target_file,PATHINFO_EXTENSION);

        $array = Array();
        for( $i = 65; $i < 91; $i++){
            $array[chr($i)] = 2;
        }
        if ($iFType === "txt")
        {
            if (move_uploaded_file($_FILES["input"]["tmp_name"], $target_file)) {
                foreach(file($target_file) as $line) {
                    if (strpos(preg_replace("/\t/", "", $line), "#") != 0)
                    {
                        $l = preg_replace("/#.*/", "", $line);
                        $new = explode("=>", $l, 2);
                        //array_push($o, $new[1].":-".$new[0]);
                        array_push($o, $new[0]);
//                        chk(preg_replace("/\s+/", "", $new[0]), $array);
                    }
                }
                chk(preg_replace("/\s+/", "", $o), $array);
                //middle($o, "=", $array);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Nice Try";
        }
    }
    return run();
?>