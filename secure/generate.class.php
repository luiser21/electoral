<?php

  /***
   * Genera contrasenias seguras(minusculas o maysuculas, simbolos y numeros de forma aleatoria; para esto se usan los siguientes tokens
   * <ul>
   *   <li>$: letras(minusculas, mayusculas)
   *   <li>#: numeros
   *   <li>&: simbolos
   * </ul>
   * @author Wilson garay
   * @version 1.0.0
   */

     	  /**Letras minusculas y mayusculas de la contrasenia*/
  	  define(LETTERS, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" );

  	  /**Numeros de la contrasenia*/
  	  define(NUMBERS, "0123456789" );

  	  /**Numeros de los simbolos*/
  	  define(SYMBOLS, "&#.:" );

  	  /**numero minimo de caracteres en la contrasenia*/
  	  define(MINIMUM,8);

  	  /**Patron para generar la contrasenia*/
  	  define(DEFAULT_PATTERN, "$$$#&#$$$" );

  class Generate {

  	  /**Patron por defecto para la contrasenia*/
  	  private $pattern = DEFAULT_PATTERN;

  	  function generateSerial($size){
            $limit = ($size<=8)?8:$size;
            $key = "";
            $num = 0;
            for($ind=0;$ind<$limit;$ind++){
              $num = rand(1,10);
              if($num%2 == 0){
                $key = $key . "$";
              }else if( $num%3 == 0){
                $key = $key . "#";
              }else{
                $key = $key . "&";
              }
            }
            return $key;
          }
        

  	  /**
  	   * Constructor
  	   * @param $pattern patron para la contrasenia
  	   */
  	   /*
  	  function __construct($pattern){
  	  	$this->pattern = (($pattern == null) or (strlen($pattern)<=MINIMUM))?DEFAULT_PATTERN:$pattern;
  	  }//*/

  	  function __construct(){
          }

  	  /**
  	   * Destructor
  	   */
  	  function __destruct(){}

  	  /**
  	   * Genera la contrasenia de forma aleatoria, basado en el patron definido
  	   */
  	  function generate(){

  	  	$randPass = "";
  	  	$limit = strlen($this->pattern);
  	  	for($ind = 0; $ind<$limit; $ind++){
  	  		if($this->pattern[$ind]=='$'){
                 $randPass = $randPass . substr(LETTERS,rand(0,strlen(LETTERS)-1),1);
  	  		}else if($this->pattern[$ind]=='#'){
  	  			$randPass = $randPass . substr(NUMBERS,rand(0,strlen(NUMBERS)-1),1);
  	  		}else if($this->pattern[$ind]=='&'){
  	  			$randPass = $randPass . substr(SYMBOLS,rand(0,strlen(SYMBOLS)-1),1);
  	  		}
  	  	}
  	  	return $randPass;
  	  }


  	  
  	  
  }

?>
