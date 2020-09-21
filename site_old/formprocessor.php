<?php 
	// add headers for utf-8 message
	$headersEncoding = "\r\n";
	$headersEncoding .= "MIME-Version: 1.0\r\n";
	$headersEncoding .= "Content-type: text/plain; charset=utf-8\r\n";
	$headersEncoding .= "Content-Transfer-Encoding: quoted-printable\r\n";
	
	$to = "contactosForm@contimovel.pt" ; 
	$from = $_REQUEST['Email'] ; 
	$name = $_REQUEST['Name'] ; 
	$headers = "From: $from";
	$headers .= $headersEncoding;
	$subject = "Web Contact Data"; 

	
	$fields = array(); 
	$fields{"Subject"} = "Subject";
	$fields{"Name"} = "Name"; 
	$fields{"Company"} = "Company";
	$fields{"Email"} = "Email";
	$fields{"Tel"} = "Tel";
	$fields{"Street"} = "Street"; 
	$fields{"HouseNr"} = "HouseNr";
	$fields{"Postcode"} = "Postcode";
	$fields{"City"} = "City";
	//$fields{"Message"} = "Message"; 
	
	$body = ""; 
	foreach($fields as $a => $b){
		$body .= sprintf("%s: %s\n",$b,$_REQUEST[$a]);
	} 
	
	$message = wordwrap($_REQUEST['Message'], 70);
	$body .=sprintf("%s: %s\n","Message",$message);
	$msg_to_administration = "Recebemos a seguinte informação\n\n".$body;	
	$headers2 = "From: noreply@contimovel.pt";
	$headers2 .= $headersEncoding;
	
	$subject2 = "[Autoreply] Obrigado por nos contactar"; 
	$autoreply = "Caro ".$name.",\n\n Obrigado por nos contactar. Receberá uma resposta assim que possível. Para mais informações pode consultar-nos por telefone ou visitar o nosso website.\n
	\nEm baixo pode rever a informação que foi submetida:\n\n".$body."\n\nNota:Esta mensagem é gerada automaticamente. Por favor não responda a este email.";


	$send = mail($to, $subject, $msg_to_administration, $headers); 
	$send2 = mail($from, $subject2, $autoreply, $headers2); 
	if($send) 
		{header( "Location: http://contimovel.pt/thankyou.html" );} 
	else{
		print "Foi encontrado um erro no envio do seu email, por favor notifique o webmaster@contimovel.pt";
	} 

?> 
