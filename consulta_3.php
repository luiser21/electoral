<html>
<head>
<script>
function esVacio(valor){
	if(valor==null){return true;}
	for(var i=0;i<valor.length;i++) {
		if ((valor.charAt(i)!=' ')&&(valor.charAt(i)!="\t")&&(valor.charAt(i)!="\n")&&(valor.charAt(i)!="\r")){return false;}
	}
	return true;
}
function esNumero(val) {
	for(var i=0;i<val.length;i++){
		if(!esDigito(val.charAt(i))){return false;}
		}
	return true;
	}

function esDigito(num) {
	if (num.length>1){return false;}
	var string="1234567890";
	if (string.indexOf(num)!=-1){return true;}
	return false;
	}

var cedula = window.parent.document.getElementById('cedula').value;	
if(esVacio(cedula)){
	alert("Debe ingresar la cedula.\nPor favor validar");
	parent.$.fn.colorbox.close(); 
}
if(!esNumero(cedula)){	
	alert("La cedula debe ser numerica.\nPor favor validar");
	parent.$.fn.colorbox.close(); 
}
document.write ("<frameset><frame name=\"intermedio\" target=\"inferior\" scrolling=\"auto\" marginwidth=\"0\" marginheight=\"0\" src=\"http://www3.registraduria.gov.co/censo/_censoresultado.php?nCedula="+cedula+"\"><noframes><body>");
</script>
</head>
<noscript>
<frameset rows="*,*">
	<frame name="intermedio" target="inferior" scrolling="auto" marginwidth="0" marginheight="0" src="http://www3.registraduria.gov.co/censo/_censoresultado.php">
	<noframes>
	</noframes>
<frame src="UntitledFrame-2"></frameset>
</noscript>
</html>