<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuário</title>
</head>
<body>

<?php

require_once("conn.php");
require_once("usuario.php");

// Recebendo os valores em forma de array
$formData = filter_input_array(INPUT_POST,FILTER_DEFAULT);
// Verificando se o botão de cadastro foi acionado
if(!empty($formData['addUser'])){
    //Criando novo objeto e setando ao atributo formData o array
    $createUser = new User();
    $createUser->formData = $formData;
    $result = $createUser->create();

    if($result){
        $_SESSION['msgSucesso'] ="Usuário cadastrado com sucesso!";
    }
    else{
        $_SESSION['msgFail']="Usuário não cadastrado";
    }

    if(isset($_SESSION['msgSucesso'])){
        echo $_SESSION['msgSucesso'];
        unset($_SESSION['msgSucesso']);
    }
    if(isset($_SESSION['msgFail'])){
        echo $_SESSION['msgFail'];
        unset ($_SESSION['msgFail']);
    }

}

?>

<form name="createUser"  method="POST" action="">
    <label>Nome:</label><br>
    <input type="text" placeholdder="Nome completo" name="nome" required><br>
    <label>Email:</label><br>
    <input type="text" placeholdder="Email" name="email" required><br>
    <label>Senha:</label><br>
    <input type="password" placeholdder="Senha" name="password" required><br><br>
    <input type="submit" value="Cadastrar" name="addUser">
    <input type="button" value="Voltar" onclick="location.href='menu.html'">
</form>

</body>
</html>