<?php
session_start();
$to ="info@m-kit.by";


if(isset($_POST['form']) && ($_POST['form']!="")) $form=$_POST['form']; else {unset($form); return;}
$param_str="";
if(isset($_SESSION['UTM']))
{
	$UTM=urldecode($_SESSION['UTM']);
	$param= explode("&",$UTM);
	foreach ($param as $val)
	{
		$val_str=explode("=", $val);
		$param_str.='<tr>
		<td><b>'.$val_str[0].'</b></td>
		<td>'.$val_str[1].'</td>
	</tr>';
	}
}
if($form==1)
{
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$tema=$_POST['tema'];
	$dob=$_POST['dob'];


	$subject = $tema;

	$message = ' 
	<html> 
	    <head> 
	        <title>'.$tema.'</title> 
	    </head> 
	    <body> 
		<p><b>'.$tema.'</b><a href="http://kuhni.m-kit.by">kuhni.m-kit.by</a></p>
	        <table>
	        	<tr>
	        		<td><b>Имя:</b></td>
	        		<td>'.$name.'</td>
	        	</tr>
	        	<tr>
	        		<td><b>Телефон:</b></td>
	        		<td>'.$phone.'</td>
	        	</tr>
	        	<tr>
	        		<td><b>Дополнительная информация:</b></td>
	        		<td>'.$dob.'</td>
	        	</tr>
	        </table> 
	        <h3>Параметры</h3>
	        <table>
				'.$param_str.'
	        </table> 
	    </body> 
	</html>';
	$EOL = "\r\n"; // ограничитель строк, некоторые почтовые сервера требуют \n - подобрать опытным путём
	$boundary     = "--".md5(uniqid(time()));  // любая строка, которой не будет ниже в потоке данных.
	$headers    = "MIME-Version: 1.0;$EOL";
	$headers   .= "Content-Type: multipart/mixed; boundary=\"$boundary\"$EOL";
	$headers   .= "From: M-Kit Mogilev <kuhni.m-kit.by@{$_SERVER['SERVER_NAME']}>\r\n";
	$headers  	.="Bcc: M-Kit Mogilev <kuhni.m-kit.by@{$_SERVER['SERVER_NAME']}>";
	$multipart  = "--$boundary$EOL";
	$multipart .= "Content-Type: text/html; charset=utf-8$EOL";
	$multipart .= "Content-Transfer-Encoding: base64$EOL";
	$multipart .= $EOL; // раздел между заголовками и телом html-части
	$multipart .= chunk_split(base64_encode($message));
	if(mail($to, $subject, $multipart, $headers))
	{
		echo true;
	}
	else
	{
		echo false;
	}
}

?>