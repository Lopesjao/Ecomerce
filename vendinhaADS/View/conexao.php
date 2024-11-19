<?php
class Conexao {
    private $host = 'localhost';
    private $dbname = 'bdlojinha';
    private $user = 'root';
    private $password = '';

    public function conexao() {
        try {
            $conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexao;
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
            return null;
        }
    }
}
?>
