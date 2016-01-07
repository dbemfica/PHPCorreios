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
    private $nVlDiametro = "";
    private $sCdMaoPropria = "N";
    private $nVlValorDeclarado = 0;
    private $sCdAvisoRecebimento = "N";

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
    * @param string $sCepOrigem
    * CEP de Origem
    */
    public function setSCepOrigem($sCepOrigem)
    {
        $sCepOrigem = str_replace("-","",$sCepOrigem);
        if( strlen($sCepOrigem) != 8 ){
            trigger_error("O CEP informado é invalido", E_USER_ERROR);
        }
        $this->sCepOrigem = $sCepOrigem;
    }

    /**
    * @param string $sCepDestino
    * CEP de Destino
    */
    public function setSCepDestino($sCepDestino)
    {
        $sCepDestino = str_replace("-","",$sCepDestino);
        if( strlen($sCepDestino) != 8 ){
            trigger_error("O CEP informado é invalido", E_USER_ERROR);
        }
        $this->sCepDestino = $sCepDestino;
    }

    /**
    * @param float $nVlPeso
    * Peso da encomenda, incluindo sua embalagem. O peso deve ser informado
    * em quilogramas. Se o formato for Envelope, o valor máximo permitido será 1 kg
    */
    public function setNVlPeso($nVlPeso)
    {
        $this->nVlPeso = $nVlPeso;
    }

    /**
    * @param int $nCdFormato
    * Formato da encomenda (incluindo embalagem).
    * 1 – Formato caixa/pacote
    * 2 – Formato rolo/prisma
    * 3 - Envelope
    */
    public function setNCdFormato($nCdFormato)
    {
        $this->nCdFormato = $nCdFormato;

        $nCdFormato = trim($nCdFormato);

        $array = array(1,2,3);
        if( in_array($nCdFormato, $array) ){
            $this->nCdFormato = (int)$nCdFormato;
        }else{
            trigger_error("O Código do Formato não é um dos valores validos", E_USER_ERROR);
        }
    }

    /**
    * @param float $nVlComprimento
    * Comprimento da encomenda (incluindo embalagem),em centímetros.
    */
    public function setNVlComprimento($nVlComprimento)
    {
        $this->nVlComprimento = (float)$nVlComprimento;
    }

    /**
    * @param float $nVlAltura
    * Altura da encomenda (incluindo embalagem), em centímetros.
    * Se o formato for envelope, informar zero(0).
    */
    public function setNVlAltura($nVlAltura)
    {
        if( $this->nCdFormato == 3 ) {
            $this->nVlAltura = 0;
        }else{
            $this->nVlAltura = (float)$nVlAltura;
        }
    }

    /**
    * @param float $nVlLargura
    * Largura da encomenda (incluindo embalagem), em centímetros.
    */
    public function setNVlLargura($nVlLargura)
    {
        $this->nVlLargura = (float)$nVlLargura;
    }

    /**
    * @param float $nVlDiametro
    * Diâmetro da encomenda (incluindo embalagem), em centímetros
    */
    public function setNVlDiametro($nVlDiametro)
    {
        $this->nVlDiametro = $this->nVlAltura + $this->nVlLargura;
    }

    /**
    * @param string $sCdMaoPropria
    * Indica se a encomenda será entregue com o serviço adicional mão própria.
    * Valores possíveis: S ou N (S – Sim, N – Não)
    */
    public function setSCdMaoPropria($sCdMaoPropria)
    {
        if( $sCdMaoPropria == "S" || $sCdMaoPropria == "N" ){
            $this->sCdMaoPropria = trim(strtolower($sCdMaoPropria));
        }else{
            trigger_error("Valor passado tem que 'S' ou 'N'", E_USER_ERROR);
        }

    }

    /**
    * @param float $nVlValorDeclarado
    * Indica se a encomenda será entregue com o serviço adicional valor declarado.
    * Neste campo deve ser apresentado o valor declarado desejado, em Reais.
    */
    public function setNVlValorDeclarado($nVlValorDeclarado)
    {
        $this->nVlValorDeclarado = (float)$nVlValorDeclarado;
    }

    /**
    * @param mixed $sCdAvisoRecebimento
    * Indica se a encomenda será entregue com o serviço adicional aviso de recebimento.
    * Valores possíveis: S ou N (S – Sim, N – Não)
    */
    public function setSCdAvisoRecebimento($sCdAvisoRecebimento)
    {
        if( $sCdAvisoRecebimento == "S" || $sCdAvisoRecebimento == "N" ){
            $this->sCdAvisoRecebimento = trim(strtolower($sCdAvisoRecebimento));
        }else{
            trigger_error("Valor passado tem que 'S' ou 'N'", E_USER_ERROR);
        }
    }

    /**
    * Monta a URL de Consulta para enviar ao webservice dos correios
    * @return string
    */
    private function _getURL()
    {
        $url = $this->_ect . '?';
        foreach ($this as $name => $var) {
            if ($name == 'ect') {
                continue;
            }
            $url .= "$name=$var&";
        }
        $this->url = $url;
        return $this->url;
    }

    /**
    * Obtém dados de uma url via curl
    * @param string $url URL do site que se deseja obter os dados
    * @return mixed Dados retornados pela URL
    */
    private function _getSite($url)
    {
        $curl_init = curl_init();
        curl_setopt($curl_init, CURLOPT_URL, $url);
        curl_setopt($curl_init, CURLOPT_SSL_VERIFYPEER, 0);
        ob_start();
        curl_exec($curl_init);
        $response = ob_get_contents();
        ob_end_clean();
        return $response;
    }

    /**
    * Comunica-se com os correios para obter os valores do frete
    * @return array
    */
    public function getFrete()
    {
        $response = $this->_getSite(self::_getURL());

        $xml = simplexml_load_string($response);

        $frete = array("servico_codigo" => $xml->cServico->Codigo,
            "valor" => $xml->cServico->Valor,
            "prazo_entrega" => $xml->cServico->PrazoEntrega,
            "mao_propria" => $xml->cServico->ValorMaoPropria,
            "aviso_recebimento" => $xml->cServico->ValorAvisoRecebimento,
            "valor_declarado" => $xml->cServico->ValorValorDeclarado,
            "en_domiciliar" => $xml->cServico->EntregaDomiciliar,
            "en_sabado" => $xml->cServico->EntregaSabado,
            "erro" => $xml->cServico->Erro,
            "msg_erro" => $xml->cServico->MsgErro);

        return $frete;
    }
}