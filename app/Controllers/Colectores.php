<?php

namespace App\Controllers;

class Colectores extends BaseController
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
            $query = $db->query("SELECT COLECTORID,COLECTOR,NUMEROREGISTRO,ESTADO FROM COLECTOR");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('COLECTOR','No. RESGISTRO', 'ACCIONES');

            foreach ($query->getResult() as $row) {
                
                $row->COLECTOR;
                $row->NUMEROREGISTRO;
                $row->ESTADO;

                $links  = '<a class="btn btn-primary" href="Colectores/vistaEditarColector/'.$row->COLECTORID.'" role="button">EDITAR</a>';
                if(($row->ESTADO)==0){
                    $links .= '<a class="btn btn-success" href="Colectores/activardesactivarcolector/'.$row->COLECTORID.'/'.$row->ESTADO.'" role="button">ACTIVAR</a>';
                }else{
                    $links  .= '<a class="btn btn-danger" href="Colectores/activardesactivarcolector/'.$row->COLECTORID.'/'.$row->ESTADO.'" role="button">DESACTIVAR</a>';
                }  
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->COLECTOR ,$row->NUMEROREGISTRO ,$links);
            }

            $datos_dinamicos = [
                'title' => 'AIG - Colectores',
                //'nombresession' => $this->$session->nombre,
                //'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'colectores',
                'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function vistaCrearColector(){
        $datos_dinamicos = [
            'title' => 'AIG - Nuevo Colector',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarcolectores',
            'datosColector' => array(null),
            'seccion' => 'NUEVO COLECTOR',
            'txtbtn' => 'CREAR COLECTOR',
            'urlpost' => 'Colectores/crearColector'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearColector(){

        $db = \Config\Database::connect();

        $colector = $_POST['colector'];
        $noregistro = $_POST['noregistro'];


        try {
            //code...
            $query = $db->query("INSERT INTO COLECTOR (COLECTOR,NUMEROREGISTRO,ESTADO) VALUES('".$colector."','".$noregistro."',1)");
            return redirect()->to(site_url('Colectores'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarColector($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM COLECTOR WHERE COLECTORID=".$id);
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'AIG - Editar Colector',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarcolectores',
            'datosColector' => $resultado,
            'seccion' => 'EDITAR COLECTOR',
            'txtbtn' => 'GURDAR CAMBIOS',
            'urlpost' => 'Colectores/editarColector'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function editarColector(){
        $db = \Config\Database::connect();

        $colectorid = $_POST['colectorid'];
        $colector = $_POST['colector'];
        $noregistro = $_POST['noregistro'];

        try {
            //code...
            $query = $db->query("UPDATE COLECTOR SET COLECTOR='".$colector."',NUMEROREGISTRO='".$noregistro."' WHERE COLECTORID=".$colectorid);
            return redirect()->to(site_url('Colectores'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function eliminarColector($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM COLECTOR WHERE COLECTORID=".$id);
            return redirect()->to(site_url('Colectores'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function activardesactivarcolector($colectorid,$estado){

        $db = \Config\Database::connect();

        if($estado < 1){
            $query = $db->query("UPDATE COLECTOR SET ESTADO=1 WHERE COLECTORID=".$colectorid);
    
        }else{
            $query = $db->query("UPDATE COLECTOR SET ESTADO=0 WHERE COLECTORID=".$colectorid);
        }

        return redirect()->to(site_url('Colectores'));

    }
}