<?php
namespace controllers;
require_once('../DAO/DAOempresaRecebimento.php');

use DAO\DAOEmpresaRecebimento;

/**
 * classe responsável por fazer o tratamento de dados vindos da DAO e/ou envio para a DAO executar as consultas
 * @author Arthur Alves
 */
class ControllerEmpresaRecebimento{
    /**
     * recebe um objeto do tipo empresaRecebimento e envia para a DAO fazer a operação
     * @param empresaRecebimento $empresaRecebimento objeto do tipo empresa Recebimento
     * @return TRUE|Excpetion
     */
    public function salvarEmpresaRecebimento($empresaRecebimento){
        $daoEmpresaRec = new DAOEmpresaRecebimento();
        try{
            $daoEmpresaRec->incluirEmpresaRecebimento($empresaRecebimento->ID_Empresa, $empresaRecebimento->ID_SubFormaRecebimento);
            unset($daoEmpresaRec);
            return true;
        }catch (\Exception $e){
            unset($daoEmpresaRec);
            throw new \Exception("Não foi possível incluir".$e->getmessage());
        }
    }

    /**
     * recebe o ID da empresa para fazer a exclusão de todos os registros dado esse ID
     * @param int $id
     * @return TRUE|Exception
     */
    public function deleteEmpresaRecebimento($id){
        $daoEmpresaRec = new DAOEmpresaRecebimento();
        try{
            $daoEmpresaRec->excluirEmpresaRecebimento($id);
            unset($daoEmpresaRec);
            return true;
        }catch(\Exception $e){
            unset($daoEmpresaRec);
            throw new \Exception("Não foi possível excluir".$e->getmessage());
        }
    }

    /**
     * recebe um objeto do tipo empresaRecebimento para fazer a atualizaão
     * @param empresaRecebimento $empresaRecebimento, objeto do tipo empresa Recebimento
     * @return TRUE|Exception
     */
    public function editarEmpresaRecebimento($empresaRecebimento){
        $daoEmpresaRec = new DAOEmpresaRecebimento();
        try{
            $daoEmpresaRec->atualizarEmpresaRecebimento($empresaRecebimento->ID_Empresa, $empresaRecebimento->ID_SubFormaRecebimento,
                                                      $empresaRecebimento->ID_EmpresaFormaRecebimento);
            unset($daoEmpresaRec);
            return true;
        }catch(\Exception $e){
            unset($daoEmpresaRec);
            throw new \Exception("Não foi possível editar".$e->getmessage());
        }
    }
    
    /**
     * Recebe o ID da empresa e retorna os ID's das subFormas atreladas a esse ID de empresa
     * @param int $ID_Empresa
     * @return Array['empresaRecebimento']|Exception
     */
    public function listaEmpresaRecebimento($ID_Empresa){
        $daoEmpresaRec = new DAOEmpresaRecebimento();
        try{
            $empresaRecebimento = $daoEmpresaRec->buscarEmpresaRecebimento($ID_Empresa);
            unset($daoEmpresaRec);
            return $empresaRecebimento;
        }catch(\Exception $e){
            unset($daoEmpresaRec);
            throw new \Exception("Não foi possível listar as empresas Recebimento".$e->getmessage());
        }
    }

    /**
     * Chama a função listaEmpresaRecebimento, que por sua vez retorna uma array de objetos
     * com os ID's necessários para a operação. 
     * @param int $ID_Empresa
     * @return Array[subformasRecebimento]|Exception
     */
    public function listaSubformasRecebimento($ID_Empresa){
        $daoEmpresaRec = new DAOEmpresaRecebimento();
        try{
            $subFormasRecebimento = $daoEmpresaRec->buscarSubformasRecebimento($ID_Empresa);
            unset($daoEmpresaRec);
            return $subFormasRecebimento;
        }catch(\Exception $e){
            unset($daoEmpresaRec);
            throw new \Exception("Não foi possível listar as Subformas de recebimento".$e->getmessage());
        }
    }

    /**
     * Recebe o ID da subForma de recebimento, dado esse ID te retorna a forma de recebimento
     * @param int $ID_SubFormaRecebimento
     * @return string|Exception
     */
    public function listaFormasRecebimento($ID_SubFormaRecebimento){
        $daoEmpresaRec = new DAOEmpresaRecebimento();
        try{
            $formaRecebimento = $daoEmpresaRec->buscarFormasRecebimento($ID_SubFormaRecebimento);
            unset($daoEmpresaRec);
            return $formaRecebimento;
        }catch(\Exception $e){
            unset($daoEmpresaRec);
            throw new \Exception("Não foi possível listar as formas de recebimento".$e->getmessage());
        }
    }
}

?>