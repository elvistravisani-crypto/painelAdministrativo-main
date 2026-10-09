<?php

# CONEXÃO COM O BANCO#

require_once __DIR__ . "/../../conexao/conecta.php";

# INICIANDO A SESSÃO #
  if (!isset($_SESSION))
    {
      session_start();
    }
    

# CADASTRANDO PRODUTO #
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_produto")
    {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $codigo_categoria = mysqli_real_escape_string($conexao, $_POST['codigo_categoria']);
    $codigo_marca = mysqli_real_escape_string($conexao, $_POST['codigo_marca']);
    $valor_faturamento = str_replace(',', '.', $_POST['valor_faturamento']);
    $preco_produto = str_replace(',', '.', $_POST['preco_produto']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $valor_lucro = !empty($_POST['valor_lucro']) ? str_replace(',', '.', $_POST['valor_lucro']) : "NULL";
    $valor_desconto = !empty($_POST['valor_desconto']) ? str_replace(',', '.', $_POST['valor_desconto']) : "NULL";
    $status = mysqli_real_escape_string($conexao, $_POST['status']);

    $ft_1 = basename($_FILES['ft_produto_1']['name']);
    $ft_2 = basename($_FILES['ft_produto_2']['name']);
    $ft_3 = basename($_FILES['ft_produto_3']['name']);

    if (!empty($ft_1)) {
        move_uploaded_file($_FILES['ft_produto_1']['tmp_name'], "../../imagens/" . $ft_1);
    }
    if (!empty($ft_2)) {
        move_uploaded_file($_FILES['ft_produto_2']['tmp_name'], "../../imagens/" . $ft_2);
    }
    if (!empty($ft_3)) {
        move_uploaded_file($_FILES['ft_produto_3']['tmp_name'], "../../imagens/" . $ft_3);
    }

    $sql = "INSERT INTO produto (codigo_produto, codigo_categoria, codigo_marca, nome, valor_faturamento, preco_produto, data_cadastro, descricao, valor_lucro, valor_desconto, status, ft_produto_1, ft_produto_2, ft_produto_3)
            VALUES (0, '$codigo_categoria', '$codigo_marca', '$nome', '$valor_faturamento', '$preco_produto', NOW(), '$descricao', $valor_lucro, $valor_desconto, '$status', '$ft_1', '$ft_2', '$ft_3')";

    try {
        if (mysqli_query($conexao, $sql))
        {
            $_SESSION['mensagem'] = "Produto cadastrado com sucesso!";
            header('Location: Index.php');
            exit;

        } else {
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

# EDITANDO PRODUTO #
if (isset($_POST['editar']) && $_POST['editar'] == "editar_produto") {
    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_produto']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $codigo_categoria = mysqli_real_escape_string($conexao, $_POST['codigo_categoria']);
    $codigo_marca = mysqli_real_escape_string($conexao, $_POST['codigo_marca']);
    $valor_faturamento = str_replace(',', '.', $_POST['valor_faturamento']);
    $preco_produto = str_replace(',', '.', $_POST['preco_produto']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $valor_lucro = !empty($_POST['valor_lucro']) ? "'" . str_replace(',', '.', $_POST['valor_lucro']) . "'" : "NULL";
    $valor_desconto = !empty($_POST['valor_desconto']) ? "'" . str_replace(',', '.', $_POST['valor_desconto']) . "'" : "NULL";
    $status = mysqli_real_escape_string($conexao, $_POST['status']);

    $ft_1 = basename($_FILES['ft_produto_1']['name']);
    $ft_2 = basename($_FILES['ft_produto_2']['name']);
    $ft_3 = basename($_FILES['ft_produto_3']['name']);

    if (!empty($ft_1)) {
        move_uploaded_file($_FILES['ft_produto_1']['tmp_name'], "../../imagens/" . $ft_1);
    }
    if (!empty($ft_2)) {
        move_uploaded_file($_FILES['ft_produto_2']['tmp_name'], "../../imagens/" . $ft_2);
    }
    if (!empty($ft_3)) {
        move_uploaded_file($_FILES['ft_produto_3']['tmp_name'], "../../imagens/" . $ft_3);
    }

    $sql = "UPDATE produto SET nome = '$nome', codigo_categoria = '$codigo_categoria', codigo_marca = '$codigo_marca', valor_faturamento = '$valor_faturamento', preco_produto = '$preco_produto', descricao = '$descricao', valor_lucro = $valor_lucro, valor_desconto = $valor_desconto, status = '$status'";

    if (!empty($ft_1)) {
        $sql .= ", ft_produto_1 = '$ft_1'";
    }
    if (!empty($ft_2)) {
        $sql .= ", ft_produto_2 = '$ft_2'";
    }
    if (!empty($ft_3)) {
        $sql .= ", ft_produto_3 = '$ft_3'";
    }

    $sql .= " WHERE codigo_produto = $codigo";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Produto atualizado com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar!";
    }

    header('Location: index.php');
    exit;
}

# EXCLUINDO PRODUTO #
if (isset($_POST['deletar_produto'])) {

    $codigo = intval($_POST['deletar_produto']);

    $sql_check = "SELECT nome FROM produto WHERE codigo_produto = $codigo";
    $result_check = mysqli_query($conexao, $sql_check);

    if ($result_check && mysqli_num_rows($result_check) > 0) {
        $dados = mysqli_fetch_assoc($result_check);
        $nome_produto = $dados['nome'];

        $sql_delete = "DELETE FROM produto WHERE codigo_produto = $codigo";

        if (mysqli_query($conexao, $sql_delete)) {
            $_SESSION['mensagem'] = "Produto '{$nome_produto}' excluído com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao tentar excluir o produto do banco de dados.";
        }
    } else {
        $_SESSION['mensagem'] = "Produto não encontrado.";
    }

    header("Location: index.php");
    exit();
}

?>