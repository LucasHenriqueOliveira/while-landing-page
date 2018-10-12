<?php

date_default_timezone_set('America/Sao_Paulo');
//error_reporting(E_ALL|E_STRICT);
//ini_set('display_errors', 1);

try{
	$con = new PDO('mysql:host=127.0.0.1;dbname=anjtr452_while','anjtr452_root','lucashen031285');
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$con->exec("SET CHARACTER SET utf8");
} catch(PDOException $e){
	echo $e->getMessage();
	die();
}
$data = date('Y-m-d H:i:s');
$email = $tel = '';
if(empty($_POST['email_1']) && empty($_POST['tel_1'])) {
	echo "<script type='text/javascript'>  

    alert('Favor preencher o email e/ou telefone.');
    
    history.back();


   </script>";
   exit();
}
if($_POST['email_1']) {
   $email = $_POST['email_1'];
}
if($_POST['tel_1']) {
   $tel = $_POST['tel_1'];
}
$nome = $_POST['nome_1'];

$sql = 'INSERT INTO newsletter (`nome`,`email`,`data`,`tipo`,`tel`) VALUES("'.$nome.'", "'.$email.'","'.$data.'","Whiler","'.$tel.'")';
	
$query = $con->prepare($sql);
$query->execute();

?>

<!DOCTYPE html>
<html lang="en">
    <head></head>
    <body>
        <h3>Obrigado! Entraremos em contato em breve!</h3>

        <h4>Equipe While</h4>
        <img src="./img/logo_branco.png">
    </body>
</html>

<?php

if($email) {
    try{
    
        include('lib/utilities.php');
        $assunto = "Apresentação While";
        $message = 'Bem-vindo Whiler! <br /><br />

        Que bacana ter você com a gente. <br /><br />
        
        Fazer parte da While significa entender que a vida pode ser muito mais leve e simples, e que 
        ninguém precisa perder pro outro ganhar. <br /><br />
        
        Que tal contratos curtos, flexíveis e liberdade de ir e vir? Que tal morar bem, conhecer gente do 
        bem e ainda ganhar por isso? <br /><br />
        
        Na While, entendemos que a vida é o que acontece enquanto se faz planos... Bora fazer 
        do "enquanto" algo incrível? <br /><br />
        
        Vem saber mais e conhecer melhor o estilo de vida While no próximo encontro Whilers: <br /><br />
        
        Ah, e bem-vindo de novo, muito bom te ter por aqui!<br /><br />' ;
        
        $message .= "Obrigado<br /><a href='https://www.while.casa' target='_blank'><img src='http://while.life/img/logo_branco.png' title='While'></a><br /><br />";

        $envia_email = enviarEmail('Whiler', $email, $assunto, $message, 1);

        try{

           $message = "Novo contato cadastrado no site <br /><br />";
           $message .= "Nome: " . $nome . "<br/>";
           $message .= "Email: " . $email . "<br/>";
           $message .= "Telefone: " . $tel . "<br/>";
           $message .= "Tipo: Whiler <br/>";
           enviarEmail('Novo Contato', 'contato@while.casa', 'Novo Contato', $message, '');

        } catch (Exception $e){
           
        }

    } catch (Exception $e){
        $assunto = "Erro";
        $message = "Erro no envio de email boas-vindas para " . $email . "<br /><br />";
        $name = "Erro Email";
        $email = "lucashen@gmail.com";

        $envia_email = enviarEmail($name, $email, $assunto, $message, '');
    }
}
?>