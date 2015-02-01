<?php require_once('topadmin.php');?> 
<?php 


$tipo = (isset($_GET['ac']) ? $_GET['ac'] : 0); ;
?>
<style>
#crudFormLineal label {
	width: 350px;
}
.bg1 {  
	position:relative;
	top:750px;
}
</style>
<div class="main">	
<header>
		<div style=" position:absolute; top:190px; width:auto; clear:both"><br/>
<?php if($tipo==1){?>
<h4>Constituci&oacute;n Nacional</h4>
<?php }if($tipo==2){?>
<h4>Votacion por Candidatos SENADO</h4>
<?php }if($tipo==3){?>
<h4>Votacion por Partidos SENADO</h4>
<?php }if($tipo==4){?>
<h4>Curules por Partidos SENADO</h4>
<?php }if($tipo==5){?>
<h4>Elegidos Detallado SENADO</h4>
<?php }if($tipo==6){?>
<h4>Votacion por Partidos CAMARA</h4>
<?php }if($tipo==7){?>
<h4>Curules por Partido CAMARA</h4>
<?php }if($tipo==8){?>
<h4>Curules por Departamento CAMARA</h4>
<?php }if($tipo==9){?>
<h4>Elegidos Detallado CAMARA</h4>
<?php }?>

<div id="crudFormLineal" style="width: 910px; height: auto; clear:both; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
<?php if($tipo==1){?>			
<embed src="documentos/Constitucioncolombia.pdf" type="application/pdf" style="width:910px; height:600px">	
<?php }if($tipo==2){?>
<embed src="documentos/canddidatos senado.pdf" type="application/pdf" style="width:910px; height:600px">	
<?php }if($tipo==3){?>
<embed src="documentos/votacion-por-partido-senado-2010.pdf" type="application/pdf" style="width:910px; height:600px">	
<?php }if($tipo==4){?>
<embed src="documentos/senado-por-partidos-curules-elec2010.pdf" type="application/pdf" style="width:910px; height:600px">	
<?php }if($tipo==5){?>
<embed src="documentos/senado-detallado-elec2010.pdf" type="application/pdf" style="width:910px; height:600px">	
<?php }if($tipo==6){?>
<embed src="documentos/votacion-por-partido-camara-2010.pdf" type="application/pdf" style="width:910px; height:600px">
<?php }if($tipo==7){?>
<embed src="documentos/camara-por-partidos-curules-elec2010.pdf" type="application/pdf" style="width:910px; height:600px">	
<?php }if($tipo==8){?>
<embed src="documentos/camara-por-dptos-curules-elec2010.pdf" type="application/pdf" style="width:910px; height:600px">	
<?php }if($tipo==9){?>
<embed src="documentos/camara-detallado-elec2010.pdf" type="application/pdf" style="width:910px; height:600px">	
<?php }if($tipo==11){?>
<embed src="documentos/Elegidos_Congreso_de_la_Republica_2014-2018.pdf" type="application/pdf" style="width:910px; height:600px">	


<?php }if($tipo==12){?>
<style>
.bg1 {  
	position:relative;
	top:1450px;
}
#menu {
    padding-top: 118px;
}
#page {
    background-color: #ebebeb;
    background-image: none;
    border-color: #000000;
    border-radius: 10px 10px 0;
    border-style: none;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
    margin-left: calc();
    margin-right: auto;
    margin-top: -12px;
    min-height: 1358px;
    padding-left: 14px;
    padding-right: 12px;
    padding-top: 0;
    width: 974px;
    z-index: -5;
}
</style>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="index_data/site_global.css">
  <link rel="stylesheet" type="text/css" href="index_data/index.css" id="pagesheet">
  <!-- Other scripts -->
  
  <div class="shadow rounded-corners clearfix" id="page" style="margin-left: calc();">
<div class="clearfix colelem" id="pu341-6"><!-- group -->
    <div class="clearfix grpelem"><!-- content -->
     <p id="u341-2">Representantes</p>
     <p id="u341-4">a la Cámara</p>
    </div>	
   </div>
   <div class="clearfix colelem" id="pu318"><!-- group -->
    <div class="clip_frame grpelem" id="u318"><!-- image -->
     <img class="block" id="u318_img" src="index_data/logo-cambio-r.png" alt="" height="84" width="84">
    </div>
    <div class="clip_frame grpelem" id="u322"><!-- image -->
     <img class="block" id="u322_img" src="index_data/logo-conservador.png" alt="" height="84" width="84">
    </div>
    <div class="clip_frame grpelem" id="u324"><!-- image -->
     <img class="block" id="u324_img" src="index_data/logo-liberal.png" alt="" height="84" width="84">
    </div>
    <div class="clip_frame grpelem" id="u330"><!-- image -->
     <img class="block" id="u330_img" src="index_data/logo-u.png" alt="" height="84" width="84">
    </div>
    <div class="clearfix grpelem" id="u344-6"><!-- content -->
     <p id="u344-2">Partido de La U</p>
     <p>37 Representantes</p>
    </div>
    <div class="clearfix grpelem" id="u346-6"><!-- content -->
     <p id="u346-2">Partido Conservador</p>
     <p>27 Representantes</p>
    </div>
    <div class="clearfix grpelem" id="u347-6"><!-- content -->
     <p id="u347-2">Partido Liberal</p>
     <p>39 Representantes</p>
    </div>
    <div class="clearfix grpelem" id="u348-6"><!-- content -->
     <p id="u348-2">Cambio Radical</p>
     <p>16 Representantes</p>
    </div>
   </div>
   <div class="clearfix colelem" id="pu334-80"><!-- group -->
    <div class="clearfix grpelem" id="u334-80"><!-- content -->
     <p>Eduar Luis Benjumea Moreno (Amazonas)</p>
     <p>Ivan Dario Agudelo Zapata (Antioquia)</p>
     <p>John Jairo Roldán Avendaño (Antioquia)</p>
     <p>Julián Bedoya Pulgarin (Antioquia)</p>
     <p>Oscar de Jesus Hurtado Pérez (Antioquia)</p>
     <p>Pedro Jesús Orjuela Gómez (Arauca)</p>
     <p>Mauricio Gómez Amin (Atlántico)</p>
     <p>Olga Lucía Velásquez (Bogotá)</p>
     <p>Clara Leticia Rojas (Bogotá)</p>
     <p>Juan Carlos Lozada (Bogotá)</p>
     <p>Silvio José Carrasquilla (Bolívar)</p>
     <p>Rafael Romero (Boyacá)</p>
     <p>Mario Alberto Castaño (Caldas)</p>
     <p>Harry Giovanny González (Caquetá)</p>
     <p>Jorge Camilo Abril Tarache (Casanare)</p>
     <p>Carlos Julio Bonilla (Cauca)</p>
     <p>Crisanto Pizo Mazabuel (Cauca)</p>
     <p>Nilton Córdoba (Chocó)</p>
     <p>Fabio Raúl Amin (Córdoba)</p>
     <p>Óscar Hernán Sánchez (Cundinamarca)</p>
     <p>Leopoldo Suárez (Guaviare)</p>
     <p>Jaime Enrique Serrano (Magdalena)</p>
     <p>Kelyn Johana González (Magdalena)</p>
     <p>Ángelo Antonio Villamil (Meta) Votos:</p>
     <p>Neftali Correa Díaz (Nariño) Votos:</p>
     <p>Alejandro Carlos Chacón (N. Santander)</p>
     <p>Jose Neftali Santos (Norte de Santander)</p>
     <p>Argenis Velásquez (Putumuyo)</p>
     <p>Luciano Grisales Londoño (Quindío)</p>
     <p>Diego Patiño Amariles (Risaralda)</p>
     <p>Jack Housni Jaller (San Andrés)</p>
     <p>Edgar Alfnso Gómez (Santander)</p>
     <p>Miguel Ángel Pinto (Santander)</p>
     <p>Ángel María Gaitán (Tolima)</p>
     <p>Fabio Alonso Arroyave (Valle)</p>
     <p>Nancy Denise Castillo&nbsp; (Valle)</p>
     <p>Juan Fernando Reyes (Valle)</p>
     <p>norbey marulanda muñoz (Vaupés)</p>
     <p>Marco Sergio Rodríguez (Vichada)</p>
    </div>
    <div class="clearfix grpelem" id="u360-78"><!-- content -->
     <p id="u360-2">Juan Felipe Lemos (Antioquia)</p>
     <p id="u360-4">León Darío Ramírez (Antioquia)</p>
     <p id="u360-6">Albeiro Vanegas Osorio (Arauca)</p>
     <p id="u360-8">Martha Patricia Villalba (Atlántico)</p>
     <p id="u360-10">Eduardo Alfonso Crissien (Atlántico)</p>
     <p id="u360-12">Carlos Arturo Correa (Bogotá)</p>
     <p id="u360-14">Efraín Antonio Torres (Bogotá)</p>
     <p id="u360-16">Marta Cecilia Curiosorio (Bolívar)</p>
     <p id="u360-18">Alonso Jose del Río Cabarcas (Bolívar)</p>
     <p id="u360-20">Jairo Enrique Castiblanco (Boyacá)</p>
     <p id="u360-22">Cristóbal Rodríguez (Boyacá)</p>
     <p id="u360-24">Luz Adriana Moreno (Caldas)</p>
     <p id="u360-26">Hernán Penagos Giraldo (Caldas)</p>
     <p id="u360-28">John Jairo Cárdenas (Cauca)</p>
     <p id="u360-30">Christian José Moreno (Cesar)</p>
     <p id="u360-32">José Bernardo Flórez (Chocó)</p>
     <p id="u360-34">Sara Elena Piedrahita (Córdoba)</p>
     <p id="u360-36">Eduardo José Tous (Córdoba)</p>
     <p id="u360-38">Raymundo Elías Méndez (Córdoba)</p>
     <p id="u360-40">José Edilberto Caicedo (Cundinamarca)</p>
     <p id="u360-42">Alfredo Guillermo Molina (Cundinamarca)</p>
     <p id="u360-44">Alexander García (Guaviare)</p>
     <p id="u360-46">Ana maría Rincón (Huila)</p>
     <p id="u360-48">Alfredo Rafael Deluque (La Guajira)</p>
     <p id="u360-50">Eduardo Agatón Díaz (Magdalena)</p>
     <p id="u360-52">Elda Lucy Contento (Meta)</p>
     <p id="u360-54">Berner León Zambrano (Nariño)</p>
     <p id="u360-56">Wilmer Ramiro Carrillo (N. Santander)</p>
     <p id="u360-58">Didier Burgos (Risaralda)</p>
     <p id="u360-60">Nicolás Daniel Guerrero (Sucre)</p>
     <p id="u360-62">Carlos Edward Osorio (Tolima)</p>
     <p id="u360-64">Jaime Armando Yepes (Tolima)</p>
     <p id="u360-66">Elbert Díaz (Valle)</p>
     <p id="u360-68">Jorge Eliecer Tamayo (Valle)</p>
     <p id="u360-70">Rafael Eduardo Palau (Valle)</p>
     <p id="u360-72">Nery Oros Ortíz (Vichada)</p>
     <p id="u360-74">Jaime Buenahora Febres (Consulado)</p>
     <p id="u360-75">&nbsp;</p>
     <p id="u360-76">&nbsp;</p>
    </div>
    <div class="clearfix grpelem" id="u361-57"><!-- content -->
     <p id="u361-2"><span id="u361">Germán Alcides Blanco (Antioquia)</span></p>
     <p id="u361-4">Luis Horacio Gallón (Antioquia)</p>
     <p id="u361-6">Nicolás Albeiro Echeverry (Antioquia)</p>
     <p id="u361-8">Aida Merlano rebolledo (Atlántico)</p>
     <p id="u361-10">Inés Cecilia López (Atlántico)</p>
     <p id="u361-12">Armando Antonio Zabarain (Atlántico)</p>
     <p id="u361-14">Telésforo Pedraza (Bogotá)</p>
     <p id="u361-16">Pedrito Tomás Pereira (Bolívar)</p>
     <p id="u361-18">Humphrey Roa Sarmiento (Boyacá)</p>
     <p id="u361-20">Arturo Yepes Alzáte (Caldas)</p>
     <p id="u361-22">Luis Fernando Urrego (Caquetá)</p>
     <p id="u361-24">Alfredo Ape Cuello (Cesar)</p>
     <p id="u361-26">David Alejandro Barguil (Córdoba)</p>
     <p id="u361-28">Orlando Alfonso Clavijo (Cundinamarca)</p>
     <p id="u361-30">Jaime Felipe Lozada (Huila)</p>
     <p id="u361-32">Diela Liliana Benavides (Nariño)</p>
     <p id="u361-34">Oscar Fernando Bravo (Nariño)</p>
     <p id="u361-36">Ciro Antonio Rodríguez (N. Santander)</p>
     <p id="u361-38">Juan Carlos García (N. Santander)</p>
     <p id="u361-40">Orlando Aníbal Guerra (Putumayo)</p>
     <p id="u361-42">Mauricio Salazar Pelaez (Risaralda)</p>
     <p id="u361-44">Juan Carlos Rivera (Risaralda)</p>
     <p id="u361-46">Lina María Barrera (Santander)</p>
     <p id="u361-48">Jose Elver Hernández (Tolima)</p>
     <p id="u361-50">Miguel Ángel Barreto (Tolima)</p>
     <p id="u361-52">Álvaro López Gil (Valle)</p>
     <p id="u361-54">Heriberto Sanabria (Valle)</p>
     <p id="u361-55">&nbsp;</p>
    </div>
    <div class="clearfix grpelem" id="u362-34"><!-- content -->
     <p>Jose Ignacio Mesa Betancur (Antioquia)</p>
     <p>Luis Eduardo Diaz Granados T. (Atlántico)</p>
     <p>Rodrigo Lara Restrepo (Bogotá)</p>
     <p>Hernando Jose Padaui Álvarez (Bolívar)</p>
     <p>Karen Violette Cure Corcione (Bolívar)</p>
     <p>Eloy Chicho Quintero Romero&nbsp; (Cesar)</p>
     <p>José Emilio Rey Ángel&nbsp; (Cundinamarca)</p>
     <p>Jorge Enrique Rozo R.&nbsp; (Cundinamarca)</p>
     <p>Carlos Alberto Cuenca Chaux (Guainía)</p>
     <p>Fabian Gerardo Castillo S. (Magdalena)</p>
     <p>Atilano Alfonso Giraldo Arboleda&nbsp; (Quindío)</p>
     <p>Jorge Ricardo Parra Sepúlveda (Quindío)</p>
     <p>Ciro Fernández Núñez (Santander)</p>
     <p>Jose Luis Pérez Oyuela (Valle)</p>
     <p>Carlos Abraham Jimenez López (Valle)</p>
     <p>Jair Arango Torres (Vaupés)</p>
    </div>
   </div>
   <div class="clearfix colelem" id="ppu332"><!-- group -->
    <div class="clearfix grpelem" id="pu332"><!-- group -->
     <div class="clip_frame grpelem" id="u332"><!-- image -->
      <img class="block" id="u332_img" src="index_data/logo-verde.png" alt="" height="84" width="84">
     </div>
     <div class="clearfix grpelem" id="u349-6"><!-- content -->
      <p id="u349-2">Alianza Verde</p>
      <p>6 Representantes</p>
     </div>
    </div>
    <div class="clip_frame grpelem" id="u320"><!-- image -->
     <img class="block" id="u320_img" src="index_data/logo-centro-d.png" alt="" height="84" width="84">
    </div>
    <div class="clip_frame grpelem" id="u326"><!-- image -->
     <img class="block" id="u326_img" src="index_data/logo-o-ciudadna.png" alt="" height="84" width="84">
    </div>
    <div class="clearfix grpelem" id="u345-6"><!-- content -->
     <p id="u345-2">Centro Democrático</p>
     <p>12 Representantes</p>
    </div>
    <div class="clearfix grpelem" id="u351-6"><!-- content -->
     <p id="u351-2">Opción Ciudadana</p>
     <p>6 Representantes</p>
    </div>
    <div class="clip_frame grpelem" id="u328"><!-- image -->
     <img class="block" id="u328_img" src="index_data/logo-polo.png" alt="" height="84" width="84">
    </div>
    <div class="clearfix grpelem" id="u350-6"><!-- content -->
     <p id="u350-2">Polo</p>
     <p>3 Representantes</p>
    </div>
   </div>
   <div class="clearfix colelem" id="pu363-27"><!-- group -->
    <div class="clearfix grpelem" id="u363-27"><!-- content -->
     <p>María Fernanda Cabal Molina (Bogotá)</p>
     <p>Esperanza María Pinzón de J. (Bogotá)</p>
     <p>Tatiana Cabello Flórez (Bogotá)</p>
     <p>Edward David Rodríguez R.&nbsp; (Bogotá)</p>
     <p>Samuel Alejandro Hoyos Mejía (Bogotá)</p>
     <p>Ciro Alejandro Ramirez Cortés (Boyacá)</p>
     <p>Hugo Hernán Gonzales Medina (Caldas)</p>
     <p>Rubén Darío Molano P. (Cundinamarca)</p>
     <p>Álvaro Hernán Prada Artunduaga (Huila)</p>
     <p>Johana Chaves García (Santander)</p>
     <p>Pierre Eugenio García Jacquier (Tolima)</p>
     <p>Carlos Alberto Cuero Valencia (Valle)</p>
     <p>&nbsp;</p>
    </div>
    <div class="clearfix grpelem" id="ppu364-14"><!-- column -->
     <div class="clearfix colelem" id="pu364-14"><!-- group -->
      <div class="clearfix grpelem" id="u364-14"><!-- content -->
       <p>Angélica Lisbeth lozano Correa (Bogotá)</p>
       <p>Ángela María Robledo Gómez (Bogotá)</p>
       <p>Inti Raul Asprilla Reyes (Bogotá)</p>
       <p>Sandra Liliana Ortiz Nova (Boyacá)</p>
       <p>Oscar Ospina Quintero (Cauca)</p>
       <p>Ana Cristina Paz Cardona (Valle)</p>
      </div>
      <div class="clearfix grpelem" id="u365-14"><!-- content -->
       <p>Rafael Elizalde Gómez (Amazonas)</p>
       <p>Fernando de la Peña Márquez (Cesar)</p>
       <p>Franklin del Cristo Lozano. (Magdalena)</p>
       <p>Bayardo Gilberto Betancourt P. (Nariño)</p>
       <p>Ricardo Flórez Rueda (Santander)</p>
       <p>María Eugenia Triana Vargas (Santander)</p>
      </div>
     </div>
     <div class="clearfix colelem" id="u373-24"><!-- content -->
      <p id="u373-2">OTROS REPRESENTANTES</p>
      <p id="u373-3">&nbsp;</p>
      <p id="u373-5">POR UN HUILA MEJOR</p>
      <p id="u373-7">Flora Perdomo Andrade (Huila)</p>
      <p id="u373-8">&nbsp;</p>
      <p id="u373-10">MOVIMIENTO AUTORIDADES INDIGENAS DE COLOMBIA</p>
      <p id="u373-12">Antenor Durán Carrillo (La Guajira)</p>
      <p id="u373-13">&nbsp;</p>
      <p id="u373-15">PARTIDO ALIANZA SOCIAL INDEPENDIENTE</p>
      <p id="u373-17">Edgar Alexander Cipriano Moreno&nbsp; (Guainía)</p>
      <p id="u373-18">&nbsp;</p>
      <p id="u373-20">MOVIMIENTO DE INTEGRACIÓN REGIONAL</p>
      <p id="u373-22">Julio Eugenio gallardo Archbold (La Guajira)</p>
     </div>
    </div>
    <div class="clearfix grpelem" id="pu366-10"><!-- column -->
     <div class="clearfix colelem" id="u366-10"><!-- content -->
      <p>Rodrigo de Jesús Saldarriaga (Antioquia)</p>
      <p>Carlos Germán Navas Talero (Bogotá)</p>
      <p>Alirio Uribe Muñoz (Bogotá)</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
     </div>
     <div class="clearfix colelem" id="pu367"><!-- group -->
      <div class="clip_frame grpelem" id="u367"><!-- image -->
       <img class="block" id="u367_img" src="index_data/logo-mira.png" alt="" height="84" width="84">
      </div>
      <div class="clearfix grpelem" id="u374-6"><!-- content -->
       <p id="u374-2">Partido Mira</p>
       <p>3 Representantes</p>
      </div>
     </div>
     <div class="clearfix colelem" id="u372-9"><!-- content -->
      <p>Carlos Eduardo Guevara Villabon (Bogotá)</p>
      <p>Guillermina Bravo Montaño (Valle)</p>
      <p>Ana Paola Agudelo García (Consulados)</p>
      <p>&nbsp;</p>
     </div>
    </div>
   </div>
   <div style="min-height: 1px;" class="verticalspacer"></div>
  </div>
 <?php }if($tipo==13){?>
<style>
.bg1 {  
	position:relative;
	top:650px;
}
</style>  
 <div class="clip_frame colelem" id="u789"><!-- image -->
    <img class="block" id="u789_img" src="index_data/camaras4.jpg" alt="" height="500" width="899">
   </div>
   <div class="clearfix colelem" id="u240-4"><!-- content -->
    <p>Resultados parciales con el 98,40% de las mesas escrutadas.</p>
   </div>
  
<?php }?>
</div></div>
</header>	
</div>
<?php require_once('bottom.php'); ?>		