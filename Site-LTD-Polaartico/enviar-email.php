<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definir variáveis e capturar dados do formulário
    $nome = strip_tags(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensagem = trim($_POST["mensagem"]);

    // Validar os dados
    if (empty($nome) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($mensagem)) {
        echo "Preencha todos os campos corretamente.";
        exit;
    }

    // Configurações do email
    $destinatario = "seuemail@dominio.com";  // Substitua pelo seu e-mail
    $assunto = "Novo contato de $nome";
    $corpo_email = "Nome: $nome\n";
    $corpo_email .= "Email: $email\n\n";
    $corpo_email .= "Mensagem:\n$mensagem\n";

    // Cabeçalhos do email
    $headers = "From: $nome <$email>";
    $headers .= "\r\nReply-To: $email";

    // Enviar email
    if (mail($destinatario, $assunto, $corpo_email, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Falha ao enviar a mensagem.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>