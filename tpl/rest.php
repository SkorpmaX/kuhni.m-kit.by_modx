<?php
$form=$_POST['form'];


$name=$_POST['name'];
$phone=$_POST['phone'];
$tema=$_POST['tema'];
$dob=$_POST['dob'];
$dob=str_replace("<br/>","\r\n",$dob);
$dob=str_replace(array("<b>", "</b>"),"",$dob);
$dob="\r\n".$dob;
/*
$name="MAKS";
$phone="+375293924946";
$mail="max.skorpmax@yandex.by";
$tema="Заявка с сайта";
$dob="Какая то инфа";
*/
$note="";

if ($form==1)
{
	$note.=$tema." kuhni.m-kit.by\r\n";
	$note.="Имя: ".$name."\r\n";
	$note.="Телефон: ".$phone."\r\n";
	$note.="Дополнительная информация: ".$dob."\r\n";
}



/*************************************************************************/
/************************** АВТОРИЗАЦИЯ **********************************/
/*************************************************************************/
$user=array(
	'USER_LOGIN'=>'info@cityboard.by', #Ваш логин (электронная почта)
	'USER_HASH'=>'363675b87e8b20147a476280f9473f02' #Хэш для доступа к API (смотрите в профиле пользователя)
);

$subdomain='new5a73730776f6f'; #Наш аккаунт - поддомен

#Формируем ссылку для запроса
$link='https://'.$subdomain.'.amocrm.ru/private/api/auth.php?type=json';

/***********************************************************************/
$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($user));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
curl_close($curl); #Завершаем сеанс cURL
/*Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом.*/

$code=(int)$code;
$errors=array(
	301=>'Moved permanently',
	400=>'Bad request',
	401=>'Unauthorized',
	403=>'Forbidden',
	404=>'Not found',
	500=>'Internal server error',
	502=>'Bad gateway',
	503=>'Service unavailable'
);
try
{
	#Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
	if($code!=200 && $code!=204)
		throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
}
catch(Exception $E)
{
	die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
}

/**
 * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
 * нам придётся перевести ответ в формат, понятный PHP
 */
$Response=json_decode($out,true);
$Response=$Response['response'];
if(isset($Response['auth'])) #Флаг авторизации доступен в свойстве "auth"
{echo "OK<br/>";}
else
{
	echo "not OK<br/>";
	return 'Авторизация не удалась';
}


/*************************************************************************************/
/*******************  СОЗДАНИЕ КОНТАКТА **********************************************/
/*************************************************************************************/


/*$link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/contacts/set';*/
$link='https://'.$subdomain.'.amocrm.ru/api/v2/contacts';

/*********************************/
$contacts['add']=array(
	array(
		'name'=>$name, #Имя контакта
		'tags' =>"М-Кит",
		'custom_fields'=>array(
			array(
				'id'=>288419,
				'values'=>
					array(
						array(
							'value' => $phone,
							'enum'=>'MOB'
						)
					)
			)
		)
	)
);

$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($contacts));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);



$code=(int)$code;
$errors=array(
	301=>'Moved permanently',
	400=>'Bad request',
	401=>'Unauthorized',
	403=>'Forbidden',
	404=>'Not found',
	500=>'Internal server error',
	502=>'Bad gateway',
	503=>'Service unavailable'
);
try
{
	#Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
	if($code!=200 && $code!=204)
		throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
}
catch(Exception $E)
{
	die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
}

/**
 * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
 * нам придётся перевести ответ в формат, понятный PHP
 */
$Response=json_decode($out,true);
$Response=$Response['_embedded']['items'];

$output='ID добавленных контактов:'.PHP_EOL;
foreach($Response as $v)
	if(is_array($v))
		$output.=$v['id'].PHP_EOL;
$new_contact=(int)$v['id'];
echo $output.'<br/>';
/*******************************************************************************************/
/*******************************************************************************************/
/*******************************************************************************************/



/*************************************************************************************/
/************************* СОЗДАНИЕ ЛИДА *********************************************/
/*************************************************************************************/
#Формируем ссылку для запроса
$link='https://'.$subdomain.'.amocrm.ru/api/v2/leads';
/*********************************/
$leads['add']=array(
	array(
		'name'=>$tema,
		'tags' =>'М-Кит',
		'status_id' => '18671479',
		'contacts_id'=>array(
			0=>$new_contact,
		),
	),
);




/*********************************/
$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($leads));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);



$code=(int)$code;
$errors=array(
	301=>'Moved permanently',
	400=>'Bad request',
	401=>'Unauthorized',
	403=>'Forbidden',
	404=>'Not found',
	500=>'Internal server error',
	502=>'Bad gateway',
	503=>'Service unavailable'
);
try
{
	#Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
	if($code!=200 && $code!=204)
		throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
}
catch(Exception $E)
{
	die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
}

/**
 * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
 * нам придётся перевести ответ в формат, понятный PHP
 */
$Response=json_decode($out,true);
$Response=$Response['_embedded']['items'];

$output='ID добавленных сделок:'.PHP_EOL;
foreach($Response as $v)
	if(is_array($v))
		$output.=$v['id'].PHP_EOL;
$new_lead=(int)$v['id'];
echo $output.'<br/>';
/*************************************************************************************/
/*************************  Примечание  *********************************************/
/*************************************************************************************/
#Формируем ссылку для запроса
$link='https://'.$subdomain.'.amocrm.ru/api/v2/notes';


$notes['add']=array(
	array(
		'element_id' => $new_lead,
		'element_type' => '2',
		'text' => $note,
		'note_type' => '4'
	)
);


$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($notes));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
/* Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
$code=(int)$code;
$errors=array(
	301=>'Moved permanently',
	400=>'Bad request',
	401=>'Unauthorized',
	403=>'Forbidden',
	404=>'Not found',
	500=>'Internal server error',
	502=>'Bad gateway',
	503=>'Service unavailable'
);
try
{
	#Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
	if($code!=200 && $code!=204)
		throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
}
catch(Exception $E)
{
	die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
}

/*************************************************************************************/
/*********************  СОЗДАНИЕ ЗАДАЧИ **********************************************/
/*************************************************************************************/
#Формируем ссылку для запроса
$link='https://'.$subdomain.'.amocrm.ru/api/v2/tasks';
/****************************/
$tasks['add']=array(
	array(
		'element_id'=>$new_contact, #ID сделки
		'element_type'=>1, #Показываем, что это - сделка, а не контакт
		'task_type'=>1, #Звонок
		'text'=>'Позвонить по заявке',
		'complete_till'=> time()+600
	)
);



/*****************************/
$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($tasks));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);


$code=(int)$code;
$errors=array(
	301=>'Moved permanently',
	400=>'Bad request',
	401=>'Unauthorized',
	403=>'Forbidden',
	404=>'Not found',
	500=>'Internal server error',
	502=>'Bad gateway',
	503=>'Service unavailable'
);
try
{
	#Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
	if($code!=200 && $code!=204)
		throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
}
catch(Exception $E)
{
	die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
}

/**
 * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
 * нам придётся перевести ответ в формат, понятный PHP
 */
$Response=json_decode($out,true);
$Response=$Response['_embedded']['items'];

$output='ID добавленных задач:'.PHP_EOL;
foreach($Response as $v)
	if(is_array($v))
		$output.=$v['id'].PHP_EOL;
echo $output;
?>


