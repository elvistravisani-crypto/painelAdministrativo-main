<?php 

# CONEXÃO COM O BANCO DE DADOS #
require_once __DIR__. "/../../conexao/conecta.php";

  # INICIANDO A SESSÃO #
  if (!isset($_SESSION))
    {
      session_start();
    }

#CADASTRANDO UMA NOVA MARCA#

    
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

    # EDITANDO UMA MARCA #
if (isset($_POST['editar']) && $_POST['editar'] == "editar_marca") {
    $codigo     = mysqli_real_escape_string($conexao, $_POST['codigo_marca']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $descricao  = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $status     = mysqli_real_escape_string($conexao, $_POST['status']);

    $sql = "UPDATE marca SET nome = '$nome', descricao = '$descricao', status = $status WHERE codigo_marca = $codigo";

    try {
        if (mysqli_query($conexao, $sql)) {
            $_SESSION['mensagem'] = "Marca atualizada com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar marca!";
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['mensagem'] = "Erro ao atualizar marca no banco de dados!";
    }

    header('Location: index.php');
    exit();
}

# EXCLUINDO MARCA #
if (isset($_POST['deletar_marca'])) {

    $codigo = intval($_POST['deletar_marca']);

    $sql_check = "SELECT marca.nome, COUNT(produto.codigo_produto) AS total_produtos
                  FROM marca
                  LEFT JOIN produto ON marca.codigo_marca = produto.codigo_marca
                  WHERE marca.codigo_marca = $codigo 
                  GROUP BY marca.codigo_marca, marca.nome";

    $result_check = mysqli_query($conexao, $sql_check);

    if ($result_check && mysqli_num_rows($result_check) > 0) {
        $dados = mysqli_fetch_assoc($result_check);
        $nome = $dados['nome'];
        $total_produtos = $dados['total_produtos'];

        // Se houver produtos vinculados, impede a exclusão
        if ($total_produtos > 0) {
            $_SESSION['mensagem'] = "Não é possível excluir a marca '{$nome}', pois existem {$total_produtos} produto(s) vinculado(s) a ela.";
        } else {
            // Se não houver produtos vinculados, deleta
            $sql_delete = "DELETE FROM marca WHERE codigo_marca = $codigo";

            if (mysqli_query($conexao, $sql_delete)) {
                $_SESSION['mensagem'] = "Marca excluída com sucesso!";
            } else {
                $_SESSION['mensagem'] = "Erro ao tentar excluir a marca do banco de dados.";
            }
        }
    } else {
        $_SESSION['mensagem'] = "Marca não encontrada.";
    }

    header("Location: index.php");
    exit();
}
