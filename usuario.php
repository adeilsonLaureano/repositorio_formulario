<?php
require_once "conn.php";

class User extends Conn
{
    public object $conn;
    public array $formData;
    public int $id;

    public function list(): array
    {
        $this->conn = $this->connect();
        $query_users = "SELECT id, nome, email FROM cliente ORDER BY id ASC LIMIT 40";
        $result_users = $this->conn->prepare($query_users);
        $result_users->execute();
        $retorno = $result_users->fetchAll();
        //var_dump($retorno);
        return $retorno;
    }

    public function create(): bool
    {
        //var_dump($this->formData);
        $this->conn = $this->connect();
        $query_user = "INSERT INTO cliente (nome, email, senha) VALUES (:nome, :email,:password)";
        $add_user = $this->conn->prepare($query_user);
        $add_user->bindParam(':nome', $this->formData['nome']);
        $add_user->bindParam(':email', $this->formData['email']);
        $add_user->bindParam(':password', $this->formData['password']);
        $add_user->execute();

        if ($add_user->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

 
}