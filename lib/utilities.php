<?php

function enviarEmail($nome_destinatario, $destinatario, $assunto, $mensagem, $tipo) {
    
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
	
	require "$root/lib/phpmailer/class.smtp.php";
	require "$root/lib/phpmailer/class.phpmailer.php";
	
	// Inicia a classe PHPMailer
    $mail = new PHPMailer();
	
	// Define os dados do servidor e tipo de conexão
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsSMTP(); // Define que a mensagem será SMTP
	$mail->Host = "mail.while.life"; // Endereço do servidor SMTP
	$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
	$mail->Username = 'contato@while.life'; // Usuário do servidor SMTP
	$mail->Password = 'Theodavi1310'; // Senha do servidor SMTP
	//$mail->Port = 25;
	
	// Define o remetente
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->From = "contato@while.life"; // Seu e-mail
	$mail->FromName = "While"; // Seu nome
	
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress($destinatario, $nome_destinatario);
	//$mail->AddAddress('ciclano@site.net');
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
	
	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
	
	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	// $mail->Subject  = "Mensagem Teste"; // Assunto da mensagem
	$mail->Subject = $assunto; // Assunto da mensagem
	//$mail->Body = "Este é o corpo da mensagem de teste, em <b>HTML</b>! <br />";
	$mail->Body = $mensagem;
	//$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n";
	
	// Define os anexos (opcional)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
	if($tipo){
		$path = "./while.pdf";
		chmod($path, 0777);
	
		$mail->AddAttachment($path);  // Insere um anexo
	}
	
	// Envia o e-mail
    $enviado = $mail->Send();
	
	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

}