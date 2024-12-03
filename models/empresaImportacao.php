<?php
namespace models;

/**
 * classe model para a tabela ER empresa_forma_importacao
 * representa os dados da tabela
 */
class empresaImportacao{
    /**
     * representa a primary key da tabela
     * @var int 
     */
    public $ID_EmpresaImportacao

    /**
     * representa a ID foreign key empresa da tabela
     * @var int
     */
    public $ID_Empresa;

    /**
     * representa a ID foreign key importacao da tabela
     * @var int
     */
    public $ID_Importacao;

    public __construct($ID_EmpresaImportacao = null, $ID_Empresa, $ID_Importacao){
        $this->ID_EmpresaImportacao = $ID_EmpresaImportacao;
        $this->ID_Empresa = $ID_Empresa;
        $this->ID_Importacao = $ID_Importacao;
    }
}
?>