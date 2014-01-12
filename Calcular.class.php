<?php 
abstract class Operaciones{
	private $promedio=0;
	public $suma=0;
	abstract protected function CalcularSuma();
	abstract protected function CalcularPromedio();
	public function getSuma(){ return $this->suma();}
	function getPromedio(){ return $this->promedio;}
}
class Calcular extends Operaciones{
	public function CalcularSuma(){ return $this->getSuma();}
	public function CalcularPromedio(){ return $this->getPromedio();}
	function Resultado(){
		return "Promedio:".$this->CalcularPromedio().",Suma:".$this->suma;
	}
	protected function ImprimirResultados(){
		return "Promedio:".$this->CalcularPromedio().",Suma:".$this->CalcularSuma();
	}
}
$_clase=new Calcular;
//$_respuesta=$_clase->CalcularSuma();
echo $_respuesta=$_clase->CalcularPromedio();
echo '<br/>';
//$_respuesta=$_clase->ImprimirResultados();
echo $_respuesta=$_clase->Resultado();
?>