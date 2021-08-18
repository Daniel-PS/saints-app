<?php

use App\Session;

function dd(...$args)
{
    echo '<pre>';
        var_dump(...$args);
    echo '</pre>';

    exit();
}

function view($view, $data = [])
{
    extract($data);
    require VIEWS_FOLDER_PATH . '/' . $view;
}

function loadFileToEnvironment($filePath)
{
    $envVars = parse_ini_file($filePath);

    foreach ($envVars as $envVarName => $envVarValue) {
        putenv("$envVarName=$envVarValue");
    }
}

function redirect($uri)
{
    header('Location: ' . $uri);
}

function redirectWithMessage($uri, $message) {
    Session::set('message', $message);
    redirect($uri);
}

function handleUploadedFile($file_key, $old_photo = '')
{
    if ($old_photo) {
        unlink(PUBLIC_UPLOADS_FOLDER_PATH . '/' . $old_photo);
    }

    $target_file = PUBLIC_UPLOADS_FOLDER_PATH . '/' . $_FILES[$file_key]['name'];
    move_uploaded_file($_FILES[$file_key]['tmp_name'], $target_file);
}

