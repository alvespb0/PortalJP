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
     * @param string $observacoes;
     * @param string $imagem;
     * @return TRUE|EXCEPTION
     */
    public function incluirEmpresa($nome, $cnpj, $endereco, $links, $observacoes, $imagem){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }

        $sqlInsert = $conexaoDB->prepare("INSERT INTO empresa(nome_Empresa, CNPJ_Empresa,
                                        endereco_Empresa, links_Empresa, observacoes, imagem) values (?,?,?,?,?,?)");
        $sqlInsert->bind_param("ssssss", $nome, $cnpj, $endereco, $links, $observacoes, $imagem);
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
     * @param string $observacoes
     * @param int $id
     * @return TRUE|EXCEPTION
     */
    public function atualizarEmpresa($nome, $cnpj, $endereco, $links, $observacoes, $id){
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
                                        observacoes = ?
                                        where ID_Empresa = ?");
        $sqlUpdate->bind_param("sssssi", $nome, $cnpj, $endereco, $links, $observacoes, $id);
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
    public function excluirEmpresa($id){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }

        $sqlDelete = $conexaoDB->prepare("DELETE from empresa where ID_Empresa = ?");
        $sqlDelete->bind_param("i", $id);
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
     * @return Array[empresa]|false
     */
    public function buscarEmpresa($cnpj){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        #array que será retornado uma ou mais empresas
        $empresas = array();

        $sqlBusca = $conexaoDB->prepare("SELECT *
                                        FROM empresa
                                        where CNPJ_Empresa = ?");
        $sqlBusca->bind_param("s", $cnpj);
        $sqlBusca->execute();

        $resultado = $sqlBusca->get_result();

        if($resultado->num_rows !== 0){
            while($linha = $resultado->fetch_assoc()){
                $empresa = new Empresa($linha['ID_Empresa'], $linha['CNPJ_Empresa'], $linha['endereco_Empresa'],
                                        $linha['links_Empresa'], $linha['nome_Empresa'], $linha['observacoes']);
                $empresas[] = $empresa;
            }
        }else{
            $conexaoDB->close();
            $sqlBusca->close();
            return $empresas;
        }
        $conexaoDB->close();
        $sqlBusca->close();
        return $empresas;
    }

    /**
     * Busca a empresa no banco de dados via SEARCH
     * @param string $search
     * @return Array|Exception
     */
    public function buscarEmpresaSearch($search = ''){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }

        $empresas = array();
        $search = "%".$search."%";

        $sqlBusca = $conexaoDB->prepare("SELECT * FROM empresa where nome_Empresa like ?");
        $sqlBusca->bind_param("s", $search);
        $sqlBusca->execute();

        $resultado = $sqlBusca->get_result();
        if($resultado->num_rows > 0){
            while ($linha = $resultado->fetch_assoc()){
                $empresa = new Empresa($linha['ID_Empresa'], $linha['CNPJ_Empresa'], $linha['endereco_Empresa'],
                $linha['links_Empresa'], $linha['nome_Empresa'], $linha['observacoes']);
                $empresas[] = $empresa;
            }
        }else{
            $conexaoDB->close();
            $sqlBusca->close();
            return $empresas;
        }
        $conexaoDB->close();
        $sqlBusca->close();
        return $empresas;
    }

    /**
     * Não recebe parâmetro, apenas faz a consulta SQL que lista todas as empresas
     * @return Array|Exception
     */
    public function buscaTodasEmpresas(){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        try{
            $sqlBusca = "SELECT * FROM empresa";
            $resultado = $conexaoDB->query($sqlBusca);
    
            if ($resultado === false) {
                throw new \Exception("Erro ao executar a consulta: " . $conexaoDB->error); 
            }else{
    
            $empresas = array(); 
            while ($linha = $resultado->fetch_assoc()) {
                $empresa = new Empresa(
                    $linha['ID_Empresa'], $linha['CNPJ_Empresa'], $linha['endereco_Empresa'],
                    $linha['links_Empresa'], $linha['nome_Empresa'], $linha['observacoes']
                );
                $empresas[] = $empresa;
            }
            $conexaoDB->close();
            return $empresas; 
        }
        }catch (Exception $e){
            throw new \Exception("Nenhuma empresa Cadastrada ".$e->getMessage());
        }
    }

    /**
     * Recebe um ID (via metodo GET, através da página de LIST) e retorna um array
     * com as informações da empresa
     * @param int $id
     * @return Array|Exception
     */
    public function buscaEmpresaById($id){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        try{
            intval($id);
            $empresas = array();
            $sqlBusca = $conexaoDB->prepare("SELECT * FROM empresa where ID_Empresa = ?");
            $sqlBusca->bind_param("i", $id);
            $sqlBusca->execute();
            
            $resultado = $sqlBusca->get_result();
            if($resultado->num_rows > 0){
                while ($linha = $resultado->fetch_assoc()){
                    $empresa = new Empresa($linha['ID_Empresa'], $linha['CNPJ_Empresa'], $linha['endereco_Empresa'],
                    $linha['links_Empresa'], $linha['nome_Empresa'], $linha['observacoes'], $linha['imagem']);
                    $empresas[] = $empresa;
                }
            }else{
                $conexaoDB->close();
                $sqlBusca->close();
                return $empresas;
            }
            $conexaoDB->close();
            $sqlBusca->close();
            return $empresas;
        }catch (Exception $e){
            throw new \Exception("Nenhuma empresa Cadastrada ".$e->getMessage());
        }
    }
    
    /**
     * Recebe o ID da empresa e retorna o blob
     * @param int $id
     * @return string|Exception
     */
    public function buscaImagemById($id){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        try{
            intval($id);
            $sqlBuscaImg = $conexaoDB->prepare("SELECT imagem FROM empresa WHERE ID_Empresa = ?");
            $sqlBuscaImg->bind_param("i", $id);
            $sqlBuscaImg->execute();

            $resultado = $sqlBuscaImg->get_result();
            if($resultado->num_rows > 0){
                $conexaoDB->close();
                $sqlBuscaImg->close();
                return $resultado->fetch_assoc(); 
            }else{
                throw new Exception("Imagem não encontrada para o ID da empresa: " . $id);
            }
        }catch (\Exception $e){
            // Caso ocorra erro em qualquer parte do processo, lança uma exceção
            throw new Exception("Erro ao buscar imagem: " . $e->getMessage());
        }
    }
}


?>