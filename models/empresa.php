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
     * particularidades da empresa
     * @var string
     */
    public $particularidades;
    
    public function __construct($ID_Empresa = null, $CNPJ_Empresa, $endereco_Empresa, $links_Empresa, $nome_Empresa, $particularidades){
        $this->id = $id;
        $this->CNPJ_Empresa = $CNPJ_Empresa;
        $this->endereco_Empresa = $endereco_Empresa;
        $this->links_Empresa = $links_Empresa;
        $this->nome_Empresa = $nome_Empresa;
        $this->particularidades = $particularidades

    }

}

?>