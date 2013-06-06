<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">


<style type="text/css">

/*Credits: CSSplay */
/*URL: http://www.cssplay.co.uk/menus/pro_drop2 */
.preload2 {background: url(images/button4.gif);}
.menu2 {padding:0 0 0 32px; margin-left:194px; list-style:none; height:40px; background:#fff url(images/button1a.gif) repeat-x; position:relative; font-family:arial, verdana, sans-serif; width: 929px; }
.menu2 li.top {display:block; float:left; position:relative;}
.menu2 li a.top_link {display:block; float:left; height:40px; line-height:33px; color:#bbb; text-decoration:none; font-size:11px; font-weight:bold; padding:0 0 0 12px; cursor:pointer;}
.menu2 li a.top_link span {float:left; display:block; padding:0 24px 0 12px; height:40px;}
.menu2 li a.top_link span.down {float:left; display:block; padding:0 24px 0 12px; height:40px; background:url(images/down.gif) no-repeat right top;}
.menu2 li a.top_link:hover {color:#fff; background: url(images/button4.gif) no-repeat;}
.menu2 li a.top_link:hover span {background:url(images/button4.gif) no-repeat right top;}
.menu2 li a.top_link:hover span.down {background:url(images/button4a.gif) no-repeat right top;}

.menu2 li:hover > a.top_link {color:#fff; background: url(images/button4.gif) no-repeat;}
.menu2 li:hover > a.top_link span {background:url(images/button4.gif) no-repeat right top;}
.menu2 li:hover > a.top_link span.down {background:url(images/button4a.gif) no-repeat right top;}


.menu2 table {border-collapse:collapse; width:0; height:0; position:absolute; top:0; left:0;}

/* Default link styling */

/* Style the list OR link hover. Depends on which browser is used */

.menu2 a:hover {visibility:visible;}
.menu2 li:hover {position:relative; z-index:200;}

/* keep the 'next' level invisible by placing it off screen. */
.menu2 ul, 
.menu2 :hover ul ul, 
.menu2 :hover ul :hover ul ul,
.menu2 :hover ul :hover ul :hover ul ul,
.menu2 :hover ul :hover ul :hover ul :hover ul ul {position:absolute; left:-9999px; top:-9999px; width:0; height:0; margin:0; padding:0; list-style:none;}

.menu2 :hover ul.sub {left:2px; top:40px; background: #fff; padding:3px 0; border:1px solid #4ab; white-space:nowrap; width:auto; height:auto;}

.menu2 :hover ul.sub li {display:block; height:20px; position:relative; float:left; width:auto;}

.menu2 :hover ul.sub li a {display:block; font-size:11px; height:20px; width:180px; line-height:20px; text-indent:5px; color:#000; text-decoration:none; border:3px solid #fff; border-width:0 0 0 3px;}

.menu2 :hover ul.sub li a.fly {background:#fff url(images/arrow.gif) 80px 7px no-repeat; }

.menu2 :hover ul.sub li a:hover {background:#4ab;}

.menu2 :hover ul.sub li a.fly:hover {background:#4ab url(images/arrow_over.gif) 80px 7px no-repeat; color:#fff;}
.menu2 :hover ul li:hover > a.fly {background:#4ab url(images/arrow_over.gif) 80px 7px no-repeat; color:#fff;} 

.menu2 :hover ul :hover ul,
.menu2 :hover ul :hover ul :hover ul,
.menu2 :hover ul :hover ul :hover ul :hover ul,
.menu2 :hover ul :hover ul :hover ul :hover ul :hover ul
{left:90px; top:-4px; background: #fff; padding:3px 0; border:1px solid #4ab; white-space:nowrap; width:auto; z-index:200; height:auto;}

</style>
<span class="preload2"></span>

<ul class="menu2">
	<li class="top"><a href="adetom.php" id="home" class="top_link"><span>Inicio</span></a></li>
	<li class="top"><a href="#" id="products" class="top_link"><span class="down">Conformaci&oacute;n Senado</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class="sub">
			<li style="color: #000000;  font-size: 11px;"><a href="#" >Senado Actual<!--[if gte IE 7]><!--></a><!--<![endif]--></li>
			<li style="color: #000000;  font-size: 11px;"><a href="#" >Proyectos de Ley Tramitados<!--[if gte IE 7]><!--></a><!--<![endif]--></li>
			<li style="color: #000000;  font-size: 11px;"><a href="#" >Sillas Vacias<!--[if gte IE 7]><!--></a><!--<![endif]--></li>
			<li style="color: #000000;  font-size: 11px;"><a href="#" >Ausencias<!--[if gte IE 7]><!--></a><!--<![endif]--></li>
					<!--[if lte IE 6]><table><tr><td><![endif]-->
				<!--	<ul style="color: #000000;  font-size: 11px;">
						<li style="color: #000000;  font-size: 11px;"><a href="#">Proyectos de Ley Tramitados</a></li>
						<li style="color: #000000;  font-size: 11px;"><a href="#">Sillas Vacias</a></li>
						<li style="color: #000000;  font-size: 11px;"><a href="../opacity/">Ausencias</a></li>
					</ul>
					<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			
		<!--	<li class="mid" ><a href="../boxes/" class="fly">Lenses<!--[if gte IE 7]><!--><!--</a><!--<![endif]-->
					<!--[if lte IE 6]><table><tr><td><![endif]-->
		<!--			<ul >
						<li style="color: #000000;  font-size: 11px;"><a href="../mozilla/">Wide Angle</a></li>
						<li style="color: #000000;  font-size: 11px;"><a href="../ie/">Standard</a></li>
						<li style="color: #000000;  font-size: 11px;"><a href="../opacity/">Telephoto</a></li>
						<li style="color: #000000;  font-size: 11px;"><a href="../menu/" class="fly">Zoom<!--[if gte IE 7]><!--><!--</a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
			<!--				<ul>
								<li style="color: #000000;  font-size: 11px;"><a href="../mozilla/">35mm to 125mm</a></li>
								<li style="color: #000000;  font-size: 11px;"><a href="../opacity/">50mm to 250mm</a></li>
								<li style="color: #000000;  font-size: 11px;"><a href="../menu/">125mm to 500mm</a></li>
							</ul>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			<!--			</li>
						<li style="color: #000000;  font-size: 11px;"><a href="../boxes/">Mirror</a></li>
						<li style="color: #000000;  font-size: 11px;"><a href="../opacity/" class="fly">Non standard<!--[if gte IE 7]><!--><!--</a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
			<!--				<ul>
								<li style="color: #000000;  font-size: 11px;"><a href="../mozilla/">Bayonet mount</a></li>
								<li style="color: #000000;  font-size: 11px;"><a href="../opacity/">Screw mount</a></li>
							</ul>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			<!--			</li>
					</ul>
					<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			<!--</li> 
			<li style="color: #000000;  font-size: 11px;"><a href="../mozilla/">Flash Guns</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="../ie/">Tripods</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="../opacity/">Filters</a></li>-->
		</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li class="top"><a href="#" id="services" class="top_link"><span class="down">Marco Legal</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class="sub">
			<li style="color: #000000;  font-size: 11px;"><a href="#">Constituci&oacute;n</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="#">Ley de Vancadas</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="#">Codigo Disciplinario</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="#">Causales Perdida Investidura</a></li>
		</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li class="top"><a href="#" id="contacts" class="top_link"><span class="down">Elecciones 2010</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class="sub">
			<li style="color: #000000;  font-size: 11px;"><a href="#">Candidatos al Senado</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="#">Votos por Partido al Senado</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="#">Votos por Partido a la Camara</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="#">Puesto Votacion Pareto Candidato</a></li>
			<!-- <li style="color: #000000;  font-size: 11px;"><a href="#" class="fly">Sales<!--[if gte IE 7]><!--></a><!--<![endif]-->
				<!--[if lte IE 6]><table><tr><td><![endif]-->
				<!-- <ul>
					<li style="color: #000000;  font-size: 11px;"><a href="../mozilla/">USA</a></li>
					<!-- <li style="color: #000000;  font-size: 11px;"><a href="../ie/">Canadian</a></li>
					<li style="color: #000000;  font-size: 11px;"><a href="../opacity/">South American</a></li>
					<li style="color: #000000;  font-size: 11px;"><a href="../menu/" class="fly">European<!--[if IE 7]><!--></a><!--<![endif]-->
						<!--[if lte IE 6]><table><tr><td><![endif]-->
						<!-- <ul>
							<li style="color: #000000;  font-size: 11px;"><a href="../mozilla/" class="fly">British<!--[if gte IE 7]><!--><!--</a><!--<![endif]-->
								<!--[if lte IE 6]><table><tr><td><![endif]-->
							<!--	<ul>
									<li style="color: #000000;  font-size: 11px;"><a href="../ie/">London</a></li>
									<li style="color: #000000;  font-size: 11px;"><a href="../menu/">Liverpool</a></li>
									<li style="color: #000000;  font-size: 11px;"><a href="../boxes/">Glasgow</a></li>
									<li style="color: #000000;  font-size: 11px;"><a href="../opacity/" class="fly">Bristol<!--[if gte IE 7]><!--><!--</a><!--<![endif]-->
										<!--[if lte IE 6]><table><tr><td><![endif]-->
									<!--	<ul>
											<li style="color: #000000;  font-size: 11px;"><a href="../ie/">Redland</a></li>
											<li style="color: #000000;  font-size: 11px;"><a href="../opacity/">Hanham</a></li>
											<li style="color: #000000;  font-size: 11px;"><a href="../menu/">Eastville</a></li>
										</ul>
										<!--[if lte IE 6]></td></tr></table></a><![endif]-->
								<!-- </li>
									<li style="color: #000000;  font-size: 11px;"><a href="../layouts/">Cardiff</a></li>
									<li style="color: #000000;  font-size: 11px;"><a href="../mozilla/">Belfast</a></li>-->
							<!--	</ul>
								<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						<!--	</li>
							<li style="color: #000000;  font-size: 11px;"><a href="../opacity/">French</a></li>
							<li style="color: #000000;  font-size: 11px;"><a href="../menu/">German</a></li>
							<li style="color: #000000;  font-size: 11px;"><a href="../boxes/">Spanish</a></li>
						</ul>
						<!--[if lte IE 6]></td></tr></table></a><![endif]-->
				<!--</li>
					<!-- <li style="color: #000000;  font-size: 11px;"><a href="../boxes/">Australian</a></li>
					<li style="color: #000000;  font-size: 11px;"><a href="../boxes/">Asian</a></li> -->
			<!--	</ul>
				<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		<!--	</li>
		<!--	<li style="color: #000000;  font-size: 11px;"><a href="../mozilla/">Buying</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="../ie/">Photographers</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="../opacity/">Stockist</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="../menu/">General</a></li> -->
	</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li class="top"><a href="#" id="shop" class="top_link"><span class="down">Administraci&oacute;n</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class="sub">
			<li style="color: #000000;  font-size: 11px;"><a href="#" class="fly">Personal</a>
				<ul>
					<li style="color: #000000;  font-size: 11px;"><a href="#">Asesores</a></li>
					<li style="color: #000000;  font-size: 11px;"><a href="#">Coordinador</a></li>
					<li style="color: #000000;  font-size: 11px;"><a href="#">Lideres</a></li>
					<li style="color: #000000;  font-size: 11px;"><a href="#">Simpatizantes</a></li>
				</ul>
			</li>
			<li style="color: #000000;  font-size: 11px;"><a href="#">Finanzas</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="#">Mercadeo</a></li>
			<li style="color: #000000;  font-size: 11px;"><a href="#">Proyecci&oacute; Estadistica</a></li>
			
		
			
		</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li class="top"><a href="#" id="privacy" class="top_link"><span>Privacy Policy</span></a></li>
</ul>
