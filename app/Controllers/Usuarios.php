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

                $links  = '<a class="btn btn-primary" href="Clientes/vistaModificarCliente/'.$row->USUARIOID.'" role="button">EDITAR</a>';
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
}