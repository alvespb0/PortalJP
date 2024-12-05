<?php
namespace DAO;

require_once('../models/empresaRecebimento.php');
use models\EmpresaRecebimento;

/**
 * Classe responsável por fazer a comunicação entre o banco de dados
 * provendo funções de crud
 * @author Arthur Alves
 * @package DAO
 */
class DAOEmpresaRecebimento{
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
     * Faz a inclusão na tabela empresa_recebimento
     * @param int $ID_Empresa
     * @param int $ID_SubformaRecebimento
     * @return TRUE|Exception
     */
    public function incluirEmpresaRecebimento($ID_Empresa, $ID_SubformaRecebimento){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        if($ID_SubformaRecebimento > 10){
            throw new \Exception("o ID de subForma recebimento é somente de 1 a 10, o inserido é maior que esse intervalo");
            die;
        }else{
            $sqlInsert = $conexaoDB->prepare("INSERT INTO empresa_recebimento (ID_Empresa, ID_SubformaRecebimento) VALUES (?,?)");
            $sqlInsert->bind_param("ii", $ID_Empresa, $ID_SubformaRecebimento);
            $sqlInsert->execute();
            if(!$sqlInsert->error){
                $retorno = TRUE;
            }else{
                throw new \Exception ("não foi possível incluir empresa recebimento");
                die;
            }
            $conexaoDB->close();
            $sqlInsert->close();
            return $retorno;
        }
    }

    /**
     * Recebe o ID da empresa e retorna uma array de todas as emperesas recebimento.
     * @param int $ID_Empresa
     * @return Array[empresaRecebimento]|Exception
     */
    public function buscarEmpresaRecebimento($ID_Empresa){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }

        $empresaRecebimento = array();

        $sqlBusca = $conexaoDB->prepare("SELECT * 
                                        FROM empresa_recebimento
                                         WHERE ID_Empresa = ?");
        $sqlBusca->bind_param("i", $ID_Empresa);
        $sqlBusca->execute();

        $resultado = $sqlBusca->get_result();
        if($resultado->num_rows !== 0){
            while($linha = $resultado->fetch_assoc()){
                $empresasRecebimento = new EmpresaRecebimento($linha['ID_EmpresaFormaRecebimento'], $linha['ID_Empresa'], $linha['ID_SubformaRecebimento']);
                $empresaRecebimento[] = $empresasRecebimento;
            }
        }else{
            throw new \Exception ("não localizado empresa recebimento");
        }
        $sqlBusca->close();
        $conexaoDB->close();
        return $empresaRecebimento;
    }

    /**
     * Faz a edição na tabela empresa_recebimento
     * @param int $ID_Empresa
     * @param int $ID_SubFormaRecebimento
     * @param int $ID_EmpresaFormaRecebimento
     * @return TRUE|Exception
     */
    public function atualizarEmpresaRecebimento($ID_Empresa, $ID_SubFormaRecebimento, $ID_EmpresaFormaRecebimento){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        if($ID_SubFormaRecebimento > 10){
            throw new \Exception("o ID de subforma de recebimento é somente de 1 a 10, o inserido é maior que esse intervalo");
            die;
        }else{
            $sqlUpdate = $conexaoDB->prepare("UPDATE empresa_recebimento set ID_Empresa = ?
                                            , ID_SubformaRecebimento = ? where ID_EmpresaFormaRecebimento = ?");
            $sqlUpdate->bind_param("iii", $ID_Empresa, $ID_SubFormaRecebimento, $ID_EmpresaFormaRecebimento);
            $sqlUpdate->execute();

            if(!$sqlUpdate->error){
                $retorno = TRUE;
            }else{
                throw new \Exception("Não foi possível Atualizar a empresa Recebimento");
                die;
            }
            $conexaoDB->close();
            $sqlUpdate->close();
            return $retorno;
        }
    }
    
    /**
     * Recebe o ID da empresa que está sendo excluída, e deleta todos os registros encontrados
     * @param int 
     * @return TRUE|Exception
     */
    public function excluirEmpresaRecebimento($ID_Empresa){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        $sqlDelete = $conexaoDB->prepare("DELETE FROM empresa_recebimento where ID_Empresa = ?");
        $sqlDelete->bind_param("i", $ID_Empresa);
        $sqlDelete->execute();

        if(!$sqlDelete->error){
            $retorno = TRUE;
        }else{
            throw new \Exception("Não foi possível excluir a empresa recebimento, entre em contato com Cassio ou Arthur");
            die;
        }
        $conexaoDB->close();
        $sqlDelete->close();
        return $retorno;
    }

    /**
     * recebe o ID da empresa e retorna as os ID's das subformas atreladas a esse ID da empresa
     * Após isso faz uma consulta na tabela de subforma
     * @param int $ID_SubFormaRecebimento
     * @return Array[subformasRecebimento]|Exception
     */
    public function buscarSubformasRecebimento($ID_Empresa){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        $subFormas = [];
        $idSubformas = [];
        $sqlBusca = $conexaoDB->prepare("SELECT ID_SubformaRecebimento
                                        from empresa_recebimento 
                                        where ID_Empresa = ?");
        $sqlBusca->bind_param("i", $ID_Empresa);
        $sqlBusca->execute();
        $resultado = $sqlBusca->get_result();

        if($resultado !== 0){
            while($linha = $resultado->fetch_assoc()){
                $idSubformas[] = $linha['ID_SubformaRecebimento'];
            }
            foreach ($idSubformas as $idSubforma) {
                $sqlBuscaSub = $conexaoDB->prepare("SELECT subformaRecebimento
                                                    FROM subformas_recebimento
                                                    WHERE ID_SubformaRecebimento = ?");
                $sqlBuscaSub->bind_param("i", $idSubforma); // Passa o ID da subforma
                $sqlBuscaSub->execute();
                $resultado2 = $sqlBuscaSub->get_result();
                if($resultado2->num_rows > 0){
                    while($linhaSubforma = $resultado2->fetch_assoc()){
                        $subFormas[] = $linhaSubforma['subformaRecebimento'];
                    }
                }else{
                    throw new \Exception("Erro! Não foi possível localizar a subforma de recebimento com o ID: $idSubforma");
                }
            }
            $sqlBusca->close();
            $sqlBuscaSub->close();
            $conexaoDB->close();

            return $subFormas;
        }else{
            throw new \Exception("Erro! Não foi possível localizar as subformas de importação");
        }
    }

    /**
     * recebe o ID da SUBFORMA de recebimento, dado o ID da sub forma
     * Busca a chave estrangeira da forma de recebimento;
     * não é necessário retornar um ARRAY devido as formas de recebimento não serem multivaloradas
     * @param int $ID_SubFormaRecebimento
     * @return string|Exception
     */
    public function buscarFormasRecebimento($ID_SubFormaRecebimento){
        try{
            $conexaoDB = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        $sqlBusca = $conexaoDB->prepare("SELECT ID_FormaRecebimento
                                        from subformas_recebimento 
                                        where ID_SubformaRecebimento = ?");
        $sqlBusca->bind_param("i", $ID_SubFormaRecebimento);
        $sqlBusca->execute();
        
        $resultado = $sqlBusca->get_result();
        if($resultado->num_rows > 0){
            $linha = $resultado->fetch_assoc();
            $IDFormaRecebimento = $linha['ID_FormaRecebimento'];

            $sqlBuscaForma = $conexaoDB->prepare("SELECT tipo_FormaRecebimento
                                                from formas_recebimento
                                                where ID_FormaRecebimento = ?");
            $sqlBuscaForma->bind_param("i", $IDFormaRecebimento);
            $sqlBuscaForma->execute();
            $resultado2 = $sqlBuscaForma->get_result();

            if($resultado2->num_rows > 0){
                $linhaForma = $resultado2->fetch_assoc();
                $formaRecebimento = $linhaForma['tipo_FormaRecebimento'];
                return $formaRecebimento;
            }else{
                throw new \Exception("Erro! Não foi possível localizar a forma de recebimento");
            }
        }else{
            throw new \Exception("Erro! Não foi possível localizar a forma de recebimento");

        }
    }
}


?>