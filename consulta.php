<html>
<head>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type'text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-5065678-1");
pageTracker._trackPageview();
} catch(err) {}</script>
<script>
function gup( name ){
	var regexS = "[\\?&]"+name+"=([^&#]*)";
	var regex = new RegExp ( regexS );
	var tmpURL = window.location.href;
	var results = regex.exec( tmpURL );
	if( results == null )
		return"";
	else
		return results[1];
}
var cedula = gup( 'nCedula' );
document.write ("<frameset><frame name=\"intermedio\" target=\"inferior\" scrolling=\"auto\" marginwidth=\"0\" marginheight=\"0\" src=\"http://www3.registraduria.gov.co/censo/_censoresultado.php?nCedula="+cedula+"\"><noframes><body>");
document.write ("<p>Esta página utiliza marcos, pero su explorador no los admite.</p></body></noframes></frameset>");
</script>
</head>
<noscript>
<frameset rows="*,*">
	<frame name="intermedio" target="inferior" scrolling="auto" marginwidth="0" marginheight="0" src="http://www3.registraduria.gov.co/censo/_censoresultado.php">
	<noframes>
	<body>
	<p>Esta página utiliza marcos, pero su explorador no los admite.</p>
	</body>
	</noframes>
</frameset>
</noscript>
</html>