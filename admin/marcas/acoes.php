<?php 

# CONEXÃO COM O BANCO DE DADOS #
require_once __DIR__. "/../../conexao/conecta.php";

  # INICIANDO A SESSÃO #
  if (!isset($_SESSION))
    {
      session_start();
    }

#CADASTRANDO UMA NOVA#

    
if(isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_marca")
    {   /* PARA SEGURANÇA EVITANDO CARACTERES ESPECIAIS */
        $marca = mysqli_real_escape_string($conexao, $_POST['marca']);
        $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);

        $sql = "INSERT INTO marca VALUES (0,'$marca', '$observacao', NOW(), 1)";

        try
        {
                    if(mysqli_query($conexao, $sql))
            {
                //header('Location: index.php');
                $_SESSION['mensagem'] = "marca cadastrado com sucesso!";
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