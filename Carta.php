<?php

class Carta
{
    private $imagem;
    private $numero;
    private $exibida = false;

    public function __construct($imagem, $numero)
    {
        $this->imagem = $imagem;
        $this->numero = $numero;
    }

    public function exibir()
    {
        $this->exibida = true;
    }

    public function ocultar()
    {
        $this->exibida = false;
    }

    public function alternarExibicao()
    {
        $this->exibida = !$this->exibida;
    }

    public function isExibida()
    {
        return $this->exibida;
    }

    public function setExibida($exibida)
    {
        $this->exibida = $exibida;
    }

public function getConteudo()
{
    return $this->exibida ? //se for pra exibir
    "<img src='{$this->imagem}' alt='Imagem {$this->numero}'>" //retorna isso (imagem)
    :
    "<span>{$this->numero}</span>"; //else, retorna isso (numero da carta)
}

     public function getImagem()
        {
            return $this->imagem;
        }

     public function getNumero()
        {
            return $this->numero;
        }
}

?>
