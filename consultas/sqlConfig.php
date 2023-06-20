<?php
require_once dirname(__FILE__) . '/../util/conecta.php';

class configuracao
{
    public $resultado;
    public $registros;
    private $conecta;

    public function __construct()
    {
        $this->conecta = new conexao();
    }

    public function contaRegistro()
    {
        $sql = "SELECT * FROM configuracao";
        $this->resultado = $this->conecta->banco->Execute($sql);
        $this->registros = $this->resultado->FetchNextObject();
        return $this->resultado->RecordCount();
    }

    public function gravarConfiguracao($nomeEmpresa, $nomeLogo, $tituloNavegador, $idUsuario)
    {
        if ($this->contaRegistro() == 0) {
            $sql = "INSERT INTO configuracao (id_usuario, nome_empresa, nome_logo, titulo_navegador) VALUES ($idUsuario, '$nomeEmpresa', '$nomeLogo', '$tituloNavegador')";
        } else {
            $sql = "UPDATE configuracao SET nome_empresa='$nomeEmpresa', nome_logo='$nomeLogo', titulo_navegador='$tituloNavegador'";
        }

        if ($this->resultado = $this->conecta->banco->Execute($sql)) {
            geraAlertaInformacao("<h3><BR>" . getTranslateMsg("Successfully saved configuration.") . "<h3>", "success", "center", "config");
        } else {
            geraAlertaInformacao("<h3>" . getTranslateMsg("Attention!") . "<BR>" . getTranslateMsg("Failed to save configuration.") . "<h3>", "success", "error", "config");
        }
    }

    public function listarConfiguracao()
    {
        $sql = "SELECT * FROM configuracao";
        $this->resultado = $this->conecta->banco->Execute($sql);
        $this->registros = $this->resultado->FetchNextObj();
    }
}

?>