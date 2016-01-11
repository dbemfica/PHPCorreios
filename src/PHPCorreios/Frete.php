<?php
namespace PHPCorreios;

class Frete
{
    //endereço do webservice dos correios
    const WS = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx";

    /**
    * Parametros para calcular o Frete
    */
    private $codigoEmpresa;
    private $senhaEmpresa;
    private $codigoServico;
    private $enderecoOrigem;
    private $enderecoDestino;
    private $pacote;


    /**
    * Atributos retornados apos a conculta;
    */
    private $valor;
    private $prazoEntrega;
    private $valorMaoPropia;
    private $valorAvisoRecebimento;
    private $valorDeclarado;
    private $entregaDomiciliar;
    private $entregaSabado;
    private $codigoErro;
    private $msgErro;

    /**
    * @param string
    * Seu código administrativo junto à ECT. O código está
    * disponível no corpo do contrato firmado com os Correios.
    */
    public function setCodigoEmpresa($codigoEmpresa)
    {
        $this->codigoEmpresa = $codigoEmpresa;
    }

    /**
    * @param string
    * Senha para acesso ao serviço, associada ao seu código administrativo.
    * A senha inicial corresponde aos 8 primeiros dígitos do CNPJ informado
    * no contrato. A qualquer momento, é possível alterar a senha no endereço
    */
    public function setSenhaEmpresa($senhaEmpresa)
    {
        $this->senhaEmpresa = $senhaEmpresa;
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
    public function setCodigoServico($codigoServico)
    {
        $codigoServico = trim($codigoServico);
        $array = array(41106,40010,40045,40215,40290,40096,40436,40444,81019,41068);
        if( in_array($codigoServico, $array) ){
            $this->codigoServico = (int)$codigoServico;
        }else{
            trigger_error("O Código de seriviço não é um dos valores validos", E_USER_ERROR);
        }
    }

    /**
    * Indica a forma de retorno da consulta.
    * XML: Resultado em XML
    * Popup:  Resultado em uma janela popup
    * <URL>: Resultado via post em uma página do requisitante
    */
    private $StrRetorno = "xml";


    private function setValor($valor)
    {
        $valor = trim($valor);
        $valor = str_replace(".","",$valor);
        $valor = str_replace(",",".",$valor);
        $this->valor = (float)$valor;
    }

    private function setPrazoEntrega($prazoEntrega)
    {
        $prazoEntrega = trim($prazoEntrega);
        $this->prazoEntrega = (int)$prazoEntrega;
    }

    private function setValorMaoPropia($valorMaoPropia)
    {
        $valorMaoPropia = trim($valorMaoPropia);
        $valorMaoPropia = str_replace(".","",$valorMaoPropia);
        $valorMaoPropia = str_replace(",",".",$valorMaoPropia);
        $this->valorMaoPropia = (float)$valorMaoPropia;
    }

    private function setValorAvisoRecebimento($valorAvisoRecebimento)
    {
        $valorAvisoRecebimento = trim($valorAvisoRecebimento);
        $valorAvisoRecebimento = str_replace(".","",$valorAvisoRecebimento);
        $valorAvisoRecebimento = str_replace(",",".",$valorAvisoRecebimento);
        $this->valorAvisoRecebimento = (float)$valorAvisoRecebimento;
    }

    private function setValorDeclarado($valorDeclarado)
    {
        $valorDeclarado = trim($valorDeclarado);
        $valorDeclarado = str_replace(".","",$valorDeclarado);
        $valorDeclarado = str_replace(",",".",$valorDeclarado);
        $this->valorDeclarado = (float)$valorDeclarado;
    }

    private function setEntregaDomiciliar($entregaDomiciliar)
    {
        $entregaDomiciliar = trim($entregaDomiciliar);
        $this->entregaDomiciliar = (string)$entregaDomiciliar;
    }

    private function setEntregaSabado($entregaSabado)
    {
        $entregaSabado = trim($entregaSabado);
        $this->entregaSabado = (string)$entregaSabado;
    }

    private function setCodigoErro($codigoErro)
    {
        $codigoErro = trim($codigoErro);
        $this->codigoErro = (int)$codigoErro;
    }

    private function setMsgErro($msgErro)
    {
        $msgErro = trim($msgErro);
        $this->msgErro = (string)$msgErro;
    }

    public function setNVlValorDeclarado($nVlValorDeclarado)
    {
        $this->nVlValorDeclarado = (float)$nVlValorDeclarado;
    }

    /**
    * @return float
    * Preço total da encomenda, em Reais, incluindo os preços dos serviços opcionais.
    */
    public function getValor()
    {
        return $this->valor;
    }

    /**
    * @return int
    * Prazo estimado em dias para entrega do produto.
    */
    public function getPrazoEntrega()
    {
        return $this->prazoEntrega;
    }

    /**
    * @return float
    * Preço do serviço adicional Mão Própria.
    */
    public function getValorMaoPropia()
    {
        return $this->valorMaoPropia;
    }

    /**
    * @return float
    * Preço do serviço adicional Aviso de Recebimento.
    */
    public function getValorAvisoRecebimento()
    {
        return $this->valorAvisoRecebimento;
    }

    /**
    * @return float
    * Preço do serviço adicional Valor Declarado.
    */
    public function getValorDeclarado()
    {
        return $this->valorDeclarado;
    }

    /**
    * @return string
    * Informa se a localidade informada possui entrega domiciliária 'S' ou 'N'.
    */
    public function getEntregaDomiciliar()
    {
        return $this->entregaDomiciliar;
    }

    /**
    * @return string
    * Informa se a localidade informada possui entrega domiciliária aos sábados 'S' ou 'N';
    */
    public function getEntregaSabado()
    {
        return $this->entregaSabado;
    }

    /**
    * @return int
    * Códigos de Erros retornados pelo calculado.
    */
    public function getCodigoErro()
    {
        return $this->codigoErro;
    }

    /**
    * @return string
    * Retorna a descrição do erro gerado.
    */
    public function getMsgErro()
    {
        return $this->msgErro;
    }

    /**
    * Método utilizado para armazenar o endereço de origem
    * @param \PHPCorreios\Endereco $endereco Para armazenar um endereco com sucesso é necessário
    * enviar um objeto do tipo Endereco
    */
    public function addEnderecoOrigem(\PHPCorreios\Endereco $endereco)
    {
        $this->enderecoOrigem = $endereco;
    }

    /**
    * Método utilizado para armazenar o endereço de destino
    * @param \PHPCorreios\Endereco $endereco Para armazenar um endereco com sucesso é necessário
    * enviar um objeto do tipo Endereco
    */
    public function addEnderecoDestino(\PHPCorreios\Endereco $endereco)
    {
        $this->enderecoDestino = $endereco;
    }

    /**
    * Método utilizado para armazenar um pacote
    * @param \PHPCorreios\Pacote $pacote Para armazenar um pacote com sucesso é necessário
    * enviar um objeto do tipo Pacote
    */
    public function addPacote(\PHPCorreios\Pacote $pacote)
    {
        $this->pacote = $pacote;
    }

    /**
    * Comunica-se com os correios para obter os valores do frete
    * @return array
    */
    public function calculaFrete()
    {
        //MONTA A URL
        $url = self::WS . '?';
        $url .= "_ect=".self::WS."&";
        $url .= "nCdEmpresa={$this->codigoEmpresa}&";
        $url .= "sDsSenha={$this->senhaEmpresa}&";
        $url .= "nCdServico={$this->codigoServico}&";
        $url .= "sCepOrigem={$this->enderecoOrigem->getCep()}&";
        $url .= "sCepDestino={$this->enderecoDestino->getCep()}&";
        $url .= "nVlPeso={$this->pacote->getPeso()}&";
        $url .= "nCdFormato={$this->pacote->getCodigoFormato()}&";
        $url .= "nVlComprimento={$this->pacote->getComprimento()}&";
        $url .= "nVlAltura={$this->pacote->getAltura()}&";
        $url .= "nVlLargura={$this->pacote->getLargura()}&";
        $url .= "nVlDiametro={$this->pacote->getDiametro()}&";
        $url .= "sCdMaoPropria={$this->pacote->getMaoPropria()}&";
        $url .= "nVlValorDeclarado={$this->pacote->getValorDeclarado()}&";
        $url .= "sCdAvisoRecebimento={$this->pacote->getAvisoRecebimento()}&";
        $url .= "StrRetorno={$this->StrRetorno}&";


        //EXECULTA O CURL
        $curl_init = curl_init();
        curl_setopt($curl_init, CURLOPT_URL, $url);
        curl_setopt($curl_init, CURLOPT_SSL_VERIFYPEER, 0);
        ob_start();
        curl_exec($curl_init);
        $response = ob_get_contents();
        ob_end_clean();

        $xml = simplexml_load_string($response);
        if( (int)$xml->cServico->Erro != 0 ){
            return (string)$xml->cServico->MsgErro;
        }

        $this->setValor($xml->cServico->Valor);
        $this->setPrazoEntrega($xml->cServico->PrazoEntrega);
        $this->setValorMaoPropia($xml->cServico->ValorMaoPropria);
        $this->setValorAvisoRecebimento($xml->cServico->ValorAvisoRecebimento);
        $this->setNVlValorDeclarado($xml->cServico->ValorValorDeclarado);
        $this->setEntregaDomiciliar($xml->cServico->EntregaDomiciliar);
        $this->setEntregaSabado($xml->cServico->EntregaSabado);

        return true;
    }
}