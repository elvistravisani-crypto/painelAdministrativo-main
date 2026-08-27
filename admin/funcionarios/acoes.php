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

# EDITANDO UM FUNCIONÁRIO #
if (isset($_POST['editar']) && $_POST['editar'] == "editar_funcionario") 
    {
    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_funcionario']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $nome_social = mysqli_real_escape_string($conexao, $_POST['nome_social']);
    /* $foto_funcionario = mysqli_real_escape_string($conexao, $_POST['']); */
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
    /* $data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']); */

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

    // UPDATE
    $sql = "UPDATE funcionario SET nome = '$nome', nome_social = '$nome_social', data_nascimento = '$data_nascimento', sexo = '$sexo', estado_civil = '$estado_civil', cpf = '$cpf', rg = '$rg', salario = '$salario', endereco = '$endereco', numero = '$numero',  complemento = '$complemento', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep', telefone_residencial = '$telefone_residencial', telefone_celular = '$telefone_celular', email = '$email', usuario = '$usuario', senha = '$senha', tipo_acesso = '$tipo_acesso', status = '$status', codigo_cargo = '$codigo_cargo'";

    /* VIRIFICAR SE O COMPO DE FOTO ESTÁ VAZIO OU NÃO PARA SUBSTITUIR FOTO EXISTENTE */
    if (!empty($foto))
    {
     $sql .= ", foto = '$foto'";
    }
    
    $sql .= " WHERE codigo_funcionario = $codigo";
    



    try {
        if (mysqli_query($conexao, $sql)) 
        {
            $_SESSION['mensagem'] = "Funcionário atualizado com sucesso!";
            header('Location: Index.php');
            exit;
                    
        } else {
             //die("Erro: " . $sql . "<br>" . mysqli_error($conexao));
             $_SESSION['mensagem'] = "Erro ao atualizar!";
            header('Location: Index.php');
            exit; 
        }
    } 
    
    catch (mysqli_sql_exception) 
    {
        $_SESSION['mensagem'] = "Erro ao atualizar!";
        header('Location: Index.php');
        exit;
    }


}

?>