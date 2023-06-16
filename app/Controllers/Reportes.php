<?php

namespace App\Controllers;

class Reportes extends BaseController
{
    public function index()
    {

    }

    public function filtrosexcel(){

        
        $db = \Config\Database::connect();

        $colectores = $db->query("SELECT * FROM COLECTOR");
        $agencias = $db->query("SELECT * FROM AGENCIA");
        $clientes = $db->query("SELECT CLIENTEID,dbo.FNNOMBRECLIENTE(CLIENTEID) AS CLIENTE
                                FROM CLIENTE
                                UNION 
                                SELECT ccodcli,cnomcli
                                FROM INTEGRAL.dbo.climide
                                ORDER BY CLIENTE ASC");

        $datos_dinamicos = [
            'title' => 'FPH - Excel',
            //'nombresession' => $this->$session->nombre,
            //'tipousuarioid' => $this->$session->tipousuarioid,
            'colectores' => $colectores,
            'agencias' => $agencias,
            'clientes' => $clientes,
            'urlpost' => 'reporteexcel',
            'content' => 'filtrosexcel'
        ];
        
        return view('dashboard',$datos_dinamicos);
    }

    public function reporteexcel(){


        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        $agenciaid = $_POST['agenciaid'];
        $colectorid = $_POST['colectorid'];
        $clienteid = $_POST['clienteid'];

        $db = \Config\Database::connect();
        $query="";

        if(($desde=='') && ($hasta=='') && ($agenciaid==0) && ($colectorid==0) && ($clienteid==0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID");

        } elseif(($desde=='') && ($hasta=='') && ($agenciaid>0) && ($colectorid==0) && ($clienteid==0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.AGENCIAID=".$agenciaid);
        } elseif(($desde=='') && ($hasta=='') && ($agenciaid==0) && ($colectorid>0) && ($clienteid==0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.COLECTORID=".$colectorid);
        } elseif(($desde=='') && ($hasta=='') && ($agenciaid==0) && ($colectorid==0) && ($clienteid>0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.CLIENTEID=".$clienteid);
        } elseif(($desde=='') && ($hasta=='') && ($agenciaid>0) && ($colectorid>0) && ($clienteid==0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.AGENCIAID=".$agenciaid." AND COLECTORID=".$colectorid);
        } elseif(($desde=='') && ($hasta=='') && ($agenciaid>0) && ($colectorid>0) && ($clienteid>0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.AGENCIAID=".$agenciaid." AND COLECTORID=".$colectorid." AND P.CLIENTEID=".$clienteid);
        } elseif(($desde=='') && ($hasta=='') && ($agenciaid==0) && ($colectorid>0) && ($clienteid>0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE COLECTORID=".$colectorid." AND P.CLIENTEID=".$clienteid);
        } elseif(($desde=='') && ($hasta=='') && ($agenciaid>0) && ($colectorid==0) && ($clienteid>0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.AGENCIAID=".$agenciaid." AND P.CLIENTEID=".$clienteid);
/* */   } elseif(($desde<>'') && ($hasta<>'') && ($agenciaid==0) && ($colectorid==0) && ($clienteid==0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID");

        } elseif(($desde<>'') && ($hasta<>'') && ($agenciaid>0) && ($colectorid==0) && ($clienteid==0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.AGENCIAID=".$agenciaid);
        } elseif(($desde<>'') && ($hasta<>'') && ($agenciaid==0) && ($colectorid>0) && ($clienteid==0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.COLECTORID=".$colectorid);
        } elseif(($desde<>'') && ($hasta<>'') && ($agenciaid==0) && ($colectorid==0) && ($clienteid>0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.CLIENTEID=".$clienteid);
        } elseif(($desde<>'') && ($hasta<>'') && ($agenciaid>0) && ($colectorid>0) && ($clienteid==0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.AGENCIAID=".$agenciaid." AND COLECTORID=".$colectorid);
        } elseif(($desde<>'') && ($hasta<>'') && ($agenciaid>0) && ($colectorid>0) && ($clienteid>0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.AGENCIAID=".$agenciaid." AND COLECTORID=".$colectorid." AND P.CLIENTEID=".$clienteid);
        } elseif(($desde<>'') && ($hasta<>'') && ($agenciaid==0) && ($colectorid>0) && ($clienteid>0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE COLECTORID=".$colectorid." AND P.CLIENTEID=".$clienteid);
        } elseif(($desde<>'') && ($hasta<>'') && ($agenciaid>0) && ($colectorid==0) && ($clienteid>0)){
            $query = $db->query("SELECT IIF(dbo.FNNOMBRECLIENTE(P.CLIENTEID)<>'',dbo.FNNOMBRECLIENTE(P.CLIENTEID),(SELECT cnomcli FROM INTEGRAL.dbo.climide WHERE ccodcli=P.CLIENTEID)) AS CLIENTE,P.REFERENCIA,C.COLECTOR,TM.TIPOMOVIMIENTO,CONVERT(NVARCHAR(100),P.FECHAREG) AS FECHAREG,CONVERT(NVARCHAR(100),P.MONTO) AS MONTO,A.AGENCIA
            FROM PAGO P
            INNER JOIN COLECTOR C ON P.COLECTORID=C.COLECTORID
            INNER JOIN TIPOMOVIMIENTO TM ON P.TIPOMOVIMIENTOID=TM.TIPOMOVIMIENTOID
            INNER JOIN AGENCIA A ON P.AGENCIAID=A.AGENCIAID
            WHERE P.AGENCIAID=".$agenciaid." AND P.CLIENTEID=".$clienteid);
        }

        if(($query->getNumRows())>0){

            include_once("xlsxwriter.php");

            $writerr = new \xlsxwriter();

            $filename = "REPORTE_CONSOLIDADOS_FPH.xlsx";
            header('Content-disposition: attachment; filename="'.$writerr::sanitize_filename($filename).'"');
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            $arr=array();

            $i=0;
            foreach ($query->getResult() as $row){	
                $arr[$i][0]=$row->CLIENTE;//your table column fields
                $arr[$i][1]=$row->REFERENCIA;
                $arr[$i][2]=$row->COLECTOR;
                $arr[$i][3]=$row->TIPOMOVIMIENTO;
                $arr[$i][4]=$row->FECHAREG;
                $arr[$i][5]=$row->MONTO;
                $arr[$i][6]=$row->AGENCIA;
                $i=$i+1;
            }

            $header = array(
            'CLIENTE'=>'string',
            'REFERENCIA'=>'string',
            'COLECTOR'=>'string',
            'TIPO DE OPERACION'=>'string',
            'FECHA'=>'string',
            'MONTO'=>'string',
            'AGENCIA'=>'string'
            );

            $writer = new \xlsxwriter();
            $writer->setAuthor('Divyesh Patel'); 
            $writer->writeSheetHeader('Sheet1', $header, $col_options = array('fill'=>'#4cb7e4','font-style'=>'bold','color'=>'#ffffff', 'border'=>'left,right,top,bottom', 'border-style'=>'thin', 'height'=>15,'widths'=>[15,20,20,20,20,20,20],'wrap_text'=>true,'valign'=>'center','halign'=>'center') );
            $border = array( 'border'=>'left,right,top,bottom');
            $border_style = array( 'border-style'=>'thin');
            foreach($arr as $row)
            $writer->writeSheetRow('Sheet1', $row, $border, $border_style);
            $writer->writeToStdOut();
            exit(0);
        }else{
            echo "<script>alert('No se encontraron registros.') </script>";  
            // Redircet to Home Page		
            //echo "<script language=\"javascript\">window.location = '".	site_url('/bankcode/swift_code_report')."'  </script>";
        }

    }

    public function reciboPago($pagoid,$referencia){
        $ssrs = new \SSRS\Report('http://192.168.0.17/reportserver/', array('username' => 'administrator', 'password' => 'password$1'));
        //$ssrs->listChildren('/');

        $result = $ssrs->loadReport('/COLECTURIA/recibo');
        
        $ssrs->setSessionId($result->executionInfo->ExecutionID);
        $ssrs->setExecutionParameters(new \SSRS\Object\ExecutionParameters(
            array(
                "PAGOID"=>$pagoid
            )
        ));
        
        $output = $ssrs->render('PDF'); // PDF | XML | CSV
        $output->download($referencia.'_'.date("Y-m-d").'.pdf');
    }
}