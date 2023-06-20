  <?php
   require_once dirname(__FILE__).'/../util/conecta.php';
	class permissao{
		
	  var $resultado;
	  var $registros;
	  var $qtdRegistros;
	  var $resultadoPermissao;
      var $registrosPermissao;
      var $dataAtual;
	 	  
	   
function permissao(){ 
		   
		   $this->conecta=new conexao();
		   $this->dataAtual=date('d-m-Y');
}	
		
function contaRegistros(){
 $sql="select *  from usuario";
 $this->resultado=$this->conecta->banco->Execute($sql);
 $this->registros=$this->resultado->FetchNextObject();
 return $this->qtdRegistros=$this->resultado->RecordCount();	
}

function listarUsuario(){
			$sql="select * from usuario";
			$this->resultado=$this->conecta->banco->Execute($sql);
	}//fim do function ListarUsuario	


function selecionarUsuario($idusuario){
			$sql="Select * from usuario 
			      where id_usuario=".$idusuario."";
			$this->resultado=$this->conecta->banco->Execute($sql);
			$this->registros=$this->resultado->FetchNextObj();
		}//fim do function SelecionarUsuario

 function existePermissaoCadastrada($idUsuarioSelecionado){

     $sql="Select * from permissao_acesso_modulo
           where  id_usuario=".$idUsuarioSelecionado."";
           $this->resultado=$this->conecta->banco->Execute($sql);
           $this->registros=$this->resultado->FetchNextObject();
           return $this->qtdRegistros=$this->resultado->RecordCount();


 }//fim do existePermissaoCadastrada

function gravarPermissao($idUsuarioSelecionado,$cdrUsuario,$cdrDocumento,$cdrTpDocumento,$cdrPermissaoAcesso,$lstDocumento,$lstLog,$lstUsuario,$lstTpDocumento,$cdrConf){
	 if($this->existePermissaoCadastrada($idUsuarioSelecionado)==0){//se não existir permissão cadastrada efetua um insert
	   $sql="insert into permissao_acesso_modulo 
	   (id_usuario,cdr_usuario,cdr_documento,cdr_tpdocumento,cdr_permissaoacesso,lst_documento,lst_log,lst_usuario,lst_tpdocumento,cdr_config)
       values($idUsuarioSelecionado,'$cdrUsuario','$cdrDocumento','$cdrTpDocumento','$cdrPermissaoAcesso','$lstDocumento','$lstLog','$lstUsuario','$lstTpDocumento','$cdrConf')";
	
	   if($this->resultado=$this->conecta->banco->Execute($sql)){
		  }else{
		 	geraAlertaInformacao("<h3>".getTranslateMsg("Failed to save permission.")."<h3>","error","center","cadastrarPermissao");
	   		}
	}else{ // caso contrário atualiza a permissão
        $sql="update permissao_acesso_modulo 
	        set cdr_usuario='$cdrUsuario',cdr_documento='$cdrDocumento',cdr_tpdocumento='$cdrTpDocumento',
            cdr_permissaoacesso='$cdrPermissaoAcesso',lst_documento='$lstDocumento',lst_log='$lstLog',
	        lst_usuario='$lstUsuario',lst_tpdocumento='$lstTpDocumento', cdr_config='$cdrConf'
           where id_usuario=$idUsuarioSelecionado ";
	   if($this->resultado=$this->conecta->banco->Execute($sql)){
	   		$this->RegistrarAcao($_SESSION['idUsuario'],$this->getNomeUsuario($idUsuarioSelecionado),$this->dataAtual,'current_time',getTranslateMsg("Updated Permission"));//log da operação

	   		geraAlertaInformacao("<h3><BR>".getTranslateMsg("Permission updated successfully.")."<h3>","success","center","cadastrarPermissao");
	   		
	      }else{
	      	geraAlertaInformacao("<h3>".getTranslateMsg("Failed to update permission.")."<h3>","error","center","cadastrarPermissao");
	   		}
	}
	
}//fim do gravarPermissao


function listarPermissaoUsuario($idUsuario){

$sql="Select *  from permissao_acesso_modulo as pm,usuario as u
           where  pm.id_usuario=".$idUsuario." and u.id_usuario=".$idUsuario."";
           $this->resultado=$this->conecta->banco->Execute($sql);
           //$this->registros=$this->resultado->FetchNextObject();

}

function getTitulo(){// SqlConfig.php
 $sql="Select titulo_navegador from configuracao";
 $this->resultado=$this->conecta->banco->Execute($sql);
 $this->registros=$this->resultado->FetchNextObj();
 return $this->registros->titulo_navegador;
}

function getLogo(){// SqlConfig.php

$sql="Select nome_logo from configuracao";
 $this->resultado=$this->conecta->banco->Execute($sql);
 $this->registros=$this->resultado->FetchNextObj();
 return $this->registros->nome_logo;	
}

function getNomeUsuario($idusuario){
			$sql="Select * from usuario 
			      where id_usuario=".$idusuario."";
			$this->resultado=$this->conecta->banco->Execute($sql);
		    $this->registros=$this->resultado->FetchNextObj();
		    return $this->registros->nome;
		}//fim do function SelecionarUsuario


function RegistrarAcao($idUsuario,$descricao,$data,$hora,$acao){
			
			$sql="insert into log_acesso_documento(id_usuario,nome_documento,data,hora,operacao)
			      values('".$idUsuario."','$descricao','$data',$hora,'".$acao."')";
			$this->resultado=$this->conecta->banco->Execute($sql);
		     			
}// fim do function registrar acao sobre tipo de documento

}//fim da class permissao
?>