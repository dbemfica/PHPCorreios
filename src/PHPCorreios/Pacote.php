<?php

namespace PHPCorreios;

class Pacote
{
    private $codigoFormato;
    private $peso;
    private $comprimento;
    private $altura;
    private $largura;
    private $diametro;

    /**
    * @return int
    */
    public function getCodigoFormato()
    {
        return $this->codigoFormato;
    }

    /**
    * @param int $nCdFormato
    * Formato da encomenda (incluindo embalagem).
    * 1 – Formato caixa/pacote
    * 2 – Formato rolo/prisma
    * 3 - Envelope
    */
    public function setNCdFormato($codigoFormato)
    {
        $codigoFormato = trim($codigoFormato);
        $array = array(1,2,3);
        if( in_array($codigoFormato, $array) ){
            $this->codigoFormato = (int)$codigoFormato;
        }else{
            trigger_error("O Código do Formato não é um dos valores validos", E_USER_ERROR);
        }
    }

        /**
    * @return string
    */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
    * @param string
    * Peso da encomenda, incluindo sua embalagem. O peso deve ser informado
    * em quilogramas. Se o formato for Envelope, o valor máximo permitido será 1 kg
    */
    public function setPeso($peso)
    {
        $this->peso = (string)trim($peso);
    }

    /**
    * @return string
    */
    public function getComprimento()
    {
        return $this->comprimento;
    }

    /**
    * @param string
    * Comprimento do pacote(incluindo embalagem),em centímetros.
    */
    public function setComprimento($comprimento)
    {
        $this->comprimento = (string)trim($comprimento);
    }

    /**
    * @return float
    */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
    * @param float
    * Altura do pacote (incluindo embalagem), em centímetros.
    * Se o formato for envelope, informar zero(0).
    */
    public function setAltura($altura)
    {
        if( $this->codigoFormato == 3 ) {
            $this->altura = 0;
        }else{
            $this->altura = (float)$altura;
        }
    }

    /**
    * @return float
    */
    public function getLargura()
    {
        return $this->largura;
    }

    /**
    * @param float
    * Largura do pacote(incluindo embalagem), em centímetros.
    */
    public function setLargura($largura)
    {
        $this->largura = (float)$largura;
    }

    /**
     * @return float
     */
    public function getDiametro()
    {
        return $this->diametro;
    }

    /**
    * @param float
    * Diâmetro do pacote(incluindo embalagem), em centímetros
    * Se não for passado, será calculado 'altura' + 'largura'
    */
    public function setDiametro($diametro = null)
    {
        if( $diametro !== NULL ){
            $this->diametro = (float)$diametro;
        }else{
            $this->diametro = $this->altura + $this->largura;
        }
    }
}