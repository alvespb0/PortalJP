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
     * @return Array|False
     */
    public function listaEmpresaByCnpj($search){
        $daoEmpresa = new DAOempresa();
        try{
            $empresa = $daoEmpresa->buscarEmpresa($search);
            if(count($empresa)>0){
                return $empresa;
            }else{
                return false;
            }
        }catch(\Exception $e){
            throw new \Exception("Erro: ".$e->getMessage());
        }
    }
    
    /**
     * recebe um nome para fazer a busca da empresa
     * @param string $search
     * @return Array|False
     */
    public function listaEmpresaByName($search){
        $daoEmpresa = new DAOempresa();
        try{
            $empresa = $daoEmpresa->buscarEmpresaSearch($search);
            if(count($empresa)>0){
                return $empresa;
            }else{
                return false;
            }
        }catch(\Exception $e){
            throw new \Exception("Erro: ".$e->getMessage());
        }
    }
    
    /**
     * recebe um search e executa as funções listaEmpresaByCnpj e listaEmpresaByName
     * verifica qual é falsa e retorna a array correta
     * se as duas forem falsas retorna false
     * @param string $search
     * @return bool|Array 
     */
    public function listaEmpresa($search){
        try{
            $listaEmpresaCNPJ = $this->listaEmpresaByCnpj($search);
            $listaEmpresaNome = $this->listaEmpresaByName($search);
            if($listaEmpresaCNPJ !== false){
                return $listaEmpresaCNPJ;
            }else if($listaEmpresaNome !== false){
                return $listaEmpresaNome;
            }else{
                return false;
            }
        }catch (\Exception $e) {
            throw new \Exception("Erro ao buscar empresa: " . $e->getMessage());
        }
    }

    /**
     * Não recebe parâmetro, apenas chama a função da DAO para listar todas as empresas
     * @return Array|Exception
     */
    public function listaTodasEmpresas(){
        $daoEmpresa = new DAOempresa();
        try{
            $empresa = $daoEmpresa->buscaTodasEmpresas();
            if(count($empresa)>0){
                return $empresa;
            }else{
                echo "nenhuma empresa cadsatrada";
            }
        }catch (\Exception $e) {
            throw new \Exception("Erro ao buscar empresa: " . $e->getMessage());
        }
    }
}
?>