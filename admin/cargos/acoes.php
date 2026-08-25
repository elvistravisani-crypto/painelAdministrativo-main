<?php 

# CONEXÃO COM O BANCO DE DADOS #
require_once __DIR__. "/../../conexao/conecta.php";

  # INICIANDO A SESSÃO #
  if (!isset($_SESSION))
    {
      session_start();
    }

#ATUALIZANDO UM  CARGO#
  
if(isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_cargo")
    {
        $cargo = mysqli_real_escape_string($conexao, $_POST['cargo']);
        $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);

        $sql = "INSERT INTO cargo VALUES (0,'$cargo', '$observacao', 1, NOW())";

        try
        {
                    if(mysqli_query($conexao, $sql))
            {
                //header('Location: index.php');
                $_SESSION['mensagem'] = "Cargo cadastrado com sucesso!";
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
    #CADASTRANDO UM NOVO CARGO#
  
if(isset($_POST['editar']) && $_POST['editar'] == "editar_cargo")
    {
        $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_cargo']);

        $cargo = mysqli_real_escape_string($conexao, $_POST['cargo']);
        $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);
        $status = mysqli_real_escape_string($conexao, $_POST['status']);


        //UPDATE

        $sql = "UPDATE cargo SET nome = '$cargo', observacao = '$observacao', status = $status WHERE codigo_cargo = $codigo";

        try
        {
                    if(mysqli_query($conexao, $sql))
            {
                //header('Location: index.php');
                $_SESSION['mensagem'] = "Cargo atualizado com sucesso!";
            }
            else
                {
                    //die("Erro: " . $sql . "<br>" . mysqli_error($conexao));
                   $_SESSION['mensagem'] = "Erro ao atualizar!";
                }

        }
        catch (mysqli_sql_exception)
        {
            $_SESSION['mensagem'] = "Erro ao cadastrar!";
        }
        header('Location: Index.php');
    }

?>


