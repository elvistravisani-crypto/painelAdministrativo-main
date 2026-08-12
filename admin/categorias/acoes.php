<?php 

# CONEXÃO COM O BANCO DE DADOS #
require_once __DIR__. "/../../conexao/conecta.php";

  # INICIANDO A SESSÃO #
  if (!isset($_SESSION))
    {
      session_start();
    }

#CADASTRANDO UM NOVO categoria#

    
if(isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_categoria")
    {
        $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);

        $sql = "INSERT INTO categoria VALUES (0,'$categoria',  1, NOW())";

        try
        {
                    if(mysqli_query($conexao, $sql))
            {
                //header('Location: index.php');
                $_SESSION['mensagem'] = "categoria cadastrado com sucesso!";
            }
            else
                {
                   // die("Erro: " . $sql . "<br>" . mysqli_error($conexao));
                   $_SESSION['mensagem'] = "Erro ao cadastrar!";
                }

        }
        catch (mysqli_sql_exception)
        {
            $_SESSION['mensagem'] = "Erro ao cadastrar!";
        }
        header('Location: inserir.php');
    }

?>