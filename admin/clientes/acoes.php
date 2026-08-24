<?php

#  CONEXÃO COM O BANCO#

require_once __DIR__ . "/../../conexao/conecta.php";

# INICIANDO A SESSÃO #
if (!isset($_SESSION)) {
    session_start();
}


/* CADASTRANDO UM NOVO CLIENTE */
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_cliente") {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $nome_social = mysqli_real_escape_string($conexao, $_POST['nome_social']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $telefone_celular = mysqli_real_escape_string($conexao, $_POST['telefone_celular']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $numero = mysqli_real_escape_string($conexao, $_POST['numero']);
    $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
    $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);

    // INSERT 
    $sql = "INSERT INTO cliente VALUES (0, '$nome', '$nome_social' , '$cpf', '$data_nascimento', '$telefone_celular', '$email', '$endereco', $numero, '$complemento', '$bairro', '$cidade', '$estado', '$cep', '$senha', '$sexo', NOW(), 1)";

     try {
        if (mysqli_query($conexao, $sql)) 
        {
            $_SESSION['mensagem'] = "Cliente cadastrado com sucesso!";
            header('Location: inserir.php');
            exit;
                    
        } else {die("Erro: " . $sql . "<br>" . mysqli_error($conexao));
           /*  $_SESSION['mensagem'] = "Erro ao cadastrar!";
            header('Location: inserir.php');
            exit; */
        }
        
    } 
    
    catch (mysqli_sql_exception) 
    {
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header('Location: inserir.php');
        exit;
    }
}
?>