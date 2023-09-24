<?php
$data = "https://scam-emailapi-biltu.vercel.app/data.txt";
$tempdomains = "https://scam-emailapi-biltu.vercel.app/TempDomains.conf";

function is_valid_email($email) {
    $isDomainOk = false;
    $isLocalOk = false;
    if (strpos($email, "@") !== false && strlen($email) <= 254) {
        $local = explode("@", $email)[0];
        $domain = explode("@", $email)[1];

        // Check Domain
        if ($domain !== "") {
            if (strlen($domain) >= 2 && strlen($domain) <= 63) {
                if (strpos($domain, "-") === false) {
                    if (!startsWith($domain, "-") && !endsWith($domain, "-") && strpos($domain, "..") === false && !endsWith($domain, ".")) {
                        if (strpos($domain, ".") !== false) {
                            $temp = str_replace(".", "", $domain);
                            if (ctype_alnum($temp)) {
                                $isDomainOk = true;
                            }
                        }
                    }
                } else {
                    if (!startsWith($domain, "-") && !endsWith($domain, "-") && strpos($domain, "..") === false && !endsWith($domain, ".")) {
                        $temp = str_replace("-", "", $domain);
                        if (strpos($temp, ".") !== false) {
                            $temp = str_replace(".", "", $temp);
                            if (ctype_alnum($temp)) {
                                $isDomainOk = true;
                            }
                        }
                    }
                }
            }
        }

        // Check Address
        if ($local !== "") {
            if (strpos($local, "-") === false && strpos($local, "_") === false && strpos($local, ".") === false) {
                if (ctype_alnum($local)) {
                    $isLocalOk = true;
                }
            } else {
                $temp = str_replace("-", "", $local);
                $temp = str_replace("_", "", $temp);
                $temp = str_replace(".", "", $temp);
                if (ctype_alnum($temp)) {
                    $isLocalOk = true;
                }
            }
        }

        // Final
        if ($isDomainOk && $isLocalOk) {
            return true;
        } else {
            return false;
        }
    }
}

function if_temp_email($email) {
    $domain = explode("@", strtolower($email))[1];
    if (strpos(file_get_contents($GLOBALS['tempdomains']), $domain) !== false){
        return true;
    } else {
        return false;
    }
}

function startsWith($string, $prefix) {
    return substr($string, 0, strlen($prefix)) === $prefix;
}

function endsWith($string, $suffix) {
    return substr($string, -strlen($suffix)) === $suffix;
}


if(isset($_REQUEST['format']) && !empty($_REQUEST['format'])){
    if(isset($_REQUEST['email']) && !empty($_REQUEST['email'])){
        if(strtolower($_REQUEST['format']) == 'text'){
            if(is_valid_email($_REQUEST['email']) && if_temp_email($_REQUEST['email']) == false && strpos(file_get_contents($data), strtolower($_REQUEST['email'])) !== false){
                echo nl2br("true");
                exit(0);
            } else {
                echo nl2br("false");
                exit(0);
            }
        }
        elseif (strtolower($_REQUEST['format']) == 'json'){
            if(is_valid_email($_REQUEST['email'])){
                if(!if_temp_email($_REQUEST['email'])){
                    if(strpos(file_get_contents($data), strtolower($_REQUEST['email'])) !== false){
                        echo nl2br("{\"ok\":true, \"found\":true}");
                        exit(0);
                    } else {
                        echo nl2br("{\"ok\":true, \"found\":false}");
                        exit(0);
                    }
                } else {
                    echo nl2br("{\"ok\":false, \"description\":\"Temporary Email Addresses are not allowed\"}");
                    exit(1);
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
    if(is_valid_email($_REQUEST['email'])){
        if(!if_temp_email($_REQUEST['email'])){
            if(strpos(file_get_contents($data), strtolower($_REQUEST['email'])) !== false){
                echo nl2br("{\"ok\":true, \"found\":true}");
                exit(0);
            } else {
                echo nl2br("{\"ok\":true, \"found\":false}");
                exit(0);
            }
        } else {
            echo nl2br("{\"ok\":false, \"description\":\"Temporary Email Addresses are not allowed\"}");
            exit(1);
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