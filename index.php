<?php

/**
 * INICIA A SESS�O PARA TODA A APLICA��O
 */
session_start();
ob_start();

/**
 * CODIFICA��O ISO-8859-1 EM TODAS AS P�GINAS HTML
 */
header('Content-type: text/html; charset=UTF-8');

/**
 * EXIBE ERROS, WARNINGS E NOTICES DO C�DIGO (OPCIONAL).
 * DEVE SER DESABILITADO NA PRODU��O.
 */
error_reporting(E_ALL);

/**
 * DEFINE O LOCAL COMO O BRASIL. �TIL PARA FORMATA��O DE DATAS.
 */
setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.iso-8859-1', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


/**
 * URL BASE DE TODA A APLICA��O
 */
$_SESSION['REF_URL'] = "http://novo.grupoarenapg.com.br/";
$_SESSION['EMAIL_ADM'] = "imobiliario@arenapg.com.br";
$_SESSION['EMAIL_IMOB'] = "imobiliario04@grupoarenapg.com.br";



/**
 * REGISTRA A FUN��O PARA INCLUS�O AUTOM�TICA DAS CLASSES DA APLICA��O
 */
spl_autoload_register("autoload");
/**
 * INSTANCIA A CLASSE APPLICATION (FRONT CONTROLLER).
 */
$authentication = new Application();
$request = $authentication->init();
/**
 * SE A REQUISI��O FOR V�LIDA, INCLUI A VIEW. CASO CONTR�RIO, RETORNA PERMISSION DENIED
 */
$request ? include $request['template'] : die("<h1>PERMISSION DENIED</h1>");

/**
 * FUN��O PARA INCLUS�O AUTOM�TICA DE CLASSES USADA PELO SPL_AUTOLOAD
 * @param STRING $class
 */
function autoload($class) {
//    __DIR__  -> dirname(__FILE__)
    if (is_readable(dirname(__FILE__) . '/App/Models/' . $class . ".php")) {
        include(dirname(__FILE__) . '/App/Models/' . $class . ".php");
    }
    if (is_readable(dirname(__FILE__) . '/Library/' . $class . ".php")) {
        include(dirname(__FILE__) . '/Library/' . $class . ".php");
    }
}
