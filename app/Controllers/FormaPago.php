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

                $links  = '<a class="btn btn-primary" href="Clientes/vistaModificarCliente/'.$row->FORMAPAGOID.'" role="button">EDITAR</a>';
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->TIPOPAGO, $links);
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
}