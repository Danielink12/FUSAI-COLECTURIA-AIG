<?php

namespace App\Controllers;

class Pagos extends BaseController
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
            $query = $db->query("SELECT P.PAGOID,IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,A.AGENCIA,TP.TIPOPAGO,C.COLECTOR,TM.TIPOMOVIMIENTO,'$'+CONVERT(NVARCHAR(10),MONTO) AS MONTO,ANULADO,FECHAREG
                                FROM PAGO P
                                INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
                                INNER JOIN TIPOPAGO TP ON P.TIPOPAGOID=TP.TIPOPAGOID
                                INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
                                INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('AGENCIA', 'CLIENTE','TIPO DE PAGO', 'COLECTOR', 'MOVIMIENTO', 'MONTO','ESTADO','ACCIONES');

            foreach ($query->getResult() as $row) {
                
                $row->CLIENTE;
                $row->AGENCIA;
                $row->TIPOPAGO;
                $row->COLECTOR;
                $row->TIPOMOVIMIENTO;
                $row->MONTO;

                if(($row->ANULADO)==0){
                    $estado="APLICADO";
                }else{
                    $estado="ANULADO";
                }

                $links  = '<a class="btn btn-primary" href="Reportes/reciboPago/'.$row->PAGOID.'/'.$row->REFERENCIA.'" role="button">RECIBO</a>';
               
                if(($row->ANULADO)==0){
                    $links .= '<a class="btn btn-danger" href="Pagos/anularaplicarpago/'.$row->PAGOID.'/'.$row->ANULADO.'" role="button">ANULAR</a>';
                }else{
                    $links  .= '<a class="btn btn-success" href="Pagos/anularaplicarpago/'.$row->PAGOID.'/'.$row->ANULADO.'" role="button">APLICAR</a>';
                }
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->AGENCIA,$row->CLIENTE,$row->TIPOPAGO,$row->COLECTOR,$row->TIPOMOVIMIENTO,$row->MONTO,$estado, $links);
            }

            $datos_dinamicos = [
                'title' => 'AIG - Pagos',
                //'nombresession' => $this->$session->nombre,
                //'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'pagos',
                'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function vistaCrearPago(){

        $db = \Config\Database::connect();

        $agencias = $db->query("SELECT * FROM AGENCIA");
        $tipopago = $db->query("SELECT * FROM TIPOPAGO");
        $colectores = $db->query("SELECT * FROM COLECTOR");
        $tipomovimiento = $db->query("SELECT * FROM TIPOMOVIMIENTO");
        $formapago = $db->query("SELECT * FROM FORMAPAGO");

        $table = new \CodeIgniter\View\Table();
        $query = $db->query("SELECT CLIENTE.ccodcli as CLIENTEID,CLIENTE.cnomcli AS NOMBRE,CLIENTE.cnudoci AS DPI, CREDITO.ccodcta AS REFERENCIA, CREDITO.nmonapr AS MONTO
                            FROM INTEGRAL.dbo.climide CLIENTE
                            INNER JOIN INTEGRAL.dbo.cremcre CREDITO ON CLIENTE.ccodcli=CREDITO.ccodcli
                            WHERE cestado='F'
                            UNION
                            SELECT C.CLIENTEID,dbo.FNNOMBRECLIENTE(C.CLIENTEID),C.DPI,'0',NULL
                            FROM CLIENTE C");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('NOMBRE', 'DPI', 'REFERENCIA', 'MONTO DEL CREDITO','ACCIONES');

            foreach ($query->getResult() as $row) {
                
                $row->NOMBRE;
                $row->DPI;
                $row->REFERENCIA;
                $row->MONTO;

                $links  = '<a class="btn btn-primary" href="getInfoC/'.$row->CLIENTEID.'/'.$row->NOMBRE.'/'.$row->REFERENCIA.'" role="button">SELECCIONAR</a>';
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->NOMBRE,$row->DPI,$row->REFERENCIA,$row->MONTO, $links);
            }


        $datos_dinamicos = [
            'title' => 'AIG - Nuevo Pago',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarpagos',
            'datosPago' => array(null),
            'data' => $table->generate(),
            'agencias' =>$agencias,
            'tipopago' => $tipopago,
            'colectores' => $colectores,
            'tipomovimiento' => $tipomovimiento,
            'formapago' => $formapago,
            'nuevo' => TRUE,
            'ref' => "",
            'clienteid' => null,
            'cliente' => null,
            'clienteelegido' => FALSE,
            'seccion' => 'NUEVO PAGO',
            'txtbtn' => 'CREAR PAGO',
            'urlpost' => 'Pagos/crearPago'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function getInfoC($clienteid,$cliente,$ref){
        $db = \Config\Database::connect();

        $agencias = $db->query("SELECT * FROM AGENCIA");
        $tipopago = $db->query("SELECT * FROM TIPOPAGO");
        $colectores = $db->query("SELECT * FROM COLECTOR");
        $tipomovimiento = $db->query("SELECT * FROM TIPOMOVIMIENTO");
        $formapago = $db->query("SELECT * FROM FORMAPAGO");

        $table = new \CodeIgniter\View\Table();
        $query = $db->query("SELECT CLIENTE.ccodcli as CLIENTEID,CLIENTE.cnomcli AS NOMBRE,CLIENTE.cnudoci AS DPI, CREDITO.ccodcta AS REFERENCIA, CREDITO.nmonapr AS MONTO
                            FROM INTEGRAL.dbo.climide CLIENTE
                            INNER JOIN INTEGRAL.dbo.cremcre CREDITO ON CLIENTE.ccodcli=CREDITO.ccodcli
                            WHERE cestado='F'
                            UNION
                            SELECT C.CLIENTEID,dbo.FNNOMBRECLIENTE(C.CLIENTEID),C.DPI,'0',NULL
                            FROM CLIENTE C");
            $resultado = $query->getResult();

            $template = [
                'table_open' => '<table id="example" class="table table-hover" style="width:100%">'
            ];
            
            $table->setTemplate($template);

            $table->setHeading('NOMBRE', 'DPI', 'REFERENCIA', 'MONTO DEL CREDITO','ACCIONES');

            foreach ($query->getResult() as $row) {
                
                $row->NOMBRE;
                $row->DPI;
                $row->REFERENCIA;
                $row->MONTO;

                $links=null;
                $links  = '<a class="btn btn-primary" href="/Colecturia-AIG/public/Pagos/getInfoC/'.$row->CLIENTEID.'/'.$row->NOMBRE.'/'.$row->REFERENCIA.'" role="button">SELECCIONAR</a>';
                //$links .= '<a class="btn btn-danger" href="Categoria/eliminarCategoria/'.$row->CATEGORIAID.'" role="button">ELIMINAR</a>';

                $table->addRow($row->NOMBRE,$row->DPI,$row->REFERENCIA,$row->MONTO, $links);
            }


        $datos_dinamicos = [
            'title' => 'AIG - Nuevo Pago',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarpagos',
            'datosPago' => array(null),
            'data' => $table->generate(),
            'agencias' =>$agencias,
            'tipopago' => $tipopago,
            'colectores' => $colectores,
            'tipomovimiento' => $tipomovimiento,
            'formapago' => $formapago,
            'nuevo' => TRUE,
            'ref' => $ref,
            'clienteid' => $clienteid,
            'cliente' => $cliente,
            'clienteelegido' => TRUE,
            'seccion' => 'NUEVO PAGO',
            'txtbtn' => 'CREAR PAGO',
            'urlpost' => 'Pagos/crearPago'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function crearPago(){

        $db = \Config\Database::connect();
        $session = session();

        $agenciaid = $_POST['agenciaid'];
        $tipopagoid = $_POST['tipopagoid'];
        $colectorid = $_POST['colectorid'];
        $tipomovimientoid = $_POST['tipomovimientoid'];
        $formapagoid = $_POST['formapagoid'];
        $clienteid = $_POST['clienteid'];
        $ref = $_POST['referencia'];
        $monto = $_POST['monto'];
        $usuarioreg = $session->get('usuarioid');

        try {

            if($clienteid==null){
                $query = $db->query("INSERT INTO PAGO (AGENCIAID,TIPOPAGOID,COLECTORID,TIPOMOVIMIENTOID,FORMAPAGOID,REFERENCIA,MONTO,USUARIOREG,ANULADO) VALUES(".$agenciaid.",".$tipopagoid.",".$colectorid.",".$tipomovimientoid.",".$formapagoid.",'".$ref."',".$monto.",".$usuarioreg.",0)");
            }else{
                $query = $db->query("INSERT INTO PAGO (AGENCIAID,CLIENTEID,TIPOPAGOID,COLECTORID,TIPOMOVIMIENTOID,FORMAPAGOID,REFERENCIA,MONTO,USUARIOREG,ANULADO) VALUES(".$agenciaid.",".$clienteid.",".$tipopagoid.",".$colectorid.",".$tipomovimientoid.",".$formapagoid.",'".$ref."',".$monto.",".$usuarioreg.",0)");
            }
            //code...
            return redirect()->to(site_url('Pagos'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function vistaEditarPago($id){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM COLECTOR WHERE COLECTORID=".$id);
        $resultado = $query->getResult();

        $datos_dinamicos = [
            'title' => 'AIG - Editar Pago',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'content' => 'creareditarpagos',
            'datosPago' => $resultado,
            'seccion' => 'EDITAR PAGO',
            'txtbtn' => 'GURDAR CAMBIOS',
            'urlpost' => 'Pagos/editarPago'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function editarPago(){
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

    public function eliminarPago($id){
        $db = \Config\Database::connect();
        try {
            $query = $db->query("DELETE FROM PAGO WHERE PAGOID=".$id);
            return redirect()->to(site_url('Pagos'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function anularaplicarpago($pagoid,$estado){

        $db = \Config\Database::connect();

        if($estado < 1){
            $query = $db->query("UPDATE PAGO SET ANULADO=1 WHERE PAGOID=".$pagoid);
    
        }else{
            $query = $db->query("UPDATE PAGO SET ANULADO=0 WHERE PAGOID=".$pagoid);
        }

        return redirect()->to(site_url('Pagos'));

    }
}