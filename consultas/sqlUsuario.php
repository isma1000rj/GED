<?php
 require_once dirname(__FILE__).'/../util/conecta.php';
  
	class usuario{
		
	  var 	$resultado;
	  var   $registros;
	  var   $qtdRegistros;
	  var   $resultadosPorPagina;
	  var   $dataAtual;
	 	  
	   function usuario(){
		   
		   $this->conecta=new conexao();
		   $this->resultadosPorPagina=6;//Quantidade de registros por página
		   $this->dataAtual=date('d-m-Y');
	     }	
	function incluirUsuario($idPerfil,$nomeUsuario,$login,$senha){
			$senha=sha1(addslashes($senha));
			$sql="Insert into usuario (id_perfil,nome,login,senha) values('$idPerfil','$nomeUsuario','$login','$senha')";
		if(!$this->existeUsuarioCadastrado($nomeUsuario,$login)){
			if($this->resultado=$this->conecta->banco->Execute($sql)){
				  geraAlertaInformacao("<h3><BR>".getTranslateMsg("User successfully registered.")."<h3>","success","center","listarUsuario");
					$this->RegistrarAcao($_SESSION['idUsuario'],$nomeUsuario,$this->dataAtual,'current_time',getTranslateMsg("Registered User"));
					return 1;
				}else{ 
					geraAlertaInformacao("<h3><BR>".getTranslateMsg("Failed to register user.")."<h3>","error","center","listarUsuario");
				}
	     }else{
	     	        geraAlertaInformacao("<h3><BR>".getTranslateMsg("User already registered.")."<h3>","error","center","cadastrarUsuario");
	     	        return 0; // evita que remova a permissão de usuário já cadastrado
	        }//fim do if existeUsuarioCadastrad		      
			
		}//fim do function incluirusuario
		
		function listarUsuario($proximaPagina,$resultadosPorPagina){
			$sql="select * from usuario as u,perfil_usuario as pu
					where u.id_perfil=pu.id_perfil 
					ORDER by nome ASC LIMIT $proximaPagina, $resultadosPorPagina";
			$this->resultado=$this->conecta->banco->Execute($sql);
		}//fim do function ListarUsuario
		
		function excluirUsuario($idusuario){
			$sql="delete from usuario 
			      where id_usuario=".$idusuario."";
			      $nomeUsuario=$this->getNomeUsuario($idusuario);
			if($this->resultado=$this->conecta->banco->Execute($sql)){
				geraAlertaInformacao("<h3><BR>".getTranslateMsg("Deletion successfully completed.")."<h3>","success","center","listarUsuario");
			   $this->RegistrarAcao($_SESSION['idUsuario'],$nomeUsuario,$this->dataAtual,'current_time',getTranslateMsg("Excluded User"));
			}else{
				geraAlertaInformacao("<h3><BR>".getTranslateMsg("Deletion not performed.")."<h3>","success","center","listarUsuario");
			}
		
		}//fim do function excluirTipoDcoucmento
	
 	    function selecionarUsuario($idusuario){
			$sql="Select * from usuario 
			      where id_usuario=".$idusuario."";
			$this->resultado=$this->conecta->banco->Execute($sql);
			$this->registros=$this->resultado->FetchNextObj();
		}//fim do function SelecionarUsuario
	
	    function selecionaIdUsuario($nomeUsuario){
	    	$sql="Select id_usuario from usuario
	    	      where nome='".$nomeUsuario."'";
	    	$this->resultado=$this->conecta->banco->Execute($sql);
	    	$this->registros=$this->resultado->FetchNextObj();
			return $this->registros->id_usuario;
		  }//fim do function SelecionarUsuario


		  function getNomeUsuario($idUsuario){
	    	$sql="Select nome from usuario
	    	      where id_usuario='".$idUsuario."'";
	    	$this->resultado=$this->conecta->banco->Execute($sql);
	    	$this->registros=$this->resultado->FetchNextObj();
			return $this->registros->nome;
		  }//fim do function SelecionarUsuario


	 function PesquisarUsuario($filtroPesquisa,$proximaPagina,$resultadosPorPagina){
			$sql="Select * from usuario as u,perfil_usuario as pu 
			      where (u.id_perfil=pu.id_perfil) and (nome like '%".$filtroPesquisa."%' or login like '%".$filtroPesquisa."%'
			      or pu.descricao like '%".$filtroPesquisa."%' or id_usuario like '%".$filtroPesquisa."%')
			      ORDER by nome ASC LIMIT $proximaPagina,$resultadosPorPagina";
			$this->resultado=$this->conecta->banco->Execute($sql);
			if($this->registros=$this->resultado->RecordCount()==0){
				geraAlertaInformacao("<h3>".getTranslateMsg("No record has been located!")."<h3>","error","center","listarUsuario");
				}
	}//fim do function PesquisarUsuario
	
	
	function atualizarUsuario($nomeUsuario,$login,$senha,$idPerfil,$idUsuario){
		   $senha=sha1(addslashes($senha));
			$sql="update usuario 
				  set nome='".$nomeUsuario."' ,login='".$login."',senha='".$senha."',id_perfil='".$idPerfil."'
				     where id_usuario='".$idUsuario."'";
			if($this->resultado=$this->conecta->banco->Execute($sql)){
				geraAlertaInformacao("<h3><BR>".getTranslateMsg("Update done successfully.")."<h3>","success","center","listarUsuario");
				$this->RegistrarAcao($_SESSION['idUsuario'],$nomeUsuario,$this->dataAtual,'current_time',getTranslateMsg("Edited user"));
							
				}else {
					geraAlertaInformacao("<h3><BR>".getTranslateMsg("Failed to perform update.")."<h3>","error","center","listarUsuario");
					}
	}//fim da function AtualizarUsuario

	function existeUsuarioCadastrado($nomeUsuario,$login){
		  $sql="Select * from usuario
	    	  where nome='".$nomeUsuario."' or login='".$login."';";
	     	$this->resultado=$this->conecta->banco->Execute($sql);
		 	if($this->registros=$this->resultado->RecordCount()==0)
	       		{
	       	 			return false;
	       			}else{

	       				return true;
	       			}
	} //fim do function existeUsuarioCadastrado	

function contaRegistros(){

 $sql="Select * from usuario as u,perfil_usuario as pu where (u.id_perfil=pu.id_perfil)";
 $this->resultado=$this->conecta->banco->Execute($sql);
 $this->registros=$this->resultado->FetchNextObject();
 return $this->registros=$this->resultado->RecordCount();	

}//fim do function contarRegistrosPaginacaoResultado

function contaRegistrosPequisa($filtroPesquisa){
 $sql="Select * from usuario as u,perfil_usuario as pu 
       where (u.id_perfil=pu.id_perfil) and (nome like '%".$filtroPesquisa."%' or login like '%".$filtroPesquisa."%'
       or pu.descricao like '%".$filtroPesquisa."%' or id_usuario like '%".$filtroPesquisa."%')";
 $this->resultado=$this->conecta->banco->Execute($sql);
 $this->registros=$this->resultado->FetchNextObject();
 return $this->registros=$this->resultado->RecordCount();	


}//fim do function contaRegistrosPesquisa()

function RegistrarAcao($idUsuario,$descricao,$data,$hora,$acao){
			
			$sql="insert into log_acesso_documento(id_usuario,nome_documento,data,hora,operacao)
			      values('".$idUsuario."','$descricao','$data',$hora,'".$acao."')";
			$this->resultado=$this->conecta->banco->Execute($sql);
		     			
}// fim do function registrar acao sobre o usuário
	
}//fim da classe usuario

?>