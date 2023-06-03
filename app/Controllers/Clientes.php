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
            $query = $db->query("SELECT CLIENTEID,PRIMERNOMBRE,DPI,TELEFONO, FROM CLIENTE");
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

                $links  = '<a class="btn btn-primary" href="Clientes/vistaModificarCliente/'.$row->CLIENTEID.'" role="button">EDITAR</a>';
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->PRIMERNOMBRE, $row->USUARIO, $estado, $links);
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
}