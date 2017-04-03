<?php

//constants
$root = "/home/betawrap";
$language_dir = "{$root}/www/language";

// function selector
if(isset($_POST['action']) /*&& function_exists($_POST['action'])*/) {
    $action = $_POST['action'];
    echo "Selecting function!";
    switch($action) {
        case 'pull':
            pull();
            break;
        case 'deploy':
            deploy();
            break;
        default:
            echo "Access denied for this function!";
    }
}

//functions
function do_($cmd)
{
    echo "Executing $cmd";
    $salida = shell_exec("$cmd 2>&1");
    echo "<pre>$salida</pre>";
}

function pull()
{
    $salida = shell_exec('git pull --rebase 2>&1');
    echo "<pre>$salida</pre>";
}

function deploy()
{
    do_("ls -la $language_dir");
}

?>