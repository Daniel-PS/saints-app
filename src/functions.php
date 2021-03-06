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
    exit();
}

function redirectWithMessage($uri, $message)
{
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

function deletePhoto($old_photo)
{
    unlink(PUBLIC_UPLOADS_FOLDER_PATH . '/' . $old_photo);
}

function h($name, $quotes = ENT_QUOTES)
{
    return htmlspecialchars($name, $quotes);
}

function old($key)
{
    $old_input = Session::get('old_input');

    if (empty($old_input[$key])) {
        return null;
    }

    return h($old_input[$key]);
}

function generateUniqueName(): string
{
    return uniqid() . '_' . $_FILES['photo']['name'];
}

function auth(): ?object
{
    return Session::get('user');
}

function dateFormat($value, $time = false)
{
    $time = $time ? ' H:m:s' : null;
    $newDate = DateTime::createFromFormat('Y-m-d' . $time, $value);

    if (! $newDate) {
        return $value;
    }

    $newDate = $newDate->format('d/m/Y');

    if (strpos($newDate, '/0000')) {
        $newDate = str_replace('/0000', '', $newDate);
    }


    return $newDate;
}
