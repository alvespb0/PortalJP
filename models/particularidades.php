<?php
namespace models;

/**
 * classe model para a tabela particularidades
 * Representa os dados da tabela particularidades
 */
class Particularidades{
    /**
     * ID do registro
     * @var int
     */
    public $ID_Particularidades;
    
    /**
     * ID da empresa (chave estrangeira)
     * @var int
     */
    public $ID_Empresa;

    /**
     * Descrição da particularidade
     * @var string
     */
    public $particularidades;

    public function __construct($ID_Particularidades = null, $ID_Empresa = null, $particularidades = null){
        $this->ID_Particularidades = $ID_Particularidades;
        $this->ID_Empresa = $ID_Empresa;
        $this->particularidades = $particularidades;
    }
}
?>