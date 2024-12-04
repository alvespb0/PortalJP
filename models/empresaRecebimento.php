<?php 
namespace models;

/**
 * Classe model para a representação da tabela empresa_recebimento
 * Representa os atributos da tabela
 */
class EmpresaRecebimento{
    /**
     * ID Empresa Recebimento
     * @var int
     */
    public $ID_EmpresaFormaRecebimento;

    /**
     * ID da empresa
     * @var int
     */
    public $ID_Empresa;

    /**
     * ID da sub forma de recebimento, lembrando que só é necessário o ID da SUBforma o ID da forma já é chave estrangeira na tabela de subforma
     * @var int
     */
    public $ID_SubFormaRecebimento;

    public function __construct($ID_EmpresaFormaRecebimento = null, $ID_Empresa, $ID_SubFormaRecebimento){
        $this->ID_EmpresaFormaRecebimento = $ID_EmpresaFormaRecebimento;
        $this->ID_Empresa = $ID_Empresa;
        $this->ID_SubFormaRecebimento = $ID_SubFormaRecebimento;
    }
}

?>