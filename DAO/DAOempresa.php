<?php
namespace DAO;

require_once('../models/empresa.php');
use models\Empresa;

/**
 * classe responsável por fazer a comunicação entre o banco de dados
 * provendo funções de crud
 * @author Arthur Alves
 * @package DAO
 */

class DAOempresa{
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
     * Faz a inclusão da empresa 
     * @param string $nome;
     * @param string $cnpj;
     * @param string $endereco;
     * @param string $links;
     * @param string $particularidades;
     * @return TRUE|EXCEPTION
     */
    public function incluirEmpresa($nome, $cnpj, $endereco, $links, $particularidades){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }

        $sqlInsert = $conexaoDB->prepare("INSERT INTO empresa(nome_Empresa, CNPJ_Empresa,
                                        endereco_Empresa, links_Empresa, particularidades) values (?,?,?,?,?)");
        $sqlInsert->bind_param("sssss", $nome, $cnpj, $endereco, $links, $particularidades);
        $sqlInsert->execute();

        if(!$sqlInsert->error){
            $retorno = TRUE;
        }else{
            throw new \Exception ("não foi possível incluir Empresa");
            die;
        }
        $conexaoDB->close();
        $sqlInsert->close();
        return $retorno;
    }
    
    /**
     * Faz a alteração da empresa
     * @param string $nome;
     * @param string $cnpj;
     * @param string $endereco;
     * @param string $links;
     * @param string $particularidades;
     * @return TRUE|EXCEPTION
     */
    public function atualizarEmpresa($nome, $cnpj, $endereco, $links, $particularidades, $id){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }

        $sqlUpdate = $conexaoDB->prepare("UPDATE empresa set 
                                        nome_Empresa = ?,
                                        CNPJ_Empresa = ?,
                                        endereco_Empresa = ?,
                                        links_Empresa = ?,
                                        particularidades = ?
                                        where ID_Empresa = ?");
        $sqlUpdate->bind_param("sssssi", $nome, $cnpj, $endereco, $links, $particularidades, $id);
        $sqlUpdate->execute();
        
        if(!$sqlUpdate->error){
            $retorno = TRUE;
        }else{
            throw new \Exception("Não foi possível Atualizar a empresa, entre em contato com Cassio ou Arthur");
            die;
        }
        $conexaoDB->close();
        $sqlUpdate->close();
        return $retorno;
    }

    /**
     * Faz a exclusão de uma empresa
     * @param string $cnpj Exclusão pelo CNPJ
     * @return TRUE|Exception
     */
    public function excluirEmpresa($cnpj){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }

        $sqlDelete = $conexaoDB->prepare("DELETE from empresa where CNPJ_Empresa = ?");
        $sqlDelete->bind_param("i", $cnpj);
        $sqlDelete->execute();

        if(!$sqlDelete->error){
            $retorno = TRUE;
        }else{
            throw new \Exception("Não foi possível excluir a empresa, entre em contato com Cassio ou Arthur");
            die;
        }
        $conexaoDB->close();
        $sqlDelete->close();
        return $retorno;
    }

    /**
     * Busca a empresa no banco de dados para search ou visualização
     * @param string $cnpj
     * @return Array[empresa]
     */
    public function buscarEmpresa($cnpj){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        #array que será retornado uma ou mais empresas
        $empresas = array();

        $sqlBusca = $conexaoDB->prepare("SELECT ID_Empresa, nome_Empresa, CNPJ_Empresa, 
                                        endereco_Empresa, links_Empresa, particularidades
                                        FROM empresa
                                        where CNPJ_Empresa = ?");
        $sqlBusca->bind_param("s", $cnpj);
        $sqlBusca->execute();

        $resultado = $sqlBusca->get_result();

        if($resultado->num_rows !== 0){
            while($linha = $resultado->fetch_assoc()){
                $empresa = new Empresa($linha['ID_Empresa'], $linha['CNPJ_Empresa'], $linha['endereco_Empresa'],
                                        $linha['links_Empresa'], $linha['nome_Empresa'], $linha['particularidades']);
                $empresas[] = $empresa;
            }
        }else{
            echo "nenhuma empresa localizada!";
        }
        $conexaoDB->close();
        $sqlBusca->close();
        return $empresas;
    }
}


?>