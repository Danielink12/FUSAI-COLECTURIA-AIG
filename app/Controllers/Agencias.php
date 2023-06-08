<?php

namespace App\Controllers;

class Agencias extends BaseController
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
            $query = $db->query("SELECT AGENCIAID,AGENCIA,ESTADO FROM AGENCIA");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('AGENCIA', 'ACCIONES');

            foreach ($query->getResult() as $row) {
                
                $row->AGENCIA;
                $row->ESTADO;

                $links  = '<a class="btn btn-primary" href="Agencias/vistaEditarAgencia/'.$row->AGENCIAID.'" role="button">EDITAR</a>';
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->AGENCIA,$links);
            }

            $datos_dinamicos = [
                'title' => 'AIG - Agencias',
                //'nombresession' => $this->$session->nombre,
                //'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'agencias',
                'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }


    }

    public function vistaCrearAgencia(){
        $datos_dinamicos = [
            'title' => 'AIG - Nueva Agencia',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditaragencias',
            'datosAgencia' => array(null),
            'seccion' => 'NUEVA AGENCIA',
            'txtbtn' => 'CREAR AGENCIA',
            'urlpost' => 'Agencias/crearAgencia'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearAgencia(){
        $session = session();
        $db = \Config\Database::connect();

        $agencia = $_POST['agencia'];
        $usuarioid = $session->get('usuarioid');

        try {
            //code...
            $query = $db->query("INSERT INTO AGENCIA (AGENCIA,USUARIOID,ESTADO) VALUES('".$agencia."',".$usuarioid.",1)");
            return redirect()->to(site_url('Agencias'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarAgencia($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM AGENCIA WHERE AGENCIAID=".$id);
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'AIG - Editar Agencia',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditaragencias',
            'datosAgencia' => $resultado,
            'seccion' => 'EDITAR AGENCIA',
            'txtbtn' => 'GURDAR CAMBIOS',
            'urlpost' => 'Agencias/editarAgencia'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function editarAgencia(){
        $db = \Config\Database::connect();

        $agenciaid= $_POST['agenciaid'];
        $agencia = $_POST['agencia'];

        try {
            //code...
            $query = $db->query("UPDATE AGENCIA SET AGENCIA='".$agencia."' WHERE AGENCIAID=".$agenciaid);
            return redirect()->to(site_url('Agencias'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function eliminarAgencia($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM AGENCIA WHERE AGENCIAID=".$id);
            return redirect()->to(site_url('Agencias'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}