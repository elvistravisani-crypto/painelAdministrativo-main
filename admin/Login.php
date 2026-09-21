<?php 
    
    # CONEXÃO COM O BANCO DE DADOS #
require_once __DIR__ . "/../conexao/conecta.php";

# INICIANDO UMA SESSÃO #
if(!isset($_SESSION))
    {
        session_start();
    }



# VERIFICANDO USUÁRIO E SENHA PARA COMPARAR INFORMAÇÕES DO BANCO #
if (isset($_POST['usuario']) && $_POST['usuario'] != '' && isset($_POST['senha']) && $_POST['senha'] != '')
  {
    // Rotina de login
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $sql = "SELECT * FROM funcionario WHERE usuario = '$usuario' AND senha = '$senha'";
    $query = mysqli_query($conexao, $sql);
    $funcionario = mysqli_fetch_assoc($query);
   
    if (isset($funcionario))
        {
            $_SESSION["ID"] = $funcionario['codigo_funcionario'];
            $_SESSION["USER"] = $funcionario['usuario'];
            $_SESSION["TYPE"] = $funcionario['tipo_acesso'];
            $_SESSION["NAME"] = $funcionario['nome'];

            header('Location: Admin.php');

        }
        else
            {
                $_SESSION['loginErro'] = "Usuário ou senha inválidos.";
                header('Location: index.php');
            }

  }
  else
    {
      $_SESSION['loginVazio'] = "Informe usuário e senha";
      header('Location: index.php');
    }


?>