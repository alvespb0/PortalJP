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
                                        $empresa->links_Empresa, $empresa->particularidades, $empresa->observacoes, $empresa->imagem);
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
    public function deleteEmpresa($id){
        $daoEmpresa = new DAOempresa();
        try{
            $daoEmpresa->excluirEmpresa($id);
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
                echo "<center>nenhuma empresa cadastrada<center>";
            }
        }catch (\Exception $e) {
            throw new \Exception("Erro ao buscar empresa: " . $e->getMessage());
        }
    }

    /**
     * Recebe um ID (via metodo GET, através da página de LIST) e retorna um array
     * com as informações da empresa
     * @param int $id
     * @return array|Exception
     */
    public function listaEmpresaById($id){
        $daoEmpresa = new DAOempresa();
        try{
            $empresa = $daoEmpresa->buscaEmpresaById($id);
            if(count($empresa)>0){
                return $empresa;
            }else{
                echo "isso não era para ocorrer! Comunique Arthur";
            }
        }catch (\Exception $e) {
            throw new \Exception("Erro ao buscar empresa: " . $e->getMessage());
        }
    }

    /**
     * Recebe o ID da empresa e retorna o blob
     * @param int $id;
     * @return string|Exception
     */
    public function baixarImagem($id){
        $daoEmpresa = new DAOempresa();
        try{
            $arquivo = $daoEmpresa->buscaImagemById($id);

            if($arquivo){
                $tipoArquivo = $this->detectarTipoArquivo($arquivo['imagem']);
                header('Content-Type: ' . $tipoArquivo['mime']);
                header('Content-Disposition: attachment; filename="arquivo_empresa_' . $id . '.' . $tipoArquivo['extensao'] . '"');
                echo $arquivo['imagem']; // Imprimindo o conteúdo do blob para o download
                exit; // Finaliza o script após o download
            }else{
                echo "arquivo não encontrado";
            }
        }catch (Exception $e) {
            echo "Erro ao buscar arquivo: " . $e->getMessage();
        }
    }

    /**
     * Função para detectar o tipo do arquivo com base no conteúdo (blob)
     * @param string $conteudoBlob
     * @return array
     */
    private function detectarTipoArquivo($conteudoBlob) {
        // Usando a função finfo para detectar o tipo MIME do arquivo
        $finfo = finfo_open(FILEINFO_MIME_TYPE); // Obtém o tipo MIME
        $mimeType = finfo_buffer($finfo, $conteudoBlob);
        finfo_close($finfo);

        // Detectar a extensão com base no tipo MIME
        $extensao = $this->mapearExtensao($mimeType);

        return ['mime' => $mimeType, 'extensao' => $extensao];
    }

    /**
     * Mapeia o tipo MIME para a extensão do arquivo
     * @param string $mimeType
     * @return string
     */
    private function mapearExtensao($mimeType) {
        // Mapeamento simples de MIME para extensões de arquivos
        $extensao = '';

        switch ($mimeType) {
            case 'application/pdf':
                $extensao = 'pdf';
                break;
            case 'image/jpeg':
                $extensao = 'jpg';
                break;
            case 'image/png':
                $extensao = 'png';
                break;
            case 'application/zip':
                $extensao = 'zip';
                break;
            case 'application/x-rar-compressed':
                $extensao = 'rar';
                break;
            case 'application/msword':
                $extensao = 'doc';
                break;
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                $extensao = 'docx';
                break;
            // Adicione outros tipos conforme necessário
            default:
                $extensao = 'bin'; // Caso o tipo não seja identificado
        }

        return $extensao;
    }


}
?>