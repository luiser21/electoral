<body> 
<table width="724" border="1">
  <tr>
    <th width="350" scope="row" style="font-size: 8px; color: #333333;line-height: 7px;padding-left: 152px;
    text-align: left; "><img style="position:absolute;margin-left: 164px;" src="images/Excel-icon.png" width="37" height="45" />
     CEDULA_LIDER<br/>NOMBRES_APELLIDO_LIDER<br/>CEDULA<br/>NOMBRES_APELLIDOS<br/>OCUPACION<br/>CELULAR
	 <br/>EMAIL<br/>DIRECCION<p>MUNICIPIO<br/>DEPARTAMENTO<br/>CANDIDATO</th>
    <td width="358">
   <form method=post action="Excel/example_doc.php" enctype="multipart/form-data">
<input type=file name="archivoupload">
<input type=button name="Submit" value="Enviar" onclick="comprueba_extension(this.form, this.form.archivoupload.value)">
</form> <br />
    </td>
  </tr>
</table>
</body>