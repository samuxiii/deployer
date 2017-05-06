<?php

require_once('Tools.php');
$tool = new Tools;

//check config.php exists
if (!file_exists('config.php'))
{
    $tool->print_("Configuration file not found.");
    return;
}

$config = include('config.php');
$deploy_path = $config->deploy_path;
$name = $config->project['name'];
$repo = $config->project['repository'];
$project = "${deploy_path}/${name}/";

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
        case 'project':
            getProject();
            break;
        default:
            $tool->print_("Access denied. Function not recognized!");
    }
}

/* project functions */
function getProject() 
{
    global $project, $name, $path;
    
    $path = "../server/".$project;
    if (!file_exists($path))
    {
        $path = "#";
    }
    $json = '{"name":"'.$name.'", "path":"'.$path.'"}';
    header('Content-Type: application/json');
    echo json_encode($json);
}

?>