<?php
// TODO 16: sessão antes de qualquer HTML.
session_start();

// TODO 17: cadastro (ou null se não existir).
$aluno = $_SESSION["aluno"] ?? null;

// TODO 18: mensagem de sucesso exibida só uma vez (flash message).
$mensagem = $_SESSION["mensagem"] ?? "";
unset($_SESSION["mensagem"]);

// TODO 19: cabeçalho compartilhado.
include __DIR__ . "/includes/cabecalho.php";
?>
<h2>Resultado do cadastro</h2>
<?php if ($mensagem !== ""): ?>
    <p><?= htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8") ?></p>
<?php endif; ?>
<?php if ($aluno !== null): ?>
    <p>Nome: <?= htmlspecialchars($aluno["nome"], ENT_QUOTES, "UTF-8") ?></p>
    <p>E-mail: <?= htmlspecialchars($aluno["email"], ENT_QUOTES, "UTF-8") ?></p>
    <p>Idade: <?= (int) $aluno["idade"] ?></p>
<?php else: ?>
    <p>Nenhum aluno cadastrado nesta sessão.</p>
<?php endif; ?>
<p><a href="cadastro.php">Novo cadastro</a> | <a href="logout.php">Encerrar sessão</a></p>
<?php
// TODO 20: rodapé compartilhado.
include __DIR__ . "/includes/rodape.php";
?>
