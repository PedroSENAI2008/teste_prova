<?php
require_once __DIR__ . "/../Model/MovimentacaoModel.php";
class MovimentacaoController {
    private $movimentacaoModel;
   
    public function __construct($pdo) {
        $this->movimentacaoModel = new MovimentacaoModel($pdo);

    }
    public function listar() {
        $estoques = $this->movimentacaoModel->buscarTodos();
        include_once __DIR__ . "/../View/Estoque/listar.php";
        return;
    }

    public function buscarestoque($id){
        $estoque = $this->movimentacaoModel->buscarestoque($id);
        return $estoque;
    }

    public function cadastrar($nome, $email, $senha){
        $this->movimentacaoModel->cadastrar($nome, $email, $senha);
    }


    
    public function editar($nome,$email, $senha, $id){
        $this->movimentacaoModel->editar($nome, $email, $senha, $id);

    }

    public function deletar($id){
        $usuario = $this->movimentacaoModel->deletar($id);
        return $usuario;
    }

}







