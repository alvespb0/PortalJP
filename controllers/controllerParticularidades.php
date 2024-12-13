<?php
namespace controllers;
require_once('../DAO/DAOparticularidades.php');

use DAO\DAOparticularidades;

/**
 * classe responsável por fazer o tratamento de dados vindos da DAO e/ou envio para a DAO executar as consultas no db
 * @author Arthur Alves
 */
class ControllerParticularidades{
    /**
     * recebe um objeto do tipo particularidades e envia para a DAO fazer a inserção
     * @param Particularidades
     * @return TRUE|Exception
     */
    public function salvarParticularidades($particularidades){
        $daoParticularidade = new DAOparticularidades();
        try{
            $daoParticularidade->incluirParticularidade($particularidades->ID_Empresa, $particularidades->particularidades);
            unset($daoParticularidade);
            return true;
        }catch (\Exception $e){
            unset($daoParticularidade);
            throw new \Exception("Não foi possível incluir".$e->getmessage());
        }
    }

    /**
     * recebe um ID de empresa para fazer a exclusão
     * @param int;
     * @return TRUE|Exception
     */
    public function deleteParticularidades($ID_Empresa){
        $daoParticularidade = new DAOparticularidades();
        try{
            $daoParticularidade->excluirParticularidades($ID_Empresa);
            unset($daoParticularidade);
            return true;
        }catch(\Exception $e){
            unset($daoParticularidade);
            throw new \Exception("Não foi possível excluir".$e->getmessage());
        }
    }

    /**
     * recebe um ID de empresa e retorna todos as particularidades associadas
     * @param int 
     * @return Array|False
     */
    public function listaParticularidades($ID_Empresa){
        $daoParticularidade = new DAOparticularidades();
        try{
            $resultado = $daoParticularidade->buscarParticularidade($ID_Empresa);
            $particularidades = array();
            if(count($resultado)>0){
                foreach($resultado as $r){
                    $particularidades [] = $r->particularidades;
                }
                return $particularidades;
            }else{
                return false;
            }
        }catch(\Exception $e){
            throw new \Exception("Erro: ".$e->getMessage());
        }
    }
}
?>