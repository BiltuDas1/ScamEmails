<?php
if(isset($_REQUEST['format']) && !empty($_REQUEST['format'])){
    if(strtolower($_REQUEST['format']) == 'text'){
        $text = shell_exec("python ./python/textparse.py " . strtolower($_REQUEST['email']));
        echo $text;
    }
} else {
    $json = shell_exec("python3 --version");
    echo $json;
}
?>