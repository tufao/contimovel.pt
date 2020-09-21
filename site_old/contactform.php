<?php
	require 'validationFunctions.php'; //import external validation functions
	require 'contacts_top.php';
	if($_REQUEST["Postback"] == 'true'){//form is postback (note: It is set at contactform_validator)		
		
		$name = trim($_REQUEST['Name']);
		$name = removeExtraSpaces($name);
		
		$company = trim($_REQUEST['Company']);
		$company = removeExtraSpaces($company);
		
		$email = trim($_REQUEST['Email']);
		$tel = trim($_REQUEST['Tel']);
		
		$street = trim($_REQUEST['Street']);
		$street = removeExtraSpaces($street);
		
		$houseNr = trim($_REQUEST['HouseNr']);
		$houseNr = removeExtraSpaces($houseNr);
		
		$postcode4d = trim($_REQUEST['Postcode4d']);
		$postcode3d = trim($_REQUEST['Postcode3d']);
		
		$city = trim($_REQUEST['City']);
		$city = removeExtraSpaces($city);
		
		$subject = trim($_REQUEST['Subject']);
		$subject = removeExtraSpaces($subject);
		
		$message = trim($_REQUEST['Message']);
		$message = removeExtraSpaces($message);
		
		//check if any of the values are invalid, and collect errors, suggestions
	
		$formIsCorrect = true; //boolean, if whole form is correct
		if(!areValidNames($name)){
			$formIsCorrect = false;
			$name_error = '*Item obrigatório&nbsp|';
			$name_suggest = 'por ex.: Maria Gonzáles Teixeira';
		}
		if(!isValidEmail($email)){
			$formIsCorrect = false;
			$email_error = '*Item obrigatório&nbsp|';
			$email_suggest = 'por ex.: email@servidor.pt';
		}
		if(isEmptyString($street)){
			$formIsCorrect = false;
			$street_error = '*Item obrigatório&nbsp|';
			$street_suggest = 'por ex.: Dr. Francisco Sousa Tavares,';
		}
		if(isEmptyString($tel)){
			$formIsCorrect = false;
			$tel_error = '*Item obrigatório&nbsp|';
			$tel_suggest = 'por ex.: 961112233';
		}
		if(isEmptyString($houseNr)){
			$formIsCorrect = false;
			$houseNr_error = '*Item obrigatório&nbsp|';
			$houseNr_suggest = 'por ex.: 7 r/c A';
		}
		if(!isValidPortuguesePostalCode($postcode4d,$postcode3d)){
			$formIsCorrect = false;
			$postcode_error = '*Item obrigatório&nbsp|';
			$postcode_suggest = 'por ex.: 1111-111';
		}
			
		if(!areValidNames($city)){
			$formIsCorrect = false;
			$city_error = '*Item obrigatório&nbsp|';
			$city_suggest = 'por ex.: Mem-Martins, Lisboa';
		}
		if(isEmptyString($subject)){
			$formIsCorrect = false;
			$subject_error = '*Item obrigatório&nbsp|';
			$subject_suggest = 'por ex.: Pedido de informação sobre os serviços da Contimóvel';
		}
		if(isEmptyString($message)){
			$formIsCorrect = false;
			$message_error = '*Item obrigatório&nbsp|';
			$message_suggest = 'por ex.: o seu texto';
		}
		if($formIsCorrect){ //send emails, and direct user to thankyou.html page
			echo "<div class='textoTitle'>Confirme os seus dados:</div><hr />";
?>






<form accept-charset='UTF-8' action='formprocessor.php' method='post'>
	<table cellspacing="0" cellpadding="4" border="0">
		  <tr>
			<th class="text_strong">Nome:</th>
			<td class="texto2"><?php echo $name; ?></td>
		  </tr>
		  <tr>
			<th class="text_strong">Firma:</th>
			<td class="texto2"><?php echo $company; ?></td>
		  </tr>
		  <tr>
			<th class="text_strong">Correio electrónico:</th>
			<td class="texto2"><?php echo $email; ?></td>
		  </tr>
		  <tr>
			<th class="text_strong">Telefone:</th>
			<td class="texto2"><?php echo $tel; ?></td>
		  </tr>
		  <tr>
			<th class="text_strong">Morada /sede:</th>
			<td></td>
		  </tr>
		  <tr>
			<th class="text">Rua:</th>
			<td class="texto2"><?php echo $street; ?></td>
		  </tr>

		  <tr>
			<th class="text">No:</th>
			<td class="texto2"><?php echo $houseNr; ?></td>
		  </tr>
		  <tr>
			<th class="text">Código postal:</th>
			<td class="texto2"><?php echo $postcode4d.' - '.$postcode3d; ?></td>

		  </tr>
		  <tr>
			<th class="text">Cidade:</th>
			<td class="texto2"><?php echo $city; ?></td>
		  </tr>
		  <tr>
			<th class="text">Assunto:</th>
			<td class="texto2"><?php echo $subject; ?></td>

		  </tr>
		  <tr>
			<th class="text">Mensagem:</th>
			<td class="texto2"><?php echo $message; ?></td>

		  </tr>
		  <tr>
			<th class="text"></th>
			<td class="text" align="left">
				<input type="hidden" name="Name" value="<?php echo $name; ?>" />
				<input type="hidden" name="Company" value="<?php echo $company; ?>" />
				<input type="hidden" name="Email" value="<?php echo $email; ?>" />
				<input type="hidden" name="Tel" value="<?php echo $tel; ?>" />
				<input type="hidden" name="Street" value="<?php echo $street; ?>" />
				<input type="hidden" name="HouseNr" value="<?php echo $houseNr; ?>" />
				<input type="hidden" name="Postcode" value="<?php echo $postcode4d.' - '.$postcode3d; ?>" />
				<input type="hidden" name="City" value="<?php echo $city; ?>" />
				<input type="hidden" name="Subject" value="<?php echo $subject; ?>" />
				<input type="hidden" name="Message" value="<?php echo $message; ?>" />
				<input type="hidden" name ="Postback" value="true" />
				<input type="submit" name="Submit" value="Confirmar" />
			</td>
		  </tr>
	</table>
</form>	
<?php
		}
		else{
			echo "<div class='textoTitle'>correcção da informação a submeter:</div><hr />";
			echo "<div class='texto'><strong>Por favor corrija os seus dados onde estiver indicado.</strong></div> "
?>

<form accept-charset='UTF-8' action='<?php echo $PHP_SELF;?>' method='post'>
	
	<table cellspacing="0" cellpadding="4" border="0">
	  <tr>
		
		<th class="text_strong">Nome</th>
		<td class="texto"><input type="text" name="Name" value="<?php echo $name; ?>" /></td>
		<td class="texto" style='color:red'><?php echo $name_error; ?></td>
		<td class="texto"><?php echo $name_suggest; ?></td>
		
	  </tr>
	  <tr>
		<th class="text_strong">Firma</th>
		<td class="text"><input type="text" name="Company" value="<?php echo $company; ?>" /></td>
		<td class="texto" style='color:red' ><?php echo $company_error; ?></td>
		<td class="texto"><?php echo $company_suggest; ?></td>
	  </tr>
	  <tr>

		<th class="text_strong">Correio electrónico</th>
		<td class="text"><input type="text" name="Email" value="<?php echo $email; ?>" /> </td>
		<td class="texto" style='color:red'><?php echo $email_error; ?></td>
		<td class="texto"><?php echo $email_suggest; ?></td>
	  </tr>
	  <tr>
		<th class="text_strong">Telefone</th>
		<td class="text"><input type="text" name="Tel" value="<?php echo $tel; ?>" /> </td>
		<td class="texto" style='color:red'><?php echo $tel_error; ?></td>
		<td class="texto"><?php echo $tel_suggest; ?></td>
	  </tr>

	  <tr>
		<th class="text_strong">Morada /sede:</th>
		<td class="text"></td>
	  </tr>
	  <tr>
		<th class="text">Rua</th>
		<td class="text"><input type="text" name="Street" value="<?php echo $street; ?>" /></td>
		<td class="texto" style='color:red'><?php echo $street_error; ?></td>
		<td class="texto"><?php echo $street_suggest; ?></td>
	  </tr>

	  <tr>
		<th class="text">No</th>
		<td class="text"><input type="text" name="HouseNr" value="<?php echo $houseNr; ?>" /> </td>
		<td class="texto" style='color:red'><?php echo $houseNr_error; ?></td>
		<td class="texto"><?php echo $houseNr_suggest; ?></td>
	  </tr>
	  <tr>
		<th class="text">Código postal</th>
		<td class="text"><input type="text" name="Postcode4d" maxlength="4" size="4" value="<?php echo $postcode4d; ?>" /> - <input type="text" name="Postcode3d" maxlength="3" size="3" value="<?php echo $postcode3d; ?>" /> </td>
		<td class="texto" style='color:red'><?php echo $postcode_error; ?></td>
		<td class="texto"><?php echo $postcode_suggest; ?></td>

	  </tr>
	  <tr>
		<th class="text">Cidade</th>
		<td class="text"><input type="text" name="City" value="<?php echo $city; ?>" /> </td>
		<td class="texto" style='color:red'><?php echo $city_error; ?></td>
		<td class="texto"><?php echo $city_suggest; ?></td>
	  </tr>
	  <tr>
		<th class="text">Assunto</th>
		<td class="text"><input type="text" name="Subject" value="<?php echo $subject; ?>" /> </td>
		<td class="texto" style='color:red'><?php echo $subject_error; ?></td>
		<td class="texto"><?php echo $subject_suggest; ?></td>

	  </tr>
	  <tr>
		<th class="text">Mensagem</th>
		<td class="text"><textarea rows="5" cols="20" name="Message"><?php echo $message; ?></textarea></td>
		<td class="texto" style='color:red'><?php echo $message_error; ?></td>
		<td class="texto"><?php echo $message_suggest; ?></td>

	  </tr>
	  <tr>
		<th class="text"></th>
		<td class="text">
			<input type="hidden" name ="Postback" value="true" />
			<input type="submit" value="Submeter" name="Submit" />
			
		</td>

	  </tr>
	</table>
</form>		
<?php	
		}


	} require 'contacts_bottom.php'; 
 ?>





<?php
	//set all values to empty string
	/*
		$name = ''; $name_error = ''; $name_suggest = '';
		$company = ''; $company_error = ''; $company_suggest = '';
		$email = ''; $email_error = ''; $email_suggest = '';
		$tel = ''; $tel_error = ''; $tel_suggest = '';
		$street = ''; $street_error = ''; $street_suggest = '';
		$houseNr = ''; $houseNr_error = ''; $houseNr_suggest = '';
		$postcode4d = ''; 
		$postcode3d = ''; $postcode_error = ''; $postcode_suggest = '';
		$city = ''; $city_error = ''; $city_suggest = '';
		$subject = ''; $subject_error = ''; $subject_suggest = '';
		$message = ''; $message_error = ''; $message_suggest = '';
	*/
?>
