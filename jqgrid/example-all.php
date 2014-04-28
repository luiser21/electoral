﻿
<?php 
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.4.6
 * @license: see license.txt included in package
*/
		
$conn = mysql_connect("localhost", "root", "1234");
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
$col["width"] = "50";
$col["search"] = true; // this column is not searchable
$col["editable"] = false; // this column is editable
$col["editoptions"] = array("size"=>50); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;

$col = array();
$col["title"] = "COMPROMISO";
$col["name"] = "COMPROMISO"; 
$col["width"] = "20";
$col["align"] = "right"; // this column is not editable
$col["search"] = true; // this column is not searchable
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
$col["title"] = "COMPROMISOTELEFONICO";
$col["name"] = "COMPROMISOTELEFONICO";
$col["width"] = "30";
$col["editable"] = true; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = true; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
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
$grid["rowNum"] = 35; // by default 20
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
						"rowactions"=>true, // show/hide row wise edit/del/save option
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
ROUND((COMPROMISO/(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*70000,0) AS META
FROM
compromisos_candidato
INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = compromisos_candidato.DEPARTAMENTO
where CANDIDATO='".$_SESSION["idcandidato"]."'
UNION
SELECT 
0 AS id,
(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."') AS COMPROMISO,
(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."') AS COMPROMISOTELEFONICO,
' TOTAL' AS NOMBRE,
CONCAT(ROUND((((select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."')/(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."')) * 100),1),'%') as porcentaje,
ROUND(((select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."')/(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*70000,0)  AS META
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

		
			
			<div  style="width: 900px; height:400px; clear:both; " >
<?php echo $out?></div>
	
</body>
</html>