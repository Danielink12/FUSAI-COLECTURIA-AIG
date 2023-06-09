<?php

namespace App\Controllers;

class FormaPago extends BaseController
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
            $query = $db->query("SELECT FORMAPAGOID,FORMAPAGO,ESTADO FROM FORMAPAGO");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('FORMA DE PAGO', 'ACCIONES');

            foreach ($query->getResult() as $row) {
                
                $row->FORMAPAGO;

                $links  = '<a class="btn btn-primary" href="FormaPago/vistaEditarFormaPago/'.$row->FORMAPAGOID.'" role="button">EDITAR</a>';
                if(($row->ESTADO)==0){
                    $links .= '<a class="btn btn-success" href="FormaPago/activardesactivarformapago/'.$row->FORMAPAGOID.'/'.$row->ESTADO.'" role="button">ACTIVAR</a>';
                }else{
                    $links  .= '<a class="btn btn-danger" href="FormaPago/activardesactivarformapago/'.$row->FORMAPAGOID.'/'.$row->ESTADO.'" role="button">DESACTIVAR</a>';
                }    
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->FORMAPAGO, $links);
            }

            $datos_dinamicos = [
                'title' => 'AIG - Tipos de pago',
                //'nombresession' => $this->$session->nombre,
                //'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'formapago',
                'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function vistaCrearFormaPago(){
        $datos_dinamicos = [
            'title' => 'AIG - Nueva Forma de Pago',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarformasdepago',
            'datosFormaPago' => array(null),
            'seccion' => 'NUEVA FORMA DE PAGO',
            'txtbtn' => 'CREAR FORMA DE PAGO',
            'urlpost' => 'FormaPago/crearFormaPago'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearFormaPago(){

        $db = \Config\Database::connect();

        $formapago = $_POST['formapago'];


        try {
            //code...
            $query = $db->query("INSERT INTO FORMAPAGO (FORMAPAGO,ESTADO) VALUES('".$formapago."',1)");
            return redirect()->to(site_url('FormaPago'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarFormaPago($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM FORMAPAGO WHERE FORMAPAGOID=".$id);
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'AIG - Editar Forma de Pago',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarformasdepago',
            'datosFormaPago' => $resultado,
            'seccion' => 'EDITAR FORMA DE PAGO',
            'txtbtn' => 'GURDAR CAMBIOS',
            'urlpost' => 'FormaPago/editarFormaPago'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function editarFormaPago(){
        $db = \Config\Database::connect();

        $formapagoid= $_POST['formapagoid'];
        $formapago = $_POST['formapago'];

        try {
            //code...
            $query = $db->query("UPDATE FORMAPAGO SET FORMAPAGO='".$formapago."' WHERE FORMAPAGOID=".$formapagoid);
            return redirect()->to(site_url('FormaPago'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function eliminarFormaPago($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM FORMAPAGO WHERE FORMAPAGOID=".$id);
            return redirect()->to(site_url('FormaPago'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function activardesactivarformapago($formapago,$estado){

        $db = \Config\Database::connect();

        if($estado < 1){
            $query = $db->query("UPDATE FORMAPAGO SET ESTADO=1 WHERE FORMAPAGOID=".$formapago);
    
        }else{
            $query = $db->query("UPDATE FORMAPAGO SET ESTADO=0 WHERE FORMAPAGOID=".$formapago);
        }

        return redirect()->to(site_url('FormaPago'));

    }
}