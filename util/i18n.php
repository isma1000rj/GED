<?php
require_once('config.php');
$locale = LANG;
$textdomain = "idioma_sistema_ged";
$locales_dir = dirname(__FILE__) . '/../idiomas/i18n';
if (isset($_GET['locale']) && !empty($_GET['locale']))
  $locale = $_GET['locale'];
 
putenv('LANGUAGE=' . $locale);
putenv('LANG=' . $locale);
putenv('LC_ALL=' . $locale);
putenv('LC_MESSAGES=' . $locale);
 
require_once dirname(__FILE__).'/gettext/gettext.inc';
 
_setlocale(LC_ALL, $locale);
_setlocale(LC_CTYPE, $locale);
 
_bindtextdomain($textdomain, $locales_dir);
_bind_textdomain_codeset($textdomain, 'UTF-8');
_textdomain($textdomain);
 
function translateMsg($string) {
  echo __($string);
}
function getTranslateMsg($string){
  return __($string);
}
?>