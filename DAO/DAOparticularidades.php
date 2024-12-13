<?php
namespace DAO;

require_once('../models/particularidades.php');
use models\Particularidades;

/**
 * classe responsável por fazer a comunicação entre o banco de dados
 * provendo funções de crud
 * @author Arthur Alves
 * @package DAO
 */

class DAOparticularidades{
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
     * faz a inclusão da particularidade
     * @param int $ID_Empresa;
     * @param string $particularidade;
     * @return TRUE|EXCEPTION
     */
    public function incluirParticularidade($ID_Empresa, $particularidade){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }

        $sqlInsert = $conexaoDB->prepare("INSERT INTO particularidades(ID_Empresa, particularidade)
                                        values (?,?)");
        $sqlInsert->bind_param("is", $ID_Empresa, $particularidade);
        $sqlInsert->execute();

        if(!$sqlInsert->error){
            $retorno = TRUE;
        }else{
            throw new \Exception ("não foi possível incluir Empresa");
        }
        $conexaoDB->close();
        $sqlInsert->close();
        return $retorno;
    }

    /**
     * busca todos as particularidades dado o ID da empresa
     * @param int $ID_Empresa;
     * @return Array|false
     */
    public function buscarParticularidade($ID_Empresa){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }

        $particularidades = array();

        $sqlBusca = $conexaoDB->prepare("SELECT *
                                        FROM particularidades
                                        where ID_Empresa = ?");
        $sqlBusca->bind_param("i", $ID_Empresa);
        $sqlBusca->execute();

        $resultado = $sqlBusca->get_result();

        if($resultado->num_rows !== 0){
            while ($linha = $resultado->fetch_assoc()){
                $particularidade = new Particularidades($linha['ID_Particularidades'], $linha['ID_Empresa'],
                                                        $linha['particularidade']);
                $particularidades [] = $particularidade;
            }
        }else{
            $conexaoDB->close();
            $sqlBusca->close();
            return false;
        }
        $conexaoDB->close();
        $sqlBusca->close();
        return $particularidades;
    }

    /**
     * exclui todas as particularidades associadas ao ID da empresa
     * @param int $ID_Empresa
     * @return TRUE|Exception
     */
    public function excluirParticularidades($ID_Empresa){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }

        $sqlDelete = $conexaoDB->prepare("DELETE from particularidades where ID_Empresa = ?");
        $sqlDelete->bind_param("i", $ID_Empresa);
        $sqlDelete->execute();

        if(!$sqlDelete->error){
            $retorno = TRUE;
        }else{
            throw new \Exception("Não foi possível excluir a particularidade, entre em contato com Cassio ou Arthur");
        }
        $conexaoDB->close();
        $sqlDelete->close();
        return $retorno;

    }
}
?>