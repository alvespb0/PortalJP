<?php
namespace controllers;
require_once('../DAO/DAOempresaImportacao.php');

use DAO\DAOEmpresaImportacao;

/**
 * classe responsável por fazer o tratamento de dados vindos da DAO e/ou envio para a DAO executar as consultas no db
 * @author Arthur Alves
 */
class ControllerEmpresaImportacao{
    /**
     * recebe um objeto do tipo empresaImportacao e envia para a DAO fazer a operação
     * @param empresaImportacao $empresaImportacao objeto do tipo empresa Importacao
     * @return TRUE|Exception
     */
    public function salvarEmpresaImportacao($empresaImportacao){
        $daoEmpresaImp = new DAOEmpresaImportacao();
        try{
            $daoEmpresaImp->incluirEmpresaImportacao($empresaImportacao->ID_Empresa, $empresaImportacao->ID_Importacao);
            unset($daoEmpresaImp);
        }catch (\Exception $e){
            unset($daoEmpresaImp);
            throw new \Exception("Não foi possível incluir".$e->getmessage());
        }
    }

    /**
     * recebe o ID da empresa para fazer a exclusão de todos os registros dado esse ID
     * @param int $id
     * @return TRUE|Exception
     */
    public function deleteEmpresaImportacao($id){
        $daoEmpresaImp = new DAOEmpresaImportacao();
        try{
            $daoEmpresaImp->excluirEmpresaImportacao($id);
            unset($daoEmpresaImp);
            return true;
        }catch(\Exception $e){
            unset($daoEmpresaImp);
            throw new \Exception("Não foi possível excluir".$e->getmessage());
        }
    }

    /**
     * recebe um objeto do tipo empresaImportacao para fazer a atualização
     * @param empresaImportacao $empresaImportacao objeto do tipo empresaImportacao
     * @return TRUE|Exception
     */
    public function editarEmpresaImportacao($empresaImportacao){
        $daoEmpresaImp = new DAOEmpresaImportacao();
        try{
            $daoEmpresaImp->atualizarEmpresaImportacao($empresaImportacao->ID_Empresa, $empresaImportacao->ID_Importacao,
                                                        $empresaImportacao->ID_EmpresaImportacao);
            unset($daoEmpresaImp);
            return true;
        }catch(\Exception $e){
            unset($daoEmpresaImp);
            throw new \Exception("Não foi possível editar".$e->getmessage());
        }
    }

    /**
     * recebe o ID de uma empresa e lista todos os ID's de importação vinculados
     * @param int $ID_Empresa
     * @return Array $empresaImp|Exception
     */
    public function listaEmpresaImportacao($ID_Empresa){
        $daoEmpresaImp = new DAOEmpresaImportacao();
        try{
            $empresaImportacao = $daoEmpresaImp->buscarEmpresaImportacao($ID_Empresa);
            if(count($empresaImportacao)>0){
                return $empresaImportacao;
            }else{
                throw new \Exception("Empresa não localizada com o ID: " . $ID_Empresa);
            }
        }catch(\Exception $e){
            throw new \Exception("Erro: ".$e->getMessage());
        }
    }
    /**
     * Chama a função listarEmpresaImportacao, listará os ID's das formas de importacao
     * e retornará os nomes das importações em array (devido a ser multivalorado)
     * @return Array $importacoes|Exception
     */
    public function listaImportacoes($ID_Empresa){
        $daoEmpresaImp = new DAOEmpresaImportacao();
        $resultado = $this->listaEmpresaImportacao($ID_Empresa);
        $importacoes = [];
        try{
            foreach($resultado as $indice => $i){
                $importacoes[] = $daoEmpresaImp->buscarImportacao($i->ID_Importacao);
            }
            /* foreach ($importacoes as $imp) {
                foreach ($imp as $item) {
                    echo $item->Tipo_FormaImportacao . "<br>";
                }
            } */
           return $importacoes;

        }catch(\Exception $e){
            throw new \Exception("Erro: ".$e->getMessage());
        }
    }
}
?>