<?php
session_start();
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "This dest = ".$uploadfile."<br>";
echo "This [tmp_name] = ".$_FILES['uploadfile']['tmp_name']."<br>";


echo "</pre>";
?>

<form action="test.php" method="post" enctype="multipart/form-data">
	<input type="file" name="uploadfile"><br>
	<input type="text" name="text"><br>
	<input type="submit" value="Загрузить"><br>
</form>

<?php
// Каталог, в который мы будем принимать файл:

//директория КУДА будет в итоге сохранен файл
//надо именно 2 обратных слеша в адресе для экранирования
//должны быть права на запись в папку
$uploadfile = "C:\AppServ\www\upload\\".$_FILES['uploadfile']['name'];

// Копируем файл из каталога для временного хранения файлов:
//$_FILES['uploadfile']['tmp_name'] - тут содержится полный адрес к временному файлу
//директория для сохранения временного файла указана  в php.ini
//путь в php.ini указываем так: upload_tmp_dir = C:\Users\*ваш_пользователь*\uploadx
//должны быть права на запись в эту папку
if (isset($_FILES['uploadfile']['name'])){
	if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile)){
		echo "<h3>Файл успешно загружен на сервер</h3>";
		//$_SESSION['result_up'] = "<h3>Файл успешно загружен на сервер</h3>";
		//header ('Location: test.php');
	}else{
		echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>"; 
		exit; 
	}

	// Выводим информацию о загруженном файле:
	echo "<h3>Мой комментарий: ".$_POST['text']."</h3>";
	echo "<h3>Информация о загруженном на сервер файле: </h3>";
	echo "<p><b>Оригинальное имя загруженного файла: ".$_FILES['uploadfile']['name']."</b></p>";
	echo "<p><b>Mime-тип загруженного файла: ".$_FILES['uploadfile']['type']."</b></p>";
	echo "<p><b>Размер загруженного файла в байтах: ".$_FILES['uploadfile']['size']."</b></p>";
	echo "<p><b>Временное имя файла: ".$_FILES['uploadfile']['tmp_name']."</b></p>";

}

//echo $_SESSION['result_up'];
//unset($_SESSION['result_up']);


// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! \\

//узнать как сохранить и сделать вывод текстовой информации про результат операции при использовании
//перезапроса страницы методом header ('Location: test.php');

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! \\
?>
