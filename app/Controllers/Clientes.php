<?php

namespace App\Controllers;

class Clientes extends BaseController
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
            $query = $db->query("SELECT CLIENTEID,dbo.FNNOMBRECLIENTE(CLIENTEID) as NOMBRE,DPI,TELEFONO,'COLECTURIA' AS TIPOCLIENTE 
                                FROM CLIENTE
                                UNION 
                                SELECT ccodcli as CLIENTEID ,cnomcli AS NOMBRE, cnudoci AS DPI, ctelfam AS TELEFONO,'INTEGRAL' AS TIPOCLIENTE 
                                FROM INTEGRAL.dbo.climide");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('NOMBRE','DPI','TELEFONO','TIPO CLIENTE', 'ACCIONES');

            foreach ($query->getResult() as $row) {
                
                $row->NOMBRE;
                $row->DPI;
                $row->TELEFONO;
                $row->TIPOCLIENTE;

                if(($row->TIPOCLIENTE)=='COLECTURIA'){
                    $links  = '<a class="btn btn-primary" href="Clientes/vistaEditarCliente/'.$row->CLIENTEID.'" role="button">EDITAR</a>';
                }else{
                    $links ="";
                }
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->NOMBRE, $row->DPI, $row->TELEFONO,$row->TIPOCLIENTE, $links);
            }

            $datos_dinamicos = [
                'title' => 'AIG - Clientes',
                //'nombresession' => $this->$session->nombre,
                //'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'clientes',
                'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function vistaCrearCliente(){

        $db = \Config\Database::connect();

        $departamentos = $db->query("SELECT * FROM INTEGRAL_GUATEMALA.dbo.DEPARTAMENTO");

        $datos_dinamicos = [
            'title' => 'AIG - Nuevo Cliente',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarclientes',
            'datosCliente' => array(null),
            'departamentos' => $departamentos,
            'nuevo' => TRUE,
            'seccion' => 'NUEVO CLIENTE',
            'txtbtn' => 'CREAR CLIENTE',
            'urlpost' => 'Clientes/crearCliente'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearCliente(){

        $session = session();
        $db = \Config\Database::connect();

        $primernombre = $_POST['primernombre'];
        $segundonombre = $_POST['segundonombre'];
        $tercernombre = $_POST['tercernombre'];
        $primerapellido = $_POST['primerapellido'];
        $segundoapellido = $_POST['segundoapellido'];
        $tercerapellido = $_POST['tercerapellido'];
        $dpi = $_POST['dpi'];
        $nit = $_POST['nit'];
        $telefono = $_POST['telefono'];
        $departamentoid = $_POST['departamentoid'];
        $usuarioreg = $session->get('usuarioid');

        try {
            //code...
            $query = $db->query("INSERT INTO CLIENTE (PRIMERNOMBRE,SEGUNDONOMBRE,TERCERNOMBRE,PRIMERAPELLIDO,SEGUNDOAPELLIDO,TERCERAPELLIDO,DPI,NIT,TELEFONO,DEPARTAMENTOID,USUARIOREG) VALUES('".$primernombre."','".$segundonombre."','".$tercernombre."','".$primerapellido."','".$segundoapellido."','".$tercerapellido."','".$dpi."','".$nit."','".$telefono."',".$departamentoid.",".$usuarioreg.")");
            return redirect()->to(site_url('Clientes'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarCliente($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM CLIENTE WHERE CLIENTEID=".$id);
        $departamentos = $db->query("SELECT * FROM INTEGRAL_GUATEMALA.dbo.DEPARTAMENTO");
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'AIG - Editar Cliente',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarclientes',
            'datosCliente' => $resultado,
            'departamentos' => $departamentos,
            'seccion' => 'EDITAR CLIENTE',
            'txtbtn' => 'GURDAR CAMBIOS',
            'nuevo' => FALSE,
            'urlpost' => 'Clientes/editarCliente'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function editarCliente(){
        $session = session();
        $db = \Config\Database::connect();

        $clienteid = $_POST['clienteid'];
        $primernombre = $_POST['primernombre'];
        $segundonombre = $_POST['segundonombre'];
        $tercernombre = $_POST['tercernombre'];
        $primerapellido = $_POST['primerapellido'];
        $segundoapellido = $_POST['segundoapellido'];
        $tercerapellido = $_POST['tercerapellido'];
        $dpi = $_POST['dpi'];
        $nit = $_POST['nit'];
        $telefono = $_POST['telefono'];
        $departamentoid = $_POST['departamentoid'];
        $usuariomodid = $session->get('usuarioid');

        try {
            //code...
            $query = $db->query("UPDATE CLIENTE SET PRIMERNOMBRE='".$primernombre."',SEGUNDONOMBRE='".$segundonombre."',TERCERNOMBRE='".$tercernombre."',PRIMERAPELLIDO='".$primerapellido."',SEGUNDOAPELLIDO='".$segundoapellido."',TERCERAPELLIDO='".$tercerapellido."',DPI='".$dpi."',NIT='".$nit."',TELEFONO='".$telefono."',DEPARTAMENTOID=".$departamentoid.",USUARIOMOD=".$usuariomodid." WHERE CLIENTEID=".$clienteid);
            return redirect()->to(site_url('Clientes'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function eliminarCliente($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM CLIENTE WHERE CLIENTEID=".$id);
            return redirect()->to(site_url('Clientes'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}