<?php

$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "DavidLuis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$nome = $_POST["nome"];
$endereco = $_POST["endereco"];
$data_nascimento = $_POST["data_nascimento"];
$telefone = $_POST["telefone"];
$email = $_POST["email"];

$sql = "INSERT INTO clientes (nome, endereco, data_nascimento, telefone, email) 
        VALUES ('$nome', '$endereco', '$data_nascimento', '$telefone', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";

    $to = $email;
    $subject = "Confirmação de Cadastro - Barros Tecnologia";
    $message = "Olá $nome,\n\nSeu cadastro foi realizado com sucesso na Barros Tecnologia!\n\nObrigado por se cadastrar!";
    $headers = "From: davidfernad@hotmail.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "<br>Email de confirmação enviado com sucesso!";
    } else {
        echo "<br>Erro ao enviar o email de confirmação.";
    }

} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

$conn->close();

?>