<?php

require_once "server/database.php";

class Server extends Database {
    private $query;
    
    public function __construct() {
        PARENT::__construct();
    }

    public function listarDados($table) {
        return $this->Listar($table);
    }

    public function SalvarRegistro() {
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        $link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$uri[0];
        
        $this->Salvar($_POST, 'acervo');
        header('Location: '.$link); 
    }

    public function DadosJson() {
        $registro = $this->CarregaRegistro('acervo', array('id' => $_POST['id']));
        echo json_encode($registro);
    }

    private function Listar($table) {
        $select = $table == 'acervo' ? "A.*, E.nome_editora" : "*";

        $sql = " SELECT $select FROM $table A ";
        if($table == "acervo")
            $sql .= " LEFT JOIN editora E ON A.id_editora = E.id_editora ";

        $this->query = $this->pdo->query($sql);
        return $this->result();
    }

    private function CarregaRegistro($table, $where) {
        $sql = " SELECT * FROM $table A ";
        $c = 0;
        foreach($where as $key => $Val) {
            if($c == 0)
                $sql .= " WHERE " . $key . " = " . $Val;
            else
                $sql .= " AND " . $key . " = " . $Val;
            $c++;
        }
        
        $this->query = $this->pdo->query($sql);
        return $this->row(0);
    }

    public function ExcluirRegistro() {
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        $link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$uri[0];
        
        $this->Excluir($_GET['id']);
        header('Location: ' . $link);
    }

    private function Salvar($data = array(), $tabela) {
        if($data) {
            $id = $data['id'];
            unset($data['id']);
            $rows = implode(', ', array_keys($data));
            
            if($id != null && $id != '') {
                $c = 0;
                $colVal = "";
                foreach($data as $key => $val){
                    $colVal .= "$key='$val'" . ($c != count($data)-1 ? ", " : "");
                    $c++;
                }
                
                $stmt = $this->pdo->query("UPDATE $tabela SET $colVal WHERE id = $id");
            } else {
                $colVal = '"'.implode('", "', $data).'"';
                $stmt = $this->pdo->query("INSERT INTO $tabela ($rows) VALUES($colVal)");
            }
            return $stmt->rowCount();
        } else 
            return false; 
    }

    private function Excluir($id) {
        $stmt = $this->pdo->query("DELETE FROM acervo WHERE id = $id");
        $stmt->execute();
    }

    private function row($c = null) {        
        $object = new stdClass();
        foreach($this->query->fetchAll(PDO::FETCH_ASSOC)[$c] as $key => $value)
            $object->$key = $value;
        return $object;
    }
    
    private function result() {        
        $res = array();
        foreach($this->query->fetchAll(PDO::FETCH_ASSOC) as $list) {
            $object = new stdClass();
            foreach($list as $key => $value)
                $object->$key = $value;
            $res[] = $object;
        }
        return $res;
    }

}