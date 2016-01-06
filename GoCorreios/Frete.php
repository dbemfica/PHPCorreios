<?php
namespace GoCorreios;

class Frete
{
    /**
     * endereço do webservice dos correios
     */
    private $_ect = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx";

    /**
     * Parametros para calcular o Frete
     */
    private $nCdEmpresa;
    private $sDsSenha;
    private $nCdServico;
    private $sCepOrigem;
    private $sCepDestino;
    private $nVlPeso;
    private $nCdFormato;
    private $nVlComprimento;
    private $nVlAltura;
    private $nVlLargura;
    private $nVlDiametro;
    private $sCdMaoPropria;
    private $nVlValorDeclarado;
    private $sCdAvisoRecebimento;

    /**
    * @param string $nCdEmpresa
    * Seu código administrativo junto à ECT. O código está
    * disponível no corpo do contrato firmado com os Correios.
    */
    public function setNCdEmpresa($nCdEmpresa)
    {
        $this->nCdEmpresa = $nCdEmpresa;
    }

    /**
    * @param string $sDsSenha
    * Senha para acesso ao serviço, associada ao seu código administrativo.
    * A senha inicial corresponde aos 8 primeiros dígitos do CNPJ informado
    * no contrato. A qualquer momento, é possível alterar a senha no endereço
    */
    public function setSDsSenha($sDsSenha)
    {
        $this->sDsSenha = $sDsSenha;
    }

    /**
     * @param Int $nCdServico
     * Código do serviço
     * 41106 PAC sem contrato
     * 40010 SEDEX sem contrato
     * 40045 SEDEX a Cobrar, sem contrato
     * 40215 SEDEX 10, sem contrato
     * 40290 SEDEX Hoje, sem contrato
     * 40096 SEDEX com contrato
     * 40436 SEDEX com contrato
     * 40444 SEDEX com contrato
     * 81019 e-SEDEX, com contrato
     * 41068 PAC com contrato
     */
    public function setNCdServico($nCdServico)
    {
        $nCdServico = trim($nCdServico);

        $array = array(41106,40010,40045,40215,40290,40096,40436,40444,81019,41068);
        if( in_array($nCdServico, $array) ){
            $this->nCdServico = (int)$nCdServico;
        }else{
            trigger_error("O Código de seriviço não é um dos valores validos", E_USER_ERROR);
        }
    }

    /**
     * @param mixed $sCepOrigem
     */
    public function setSCepOrigem($sCepOrigem)
    {
        $this->sCepOrigem = $sCepOrigem;
    }

    /**
     * @param mixed $sCepDestino
     */
    public function setSCepDestino($sCepDestino)
    {
        $this->sCepDestino = $sCepDestino;
    }

    /**
     * @param mixed $nVlPeso
     */
    public function setNVlPeso($nVlPeso)
    {
        $this->nVlPeso = $nVlPeso;
    }

    /**
     * @param mixed $nCdFormato
     */
    public function setNCdFormato($nCdFormato)
    {
        $this->nCdFormato = $nCdFormato;
    }

    /**
     * @param mixed $nVlComprimento
     */
    public function setNVlComprimento($nVlComprimento)
    {
        $this->nVlComprimento = $nVlComprimento;
    }

    /**
     * @param mixed $nVlAltura
     */
    public function setNVlAltura($nVlAltura)
    {
        $this->nVlAltura = $nVlAltura;
    }

    /**
     * @param mixed $nVlLargura
     */
    public function setNVlLargura($nVlLargura)
    {
        $this->nVlLargura = $nVlLargura;
    }

    /**
     * @param mixed $nVlDiametro
     */
    public function setNVlDiametro($nVlDiametro)
    {
        $this->nVlDiametro = $nVlDiametro;
    }

    /**
     * @param mixed $sCdMaoPropria
     */
    public function setSCdMaoPropria($sCdMaoPropria)
    {
        $this->sCdMaoPropria = $sCdMaoPropria;
    }

    /**
     * @param mixed $nVlValorDeclarado
     */
    public function setNVlValorDeclarado($nVlValorDeclarado)
    {
        $this->nVlValorDeclarado = $nVlValorDeclarado;
    }

    /**
     * @param mixed $sCdAvisoRecebimento
     */
    public function setSCdAvisoRecebimento($sCdAvisoRecebimento)
    {
        $this->sCdAvisoRecebimento = $sCdAvisoRecebimento;
    }


}