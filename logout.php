<?php
// TODO 21: recupera a sessão atual.
session_start();
// TODO 22: remove todas as variáveis da sessão.
session_unset();
// TODO 23: destrói a sessão no servidor.
session_destroy();
// TODO 24: volta à página inicial e encerra o script.
header("Location: index.php");
exit;
