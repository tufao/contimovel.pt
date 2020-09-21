<?php

	/*
		------------------------------------------------------
		Author: 	Attila Gönczi
		Email: 	gonczos@freemail.hu
		------------------------------------------------------
		Purpose: Functions useful for name/email validations
	*/
	function isEmptyString($inputString){ //check if string has a value
		if($inputString == "")
			return true;
		return false;
	}
	
//validating specific fields
	function isValidEmail($inputString){ //check if an email is valid
		/*
		Function to check if an email is valid
		Notes: 
			- leading and end space chars are NOT ALLOWED!!!!
			- maximum length: 20
			- allowed characters --> all letters, and '-'
		*/
      $inputString = trim($inputString);
	  $emailPattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.]+\.[a-zA-Z.]{2,5}$/u';
	  if (preg_match($emailPattern,$inputString)) return true;
      return false;
	}
	
	function removeExtraSpaces($inputString){
		/*
			removeExtraSpaces($inputString) takes a string as an input, and
			-  it removes spaces before and after the $inputString,
			- if the string consists of more than one words seperated by space(s) , 
			  it also insures that the delimiting space is exactly one space char.
			- the function returns the corrected string 
		*/
		$string = trim($inputString); //removes spaces at the beginning and end of the string
		$string = preg_replace('/[ ]+/', ' ', $string);//replaces more than one inner spaces by one space
		return $string;
	}

		
	function isValidSingleName($inputString){//check if a single name is valid
      	/*
		Function that to check if a single name  is valid
			returns true if name is valid
			returns false if name is invalid
		Notes: 
			- minimum length: 2
			- maximum length: 20
			- allowed characters --> all letters, '-', and '.' at the end of name
			- no spaces are allowed between characters
			
		*/
	  $inputString = trim($inputString);
	  $namePattern = '/^[a-zA-Z-ãÃáÁâÂàÀéÉêÊíÍóÓôÔõÕöÖúÚüÜçÇ]{2,20}$/u';
      if (preg_match($namePattern,$inputString)) return true;
      return false;
	}
	

	function areValidNames($namesString){ //check if a string of names, seperated with spaces, is valid
		/*
		Function that to check if names delimited by " " are valid
			'areValidNames($namesString)' is using the function 'isValidSingleName($inputString)'
			Returns true, if all names are valid in the string
			Returns false if any of the names in the string is invalid
		Notes: 
			- names must be delimited by EXACTLY ONE space character!
			- for the validation of each single name, check description of 
			   'isValidSingleName($inputString)'
		*/
		$namesString = removeExtraSpaces($namesString);
		$namesArray = explode(" ",$namesString);
		foreach($namesArray as $name)
			if(!isValidSingleName($name))return false;
		return true;
	}
	
	
	function isValidPortuguesePostalCode($firstFour,$lastThree){ //check if a string is 
		$firstFour = trim($firstFour);
		$lastThree = trim($lastThree);
		$firstFourPattern = '/^[1-9][0-9]{3}$/';
		$lastThreePattern = '/^[1-9][0-9]{2}$/';
		if(preg_match($firstFourPattern,$firstFour)&&preg_match($lastThreePattern,$lastThree))
			return true;
		return false;
	}
		

	
	
?>