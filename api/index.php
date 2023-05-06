<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(strtolower($_GET['format']) == 'text'){
        $text = shell_exec("python ./python/textparse.py " . strtolower($_GET['email']));
        echo $text;
    } else {
        $json = shell_exec("python ./python/jsonparse.py " . strtolower($_GET['email']));
        echo $json;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(strtolower($_POST['format']) == 'text'){
        $text = shell_exec("python ./python/textparse.py " . strtolower($_POST['email']));
        echo $text;
    } else {
        $json = shell_exec("python ./python/jsonparse.py " . strtolower($_POST['email']));
        echo $json;
    }
}
?>