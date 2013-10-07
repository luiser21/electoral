<html>
    <head><title>Prueba</title></head>
    <body>
<?php
    $host="127.0.0.1";
    $port="5432";
    $user="postgres";
    $pass="301-mami";
    $dbname="fantaxias";
// echo extension_loaded('pgsql') ? 'yes':'no'; 

   // $connect = @pg_connect("host=$host port=$port user=$user pass=$pass dbname=$dbname");

   // if(!$connect)
     //   echo "<p><i>No me conecte</i></p>";
    //else
      //  echo "<p><i>Me conecte</i></p>";

//    pg_close($connect);
	
	error_reporting(E_ALL | E_STRICT);

echo "connecting...<br>";        
echo 'php.ini: ', get_cfg_var('cfg_file_path')," <br/> ";
echo extension_loaded('pgsql') ? 'yes':'no'," <br/> ";
$pg = pg_connect("host=localhost user=postgres
        password=xx dbname=xx")
or die("Can't connect to database.");

echo "connected<br>";        
?>
?>
    </body>
</html>
