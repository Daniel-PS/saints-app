<?php

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
