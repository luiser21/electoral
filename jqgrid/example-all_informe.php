<?php 

		
$conn = mysql_connect("localhost", "root", "");
mysql_select_db("electoral");

mysql_query("SET NAMES 'utf8'");

include("inc/jqgrid_dist.php");

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
$col["search"] = false; // this column is not searchable
$col["editable"] = false; // this column is editable
$col["editoptions"] = array("size"=>50); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;

$col = array();
$col["title"] = "COMPROMISO";
$col["name"] = "COMPROMISO"; 
$col["width"] = "20";
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editable"] = false; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col["hidden"] = true;


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
$col["hidden"] = true;

$cols[] = $col;

$col = array();
$col["title"] = "META";
$col["name"] = "META"; 
$col["width"] = "10";
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editable"] = false; // this column is editable
$col["editrules"] = array("required"=>false, "edithidden"=>false); // and is required
$col["hidden"] = true;

$cols[] = $col;


$col = array();
$col["title"] = "COMPROMISOTELEFONICO";
$col["name"] = "COMPROMISOTELEFONICO";
$col["width"] = "20";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;

$col = array();
$col["title"] = "1er Rprt";
$col["name"] = "1er Reporte";
$col["width"] = "20";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;

$col = array();
$col["title"] = "%";
$col["name"] = "porcent1";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;

$col = array();
$col["title"] = "2do Rprt";
$col["name"] = "2do Reporte";
$col["width"] = "20";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;

$col = array();
$col["title"] = "%";
$col["name"] = "porcent2";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;
$col = array();
$col["title"] = "3er Rprt";
$col["name"] = "3er Reporte";
$col["width"] = "20";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;
$col = array();
$col["title"] = "%";
$col["name"] = "porcent3";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;
$col = array();
$col["title"] = "4to Rprt";
$col["name"] = "4to Reporte";
$col["width"] = "20";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;
$col = array();
$col["title"] = "%";
$col["name"] = "porcent4";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;
$col = array();
$col["title"] = "5to Rprt";
$col["name"] = "5to Reporte";
$col["width"] = "20";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;
$col = array();
$col["title"] = "%";
$col["name"] = "porcent5";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;
$col = array();
$col["title"] = "6to Rprt";
$col["name"] = "6to Reporte";
$col["width"] = "20";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;
$col = array();
$col["title"] = "%";
$col["name"] = "porcent6";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;
$col = array();
$col["title"] = "7mo Rprt";
$col["name"] = "7mo Reporte";
$col["width"] = "20";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;

$col = array();
$col["title"] = "%";
$col["name"] = "porcent7";
$col["width"] = "10";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;

$col = array();
$col["title"] = "Votos Reales";
$col["name"] = "VOTOSREALES";
$col["width"] = "20";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;

$col = array();
$col["title"] = "Diferencia";
$col["name"] = "DIFERENCIA";
$col["width"] = "20";
$col["editable"] = false; // this column is not editable
$col["align"] = "right"; // this column is not editable
$col["search"] = false; // this column is not searchable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true, "integer"=>true); // and is required
$col["hidden"] = false;

$cols[] = $col;

$g = new jqgrid();

$grid["rowNum"] = 35; // by default 20
$grid["sortname"] = 'NOMBRE'; // by default sort grid by this field
$grid["sortorder"] = "ASC"; // ASC or DESC
$grid["caption"] = "COMPROMISO DE LOS LIDERES DEPARTAMENTALES"; // caption of grid
$grid["autowidth"] = true; // expand grid to screen width
$grid["multiselect"] =true; // allow you to multi-select through checkboxes


$g->set_options($grid);

$g->set_actions(array(	
						"add"=>false, // allow/disallow add
						"edit"=>false, // allow/disallow edit
						"delete"=>false, // allow/disallow delete
						"rowactions"=>true, // show/hide row wise edit/del/save option
						"search" => "advance", // show single/multi field search condition (e.g. simple or advance)
						"autofilter" => true,
					) 
				);

// you can provide custom SQL query to display data
$g->select_command = "SELECT
(SELECT boletines.ID FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=10 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO) as id,
compromisos_candidato.COMPROMISO,
compromisos_candidato.COMPROMISOTELEFONICO,
departamentos.NOMBRE,
CONCAT(ROUND(((COMPROMISO/(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."')) * 100),1),'%') as porcentaje,
ROUND((COMPROMISO/(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*70000,0) AS META,
(SELECT boletines.MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=10 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO) as '1er Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=10 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO)/compromisos_candidato.COMPROMISOTELEFONICO)*100),1),'%') as porcent1,
(SELECT boletines.MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=11 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO) as '2do Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=11 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO)/compromisos_candidato.COMPROMISOTELEFONICO)*100),1),'%') as porcent2,
(SELECT boletines.MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=12 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO) as '3er Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=12 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO)/compromisos_candidato.COMPROMISOTELEFONICO)*100),1),'%') as porcent3,
(SELECT boletines.MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=13 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO) as '4to Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=13 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO)/compromisos_candidato.COMPROMISOTELEFONICO)*100),1),'%') as porcent4,
(SELECT boletines.MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=14 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO) as '5to Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=14 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO)/compromisos_candidato.COMPROMISOTELEFONICO)*100),1),'%') as porcent5,
(SELECT boletines.MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=15 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO) as '6to Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=15 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO)/compromisos_candidato.COMPROMISOTELEFONICO)*100),1),'%') as porcent6,
(SELECT boletines.MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=16 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO) as '7mo Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=16 and boletines.IDDEPARTAMENTO=compromisos_candidato.DEPARTAMENTO)/compromisos_candidato.COMPROMISOTELEFONICO)*100),1),'%') as porcent7,
compromisos_candidato.VOTOSREALES,

(compromisos_candidato.VOTOSREALES-(
		SELECT
			boletines.MOVILIZADOS
		FROM
			boletines
		WHERE
			boletines.CANDIDATO = '21'
		AND HORA_REAL = 16
		AND boletines.IDDEPARTAMENTO = compromisos_candidato.DEPARTAMENTO
	)) AS DIFERENCIA
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
ROUND(((select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."')/(select sum(COMPROMISO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*70000,0)  AS META,
(SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=10 ) as '1er Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=10)/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*100),1),'%') as porcent1,
(SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=11 ) as '2do Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=11)/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*100),1),'%') as porcent2,
(SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=12 ) as '3er Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=12)/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*100),1),'%') as porcent3,
(SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=13 ) as '4to Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=13)/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*100),1),'%') as porcent4,
(SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=14 ) as '5to Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=14)/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*100),1),'%') as porcent5,
(SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=15 ) as '6to Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=15)/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*100),1),'%') as porcent6,
(SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=16 ) as '7mo Reporte',
CONCAT(ROUND((((SELECT sum(boletines.MOVILIZADOS) as MOVILIZADOS FROM boletines
where boletines.CANDIDATO='".$_SESSION["idcandidato"]."' and HORA_REAL=16)/(select sum(COMPROMISOTELEFONICO) from compromisos_candidato where CANDIDATO='".$_SESSION["idcandidato"]."'))*100),1),'%') as porcent7,
(SELECT
				sum(compromisos_candidato.VOTOSREALES)
			FROM
				compromisos_candidato
			WHERE
				CANDIDATO = '21'
		)AS VOTOSREALES,
((SELECT
				sum(compromisos_candidato.VOTOSREALES)
			FROM
				compromisos_candidato
			WHERE
				CANDIDATO = '21'
		)-(
			SELECT
				sum(boletines.MOVILIZADOS)AS MOVILIZADOS
			FROM
				boletines
			WHERE
				boletines.CANDIDATO = '21'
			AND HORA_REAL = 16
		)) AS DIFERENCIA
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
<!-- <div  style="width: 900px; height:400px; clear:both; " ></div>-->
<?php echo $out?>
	
</body>
</html>