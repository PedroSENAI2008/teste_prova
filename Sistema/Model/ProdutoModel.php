<?php
class ProdutoModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function buscarTodos() {
        $stmt = $this->pdo->query("SELECT * FROM produtos ORDER BY nome");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarProduto($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $descricao, $valor, $quantidade) {
        $sql = "INSERT INTO produtos (nome, descricao, valor, quantidade)
                VALUES (:nome, :descricao, :valor, :quantidade)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':valor' => $valor,
            ':quantidade' => $quantidade
        ]);
    }

    public function editar($nome, $descricao, $valor, $quantidade, $id) {
        $sql = "UPDATE produtos
                SET nome = :nome, descricao = :descricao, valor = :valor, quantidade = :quantidade
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':valor' => $valor,
            ':quantidade' => $quantidade,
            ':id' => $id
        ]);
    }

    public function deletar($id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM estoques WHERE id_produto = :id");
        $stmt->execute([':id' => $id]);
        if ((int) $stmt->fetchColumn() > 0) {
            return false;
        }

        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() === 1;
    }

    public function ajustarEstoque($id, $tipo, $quantidade) {
        if ($tipo === 'entrada') {
            $sql = "UPDATE produtos
                    SET quantidade = quantidade + :quantidade
                    WHERE id = :id";
        } else {
            $sql = "UPDATE produtos
                    SET quantidade = quantidade - :quantidade
                    WHERE id = :id AND quantidade >= :quantidade";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':quantidade' => $quantidade,
            ':id' => $id
        ]);
        return $stmt->rowCount() === 1;
    }
}
