
<?php 
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.4.6
 * @license: see license.txt included in package
*/
		
$conn = mysql_connect("localhost", "root", "");
mysql_select_db("electoral");

// set your db encoding -- for ascent chars (if required)
mysql_query("SET NAMES 'utf8'");

include("inc/jqgrid_dist.php");

//var_dump(array("value"=>'2:Not Booked eg. Ñ, Í,É;1:Yes it is Booked eg. Ñ, Í,É'));
// you can customize your own columns ...

$col = array();
$col["title"] = "ID"; // caption of column
$col["name"] = "id"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias) 
$col["width"] = "10";
$col["hidden"] = true;
$cols[] = $col;		

$col = array();
$col["title"] = "DEPARTAMENTOS";
$col["name"] = "NOMBRE"; 
$col["width"] = "30";
$col["search"] = true; // this column is not searchable
$col["editable"] = false; // this column is editable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;

$col = array();
$col["title"] = "COMPROMISO";
$col["name"] = "COMPROMISO"; 
$col["width"] = "20";
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
//$col["hidden"] = true;

//$col["formatter"] = "date"; // format as date
// $col["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'d/m/Y'); // @todo: format as date, not working with editing

$cols[] = $col;

$col = array();
$col["title"] = "%";
$col["name"] = "porcentaje"; 
$col["width"] = "10";
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editable"] = false; // this column is editable
//$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>false, "edithidden"=>false); // and is required
//$col["hidden"] = true;

//$col["formatter"] = "date"; // format as date
// $col["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'d/m/Y'); // @todo: format as date, not working with editing

$cols[] = $col;

$col = array();
$col["title"] = "META";
$col["name"] = "META"; 
$col["width"] = "10";
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editable"] = false; // this column is editable
//$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>false, "edithidden"=>false); // and is required
//$col["hidden"] = true;

//$col["formatter"] = "date"; // format as date
// $col["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'d/m/Y'); // @todo: format as date, not working with editing

$cols[] = $col;


$col = array();
$col["title"] = "COMPROMISO. TELF";
$col["name"] = "COMPROMISOTELEFONICO";
$col["width"] = "30";
$col["editable"] = true; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;

$col = array();
$col["title"] = "1er REPORTE";
$col["name"] = "1er REPORTE";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;


$col = array();
$col["title"] = "%";
$col["name"] = "1%";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;

$col = array();
$col["title"] = "2do REPORTE";
$col["name"] = "2do REPORTE";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;


$col = array();
$col["title"] = "%";
$col["name"] = "2%";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;


$col = array();
$col["title"] = "3er REPORTE";
$col["name"] = "3er REPORTE";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;


$col = array();
$col["title"] = "%";
$col["name"] = "3%";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;
$col = array();
$col["title"] = "4to REPORTE";
$col["name"] = "4to REPORTE";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;


$col = array();
$col["title"] = "%";
$col["name"] = "4%";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;
$col = array();
$col["title"] = "5to REPORTE";
$col["name"] = "5to REPORTE";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;


$col = array();
$col["title"] = "%";
$col["name"] = "5%";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;

$col = array();
$col["title"] = "6to REPORTE";
$col["name"] = "6to REPORTE";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;


$col = array();
$col["title"] = "%";
$col["name"] = "6%";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;

$col = array();
$col["title"] = "7to REPORTE";
$col["name"] = "7to REPORTE";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;


$col = array();
$col["title"] = "%";
$col["name"] = "7%";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>10); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$cols[] = $col;

/*
$col = array();
$col["title"] = "EMAIL";
$col["name"] = "EMAIL";
$col["width"] = "50";
$col["editable"] = true;
$col["search"] = true;
$col["formatter"] = "email"; // format as date
$col["editrules"] = array("required"=>true, "edithidden"=>true, "email"=>true); 
// To mask password field, apply following attribs
# $col["edittype"] = "password";
# $col["formatter"] = "password";

// default render is textbox
// $col["editoptions"] = array("value"=>'10');

// can be switched to select (dropdown)
# $col["edittype"] = "select"; // render as select
# $col["editoptions"] = array("value"=>'10:$10;20:$20;30:$30;40:$40;50:$50'); // with these values "key:value;key:value;key:value"

$cols[] = $col;


$col = array();
$col["title"] = "PARTIDO";
$col["name"] = "PARTIDO";
$col["width"] = "80";
$col["editable"] = true;
$col["search"] = true;
//$col["edittype"] = "checkbox"; // render as checkbox
//$col["editoptions"] = array("value"=>"1:0"); // with these values "checked_value:unchecked_value"
$col["hidden"] = false;
$col["edittype"] = "select"; // render as select
$col["editoptions"] = $arrpartidos; // with these values "key:value;key:value;key:value"
$col["editrules"] = array("required"=>true, "edithidden"=>true); 
$cols[] = $col;
*/
$g = new jqgrid();

// $grid["url"] = ""; // your paramterized URL -- defaults to REQUEST_URI
$grid["rowNum"] = 25; // by default 20
$grid["sortname"] = 'NOMBRE'; // by default sort grid by this field
$grid["sortorder"] = "ASC"; // ASC or DESC
$grid["caption"] = "COMPROMISO DE LOS LIDERES DEPARTAMENTALES"; // caption of grid
$grid["autowidth"] = true; // expand grid to screen width
$grid["multiselect"] =true; // allow you to multi-select through checkboxes

$g->set_options($grid);

$g->set_actions(array(	
						"add"=>false, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"rowactions"=>false, // show/hide row wise edit/del/save option
						"search" => "advance" // show single/multi field search condition (e.g. simple or advance)
					) 
				);

// you can provide custom SQL query to display data
$g->select_command = "SELECT
compromisos_candidato.id,
compromisos_candidato.COMPROMISO,
compromisos_candidato.COMPROMISOTELEFONICO,
departamentos.NOMBRE,
CONCAT(ROUND(((COMPROMISO/(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."')) * 100),1),'%') as porcentaje,
ROUND((COMPROMISO/(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*70000,0) AS META,
(SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='1er REPORTE') AS '1er REPORTE',
CONCAT(ROUND(((SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='1er REPORTE')/(compromisos_candidato.COMPROMISOTELEFONICO))*100,1),'','%') AS '1%',
(SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='2do REPORTE') AS '2do REPORTE',
CONCAT(ROUND(((SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='2do REPORTE')/(compromisos_candidato.COMPROMISOTELEFONICO))*100,1),'','%') AS '2%',
(SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='3er REPORTE') AS '3er REPORTE',
CONCAT(ROUND(((SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='3er REPORTE')/(compromisos_candidato.COMPROMISOTELEFONICO))*100,1),'','%') AS '3%',
(SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='4to REPORTE') AS '4to REPORTE',
CONCAT(ROUND(((SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='4to REPORTE')/(compromisos_candidato.COMPROMISOTELEFONICO))*100,1),'','%') AS '4%',
(SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='5to REPORTE') AS '5to REPORTE',
CONCAT(ROUND(((SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='5to REPORTE')/(compromisos_candidato.COMPROMISOTELEFONICO))*100,1),'','%') AS '5%',
(SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='6to REPORTE') AS '6to REPORTE',
CONCAT(ROUND(((SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='6to REPORTE')/(compromisos_candidato.COMPROMISOTELEFONICO))*100,1),'','%') AS '6%',
(SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='7to REPORTE') AS '7to REPORTE',
CONCAT(ROUND(((SELECT MOVILIZADOS FROM boletines WHERE compromisos_candidato.DEPARTAMENTO=boletines.IDDEPARTAMENTO AND boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='7to REPORTE')/(compromisos_candidato.COMPROMISOTELEFONICO))*100,1),'','%') AS '7%'
FROM
compromisos_candidato
INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = compromisos_candidato.DEPARTAMENTO
where CANDIDATO='".$_SESSION["idcandidato"]."'
having compromisos_candidato.COMPROMISOTELEFONICO>0
UNION
SELECT 
0 AS id,
(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."') AS COMPROMISO,
(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."') AS COMPROMISOTELEFONICO,
' TOTAL' AS NOMBRE,
CONCAT(ROUND((((select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."')/(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."')) * 100),1),'%') as porcentaje,
ROUND(((select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."')/(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*70000,0)  AS META,
(SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=21
AND boletines.REPORTES='1er REPORTE') AS '1er REPORTE',
CONCAT(ROUND(((SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='1er REPORTE')/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='21'))*100,1),'','%') AS '1%',
(SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='2do REPORTE') AS '2do REPORTE',
CONCAT(ROUND(((SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='2do REPORTE')/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='21'))*100,1),'','%') AS '2%',
(SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='3er REPORTE') AS '3er REPORTE',
CONCAT(ROUND(((SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='3er REPORTE')/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='21'))*100,1),'','%') AS '3%',
(SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='4to REPORTE') AS '4to REPORTE',
CONCAT(ROUND(((SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='4to REPORTE')/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='21'))*100,1),'','%') AS '4%',
(SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='5to REPORTE') AS '5to REPORTE',
CONCAT(ROUND(((SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='5to REPORTE')/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='21'))*100,1),'','%') AS '5%',
(SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='6to REPORTE') AS '6to REPORTE',
CONCAT(ROUND(((SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='6to REPORTE')/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='21'))*100,1),'','%') AS '6%',
(SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='7to REPORTE') AS '7to REPORTE',
CONCAT(ROUND(((SELECT sum(MOVILIZADOS) FROM boletines WHERE boletines.CANDIDATO=compromisos_candidato.CANDIDATO
AND boletines.REPORTES='7to REPORTE')/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='21'))*100,1),'','%') AS '7%'
FROM
compromisos_candidato
where CANDIDATO='".$_SESSION["idcandidato"]."'
GROUP BY NOMBRE";

// this db table will be used for add,edit,delete
$g->table = "compromisos_candidato";

// pass the cooked columns to grid
$g->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$out = $g->render("list1");

$themes = array("redmond","smoothness","start","dot-luv","excite-bike","flick","ui-darkness","ui-lightness","cupertino","dark-hive");
$i = rand(8,8);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<link rel="stylesheet" type="text/css" media="screen" href="js/themes/<?php echo $themes[$i]?>/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
<body>

		
			
		<!--	<div  style="width: 900px; height:400px; clear:both; " >-->
<?php echo $out?></div>
	
</body>
</html>