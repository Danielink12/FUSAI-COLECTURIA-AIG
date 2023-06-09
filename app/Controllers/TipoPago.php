<?php

namespace App\Controllers;

class TipoPago extends BaseController
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
            $query = $db->query("SELECT TIPOPAGOID,TIPOPAGO,ESTADO FROM TIPOPAGO");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('TIPO DE PAGO', 'ACCIONES');

            foreach ($query->getResult() as $row) {
                
                $row->TIPOPAGO;

                $links  = '<a class="btn btn-primary" href="TipoPago/vistaEditarFormaPago/'.$row->TIPOPAGOID.'" role="button">EDITAR</a>';
                if(($row->ESTADO)==0){
                    $links .= '<a class="btn btn-success" href="TipoPago/activardesactivarformapago/'.$row->TIPOPAGOID.'/'.$row->ESTADO.'" role="button">ACTIVAR</a>';
                }else{
                    $links  .= '<a class="btn btn-danger" href="TipoPago/activardesactivarformapago/'.$row->TIPOPAGOID.'/'.$row->ESTADO.'" role="button">DESACTIVAR</a>';
                } 
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->TIPOPAGO, $links);
            }

            $datos_dinamicos = [
                'title' => 'AIG - Tipos de pago',
                //'nombresession' => $this->$session->nombre,
                //'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'tipopago',
                'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function vistaCrearTipoPago(){
        $datos_dinamicos = [
            'title' => 'AIG - Nuevo Tipo de Pago',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditartiposdepago',
            'datosTipoPago' => array(null),
            'seccion' => 'NUEVO TIPO DE PAGO',
            'txtbtn' => 'CREAR TIPO DE PAGO',
            'urlpost' => 'TipoPago/crearTipoPago'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearTipoPago(){

        $db = \Config\Database::connect();

        $tipopago = $_POST['tipopago'];


        try {
            //code...
            $query = $db->query("INSERT INTO TIPOPAGO (TIPOPAGO,ESTADO) VALUES('".$tipopago."',1)");
            return redirect()->to(site_url('TipoPago'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarFormaPago($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM TIPOPAGO WHERE TIPOPAGOID=".$id);
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'AIG - Editar Tipo de Pago',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditartiposdepago',
            'datosTipoPago' => $resultado,
            'seccion' => 'EDITAR TIPO DE PAGO',
            'txtbtn' => 'GURDAR CAMBIOS',
            'urlpost' => 'TipoPago/editarTipoPago'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function editarTipoPago(){
        $db = \Config\Database::connect();

        $tipopagoid= $_POST['tipopagoid'];
        $tipopago = $_POST['tipopago'];

        try {
            //code...
            $query = $db->query("UPDATE TIPOPAGO SET TIPOPAGO='".$tipopago."' WHERE TIPOPAGOID=".$tipopagoid);
            return redirect()->to(site_url('TipoPago'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function eliminarTipoPago($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM TIPOPAGO WHERE TIPOPAGOID=".$id);
            return redirect()->to(site_url('TipoPago'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function activardesactivarformapago($tipopago,$estado){

        $db = \Config\Database::connect();

        if($estado < 1){
            $query = $db->query("UPDATE TIPOPAGO SET ESTADO=1 WHERE TIPOPAGOID=".$tipopago);
    
        }else{
            $query = $db->query("UPDATE TIPOPAGO SET ESTADO=0 WHERE TIPOPAGOID=".$tipopago);
        }

        return redirect()->to(site_url('TipoPago'));

    }
}