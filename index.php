<!DOCTYPE html>
<html>
<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(strtolower($_REQUEST['format']) == 'text'){
        $text = shell_exec("python ./python/textparse.py " . strtolower($_REQUEST['email']));
        echo $text;
    } else {
        $json = shell_exec("python ./python/jsonparse.py " . strtolower($_REQUEST['email']));
        echo $json;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(strtolower($_REQUEST['format']) == 'text'){
        $text = shell_exec("python ./python/textparse.py " . strtolower($_REQUEST['email']));
        echo $text;
    } else {
        $json = shell_exec("python ./python/jsonparse.py " . strtolower($_REQUEST['email']));
        echo $json;
    }
}
?>
</html>