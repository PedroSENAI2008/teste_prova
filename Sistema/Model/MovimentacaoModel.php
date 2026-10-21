<?php
class MovimentacaoModel {
    private $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function buscarTodos(){
        $sql = "SELECT estoques.*, produtos.nome AS produto_nome, usuarios.nome AS usuario_nome
                FROM estoques
                INNER JOIN produtos ON estoques.produto_id = produtos.id
                INNER JOIN usuarios ON estoques.usuario_id = usuarios.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function buscarestoque($id){
        $sql = "SELECT estoques.*, produtos.nome AS produto_nome, usuarios.nome AS usuario_nome
                FROM estoques
                INNER JOIN produtos ON estoques.produto_id = produtos.id
                INNER JOIN usuarios ON estoques.usuario_id = usuarios.id
                WHERE estoques.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $email, $senha) {
        $sql = "INSERT INTO estoques (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha
        ]);
    }
    public function editar($nome, $email, $senha, $id) {
        $sql = "UPDATE estoques SET nome=?, email=?, senha=? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $senha, $id]);
    }

    public function deletar($id) {
        $sql = "DELETE FROM estoques WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function Login($email, $senha) {
        $sql = "SELECT * FROM estoques WHERE email = :email AND senha = :senha";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':senha' => $senha
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}