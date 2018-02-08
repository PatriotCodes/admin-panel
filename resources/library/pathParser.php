<?php

function parsePath($inputString) {
	if (strtolower(substr($inputString,0,4)) == 'http') {
		return $inputString;
	}
	$result = '';
	for ($index = 0; $index < strlen($inputString); $index++) {
		echo $index;
		if ($inputString[$index] == '\\') {
			if ($index != (strlen($inputString) - 1)) {
				if ($inputString[$index + 1] != '\\') {
					$result .= '\\';
				}
			} else {
				return $result;
			}
		}
		$result .= $inputString[$index];
	}
	return $result;
}

?>