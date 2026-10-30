<?php
// TODO 09: sessão disponível antes de qualquer operação.
session_start();

// TODO 10: funções carregadas uma única vez.
require_once __DIR__ . "/includes/funcoes.php";

// TODO 11: só processa requisições POST.
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: cadastro.php");
    exit;
}

// TODO 12: recebimento dos dados.
$nome  = limparTexto(filter_input(INPUT_POST, "nome") ?? "");
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL); // string | false | null
$idade = filter_input(INPUT_POST, "idade", FILTER_VALIDATE_INT);   // int | false | null

// TODO 13: validações na ordem de prioridade.
$erro = "";
if ($nome === "") {
    $erro = "O nome é obrigatório.";
} elseif ($email === false || $email === null || !validarEmail($email)) {
    $erro = "Informe um e-mail válido.";
} elseif ($idade === false || $idade === null || $idade <= 0) {
    $erro = "A idade deve ser um número inteiro maior que zero.";
}

// TODO 14: cadastro inválido.
if ($erro !== "") {
    $_SESSION["erro"] = $erro;
    $_SESSION["dados_anteriores"] = [
        "nome"  => $nome,
        "email" => $_POST["email"] ?? "",
        "idade" => $_POST["idade"] ?? "",
    ];
    header("Location: cadastro.php");
    exit;
}

// TODO 15: cadastro válido.
$_SESSION["aluno"] = [
    "nome"  => $nome,
    "email" => $email,
    "idade" => $idade,
];
$_SESSION["mensagem"] = "Cadastro realizado com sucesso!";
header("Location: resultado.php");
exit;
