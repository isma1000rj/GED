<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$idioma = isset($_SESSION['idiomaSelecionado']) ? $_SESSION['idiomaSelecionado'] : 'valor_padrao';

define('LANG', $idioma);
ob_end_flush();

?>