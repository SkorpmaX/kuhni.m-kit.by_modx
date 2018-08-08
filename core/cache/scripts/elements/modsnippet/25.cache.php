<?php  return 'session_start();
if (!$_SERVER[\'QUERY_STRING\'] == NULL)
{
	$_SESSION[\'UTM\']=$_SERVER[\'QUERY_STRING\'];
	$_SESSION[\'city\']=$_GET[\'utm_city\'];
	header("Location: /");
}
return;
return;
';