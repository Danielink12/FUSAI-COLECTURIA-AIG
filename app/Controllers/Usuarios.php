<?php

namespace App\Controllers;

class Usuarios extends BaseController
{

    public function __construct(){
        //$this->$db = \Config\Database::connect('PCSC');
        helper("utilidades");
    }

    public function index()
    {

        $session = session();

        try {
            decodeToken($session->token);
        } catch (\Throwable $th) {
            cerrarSesion();
        }

        if(isset($session->usuario)){
        
            $db = \Config\Database::connect();
            $table = new \CodeIgniter\View\Table();
            $query = $db->query("SELECT USUARIOID,PRIMERNOMBRE,PRIMERAPELLIDO,USUARIO,ESTADO FROM USUARIO");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('NOMBRE','USUARIO','ESTADO', 'ACCIONES');

            foreach ($query->getResult() as $row) {
                
                $row->PRIMERNOMBRE;
                $row->USUARIO;
                $row->ESTADO;

                if($row->ESTADO){
                    $estado="ACTIVO";
                }else {
                    $estado="INACTIVO";
                }

                $links  = '<a class="btn btn-primary" href="Usuarios/vistaEditarUsuario/'.$row->USUARIOID.'" role="button">EDITAR</a>';
                if(($row->ESTADO)==0){
                    $links .= '<a class="btn btn-success" href="Usuarios/activardesactivarusuario/'.$row->USUARIOID.'/'.$row->ESTADO.'" role="button">ACTIVAR</a>';
                }else{
                    $links  .= '<a class="btn btn-danger" href="Usuarios/activardesactivarusuario/'.$row->USUARIOID.'/'.$row->ESTADO.'" role="button">DESACTIVAR</a>';
                }
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->PRIMERNOMBRE, $row->USUARIO, $estado, $links);
            }

            $datos_dinamicos = [
                'title' => 'AIG - Usuarios',
                //'nombresession' => $this->$session->nombre,
                //'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'usuarios',
                'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function vistaCrearUsuario(){

        $db = \Config\Database::connect();

        $agencia = $db->query("SELECT * FROM AGENCIA");
        $tipousuario = $db->query("SELECT * FROM TIPOUSUARIO");

        $datos_dinamicos = [
            'title' => 'AIG - Nuevo Usuario',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarusuarios',
            'datosUsuario' => array(null),
            'agencia' => $agencia,
            'tipousuario' => $tipousuario,
            'nuevo' => TRUE,
            'seccion' => 'NUEVO USUARIO',
            'txtbtn' => 'CREAR USUARIO',
            'urlpost' => 'Usuarios/crearUsuario'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearUsuario(){

        $session = session();
        $db = \Config\Database::connect();

        $primernombre = $_POST['primernombre'];
        $segundonombre = $_POST['segundonombre'];
        $tercernombre = $_POST['tercernombre'];
        $primerapellido = $_POST['primerapellido'];
        $segundoapellido = $_POST['segundoapellido'];
        $tercerapellido = $_POST['tercerapellido'];
        $usuario = $_POST['usuario'];
        $clave = encrypt($_POST['clave']);
        $correo = $_POST['correo'];
        $agenciaid = $_POST['agenciaid'];
        $tipousuarioid = $_POST['tipousuarioid'];
        $usuarioreg = $session->get('usuarioid');

        try {
            //code...
            $query = $db->query("INSERT INTO USUARIO (PRIMERNOMBRE,SEGUNDONOMBRE,TERCERNOMBRE,PRIMERAPELLIDO,SEGUNDOAPELLIDO,TERCERAPELLIDO,USUARIO,CLAVE,CORREO,AGENCIAID,TIPOUSUARIOID,USUARIOREG,ESTADO) VALUES('".$primernombre."','".$segundonombre."','".$tercernombre."','".$primerapellido."','".$segundoapellido."','".$tercerapellido."','".$usuario."','".$clave."','".$correo."',".$agenciaid.",".$tipousuarioid.",".$usuarioreg.",1)");
            return redirect()->to(site_url('Usuarios'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarUsuario($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM USUARIO WHERE USUARIOID=".$id);
        $agencia = $db->query("SELECT * FROM AGENCIA");
        $tipousuario = $db->query("SELECT * FROM TIPOUSUARIO");
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'AIG - Editar Usuario',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarusuarios',
            'datosUsuario' => $resultado,
            'agencia' => $agencia,
            'tipousuario' => $tipousuario,
            'seccion' => 'EDITAR USUARIO',
            'txtbtn' => 'GURDAR CAMBIOS',
            'nuevo' => FALSE,
            'urlpost' => 'Usuarios/editarUsuario'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function editarUsuario(){
        $session = session();
        $db = \Config\Database::connect();

        $usuarioid = $_POST['usuarioid'];
        $primernombre = $_POST['primernombre'];
        $segundonombre = $_POST['segundonombre'];
        $tercernombre = $_POST['tercernombre'];
        $primerapellido = $_POST['primerapellido'];
        $segundoapellido = $_POST['segundoapellido'];
        $tercerapellido = $_POST['tercerapellido'];
        $usuario = $_POST['usuario'];
        $clave = encrypt($_POST['clave']);
        $correo = $_POST['correo'];
        $agenciaid = $_POST['agenciaid'];
        $tipousuarioid = $_POST['tipousuarioid'];   
        $usuariomodid = $session->get('usuarioid');

        try {
            //code...
            $query = $db->query("UPDATE USUARIO SET PRIMERNOMBRE='".$primernombre."',SEGUNDONOMBRE='".$segundonombre."',TERCERNOMBRE='".$tercernombre."',PRIMERAPELLIDO='".$primerapellido."',SEGUNDOAPELLIDO='".$segundoapellido."',TERCERAPELLIDO='".$tercerapellido."',USUARIO='".$usuario."',CLAVE='".$clave."',CORREO='".$correo."',AGENCIAID=".$agenciaid.",TIPOUSUARIOID=".$tipousuarioid.",USUARIOMOD=".$usuariomodid." WHERE USUARIOID=".$usuarioid);
            return redirect()->to(site_url('Usuarios'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function eliminarUsuario($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM USUARIO WHERE USUARIOID=".$id);
            return redirect()->to(site_url('Usuarios'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function activardesactivarusuario($usuarioid,$estado){

        $db = \Config\Database::connect();

        if($estado < 1){
            $query = $db->query("UPDATE USUARIO SET ESTADO=1 WHERE USUARIOID=".$usuarioid);
    
        }else{
            $query = $db->query("UPDATE USUARIO SET ESTADO=0 WHERE USUARIOID=".$usuarioid);
        }

        return redirect()->to(site_url('Usuarios'));

    }
}