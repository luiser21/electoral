<body>
<form method=post action="Excel/example_doc.php" enctype="multipart/form-data"> 
<table width="724" border="1">
  <tr>
    <th width="350" scope="row" style="font-size: 8px; color: #333333;line-height: 7px;padding-left: 152px;
    text-align: left; "><img style="position:absolute;margin-left: 164px;" src="images/Excel-icon.png" width="37" height="45" />
     CEDULA_LIDER<br/>NOMBRES_APELLIDO_LIDER<br/>CEDULA<br/>NOMBRES_APELLIDOS<br/>OCUPACION<br/>CELULAR
	 <br/>EMAIL<br/>DIRECCION<p>MUNICIPIO<br/>DEPARTAMENTO<br/>CANDIDATO</th>
    <td width="358">
      <label>
        <input type="file" name="file" size="50" />
		<button type=button name="Submit" onclick="upload(this.form, this.form.file.value)">Subir_Archivo</button>
        </label>
    </td>
  </tr>
</table>
</form> 
</body>

