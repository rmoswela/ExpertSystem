<?php

if (file_exists("t.csv")) {
	$ret = array();
	if ($fd = fopen('t.csv', 'r')) {
		while ($db = fgetcsv($fd, 0, ';'))
			$ret[$db[0]] = $db[1];
		fclose($fd);
	}
	echo json_encode($ret);
}
else
	echo "Ask me something";
?>