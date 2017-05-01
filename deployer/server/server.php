<?php

require_once('Tools.php');

/* main */
$tool = new Tools;

/*
 * TODO: verify if config.php is initialized to continue..
 */
 
$config = include('config.php');
$deploy_path = $config->deploy_path;

//for the time being the project definition is here
$project = $deploy_path."/language/";
$repo = "BetWrapTeam/betawrapper.git";

/*
 * According to the action received the related Tools method is called
 */
if (isset($_POST['action'])) 
{
    $action = $_POST['action'];
    switch($action) 
    {
        case 'clone':
            $tool->clone($project, $repo, $_POST['token']);
            break;
        case 'pull':
            $tool->pull($project, $repo, $_POST['token']);
            break;
        case 'deploy':
            $tool->deploy($project);
            break;
        case 'update':
            $tool->update();
            break;
        case 'link':
            getPath($project);
            break;
        default:
            $tool->print_("Access denied. Function not recognized!");
    }
}

/* project functions */
function getPath($project) 
{
    $path = "../server/".$project;
    if (file_exists($path))
    {
        echo "../server/".$project;
    }
}

?>