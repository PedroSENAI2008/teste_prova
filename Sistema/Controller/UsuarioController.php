<?php
require_once __DIR__ ."/../Model/UsuarioModel.php";
class UsuarioController {
    private $usuarioModel;
   
    public function __construct($pdo){

        $this->usuarioModel = new UsuarioModel($pdo);

    }
    public function listar() {
        $usuarios = $this->usuarioModel->buscarTodos();
        include_once  __DIR__ . "/Sistema/View/Usuario/listar.php";
        return;
    }

    public function buscarUsuario($id){
        $usuario = $this->usuarioModel->buscarUsuario($id);
        return $usuario;
    }

    public function buscarporEmail($email){
        $usuario = $this->usuarioModel->buscarporEmail($email);
        return $usuario;
    }
    public function cadastrar($nome, $email, $senha){
        $this->usuarioModel->cadastrar($nome, $email, $senha);
    }

    public function login($email, $senha){
        $usuario = $this->usuarioModel->buscarporEmail($email);
        if ($usuario && password_verify ($senha, $usuario['senha'])){//mei q descriptografa
        unset($usuario['senha']);//deixa de guardar senha
        return $usuario;} 
    return false;

    }
    
    public function editar($nome,$email, $senha, $id){
        $this->usuarioModel->editar($nome, $email, $senha, $id);

    }

    public function deletar($id){
        $usuario = $this->usuarioModel->deletar($id);
        return $usuario;
    }

}








