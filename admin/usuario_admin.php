<?php   
# INICIANDO UMA SESSÃO #
if(!isset($_SESSION))
    {
        session_start();
    }

  # VERIFICANDO SE O USUÁRIO É ADMIN #
    if ($_SESSION['TYPE'] != '1')
        {
            $_SESSION['naoAdm'] = "Apenas usuários administradores podem acessar esta área";
            header('Location: ../Admin.php');
        }



?>