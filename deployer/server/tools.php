<?php

class Tools
{
    /* private methods */

    //executor
    private function do_($cmd)
    {
        $output = shell_exec("sudo -u www-data $cmd 2>&1");
        $this->print_($output);
    }

    /* public methods */

    //decorator for common printouts
    function print_($text)
    {
        echo "<pre>Response:<br>$text</pre>";
    }

    //update the deployer itself
    function update()
    {
        $this->do_('git pull --rebase');
    }

    //clone git project 
    function clone($path, $repo, $token)
    {
        $this->do_("git clone https://x-token-auth:{$token}@bitbucket.org/{$repo} {$path}");
    }

    //bring the changes from git project 
    function pull($path, $repo, $token)
    {
        $this->do_("git -C {$path} pull --rebase https://x-token-auth:{$token}@bitbucket.org/{$repo} master");
    }

    //copy to the correct apache folder and publish
    function deploy($path)
    {
        $this->print_("You can access by this <a href='../server/{$path}'>link</a>");
    }
}

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
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
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
            /* TODO: return empty if the directory doesn't exist */
            echo "../server/".$project;
            break;
        default:
            $tool->print_("Access denied. Function not recognized!");
    }
}

?>