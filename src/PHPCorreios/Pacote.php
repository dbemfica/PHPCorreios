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
    private $maoPropria;
    private $valorDeclarado;
    private $avisoRecebimento;

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
        if( is_numeric($altura) ){
            trigger_error("O valor deve ser Int ou Float", E_USER_ERROR);
        }
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
        if( is_numeric($largura) ){
            trigger_error("O valor deve ser Int ou Float", E_USER_ERROR);
        }
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
            if( is_numeric($diametro) ){
                trigger_error("O valor deve ser Int ou Float", E_USER_ERROR);
            }
            $this->diametro = (float)$diametro;
        }else{
            $this->diametro = $this->altura + $this->largura;
        }
    }

    /**
    * @return string
    */
    public function getMaoPropria()
    {
        return $this->maoPropria;
    }

    /**
    * @return string
    * Indica se a encomenda será entregue com o serviço adicional mão própria.
    * Valores possíveis: S ou N (S – Sim, N – Não)
    */
    public function setMaoPropria($maoPropria)
    {
        $maoPropria = trim($maoPropria);
        $array = array('S','N');
        if( in_array($maoPropria, $array) ){
            $this->maoPropria = (string)$maoPropria;
        }else{
            trigger_error("O valor não é um dos valores validos", E_USER_ERROR);
        }
    }

    /**
    * @return float
    */
    public function getValorDeclarado()
    {
        return $this->valorDeclarado;
    }

    /**
    * @param float
    * Indica se a encomenda será entregue com o serviço adicional valor declarado.
    * Neste campo deve ser apresentado o valor declarado desejado, em Reais.
    */
    public function setValorDeclarado($valorDeclarado)
    {
        if( is_numeric($valorDeclarado) ){
            trigger_error("O valor deve ser Int ou Float", E_USER_ERROR);
        }
        $this->valorDeclarado = (float)$valorDeclarado;
    }

    /**
    * @return string
    */
    public function getAvisoRecebimento()
    {
        return $this->avisoRecebimento;
    }

    /**
    * @return string
    * Indica se a encomenda será entregue com o serviço adicional aviso de recebimento.
    * Valores possíveis: S ou N (S – Sim, N – Não)
    */
    public function setAvisoRecebimento($avisoRecebimento)
    {
        $avisoRecebimento = trim($avisoRecebimento);
        $array = array('S','N');
        if( in_array($avisoRecebimento, $array) ){
            $this->avisoRecebimento = (string)$avisoRecebimento;
        }else{
            trigger_error("O valor não é um dos valores validos", E_USER_ERROR);
        }
    }
}