<?php

#  CONEXÃO COM O BANCO#

require_once __DIR__ . "/../../conexao/conecta.php";

# INICIANDO A SESSÃO #
  if (!isset($_SESSION))
    {
      session_start();
    }
    

# CADASTRANDO UM NOVO FUNCIONÁRIO #
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_funcionario")
    {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $nome_social = mysqli_real_escape_string($conexao, $_POST['nome_social']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $estado_civil = mysqli_real_escape_string($conexao, $_POST['estado_civil']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $rg = mysqli_real_escape_string($conexao, $_POST['rg']);
    $salario = str_replace(',', '.', $_POST['salario']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $numero = mysqli_real_escape_string($conexao, $_POST['numero']);
    $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
    $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
    $telefone_residencial = mysqli_real_escape_string($conexao, $_POST['telefone_residencial']);
    $telefone_celular = mysqli_real_escape_string($conexao, $_POST['telefone_celular']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    $tipo_acesso = mysqli_real_escape_string($conexao, $_POST['tipo_acesso']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);
    $codigo_cargo = mysqli_real_escape_string($conexao, $_POST['codigo_cargo']);

    /* ENVIANDO A FOTO PARA O SERVIDOR */

    /* Pegando o caminho da imagem */
    $foto = basename($_FILES['foto_funcionario']['name']);

    /* Salvando um caminho temporário na pasta 'TMP' */
    $tmp = $_FILES['foto_funcionario']['tmp_name'];

    /* Criadno o caminho para a pasta final */
    $final = "../../imagens/" . $foto;

    /* movendo a imagem da pasta TMP para a pasta IMAGES */
    if (!empty($foto))
        {
            move_uploaded_file($tmp, $final);
        }

    // INSERT
    $sql = "INSERT INTO funcionario (codigo_funcionario, codigo_cargo, nome, nome_social, foto, data_nascimento, sexo, estado_civil, cpf, rg, salario, endereco, numero, complemento, bairro, cidade, estado, cep, telefone_residencial, telefone_celular, email, usuario, senha, tipo_acesso, status, data_cadastro)
            VALUES (0, '$codigo_cargo', '$nome', '$nome_social', '$foto', '$data_nascimento', '$sexo', '$estado_civil', '$cpf', '$rg', '$salario', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$cep', '$telefone_residencial', '$telefone_celular', '$email', '$usuario', '$senha', '$tipo_acesso', '$status', NOW())";

    try {
        if (mysqli_query($conexao, $sql))
        {
            $_SESSION['mensagem'] = "Funcionário cadastrado com sucesso!";
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

# ATUALIZANDO FUNCIONÁRIO #
if (isset($_POST['editar']) && $_POST['editar'] == "editar_funcionario") {
    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_funcionario']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $nome_social = mysqli_real_escape_string($conexao, $_POST['nome_social']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $estado_civil = mysqli_real_escape_string($conexao, $_POST['estado_civil']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $rg = mysqli_real_escape_string($conexao, $_POST['rg']);
    $salario = str_replace(',', '.', $_POST['salario']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $numero = mysqli_real_escape_string($conexao, $_POST['numero']);
    $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
    $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
    $telefone_residencial = mysqli_real_escape_string($conexao, $_POST['telefone_residencial']);
    $telefone_celular = mysqli_real_escape_string($conexao, $_POST['telefone_celular']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    // TRATAMENTO PARA QUE O VALOR 0 (COMUM) NÃO SEJA IGNORADO
    $tipo_acesso = (isset($_POST['tipo_acesso']) && $_POST['tipo_acesso'] !== '') ? intval($_POST['tipo_acesso']) : 0;

    $status = mysqli_real_escape_string($conexao, $_POST['status']);

    // NO EDITAR.PHP O SELECT DE CARGO SE CHAMA "codigo_cargo", NÃO "cargo"
    $cargo = mysqli_real_escape_string($conexao, $_POST['codigo_cargo']);

    // ENVIANDO A FOTO PARA O SERVIDOR SE UMA NOVA FOTO FOI SELECIONADA
    $foto = basename($_FILES['foto_funcionario']['name']);
    if (!empty($foto)) {
        $tmp = $_FILES['foto_funcionario']['tmp_name'];
        $final = __DIR__ . "/../../assets/img/funcionarios/" . $foto;
        move_uploaded_file($tmp, $final);
    }

    // UPDATE BASE
    $sql = "UPDATE funcionario SET nome = '$nome', nome_social = '$nome_social', data_nascimento = '$data_nascimento', sexo = '$sexo', estado_civil = '$estado_civil', cpf = '$cpf', rg = '$rg', salario = '$salario', endereco = '$endereco', numero = '$numero', complemento = '$complemento', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep', telefone_residencial = '$telefone_residencial', telefone_celular = '$telefone_celular', email = '$email', usuario = '$usuario', senha = '$senha', tipo_acesso = $tipo_acesso, status = $status, codigo_cargo = '$cargo'";

    // ADICIONA A FOTO APENAS SE FOI ENVIADA UMA NOVA
    if (!empty($foto)) {
        $sql .= ", foto = '$foto'";
    }

    // COMPLETANDO O UPDATE COM CLAUSULA WHERE
    $sql .= " WHERE codigo_funcionario = $codigo";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Funcionário atualizado com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar!";
    }

    // REDIRECIONAMENTO CORRIGIDO PARA O INDEX
    header('Location: index.php');
    exit;
}

# EXCLUINDO FUNCIONÁRIO #
if (isset($_POST['deletar_funcionario'])) {

    $codigo = intval($_POST['deletar_funcionario']);

    // 1. Busca o nome do funcionário para personalizar a mensagem
    $sql_check = "SELECT nome FROM funcionario WHERE codigo_funcionario = $codigo";
    $result_check = mysqli_query($conexao, $sql_check);

    if ($result_check && mysqli_num_rows($result_check) > 0) {
        $dados = mysqli_fetch_assoc($result_check);
        $nome_funcionario = $dados['nome'];

        // 2. Executa a exclusão no banco de dados
        $sql_delete = "DELETE FROM funcionario WHERE codigo_funcionario = $codigo";

        if (mysqli_query($conexao, $sql_delete)) {
            $_SESSION['mensagem'] = "Funcionário '{$nome_funcionario}' excluído com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao tentar excluir o funcionário do banco de dados.";
        }
    } else {
        $_SESSION['mensagem'] = "Funcionário não encontrado.";
    }

    header("Location: index.php");
    exit();
}

?>