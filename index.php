<?php
require_once 'Jogo.php';
$jogo = new JogoDaMemoria();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo da Memória</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Jogo da Memória</h1>

    <?php


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jogo->alternarExibicao();
    }

    echo "<form style='width: 75%;' method='post' >";
    $jogo->renderizarCartas();
    echo '</form>';
    ?>

</body>
</html>
