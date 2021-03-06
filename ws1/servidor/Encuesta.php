<?php
require_once"AccesoDatos.php";
class Encuesta
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $idEnc;
	public $idPed;
	public $idCliente;
	public $valorProducto;
	public $valorAtencion;
	public $valorDemora;
	public $comentario;
  	//public $codFoto1

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	public function GetIdEncuesta()
	{
		return $this->idEnc;
	}
  	public function GetIdPedido()
	{
		return $this->idPed;
	}
	public function GetIdCliente()
	{
		return $this->idCliente;
	}
	public function GetValorProducto()
	{
		return $this->valorProducto;
	}
	public function GetValorAtencion()
	{
		return $this->valorAtencion;
	}
	public function GetValorDemora()
	{
		return $this->valorDemora;
	}
	public function GetComentario()
	{
		return $this->comentario;
	}

	/*public function getCodFoto1)
	{
		return $this->codFoto1
	}*/


	public function SetIdEncuesta($valor)
	{
		$this->idEnc = $valor;
	}
	public function SetIdPedido($valor)
	{
		$this->idPed = $valor;
	}
	public function SetIdCliente($valor)
	{
		$this->idCliente = $valor;
	}
	public function SetValorProducto($valor)
	{
		$this->valorProducto = $valor;
	}
	public function SetValorAtencion($valor)
	{
		$this->valorAtencion = $valor;
	}
	public function SetValorDemora($valor)
	{
		$this->valorDemora = $valor;
	}
	public function SetComentario($valor)
	{
		$this->comentario= $valor;
	}

	/*public function SetCodFoto1$valor)
	{
		$this->codFoto1= $valor;
	}*/
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL)
	{
		if($id != NULL){
			$obj = Encuesta::TraerUnaEncuesta($id);
			
			$this->idPed = $obj->idPed;
			$this->idCliente = $obj->idCliente;
			$this->valorProducto = $obj->valorProducto;
			$this->valorAtencion = $obj->valorAtencion;
			$this->valorDemora = $obj->valorDemora;
			$this->comentario = $obj->comentario;
			//$this->codFoto1= $obj->codFoto1
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->idEnc."-".$this->idCliente."-".$this->valorProducto."-".$this->valorAtencion."-".$this->valorDemora."-".$this->comentario;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnaEncuesta($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM encuestas WHERE idEnc=:idEnc");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaPersona(:id)");
		$consulta->bindValue(':idEnc', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$encuestaBuscada= $consulta->fetchObject('encuesta');
		return $encuestaBuscada;	
					
	}
	
	public static function TraerTodasLasEncuestas()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM encuestas ");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodasLasPersonas() ");
		$consulta->execute();			
		$arrEncuestas= $consulta->fetchAll(PDO::FETCH_CLASS, "encuesta");	
		return $arrEncuestas;
	}
	
	public static function BorrarEncuesta($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM encuestas WHERE idEnc=:idEnc");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarPersona(:id)");	
		$consulta->bindValue(':idEnc',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function Modificarencuesta($encuesta)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				UPDATE encuestas 
				SET idPed=:idPed,
				idCliente=:idCliente,
				valorProducto=:valorProducto,
				valorAtencion=:valorAtencion,
				valorDemora:valorDemora,
				comentario:comentario
				WHERE idEnc=:idEnc");
			$consulta->bindValue(':idEnc',$encuesta->idEnc, PDO::PARAM_INT);
			$consulta->bindValue(':idPed', $encuesta->idPed, PDO::PARAM_INT);
			$consulta->bindValue(':idCliente', $encuesta->idCliente, PDO::PARAM_INT);
			$consulta->bindValue(':valorProducto', $encuesta->valorProducto, PDO::PARAM_INT);
			$consulta->bindValue(':valorAtencion', $encuesta->valorAtencion, PDO::PARAM_INT);
			$consulta->bindValue(':valorDemora', $encuesta->valorDemora, PDO::PARAM_INT);
			$consulta->bindValue(':comentario', $encuesta->comentario, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function Insertarencuesta($encuesta)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into encuestas (idPed,idCliente,valorProducto,valorAtencion,valorDemora,comentario) values(:idPed,:idCliente,:valorProducto,:valorAtencion,:valorDemora,:comentario)");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL Insertarencuesta (:nombre,:nombre,:dni,:foto1,:foto1,:foto1,:codFoto1");
		$consulta->bindValue(':idPed', $encuesta->idPed, PDO::PARAM_INT);
		$consulta->bindValue(':idCliente', $encuesta->idCliente, PDO::PARAM_INT);
		$consulta->bindValue(':valorProducto', $encuesta->valorProducto, PDO::PARAM_INT);
		$consulta->bindValue(':valorAtencion', $encuesta->valorAtencion, PDO::PARAM_INT);
		$consulta->bindValue(':valorDemora', $encuesta->valorDemora, PDO::PARAM_INT);
		$consulta->bindValue(':comentario', $encuesta->comentario, PDO::PARAM_STR);
		//$consulta->bindValue(':codFoto1, $encuesta->codFoto1 PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}	
//--------------------------------------------------------------------------------//


}
