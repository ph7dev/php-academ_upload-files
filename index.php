<?php
/**
 * Created by PhpStorm.
 * User: Slava
 * Date: 14.04.2016
 * Time: 11:45
 */

//error_reporting(-1);
session_start();
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Имя файла: <input type="text" name="text"><br>
    <input type="file" name="uploadfile"><br>
	<input type="submit" value="Загрузить"><br>
</form>

<h3>Информация о загруженном на сервер файле: </h3>
<p align="left">
<?php
if (isset($_SESSION["InfoUpload"])) {
    if (is_array($_SESSION["InfoUpload"])) {
        foreach ($_SESSION["InfoUpload"] as $row) {
            echo $row . "<br>";
        }
    }else{
        echo $_SESSION["InfoUpload"];
    }
}
?>
</p>
