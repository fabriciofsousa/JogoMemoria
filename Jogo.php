<?php
require_once 'Carta.php';

class JogoDaMemoria
{
    private $cartas;

    public function __construct()
    {

        session_start();
        $this->inicializarCartas();
    }


    private function inicializarCartas()
    {
        $this->cartas = [
        new Carta('imagens/imagem1.jpeg', 0),
        new Carta('imagens/imagem2.jpeg', 1),
        new Carta('imagens/imagem3.jpeg', 2),
        new Carta('imagens/imagem4.jpeg', 3),

        new Carta('imagens/imagem1.jpeg', 4),
        new Carta('imagens/imagem2.jpeg', 5),
        new Carta('imagens/imagem3.jpeg', 6),
        new Carta('imagens/imagem4.jpeg', 7),

        ];

        // Restaura o estado das cartas a partir da sessão
        foreach ($this->cartas as $index => $carta) {
            $this->cartas[$index]->setExibida(isset($_SESSION['cartas'][$index]) ? $_SESSION['cartas'][$index] : false);
        }
    }


    public function renderizarCartas()
    {
        echo "<table>";

                    echo "<form method='post' style='display:inline-block;'>
                            <input type='hidden' name='carta_clicada' value='{$this->cartas[0]->getNumero()}'>
                            <button type='submit' class='card' style='vertical-align: bottom;'>{$this->cartas[0]->getConteudo()}</button>
                          </form>";

                    echo "<form method='post' style='display:inline-block;'>
                            <input type='hidden' name='carta_clicada' value='{$this->cartas[1]->getNumero()}'>
                            <button type='submit' class='card' style='vertical-align: bottom;'>{$this->cartas[1]->getConteudo()}</button>
                          </form>";


                    echo "<form method='post' style='display:inline-block;'>
                            <input type='hidden' name='carta_clicada' value='{$this->cartas[2]->getNumero()}'>
                            <button type='submit' class='card' style='vertical-align: bottom;'>{$this->cartas[2]->getConteudo()}</button>
                          </form>";

                    echo "<form method='post' style='display:inline-block;'>
                            <input type='hidden' name='carta_clicada' value='{$this->cartas[3]->getNumero()}'>
                            <button type='submit' class='card' style='vertical-align: bottom;'>{$this->cartas[3]->getConteudo()}</button>
                          </form>";

                    echo "<form method='post' style='display:inline-block;'>
                            <input type='hidden' name='carta_clicada' value='{$this->cartas[4]->getNumero()}'>
                            <button type='submit' class='card' style='vertical-align: bottom;'>{$this->cartas[4]->getConteudo()}</button>
                          </form>";

                    echo "<form method='post' style='display:inline-block;'>
                            <input type='hidden' name='carta_clicada' value='{$this->cartas[5]->getNumero()}'>
                            <button type='submit' class='card' style='vertical-align: bottom;'>{$this->cartas[5]->getConteudo()}</button>
                          </form>";

                    echo "<form method='post' style='display:inline-block;'>
                            <input type='hidden' name='carta_clicada' value='{$this->cartas[6]->getNumero()}'>
                            <button type='submit' class='card' style='vertical-align: bottom;'>{$this->cartas[6]->getConteudo()}</button>
                          </form>";

                    echo "<form method='post' style='display:inline-block;'>
                            <input type='hidden' name='carta_clicada' value='{$this->cartas[7]->getNumero()}'>
                            <button type='submit' class='card' style='vertical-align: bottom;'>{$this->cartas[7]->getConteudo()}</button>
                          </form>";

        echo "</table>";

    }

public function alternarExibicao()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['carta_clicada'])) {
            $cartaClicadaIndex = $_POST['carta_clicada'];

            // Verifica se a carta já está exibida
            if (!$this->cartas[$cartaClicadaIndex]->isExibida()) {
                $cartaClicada = $this->cartas[$cartaClicadaIndex];
                $cartaClicada->alternarExibicao();

                if (!isset($_SESSION['primeiroClique'])) {
                    $_SESSION['primeiroClique'] = $cartaClicadaIndex;
                } else {
                    $_SESSION['segundoClique'] = $cartaClicadaIndex;
                    $this->verificarCartasClicadas();
                }
            }
        }

        // Atualiza o estado das cartas na sessão
        foreach ($this->cartas as $index => $carta) {
            $_SESSION['cartas'][$index] = $carta->isExibida();
        }
    }
}



private function verificarCartasClicadas()
{
    if (isset($_SESSION['primeiroClique']) && isset($_SESSION['segundoClique'])) {
        $indice1 = $_SESSION['primeiroClique'];
        $indice2 = $_SESSION['segundoClique'];

        $carta1 = $this->cartas[$indice1];
        $carta2 = $this->cartas[$indice2];

        if ($carta1->getImagem() === $carta2->getImagem() && $carta1->getNumero() !== $carta2->getNumero()) {
            echo "<br>";
            echo "Certo";
        } else {
            echo "<br>";
            echo "Errado";

            echo "<script>reload()</script>";
                        $carta1->exibir();
                        $carta2->exibir();
            // Atrasa a ocultação das cartas no lado do servidor para sincronizar com o atraso do JavaScript
            usleep(500000); // 500000 microssegundos = 0,5 segundos

            // Oculta as cartas no lado do servidor
            echo "<script>reload()</script>";
            $carta1->ocultar();
            $carta2->ocultar();
            echo "<script>reload()</script>";
        }

        unset($_SESSION['primeiroClique']);
        unset($_SESSION['segundoClique']);
    }
}

}
?>
