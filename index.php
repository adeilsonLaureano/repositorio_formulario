<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuário</title>

    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

<form name="createUser" class="sm-3 mx-auto"  method="POST" action="" style="background-color: lightblue; margin-radius: 5px;">
<div class="mb-3 mt-3">
    <label for="nome" class="form-label">Nome:</label><br>
    <input type="text" class="form-control" placeholdder="Nome completo" name="nome" required><br>
</div>
    
<div class="mb-3 mt-3">
    <label for="email" class="form-label">Email:</label><br>
    <input type="text" class="form-control" placeholdder="Email" name="email" required><br>
</div>

<div class="mb-3 mt-3">
    <label for="password" class="form-label">Senha:</label><br>
    <input type="password" class="form-control" placeholdder="Senha" name="password" required><br><br>
</div>

    <input type="submit" class="btn btn-primary" value="Cadastrar" name="addUser">
</form>

</body>
</html>