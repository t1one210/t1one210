<?php
define('CRM_HOST', 'bitrix24.ru/'); // Указываем Ваш домен в CRM 
define('CRM_PORT', '443'); // Порт сервера CRM. Установлен по умолчанию, не меняем
define('CRM_PATH', '/crm/configs/import/lead.php'); 

define('CRM_LOGIN', 'korepanov.andrew@mail.ru'); // Логин пользователя Вашей CRM 
define('CRM_PASSWORD', 'yevjld9nc20pr'); // Пароль пользователя Вашей CRM 
$tema = $_POST['tema']; //получаем значнеие полей из формы и записываем их в переменные методом POST 
$companyname = $_POST['companyname'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$message = $_POST['message'];

// Начинаем обработку внутри скрипта
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$leadData = $_POST['DATA'];

	// представляем массим
	$postData = array(
		'TITLE' => $tema,
		'COMPANY_TITLE' => $companyname,
		'NAME' => $name,
		'LAST_NAME' => $lastname,
		'COMMENTS' => $message,
	);

	// добавляем в массив параметры авторизации
	if (defined('CRM_AUTH'))
	{
		$postData['AUTH'] = CRM_AUTH;
	}
	else
	{
		$postData['LOGIN'] = CRM_LOGIN;
		$postData['PASSWORD'] = CRM_PASSWORD;
	}

	// открываем сокет соединения к облачной CRM
	$fp = fsockopen("ssl://".CRM_HOST, CRM_PORT, $errno, $errstr, 30);
	if ($fp)
	{
		// производим URL-кодирование строки
		$strPostData = '';
		foreach ($postData as $key => $value)
			$strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);

		// подготавливаем заголовки
		$str = "POST ".CRM_PATH." HTTP/1.0\r\n";
		$str .= "Host: ".CRM_HOST."\r\n";
		$str .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$str .= "Content-Length: ".strlen($strPostData)."\r\n";
		$str .= "Connection: close\r\n\r\n";

		$str .= $strPostData;

		fwrite($fp, $str);

		$result = '';
		while (!feof($fp))
		{
			$result .= fgets($fp, 128);
		}
		fclose($fp);

		$response = explode("\r\n\r\n", $result);

		$output = '&lt;pre>'.print_r($response[1], 1).'&lt;/pre>';
	}
	else
	{
		echo 'Не удалось подключиться к CRM '.$errstr.' ('.$errno.')';
	}
}
else
{
}
?>