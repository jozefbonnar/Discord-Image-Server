<?php

include 'img/functions.php';
$config = include 'img/config.php';

$key = $config['secure_key'];
$uploadhost = $config['output_url'];
$redirect = $config['redirect_url'];

if ('/robot.txt' === $_SERVER['REQUEST_URI']) {
    die("User-agent: *\nDisallow: /");
}

if (isset($_POST['key'])) {
    if ($_POST['key'] === $key) {
        $target = get_file_target($config, $_FILES['d']['name'], $_POST['name']);

        if (move_uploaded_file($_FILES['d']['tmp_name'], $target)) {
            $target_parts = explode('/img/', $target);
            echo substr($uploadhost.end($target_parts), 0, -4);
        } else {
            echo 'File upload failed, ensure permissions are writeable on the directory (777)';
        }
    } else {
        echo 'The key provided does not match your config.php';
    }
} else {
    echo 'You may not upload without the key parameter';
}
