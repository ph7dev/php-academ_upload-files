<?php
/**
 * Created by PhpStorm.
 * User: Slava
 * Date: 14.04.2016
 * Time: 12:21
 */

//сохранение данных о загруженном файле в массив.

function saveInfoFile ($originName, $mime, $size, $tmpName, $userText, $success){
    $result = array();
    $result['success'] = $success;
    $result['originalName'] = "Оригинальное имя загруженного файла: ".$originName;
    $result['mimeType'] = "Mime-тип загруженного файла: ".$mime;
    $result['fileSize'] = "Размер загруженного файла : ".round((($size/1024)/1024),2)." МБ (".$size." байт).";
    $result['tmpName'] = "Временное имя файла: ".$tmpName;
    $result['userText'] = "Комментарий пользователя: ".$userText;
    return $result;
}

//рекурсивное переименование файла.

function myRenameFile ($name){
    $newName = "new_".$name;
    if (file_exists("upload/".$newName)){
        return myRenameFile($newName);
    }
    return $newName;
}

