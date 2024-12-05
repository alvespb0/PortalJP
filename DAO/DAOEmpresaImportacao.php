<?php
namespace DAO;

require_once('../models/empresaImportacao.php');
use models\empresaImportacao;

/**
 * classe responsável por fazer a comunicação entre o banco de dados
 * provendo funções de crud
 * @author Arthur Alves
 * @package DAO
 */
class DAOEmpresaImportacao{
    /**
     * Estabelece a conexão com o banco de dados.
     *
     * @return \MySQLi
     * @throws \Exception
     */
    private function conectarBanco() {
        if (!defined('DS')) {
            define('DS', DIRECTORY_SEPARATOR);
        }
        if (!defined('BASE_DIR')) {
            define('BASE_DIR', dirname(__FILE__) . DS);
        }

        require(BASE_DIR . 'configdb.php');  // Inclui as configurações do banco de dados

        try {
            $conn = new \MySQLi($dbhost, $user, $password, $banco);  // Cria a conexão
            return $conn;
        } catch (mysqli_sql_exception $e) {
            throw new \Exception("Erro na conexão com o banco de dados: " . $e->getMessage());  // Lança exceção se a conexão falhar
        }
    }

    /**
     * Faz a inclusão na tabela empresa_forma_importacao
     * @param int $ID_Empresa
     * @param int $ID_Importacao (1 a 10, passou disso, lançar excessão)
     * @return TRUE|Exception
     */
    public function incluirEmpresaImportacao($ID_Empresa, $ID_Importacao){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        if($ID_Importacao > 10){
            throw new \Exception("o ID de importação é somente de 1 a 10, o inserido é maior que esse intervalo");
            die;
        }else{
            $sqlInsert = $conexaoDB->prepare("INSERT INTO empresa_forma_importacao(ID_Empresa, ID_FormasImportacao) values (?,?)");
            $sqlInsert->bind_param("ii", $ID_Empresa, $ID_Importacao);
            $sqlInsert->execute();
            if(!$sqlInsert->error){
                $retorno = TRUE;
            }else{
                throw new \Exception ("não foi possível incluir empresa Importacao");
                die;
            }
            $conexaoDB->close();
            $sqlInsert->close();
            return $retorno;
        }
    }

    /**
     * faz a edição na tabela empresa_forma_importacao
     * @param int $ID_Empresa
     * @param int $ID_Importacao (1 a 10, passou disso, lançar excessão)
     * @param int $ID_EmpresaImportacao
     * @return TRUE|Exception
     */
    public function atualizarEmpresaImportacao($ID_Empresa, $ID_Importacao, $ID_EmpresaImportacao){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        if($ID_Importacao > 10){
            throw new \Exception("o ID de importação é somente de 1 a 10, o inserido é maior que esse intervalo");
            die;
        }else{
            $sqlUpdate = $conexaoDB->prepare("UPDATE empresa_forma_importacao set ID_Empresa = ?, 
                                            ID_FormasImportacao = ? where ID_EmpresaImportacao = ?");
            $sqlUpdate->bind_param("iii", $ID_Empresa, $ID_Importacao, $ID_EmpresaImportacao);
            $sqlUpdate->execute();
            if(!$sqlUpdate->error){
                $retorno = TRUE;
            }else{
                throw new \Exception("Não foi possível Atualizar a empresa Importacao");
                die;
            }
            $conexaoDB->close();
            $sqlUpdate->close();
            return $retorno;
        }
    }

    /**
     * recebe o ID da empresa que está sendo excluída, e deleta todos os registros encontrados
     * @param int $ID_Empresa
     * @return TRUE|Exception
     */
    public function excluirEmpresaImportacao($ID_Empresa){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }

        $sqlDelete = $conexaoDB->prepare("DELETE from empresa_forma_importacao where ID_Empresa = ?");
        $sqlDelete->bind_param("i", $ID_Empresa);
        $sqlDelete->execute();

        if(!$sqlDelete->error){
            $retorno = TRUE;
        }else{
            throw new \Exception("Não foi possível excluir a empresa importacao, entre em contato com Cassio ou Arthur");
            die;
        }
        $conexaoDB->close();
        $sqlDelete->close();
        return $retorno;
    }
    
    /**
     * Recebe o ID da empresa que está sendo listada e retorna todas as formas de importacao
     * @param int $ID_Empresa
     * @return Array[empresaImportacao]
     */
    public function buscarEmpresaImportacao($ID_Empresa){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        #array que será retornado uma ou mais empresas
        $formasImportacao = array();

        $sqlBusca = $conexaoDB->prepare("SELECT *
                                        FROM empresa_forma_importacao
                                        where ID_Empresa = ?");
        $sqlBusca->bind_param("i", $ID_Empresa);
        $sqlBusca->execute();

        $resultado = $sqlBusca->get_result();

        if($resultado->num_rows !== 0){
            while($linha = $resultado->fetch_assoc()){
                $empresaImportacao = new empresaImportacao($linha['ID_EmpresaImportacao'], $linha['ID_Empresa'], $linha['ID_FormasImportacao']);
                $formasImportacao[] = $empresaImportacao;
            }
        }else{
            echo "nenhuma empresa localizada!";
        }
        $conexaoDB->close();
        $sqlBusca->close();
        return $formasImportacao;
    }

    /**
     * recebe o ID da importacao e retorna a forma de importacao
     * @param int $ID_FormasImportacao
     * @return Array[formasImportacao]|Exception;
     */
    public function buscarImportacao($ID_FormasImportacao){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        $importacoes = [];

        $sqlBusca = $conexaoDB->prepare("SELECT Tipo_FormaImportacao
                                        from formas_importacao where ID_FormasImportacao = ?");
        $sqlBusca->bind_param("i", $ID_FormasImportacao);
        $sqlBusca->execute();
        $resultado = $sqlBusca->get_result();
        if($resultado !== 0){
            $importacoes[] = $resultado->fetch_object();;
            return $importacoes;
        }else{
            throw new \Exception("Erro! Não foi possível localizar as formas de importacao");
        }
    }
}
?>