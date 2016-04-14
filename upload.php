<?php
session_start();
require_once "libs.php";

//$uploadDir - каталог, в который мы будем принимать файл:
//директория КУДА будет в итоге сохранен файл
//надо именно 2 обратных слеша в адресе для экранирования
//должны быть права на запись в папку
$uploadDir = "upload\\";

$uploadFileName = $_FILES['uploadfile']['name'];

// Копируем файл из каталога для временного хранения файлов:
//$_FILES['uploadfile']['tmp_name'] - тут содержится полный адрес к временному файлу
//директория для сохранения временного файла указана  в php.ini
//путь в php.ini указываем так: upload_tmp_dir = C:\Users\*ваш_пользователь*\upload
//должны быть права на запись в эту папку

if (isset($_FILES['uploadfile']['name'])){
	//проверяем есть ли файл с таким именем
	if (file_exists("upload/".$_FILES['uploadfile']['name'])){
		$uploadFileName = myRenameFile($_FILES['uploadfile']['name']);
	}
	if (copy($_FILES['uploadfile']['tmp_name'], ($uploadDir.$uploadFileName))){
		$success = "Файл успешно загружен на сервер!<br>";
	}else{
		$_SESSION["InfoUpload"] = $error = "Ошибка! Не удалось загрузить файл на сервер!";
		header("Location: index.php");
		exit;
	}
	// Сохраняем ифнормацию про загруженный файл:
	if (isset($success)) {
		$_SESSION["InfoUpload"] = saveInfoFile(
			$_FILES['uploadfile']['name'],
			$_FILES['uploadfile']['type'],
			$_FILES['uploadfile']['size'],
			$_FILES['uploadfile']['tmp_name'],
			$_POST['text'],
			$success

		);
		header("Location: index.php");
		exit();
	}


}
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! \\
//узнать как сохранить и сделать вывод текстовой информации про результат операции при использовании
//перезапроса страницы методом header ('Location: index.php');
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! \\
?>
