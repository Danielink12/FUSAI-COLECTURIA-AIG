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
            $query = $db->query("SELECT A.AGENCIAID,A.AGENCIA,D.DEPARTAMENTO,A.CONTACTO,A.TELEFONO,A.ESTADO 
                                FROM AGENCIA A
                                LEFT JOIN INTEGRAL_GUATEMALA.dbo.DEPARTAMENTO D ON A.DEPARTAMENTOID=D.DEPARTAMENTOID");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('AGENCIA', 'DEPARTAMENTO', 'CONTACTO', 'TELEFONO','ACCIONES');

            foreach ($query->getResult() as $row) {
                
                $row->AGENCIA;
                $row->DEPARTAMENTO;
                $row->CONTACTO;
                $row->TELEFONO;

                $links  = '<a class="btn btn-primary" href="Agencias/vistaEditarAgencia/'.$row->AGENCIAID.'" role="button">EDITAR</a>';
                if(($row->ESTADO)==0){
                    $links .= '<a class="btn btn-success" href="Agencias/activardesactivaragencia/'.$row->AGENCIAID.'/'.$row->ESTADO.'" role="button">ACTIVAR</a>';
                }else{
                    $links  .= '<a class="btn btn-danger" href="Agencias/activardesactivaragencia/'.$row->AGENCIAID.'/'.$row->ESTADO.'" role="button">DESACTIVAR</a>';
                }  
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->AGENCIA,$row->DEPARTAMENTO,$row->CONTACTO,$row->TELEFONO,$links);
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

        $db = \Config\Database::connect();

        $departamentos = $db->query("SELECT * FROM INTEGRAL_GUATEMALA.dbo.DEPARTAMENTO");

        $datos_dinamicos = [
            'title' => 'AIG - Nueva Agencia',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditaragencias',
            'datosAgencia' => array(null),
            'departamentos' => $departamentos,
            'nuevo' => TRUE,
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
        $departamentoid = $_POST['departamentoid'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $usuarioid = $session->get('usuarioid');

        try {
            //code...
            $query = $db->query("INSERT INTO AGENCIA (AGENCIA,DEPARTAMENTOID,CONTACTO,TELEFONO,USUARIOID,ESTADO) VALUES('".$agencia."',".$departamentoid.",'".$nombre."','".$telefono."',".$usuarioid.",1)");
            return redirect()->to(site_url('Agencias'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarAgencia($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM AGENCIA WHERE AGENCIAID=".$id);
        $departamentos = $db->query("SELECT * FROM INTEGRAL_GUATEMALA.dbo.DEPARTAMENTO");
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'AIG - Editar Agencia',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditaragencias',
            'datosAgencia' => $resultado,
            'departamentos' => $departamentos,
            'nuevo' => FALSE,
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
        $departamentoid = $_POST['departamentoid'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];

        try {
            //code...
            $query = $db->query("UPDATE AGENCIA SET AGENCIA='".$agencia."',DEPARTAMENTOID=".$departamentoid.",CONTACTO='".$nombre."',TELEFONO='".$telefono."' WHERE AGENCIAID=".$agenciaid);
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

    public function activardesactivaragencia($agenciaid,$estado){

        $db = \Config\Database::connect();

        if($estado < 1){
            $query = $db->query("UPDATE AGENCIA SET ESTADO=1 WHERE AGENCIAID=".$agenciaid);
    
        }else{
            $query = $db->query("UPDATE AGENCIA SET ESTADO=0 WHERE AGENCIAID=".$agenciaid);
        }

        return redirect()->to(site_url('Agencias'));

    }
}