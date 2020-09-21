<?php

if ( isset($_POST['submit']) ) {

// Dados de autenticação SMTP
$smtpinfo['host'] = 'localhost';
$smtpinfo['port'] = '25';
$smtpinfo['auth'] = true;
$smtpinfo['username'] = 'geral@contimovel.pt';
$smtpinfo['password'] = ';ti;.R(hX%d)*';

// Dados recebidos do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];

// Inclusão de ficheiro PEAR. Certifique-se que o PEAR está activado no seu alojamento
require_once "Mail.php";

// Corpo da mensagem
$body = "Nome: ".$nome;
$body.= "\n";
$body.= nl2br($mensagem);

$headers = array ('From' => $email,
'To' => $smtpinfo["username"],
'Subject' => 'Pedido de contacto');

$mail_object = Mail::factory('smtp', $smtpinfo);

$mail = $mail_object->send($smtpinfo["username"], $headers, $body);

if ( PEAR::isError($mail) ) {
echo $mail->getMessage();
} else {
echo '<b>O seu comentario foi enviado com sucesso.</b>';
}

}
?>
