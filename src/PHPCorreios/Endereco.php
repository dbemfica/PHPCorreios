<?php

namespace PHPCorreios;

class Endereco
{
    private $endereco;
    private $numero;
    private $cep;
    private $bairro;
    private $codCidadade;
    private $uf;

    /**
     * Endereço
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Endereço
     * @param string
     */
    public function setEndereco($endereco)
    {
        $this->endereco = (string)trim($endereco);
    }

    /**
     * Número
     * @return inteiro
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Número
     * @param inteiro
     */
    public function setNumero($numero)
    {
        $this->numero = (int)trim($numero);
    }

    /**
     * CEP
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * CEP
     * @param mixed CEP
     */
    public function setCep($cep)
    {
        $cep = str_replace("-","",$cep);
        if( strlen($cep) != 8 ){
            trigger_error("O CEP informado é invalido", E_USER_ERROR);
        }
        $this->cep = (string)$cep;
    }

    /**
     * Bairro
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Bairro
     * @param string
     */
    public function setBairro($bairro)
    {
        $this->bairro = (string)trim($bairro);
    }

    /**
     * O código IBGE da Cidade
     * @return inteiro
     */
    public function getCodCidadade()
    {
        return $this->codCidadade;
    }

    /**
     * 'O código IBGE da Cidade'
     * @param inteiro
     */
    public function setCodCidadade($codCidadade)
    {
        $this->codCidadade = (int)trim($codCidadade);
    }

    /**
     * UF do Estado
     * @return string
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * UF do Estado
     * @param string
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    }


}