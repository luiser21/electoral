<?php require_once('top.php');?>

<style>
.bg1 {
	position:relative;
	top:950px;
}

/* Container principal */
.casos-exito-container {
	position: absolute;
	top: 190px;
	width: 100%;
	padding: 20px 0;
}

.casos-exito-content {
	max-width: 960px;
	margin: 0 auto;
	background: linear-gradient(to bottom, #ffffff 0%, #f5f5f5 100%);
	padding: 50px;
	box-shadow: 0 5px 25px rgba(0,0,0,0.15);
	border-radius: 15px;
}

/* Header */
.casos-header {
	text-align: center;
	margin-bottom: 50px;
	padding-bottom: 30px;
	border-bottom: 4px solid #5f870e;
	position: relative;
}

.casos-header::after {
	content: '';
	position: absolute;
	bottom: -4px;
	left: 50%;
	transform: translateX(-50%);
	width: 100px;
	height: 4px;
	background: #fff;
}

.casos-header h1 {
	color: #5f870e;
	font-size: 42px;
	font-weight: bold;
	margin-bottom: 15px;
	text-transform: uppercase;
	letter-spacing: 3px;
	text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.casos-header h2 {
	color: #666;
	font-size: 26px;
	font-weight: 300;
	margin-top: 15px;
}

/* Banner imagen */
.imagen-destacada {
	text-align: center;
	margin: 40px 0;
	padding: 20px;
	background: white;
	border-radius: 10px;
	box-shadow: 0 3px 15px rgba(0,0,0,0.1);
}

.imagen-destacada img {
	max-width: 100%;
	height: auto;
	border-radius: 8px;
	transition: transform 0.3s ease;
}

.imagen-destacada:hover img {
	transform: scale(1.02);
}

/* Sección de contenido */
.contenido-exito {
	background: white;
	padding: 40px;
	border-radius: 10px;
	margin: 30px 0;
	box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.contenido-exito img {
	max-width: 100%;
	height: auto;
	border-radius: 8px;
	box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Decoración */
.decoracion {
	text-align: center;
	margin: 30px 0;
	color: #5f870e;
	font-size: 24px;
}

/* Responsive */
@media screen and (max-width: 768px) {
	.casos-exito-content {
		padding: 30px 20px;
	}

	.casos-header h1 {
		font-size: 32px;
	}

	.casos-header h2 {
		font-size: 20px;
	}

	.contenido-exito {
		padding: 20px;
	}
}
</style>

<div class="main">
	<div class="casos-exito-container">
		<div class="casos-exito-content">
			<!-- Header -->
			<div class="casos-header">
				<h1>Casos de Éxito</h1>
				<h2>Elecciones 30 de Octubre de 2010</h2>
			</div>

			<!-- Imagen destacada principal -->
			<div class="imagen-destacada">
				<img src="images/header2.jpg" alt="Elecciones 2010">
			</div>

			<div class="decoracion">✦ ✦ ✦</div>

			<!-- Contenido principal -->
			<div class="contenido-exito">
				<img src="images/exito.png" alt="Casos de Éxito Electoral">
			</div>
		</div>
	</div>
</div>

<?php require_once('bottom.php'); ?>
