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
if(empty($_POST['email_2']) && empty($_POST['tel_2'])) {
	echo "<script type='text/javascript'>  

    alert('Favor preencher o email e/ou telefone.');
    
    history.back();


   </script>";
   exit();
}
if($_POST['email_2']) {
   $email = $_POST['email_2'];
}
if($_POST['tel_2']) {
   $tel = $_POST['tel_2'];
}
$nome = $_POST['nome_2'];

$sql = 'INSERT INTO newsletter (`nome`,`email`,`data`,`tipo`,`tel`) VALUES("'.$nome.'", "'.$email.'","'.$data.'","Proprietário","'.$tel.'")';
	
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
        $message = 'Bem-vindo a While!<br /><br />

        Receber seu email faz toda diferença pra gente.
        
        Significa que tem um dono de um imóvel incrível querendo vendê-lo e que tem um 
        comprador querendo comprar exatamente este imóvel. <br />
        Significa que tem um Whiler querendo alugar seu imóvel enquanto ele não vende, e disposto a 
        ajudar de corpo e alma nessa jornada de venda! <br /><br />
        
        Na While nossa força vem da união, da cooperação e da certeza de que todos estamos 
        conectados desta maneira. Cada um exerce seu papel e todos lucram com isso! <br /><br />
        
        Nosso foco é alugar seu imóvel enquanto não vende, gerando lucro em vez de perdas, e ainda vender 
        seu imóvel mais rápido! Anexamos um documento abaixo com todos os benefícios gerados 
        por esta parceria. <br /><br />
        
        Bem-vindo novamente, é um prazer te ter por aqui!<br /><br />' ;
        
        $message .= "Obrigado<br /><a href='https://www.while.casa' target='_blank'><img src='http://while.life/img/logo_branco.png' title='While'></a><br /><br />";

        $envia_email = enviarEmail('Parceiro While', $email, $assunto, $message, 2);

        try{

           $message = "Novo contato cadastrado no site <br /><br />";
           $message .= "Nome: " . $nome . "<br/>";
           $message .= "Email: " . $email . "<br/>";
           $message .= "Telefone: " . $tel . "<br/>";
           $message .= "Tipo: Proprietário <br/>";
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