<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pega os dados enviados pelo formulário
    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = htmlspecialchars(trim($_POST['email']));
    $telefone = htmlspecialchars(trim($_POST['telefone']));
    $mensagem = htmlspecialchars(trim($_POST['mensagem']));

    // Validação básica (pode ser expandida)
    if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($mensagem)) {

        // Definir o destinatário do e-mail
        $para = "seuemail@exemplo.com"; // Substitua pelo seu e-mail
        $assunto = "Novo contato - Sessão individual com Ayahuasca";

        // Monta o corpo do e-mail
        $corpo_email = "Você recebeu uma nova mensagem de contato do site.\n\n";
        $corpo_email .= "Nome: $nome\n";
        $corpo_email .= "E-mail: $email\n";
        $corpo_email .= "Telefone: $telefone\n\n";
        $corpo_email .= "Mensagem: \n$mensagem\n";

        // Cabeçalhos para garantir que o e-mail seja enviado como UTF-8 e com um remetente adequado
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

        // Envia o e-mail
        if (mail($para, $assunto, $corpo_email, $headers)) {
            // Se o e-mail for enviado com sucesso, redireciona para uma página de agradecimento
            echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href = 'obrigado.html';</script>";
        } else {
            // Caso haja algum erro no envio
            echo "<script>alert('Erro ao enviar mensagem. Por favor, tente novamente.'); window.location.href = 'index.html';</script>";
        }
    } else {
        // Se houver campos vazios, informa o usuário
        echo "<script>alert('Por favor, preencha todos os campos.'); window.location.href = 'index.html';</script>";
    }
} else {
    // Caso o acesso não seja via método POST, redireciona para a página inicial
    header("Location: index.html");
    exit();
}
?>
