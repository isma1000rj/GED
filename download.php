<?php
 $arquivo = $_GET["arquivo"];
   if(isset($arquivo) && file_exists($arquivo)){
      switch(strtolower(substr(strrchr(basename($arquivo),"."),1))){
         case "pdf": $tipo="application/pdf"; break;
         case "png": $tipo="image/png"; break;
         case "jpg": $tipo="image/jpg"; break;
         case "jpeg": $tipo="image/jpep";break;
         case "ods": $tipo="application/ods";break;
         case "odp": $tipo="application/odp";break;
         case "odt"; $tipo="application/odt";break;
         case "php": // deixar vazio por seurança
         case "htm": // deixar vazio por seurança
         case "html": // deixar vazio por seurança
      }
      ob_start();
      header("Content-Type: ".$tipo);
      header("Content-Length: ".filesize($arquivo));
      header("Content-Disposition: attachment; filename=".basename($arquivo));
      readfile($arquivo);
      exit;
   }

?>