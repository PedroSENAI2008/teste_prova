<?php
require_once __DIR__ . "/../Model/ProdutoModel.php";

class ProdutoController {
    private $produtoModel;

    public function __construct(PDO $pdo) {
        $this->produtoModel = new ProdutoModel($pdo);
    }

    public function listar() {
        return $this->produtoModel->buscarTodos();
    }

    public function buscarProduto($id) {
        return $this->produtoModel->buscarProduto($id);
    }

    public function validarDados($nome, $descricao, $valor, $quantidade) {
        if (trim($nome) === '' || trim($descricao) === '') {
            return "Preencha o nome e a descrição do produto.";
        }
        if (!is_numeric($valor) || (float) $valor < 0) {
            return "Informe um valor válido e não negativo.";
        }
        if (filter_var($quantidade, FILTER_VALIDATE_INT) === false || (int) $quantidade < 0) {
            return "A quantidade deve ser um número inteiro igual ou maior que zero.";
        }
        return null;
    }

    public function cadastrar($nome, $descricao, $valor, $quantidade) {
        return $this->produtoModel->cadastrar($nome, $descricao, $valor, $quantidade);
    }

    public function editar($nome, $descricao, $valor, $quantidade, $id) {
        return $this->produtoModel->editar($nome, $descricao, $valor, $quantidade, $id);
    }

    public function deletar($id) {
        return $this->produtoModel->deletar($id);
    }

    public function ajustarEstoque($id, $tipo, $quantidade) {
        if (!in_array($tipo, ['entrada', 'saida'], true)
            || filter_var($id, FILTER_VALIDATE_INT) === false
            || (int) $id < 1
            || filter_var($quantidade, FILTER_VALIDATE_INT) === false
            || (int) $quantidade < 1) {
            return false;
        }

        return $this->produtoModel->ajustarEstoque((int) $id, $tipo, (int) $quantidade);
    }
}
