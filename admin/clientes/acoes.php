<?php

#  CONEXÃO COM O BANCO#

require_once __DIR__ . "/../../conexao/conecta.php";

# INICIANDO A SESSÃO #
  if (!isset($_SESSION))
    {
      session_start();
    }


# CADASTRANDO UM NOVO CLIENTE #
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_cliente")
    {
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
    $sql = "INSERT INTO cliente (codigo_cliente, nome, nome_social, cpf, data_nascimento, telefone, email, endereco, numero, complemento, bairro, cidade, estado, cep, senha, sexo, data_cadastro, status)
            VALUES (0, '$nome', '$nome_social', '$cpf', '$data_nascimento', '$telefone_celular', '$email', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$cep', '$senha', '$sexo', NOW(), 1)";

    try {
        if (mysqli_query($conexao, $sql))
        {
            $_SESSION['mensagem'] = "Cliente cadastrado com sucesso!";
            header('Location: Index.php');
            exit;

        } else {
            //die("Erro: " . $sql . "<br>" . mysqli_error($conexao));
            $_SESSION['mensagem'] = "Erro ao cadastrar!";
            header('Location: inserir.php');
            exit;
        }
    }

    catch (mysqli_sql_exception)
    {
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header('Location: inserir.php');
        exit;
    }

}

# ATUALIZANDO CLIENTE #
if (isset($_POST['editar']) && $_POST['editar'] == "editar_cliente") {
    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_cliente']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $nome_social = mysqli_real_escape_string($conexao, $_POST['nome_social']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $telefone_celular = mysqli_real_escape_string($conexao, $_POST['telefone_celular']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $numero = mysqli_real_escape_string($conexao, $_POST['numero']);
    $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
    $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);

    // UPDATE
    $sql = "UPDATE cliente SET nome = '$nome', nome_social = '$nome_social', cpf = '$cpf', data_nascimento = '$data_nascimento', sexo = '$sexo', telefone = '$telefone_celular', email = '$email', senha = '$senha', status = $status, endereco = '$endereco', numero = '$numero', complemento = '$complemento', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep' WHERE codigo_cliente = $codigo";

    try {
        if (mysqli_query($conexao, $sql)) {
            $_SESSION['mensagem'] = "Cliente atualizado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar!";
        }
    }

    catch (mysqli_sql_exception)
    {
        $_SESSION['mensagem'] = "Erro ao atualizar!";
    }

    header('Location: index.php');
    exit;
}

# EXCLUINDO CLIENTE #
if (isset($_POST['deletar_cliente'])) {

    $codigo = intval($_POST['deletar_cliente']);

    // 1. Busca o nome do cliente para personalizar a mensagem
    $sql_check = "SELECT nome FROM cliente WHERE codigo_cliente = $codigo";
    $result_check = mysqli_query($conexao, $sql_check);

    if ($result_check && mysqli_num_rows($result_check) > 0) {
        $dados = mysqli_fetch_assoc($result_check);
        $nome_cliente = $dados['nome'];

        // 2. Executa a exclusão no banco de dados
        $sql_delete = "DELETE FROM cliente WHERE codigo_cliente = $codigo";

        try {
            if (mysqli_query($conexao, $sql_delete)) {
                $_SESSION['mensagem'] = "Cliente '{$nome_cliente}' excluído com sucesso!";
            } else {
                $_SESSION['mensagem'] = "Erro ao tentar excluir o cliente do banco de dados.";
            }
        }

        catch (mysqli_sql_exception)
        {
            $_SESSION['mensagem'] = "Não é possível excluir o cliente '{$nome_cliente}', pois existem pedidos vinculados a ele.";
        }
    } else {
        $_SESSION['mensagem'] = "Cliente não encontrado.";
    }

    header("Location: index.php");
    exit();
}

?>