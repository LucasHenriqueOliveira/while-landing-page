<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    <?php

    date_default_timezone_set('America/Sao_Paulo');
    error_reporting(E_ERROR | E_PARSE);

    try{
        $con = new PDO('mysql:host=127.0.0.1;dbname=anjtr452_while','anjtr452_root','lucashen031285');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->exec("SET CHARACTER SET utf8");
    } catch(PDOException $e){
        echo $e->getMessage();
        die();
    }

    $sql = 'SELECT * FROM `newsletter`';

    foreach ($con->query($sql) as $row) {
        print "Nome: " . $row['nome'] . "<br/>";
        print "Email: " . $row['email'] . "<br/>";
        print "Telefone: " . $row['tel'] . "<br/>";
        print "Tipo: " .$row['tipo'] . "<br/>";
        print '<br/><br/>';
    }

    ?>
</body>