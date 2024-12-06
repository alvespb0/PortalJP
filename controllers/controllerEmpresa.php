<?php
namespace controllers;
require_once('../DAO/DAOempresa.php');

use DAO\DAOempresa;

/**
 * classe responsável por fazer o tratamento de dados vindos da DAO e/ou envio para a DAO executar as consultas no db
 * @author Arthur Alves
 */

class ControllerEmpresa{
    /**
     * recebe um objeto do tipo empresa e envia para a DAO a operação solicitada.
     * @param empresa $empresa objeto do tipo empresa
     * @return TRUE|Exception
     */
    public function salvarEmpresa($empresa){
        $daoEmpresa = new DAOempresa();
        try{
            $daoEmpresa->incluirEmpresa($empresa->nome_Empresa, $empresa->CNPJ_Empresa, $empresa->endereco_Empresa,
                                        $empresa->links_Empresa, $empresa->particularidades, $empresa->observacoes);
            unset($daoEmpresa);                                        
            return true;
        }catch (\Exception $e){
            unset($daoEmpresa);
            throw new \Exception("Não foi possível incluir".$e->getmessage());
        }
    }

    /**
     * recebe um CNPJ para fazer a exclusão.
     * @param string $cnpj
     * @return TRUE|Exception
     */
    public function deleteEmpresa($cnpj){
        $daoEmpresa = new DAOempresa();
        try{
            $daoEmpresa->excluirEmpresa($cnpj);
            unset($daoEmpresa);
            return true;
        }catch(\Exception $e){
            unset($daoEmpresa);
            throw new \Exception("Não foi possível excluir".$e->getmessage());
        }
    }
    
    /**
     * recebe um objeto do tipo empresa para fazer a atualização
     * @param empresa $empresa objeto do tipo empresa
     * @return TRUE|Exception
     */
    public function editarEmpresa($empresa){
        $daoEmpresa = new DAOempresa();
        try{
            $daoEmpresa->atualizarEmpresa($empresa->nome_Empresa, $empresa->CNPJ_Empresa, $empresa->endereco_Empresa,
                                        $empresa->links_Empresa, $empresa->particularidades, $empresa->observacoes, $empresa->ID_Empresa);
            unset($daoEmpresa);                                        
            return true;
        }catch (\Exception $e){
            unset($daoEmpresa);
            throw new \Exception("Não foi possível incluir".$e->getMessage());
        }
    }

    /**
     * recebe um CNPJ para fazer a busca da empresa
     * @param string $cnpj
     * @return Array $empresa|Exception
     */
    public function listaEmpresa($cnpj){
        $daoEmpresa = new DAOempresa();
        try{
            $empresa = $daoEmpresa->buscarEmpresa($cnpj);
            if(count($empresa)>0){
                return $empresa;
            }else{
                throw new \Exception("Empresa não localizada com o CNPJ: " . $cnpj);
            }
        }catch(\Exception $e){
            throw new \Exception("Erro: ".$e->getMessage());
        }
    }    
}
?>