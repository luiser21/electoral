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
     <p id="u341-4">a la C�mara</p>
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
     <p>John Jairo Rold�n Avenda�o (Antioquia)</p>
     <p>Juli�n Bedoya Pulgarin (Antioquia)</p>
     <p>Oscar de Jesus Hurtado P�rez (Antioquia)</p>
     <p>Pedro Jes�s Orjuela G�mez (Arauca)</p>
     <p>Mauricio G�mez Amin (Atl�ntico)</p>
     <p>Olga Luc�a Vel�squez (Bogot�)</p>
     <p>Clara Leticia Rojas (Bogot�)</p>
     <p>Juan Carlos Lozada (Bogot�)</p>
     <p>Silvio Jos� Carrasquilla (Bol�var)</p>
     <p>Rafael Romero (Boyac�)</p>
     <p>Mario Alberto Casta�o (Caldas)</p>
     <p>Harry Giovanny Gonz�lez (Caquet�)</p>
     <p>Jorge Camilo Abril Tarache (Casanare)</p>
     <p>Carlos Julio Bonilla (Cauca)</p>
     <p>Crisanto Pizo Mazabuel (Cauca)</p>
     <p>Nilton C�rdoba (Choc�)</p>
     <p>Fabio Ra�l Amin (C�rdoba)</p>
     <p>�scar Hern�n S�nchez (Cundinamarca)</p>
     <p>Leopoldo Su�rez (Guaviare)</p>
     <p>Jaime Enrique Serrano (Magdalena)</p>
     <p>Kelyn Johana Gonz�lez (Magdalena)</p>
     <p>�ngelo Antonio Villamil (Meta) Votos:</p>
     <p>Neftali Correa D�az (Nari�o) Votos:</p>
     <p>Alejandro Carlos Chac�n (N. Santander)</p>
     <p>Jose Neftali Santos (Norte de Santander)</p>
     <p>Argenis Vel�squez (Putumuyo)</p>
     <p>Luciano Grisales Londo�o (Quind�o)</p>
     <p>Diego Pati�o Amariles (Risaralda)</p>
     <p>Jack Housni Jaller (San Andr�s)</p>
     <p>Edgar Alfnso G�mez (Santander)</p>
     <p>Miguel �ngel Pinto (Santander)</p>
     <p>�ngel Mar�a Gait�n (Tolima)</p>
     <p>Fabio Alonso Arroyave (Valle)</p>
     <p>Nancy Denise Castillo&nbsp; (Valle)</p>
     <p>Juan Fernando Reyes (Valle)</p>
     <p>norbey marulanda mu�oz (Vaup�s)</p>
     <p>Marco Sergio Rodr�guez (Vichada)</p>
    </div>
    <div class="clearfix grpelem" id="u360-78"><!-- content -->
     <p id="u360-2">Juan Felipe Lemos (Antioquia)</p>
     <p id="u360-4">Le�n Dar�o Ram�rez (Antioquia)</p>
     <p id="u360-6">Albeiro Vanegas Osorio (Arauca)</p>
     <p id="u360-8">Martha Patricia Villalba (Atl�ntico)</p>
     <p id="u360-10">Eduardo Alfonso Crissien (Atl�ntico)</p>
     <p id="u360-12">Carlos Arturo Correa (Bogot�)</p>
     <p id="u360-14">Efra�n Antonio Torres (Bogot�)</p>
     <p id="u360-16">Marta Cecilia Curiosorio (Bol�var)</p>
     <p id="u360-18">Alonso Jose del R�o Cabarcas (Bol�var)</p>
     <p id="u360-20">Jairo Enrique Castiblanco (Boyac�)</p>
     <p id="u360-22">Crist�bal Rodr�guez (Boyac�)</p>
     <p id="u360-24">Luz Adriana Moreno (Caldas)</p>
     <p id="u360-26">Hern�n Penagos Giraldo (Caldas)</p>
     <p id="u360-28">John Jairo C�rdenas (Cauca)</p>
     <p id="u360-30">Christian Jos� Moreno (Cesar)</p>
     <p id="u360-32">Jos� Bernardo Fl�rez (Choc�)</p>
     <p id="u360-34">Sara Elena Piedrahita (C�rdoba)</p>
     <p id="u360-36">Eduardo Jos� Tous (C�rdoba)</p>
     <p id="u360-38">Raymundo El�as M�ndez (C�rdoba)</p>
     <p id="u360-40">Jos� Edilberto Caicedo (Cundinamarca)</p>
     <p id="u360-42">Alfredo Guillermo Molina (Cundinamarca)</p>
     <p id="u360-44">Alexander Garc�a (Guaviare)</p>
     <p id="u360-46">Ana mar�a Rinc�n (Huila)</p>
     <p id="u360-48">Alfredo Rafael Deluque (La Guajira)</p>
     <p id="u360-50">Eduardo Agat�n D�az (Magdalena)</p>
     <p id="u360-52">Elda Lucy Contento (Meta)</p>
     <p id="u360-54">Berner Le�n Zambrano (Nari�o)</p>
     <p id="u360-56">Wilmer Ramiro Carrillo (N. Santander)</p>
     <p id="u360-58">Didier Burgos (Risaralda)</p>
     <p id="u360-60">Nicol�s Daniel Guerrero (Sucre)</p>
     <p id="u360-62">Carlos Edward Osorio (Tolima)</p>
     <p id="u360-64">Jaime Armando Yepes (Tolima)</p>
     <p id="u360-66">Elbert D�az (Valle)</p>
     <p id="u360-68">Jorge Eliecer Tamayo (Valle)</p>
     <p id="u360-70">Rafael Eduardo Palau (Valle)</p>
     <p id="u360-72">Nery Oros Ort�z (Vichada)</p>
     <p id="u360-74">Jaime Buenahora Febres (Consulado)</p>
     <p id="u360-75">&nbsp;</p>
     <p id="u360-76">&nbsp;</p>
    </div>
    <div class="clearfix grpelem" id="u361-57"><!-- content -->
     <p id="u361-2"><span id="u361">Germ�n Alcides Blanco (Antioquia)</span></p>
     <p id="u361-4">Luis Horacio Gall�n (Antioquia)</p>
     <p id="u361-6">Nicol�s Albeiro Echeverry (Antioquia)</p>
     <p id="u361-8">Aida Merlano rebolledo (Atl�ntico)</p>
     <p id="u361-10">In�s Cecilia L�pez (Atl�ntico)</p>
     <p id="u361-12">Armando Antonio Zabarain (Atl�ntico)</p>
     <p id="u361-14">Tel�sforo Pedraza (Bogot�)</p>
     <p id="u361-16">Pedrito Tom�s Pereira (Bol�var)</p>
     <p id="u361-18">Humphrey Roa Sarmiento (Boyac�)</p>
     <p id="u361-20">Arturo Yepes Alz�te (Caldas)</p>
     <p id="u361-22">Luis Fernando Urrego (Caquet�)</p>
     <p id="u361-24">Alfredo Ape Cuello (Cesar)</p>
     <p id="u361-26">David Alejandro Barguil (C�rdoba)</p>
     <p id="u361-28">Orlando Alfonso Clavijo (Cundinamarca)</p>
     <p id="u361-30">Jaime Felipe Lozada (Huila)</p>
     <p id="u361-32">Diela Liliana Benavides (Nari�o)</p>
     <p id="u361-34">Oscar Fernando Bravo (Nari�o)</p>
     <p id="u361-36">Ciro Antonio Rodr�guez (N. Santander)</p>
     <p id="u361-38">Juan Carlos Garc�a (N. Santander)</p>
     <p id="u361-40">Orlando An�bal Guerra (Putumayo)</p>
     <p id="u361-42">Mauricio Salazar Pelaez (Risaralda)</p>
     <p id="u361-44">Juan Carlos Rivera (Risaralda)</p>
     <p id="u361-46">Lina Mar�a Barrera (Santander)</p>
     <p id="u361-48">Jose Elver Hern�ndez (Tolima)</p>
     <p id="u361-50">Miguel �ngel Barreto (Tolima)</p>
     <p id="u361-52">�lvaro L�pez Gil (Valle)</p>
     <p id="u361-54">Heriberto Sanabria (Valle)</p>
     <p id="u361-55">&nbsp;</p>
    </div>
    <div class="clearfix grpelem" id="u362-34"><!-- content -->
     <p>Jose Ignacio Mesa Betancur (Antioquia)</p>
     <p>Luis Eduardo Diaz Granados T. (Atl�ntico)</p>
     <p>Rodrigo Lara Restrepo (Bogot�)</p>
     <p>Hernando Jose Padaui �lvarez (Bol�var)</p>
     <p>Karen Violette Cure Corcione (Bol�var)</p>
     <p>Eloy Chicho Quintero Romero&nbsp; (Cesar)</p>
     <p>Jos� Emilio Rey �ngel&nbsp; (Cundinamarca)</p>
     <p>Jorge Enrique Rozo R.&nbsp; (Cundinamarca)</p>
     <p>Carlos Alberto Cuenca Chaux (Guain�a)</p>
     <p>Fabian Gerardo Castillo S. (Magdalena)</p>
     <p>Atilano Alfonso Giraldo Arboleda&nbsp; (Quind�o)</p>
     <p>Jorge Ricardo Parra Sep�lveda (Quind�o)</p>
     <p>Ciro Fern�ndez N��ez (Santander)</p>
     <p>Jose Luis P�rez Oyuela (Valle)</p>
     <p>Carlos Abraham Jimenez L�pez (Valle)</p>
     <p>Jair Arango Torres (Vaup�s)</p>
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
     <p id="u345-2">Centro Democr�tico</p>
     <p>12 Representantes</p>
    </div>
    <div class="clearfix grpelem" id="u351-6"><!-- content -->
     <p id="u351-2">Opci�n Ciudadana</p>
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
     <p>Mar�a Fernanda Cabal Molina (Bogot�)</p>
     <p>Esperanza Mar�a Pinz�n de J. (Bogot�)</p>
     <p>Tatiana Cabello Fl�rez (Bogot�)</p>
     <p>Edward David Rodr�guez R.&nbsp; (Bogot�)</p>
     <p>Samuel Alejandro Hoyos Mej�a (Bogot�)</p>
     <p>Ciro Alejandro Ramirez Cort�s (Boyac�)</p>
     <p>Hugo Hern�n Gonzales Medina (Caldas)</p>
     <p>Rub�n Dar�o Molano P. (Cundinamarca)</p>
     <p>�lvaro Hern�n Prada Artunduaga (Huila)</p>
     <p>Johana Chaves Garc�a (Santander)</p>
     <p>Pierre Eugenio Garc�a Jacquier (Tolima)</p>
     <p>Carlos Alberto Cuero Valencia (Valle)</p>
     <p>&nbsp;</p>
    </div>
    <div class="clearfix grpelem" id="ppu364-14"><!-- column -->
     <div class="clearfix colelem" id="pu364-14"><!-- group -->
      <div class="clearfix grpelem" id="u364-14"><!-- content -->
       <p>Ang�lica Lisbeth lozano Correa (Bogot�)</p>
       <p>�ngela Mar�a Robledo G�mez (Bogot�)</p>
       <p>Inti Raul Asprilla Reyes (Bogot�)</p>
       <p>Sandra Liliana Ortiz Nova (Boyac�)</p>
       <p>Oscar Ospina Quintero (Cauca)</p>
       <p>Ana Cristina Paz Cardona (Valle)</p>
      </div>
      <div class="clearfix grpelem" id="u365-14"><!-- content -->
       <p>Rafael Elizalde G�mez (Amazonas)</p>
       <p>Fernando de la Pe�a M�rquez (Cesar)</p>
       <p>Franklin del Cristo Lozano. (Magdalena)</p>
       <p>Bayardo Gilberto Betancourt P. (Nari�o)</p>
       <p>Ricardo Fl�rez Rueda (Santander)</p>
       <p>Mar�a Eugenia Triana Vargas (Santander)</p>
      </div>
     </div>
     <div class="clearfix colelem" id="u373-24"><!-- content -->
      <p id="u373-2">OTROS REPRESENTANTES</p>
      <p id="u373-3">&nbsp;</p>
      <p id="u373-5">POR UN HUILA MEJOR</p>
      <p id="u373-7">Flora Perdomo Andrade (Huila)</p>
      <p id="u373-8">&nbsp;</p>
      <p id="u373-10">MOVIMIENTO AUTORIDADES INDIGENAS DE COLOMBIA</p>
      <p id="u373-12">Antenor Dur�n Carrillo (La Guajira)</p>
      <p id="u373-13">&nbsp;</p>
      <p id="u373-15">PARTIDO ALIANZA SOCIAL INDEPENDIENTE</p>
      <p id="u373-17">Edgar Alexander Cipriano Moreno&nbsp; (Guain�a)</p>
      <p id="u373-18">&nbsp;</p>
      <p id="u373-20">MOVIMIENTO DE INTEGRACI�N REGIONAL</p>
      <p id="u373-22">Julio Eugenio gallardo Archbold (La Guajira)</p>
     </div>
    </div>
    <div class="clearfix grpelem" id="pu366-10"><!-- column -->
     <div class="clearfix colelem" id="u366-10"><!-- content -->
      <p>Rodrigo de Jes�s Saldarriaga (Antioquia)</p>
      <p>Carlos Germ�n Navas Talero (Bogot�)</p>
      <p>Alirio Uribe Mu�oz (Bogot�)</p>
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
      <p>Carlos Eduardo Guevara Villabon (Bogot�)</p>
      <p>Guillermina Bravo Monta�o (Valle)</p>
      <p>Ana Paola Agudelo Garc�a (Consulados)</p>
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