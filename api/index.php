<?php
$data = "https://scam-emailapi-biltu.vercel.app/data.txt";

if(isset($_REQUEST['format']) && !empty($_REQUEST['format'])){
    if(isset($_REQUEST['email']) && !empty($_REQUEST['email'])){
        if(strtolower($_REQUEST['format']) == 'text'){
            if(strpos(file_get_contents($data), strtolower($_REQUEST['email'])) !== false){
                echo nl2br("true");
                exit(0);
            } else {
                echo nl2br("false");
                exit(0);
            }
        }
        elseif (strtolower($_REQUEST['format']) == 'json'){
            if(strpos($_REQUEST['email'], "@") !== false){
                if(strpos(file_get_contents($data), strtolower($_REQUEST['email'])) !== false){
                    echo nl2br("{\"ok\":true, \"found\":true}");
                    exit(0);
                } else {
                    echo nl2br("{\"ok\":true, \"found\":false}");
                    exit(0);
                }
            } else {
                echo nl2br("{\"ok\":false, \"description\":\"Invalid email address\"}");
                exit(1);
            }
        }
        else {
            echo nl2br("{\"ok\":false, \"description\":\"Unknown format parameter passed\"}");
            exit(1);
        }
    } else {
        if(strtolower($_REQUEST['format']) == 'text'){
            echo "Please provide an email address";
            exit(1);
        }
        else {
            echo nl2br("{\"ok\":false, \"description\":\"Please provide an email address\"}");
            exit(1);
        }
    }
}

if(isset($_REQUEST['email']) && !empty($_REQUEST['email'])){
    if(strpos($_REQUEST['email'], "@") !== false){
        if(strpos(file_get_contents($data), strtolower($_REQUEST['email'])) !== false){
            echo nl2br("{\"ok\":true, \"found\":true}");
            exit(0);
        } else {
            echo nl2br("{\"ok\":true, \"found\":false}");
            exit(0);
        }
    } else {
        echo nl2br("{\"ok\":false, \"description\":\"Invalid email address\"}");
        exit(1);
    }
} else {
    echo nl2br("{\"ok\":false, \"description\":\"Please provide an email address\"}");
    exit(1);
}
?>