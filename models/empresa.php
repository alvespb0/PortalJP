<?php
namespace models;

/**
 * Classe model para a tabela empresa
 * Representa os dados da tabela empresa
 */

class Empresa{
    /**
     * ID do registro
     * @var int
     */
    public $ID_Empresa;

    /**
     * CNPJ da empresa
     * @var string
     */
    public $CNPJ_Empresa;

    /**
     * Endereco da empresa
     * @var string
     */
    public $endereco_Empresa;

    /**
     * links da empresa
     * @var string
     */
    public $links_Empresa;

    /**
     * nome da empresa
     * @var string
     */

    public $nome_Empresa;

    /**
     * Outras observações
     * @var string
     */
    public $observacoes;

    /**
     * Imagem 
     * @var string
     */
    public $imagem;

    public function __construct($ID_Empresa = null, $CNPJ_Empresa = null, $endereco_Empresa = null, $links_Empresa = null,
                                 $nome_Empresa = null, $observacoes = null, $imagem = null){
        $this->ID_Empresa = $ID_Empresa;
        $this->CNPJ_Empresa = $CNPJ_Empresa;
        $this->endereco_Empresa = $endereco_Empresa;
        $this->links_Empresa = $links_Empresa;
        $this->nome_Empresa = $nome_Empresa;
        $this->observacoes = $observacoes;
        $this->imagem = $imagem;
    }

}

?>