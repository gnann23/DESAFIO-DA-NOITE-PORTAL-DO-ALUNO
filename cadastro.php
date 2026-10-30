<?php
// TODO 04: sessão antes de qualquer saída HTML.
session_start();
$nome = "";
$email = "";
$idade = "";
$mensagem = "";

// TODO 05: recupera a mensagem de erro e a remove da sessão.
if (isset($_SESSION["erro"])) {
    $mensagem = $_SESSION["erro"];
    unset($_SESSION["erro"]);
}

// TODO 06: recupera os valores da tentativa anterior e os remove da sessão.
if (isset($_SESSION["dados_anteriores"])) {
    $dados = $_SESSION["dados_anteriores"];
    $nome  = $dados["nome"] ?? "";
    $email = $dados["email"] ?? "";
    $idade = $dados["idade"] ?? "";
    unset($_SESSION["dados_anteriores"]);
}

// TODO 07: cabeçalho compartilhado.
include __DIR__ . "/includes/cabecalho.php";
?>
<h2>Cadastro de aluno</h2>
<?php if ($mensagem !== ""): ?>
    <p><?= htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8") ?></p>
<?php endif; ?>
<form method="POST" action="processar_cadastro.php">
    <label for="nome">Nome:</label>
    <input id="nome" name="nome" type="text" value="<?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>">
    <br><br>
    <label for="email">E-mail:</label>
    <input id="email" name="email" type="text" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>">
    <br><br>
    <label for="idade">Idade:</label>
    <input id="idade" name="idade" type="number" value="<?= htmlspecialchars((string) $idade, ENT_QUOTES, 'UTF-8') ?>">
    <br><br>
    <button type="submit">Salvar cadastro</button>
</form>
<p><a href="index.php">Voltar</a></p>
<?php
// TODO 08: rodapé compartilhado.
include __DIR__ . "/includes/rodape.php";
?>
