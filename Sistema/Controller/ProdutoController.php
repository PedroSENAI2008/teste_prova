<?php
require_once "C:/xampp/htdocs/mvc/Model/ProdutoModel.php";
class ProdutoController {
    private $produtoModel;
   
    public function __construct($pdo) {
        $this->produtoModel = new ProdutoModel($pdo);

    }
    public function listar() {
        $produtos = $this->produtoModel->buscarTodos();
        include_once  __DIR__ . "/Sistema/View/Produto/listar.php";
        return;
    }

    public function buscarProduto($id){
        $produto = $this->produtoModel->buscarProduto($id);
        return $produto;
    }

    public function cadastrar($nome, $email, $senha){
        $this->produtoModel->cadastrar($nome, $email, $senha);
    }

    public function login($email, $senha){
        $usuario = $this->produtoModel->Login($email, $senha);
        return $usuario;
    }
    
    public function editar($nome,$email, $senha, $id){
        $this->produtoModel->editar($nome, $email, $senha, $id);

    }

    public function deletar($id){
        $usuario = $this->produtoModel->deletar($id);
        return $usuario;
    }

}








