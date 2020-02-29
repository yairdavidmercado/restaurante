<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$id = $_GET["id"];

if (isset($id)) {
    include_once("phpjasperxml/PHPJasperXML.inc.php");
    //include_once ('setting.php');
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

    $server = "localhost";
    $user = "inventory";
    $pass = "admin";
    $db = "inventario";


    $PHPJasperXML = new PHPJasperXML();
    //$PHPJasperXML->debugsql=true;
    $PHPJasperXML->arrayParameter=array("parameter1"=>$id);
    $PHPJasperXML->load_xml_file("facturas.jrxml");

    $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db); //* use this line if you want to connect with mysql

    //if you want to use universal odbc connection, please create a dsn connection in odbc first
    //$PHPJasperXML->transferDBtoArray($server,"odbcuser","odbcpass","phpjasperxml","odbc"); //odbc = connect to odbc
    //$PHPJasperXML->transferDBtoArray($server,"psqluser","psqlpass","phpjasperxml","psql"); //odbc = connect to potgresql
    $PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
}else{
    echo "No existe la factura ".$id;
}


