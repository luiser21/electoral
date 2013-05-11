<?php

  /**
   * Implementa el calculo de los algoritmos de hash SHA1 y MD5, el proposito de esta clase es
   * centralizar los procesos de cifrado
   * 
   * @author Wilson Garay
   * @version 1.0.0
   */
  class Hash {
  	
     /**Instancia del objecto*/
     private static $inst;

     /**Constructor*/
     private function __construct(){
     }

     /**
      Singleton del objeto
     */
     public static function getInstance(){
       if(!self::$inst){
         self::$inst = new self();
       }
       return self::$inst;
     }
       	
  	/**
     * Calcula el md5 del texto enviado por parametro
  	 * @param $text texto ha evaluar
  	 * @return hash MD5 del texto
  	 */
  	public static function calcMD5($text){
  		return md5($text);
  	}

  	/**
     * Calcula el sha1 del texto enviado por parametro
  	 * @param $text texto ha evaluar
  	 * @return hash SHA del texto
  	 */  	
  	public static function calcSHA($text){
  	    return sha1($text);
  	}
  	
  }

?>
