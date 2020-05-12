<?php
	function check_input($data){
		$data = trim($data); // remove spaces
		$data = trim($data,"\t\n\r\0\x0B"); // remove tab, newline, carriagereturn, nul-byte, verticaltab
		$data = trim($data,"/"); // remove backslash
		$data = stripslashes($data); // remove slashes
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function check_input2($data){
		$data = trim($data,"\t\n\r\0\x0B"); // remove tab, newline, carriagereturn, nul-byte, verticaltab
		$data = trim($data,"/"); // remove backslash
		$data = stripslashes($data); // remove slashes
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function check_user($data){
		$arr = str_split($data); // split the string
		foreach($arr as $char){ // Iterator
			//echo $char."<br>";
			if($char=='0' or $char=='1' or $char=='2' or $char=='3' or $char=='4' or $char=='5' or $char=='6' or $char=='7' or $char=='8' or $char=='9'){
				continue;
			} else{
				return false;
			}
		}
		return true; // the user is right
	}
	
	function size_Me($data, $size){
		$arr = str_split($data);
		if(sizeof($arr) > $size){
			return false;
		}
		return true;
	}
	
	function is_a_number($data){
		$arr = str_split($data);
		$countN = 0;
		foreach($arr as $char){ // Iterator
			if($char=='0' or $char=='1' or $char=='2' or $char=='3' or $char=='4' or $char=='5' or $char=='6' or $char=='7' or $char=='8' or $char=='9'){
				continue;
			} else{
				$countN = $countN+1;
			}
		}
		if($countN > (sizeof($arr)/2)){ // at least half fo the user input should be numbers
			return false;
		}
		return true;		
	}
	
	function is_an_email($data){
		$first = strpos($data,'@');
		if($first == FALSE){
			return false;
		}
		$last = strrpos($data,'@');
		if($first != $last){
			return false;
		}
		return true;
	}
?>