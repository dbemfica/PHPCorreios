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
    public function setCodigoFormato($codigoFormato)
    {
        $codigoFormato = trim($codigoFormato);
        $array = array(1,2,3);
        if( in_array($codigoFormato, $array) ){
            $this->codigoFormato = (int)$codigoFormato;
        }else{
            trigger_error("O 'Código do Formato' deve ser 1,2 ou 3", E_USER_ERROR);
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
    * @return float
    */
    public function getComprimento()
    {
        return $this->comprimento;
    }

    /**
    * @param float
    * Validação: O comprimento não pode ser inferior a 16 cm e superior a 105 cm.
    * Comprimento do pacote(incluindo embalagem),em centímetros.
    */
    public function setComprimento($comprimento)
    {
        if( !is_numeric($comprimento) ){
            trigger_error("O 'Comprimento' deve ser Int ou Float", E_USER_ERROR);
        }
        if( $comprimento < 16 || $comprimento > 105 ){
            trigger_error("O 'Comprimento' não pode ser inferior a 18 cm ou superior a 105", E_USER_ERROR);
        }
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
    * Validação: A altura não pode ser inferior a 2 cm e superior a 105 cm.
    * Altura do pacote (incluindo embalagem), em centímetros.
    * Se o formato for envelope, informar zero(0).
    */
    public function setAltura($altura)
    {
        if( !is_numeric($altura) ){
            trigger_error("A 'Altura' deve ser Int ou Float", E_USER_ERROR);
        }
        if( $altura < 2 || $altura > 105 ){
            trigger_error("A 'Altura' não pode ser inferior a 2 cm ou superior a 105", E_USER_ERROR);
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
    * Validação: A largura não pode ser inferior a 11 cm e superior a 105 cm
    * Largura do pacote(incluindo embalagem), em centímetros.
    */
    public function setLargura($largura)
    {
        if( !is_numeric($largura) ){
            trigger_error("A 'Largura' deve ser Int ou Float", E_USER_ERROR);
        }
        if( $largura < 11 || $largura > 105 ){
            trigger_error("A 'Largura' não pode ser inferior a 11 cm e superior a 105 cm", E_USER_ERROR);
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
    * Validação: O diametro não pode ser inferior a 5 cm e superior a 91 cm
    * Diâmetro do pacote(incluindo embalagem), em centímetros
    * Se não for passado, será calculado 'altura' + 'largura'
    */
    public function setDiametro($diametro = null)
    {
        if( $diametro !== NULL ){
            if( !is_numeric($diametro) ){
                trigger_error("O 'Diametro' deve ser Int ou Float", E_USER_ERROR);
            }
            if( $diametro < 5 || $diametro > 91 ){
                trigger_error("O 'Diametro' não pode ser inferior a 5 cm e superior a 91 cm", E_USER_ERROR);
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
            trigger_error("O 'Mão Propria' deve ser 'S' ou 'N'", E_USER_ERROR);
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
        if( !is_numeric($valorDeclarado) ){
            trigger_error("O 'Valor Declarado' deve ser Int ou Float", E_USER_ERROR);
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
            trigger_error("O 'Aviso Recebimento' deve ser 'S' ou 'N'", E_USER_ERROR);
        }
    }
}