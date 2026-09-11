<?php

# CONEXÃO COM O BANCO DE DADOS #
require_once __DIR__ . "/../../conexao/conecta.php";

# INICIANDO A SESSÃO #
if (!isset($_SESSION)) {
    session_start();
}


#CADASTRANDO UM NOVO categoria#

if (isset($_POST['editar']) && $_POST['editar'] == "editar_categoria") {
    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_categoria']);

    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);
    $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);


    //UPDATE

    $sql = "UPDATE categoria SET nome = '$categoria', observacao = '$observacao', status = $status WHERE codigo_categoria = $codigo";

    try {
        if (mysqli_query($conexao, $sql)) {
            //header('Location: index.php');
            $_SESSION['mensagem'] = "categoria atualizado com sucesso!";
        } else {
            //die("Erro: " . $sql . "<br>" . mysqli_error($conexao));
            $_SESSION['mensagem'] = "Erro ao atualizar!";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
    }
    header('Location: Index.php');
}
#ATUALIZANDO UM  categoria#

if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_categoria") {
    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);
    $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);

    $sql = "INSERT INTO categoria VALUES (0,'$categoria', '$observacao', 1, NOW())";

    try {
        if (mysqli_query($conexao, $sql)) {
            //header('Location: index.php');
            $_SESSION['mensagem'] = "categoria cadastrado com sucesso!";
        } else {
            // die("Erro: " . $sql . "<br>" . mysqli_error($conexao));
            $_SESSION['mensagem'] = "Erro ao cadastrar!";
        }
    } catch (mysqli_sql_exception) {
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
    }
    header('Location: inserir.php');
}
//EXCLUINDO categoria 
if (isset($_POST['deletar_categoria'])) {
    $codigo = $_POST['deletar_categoria'];

    $sql = "DELETE FROM categoria WHERE codigo_categoria = $codigo";


    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "categoria excluido com sucesso!";
        header("Location: Index.php");
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir! Se algum funcionário estiver vinculado a este categoria, não será possível excluí-lo";
        header("Location: Index.php");
    }
}
