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

    //bring the changes from certain git project 
    function pull()
    {
        $this->print_("Not implemented yet");
    }

    //copy to the correct apache folder and publish
    function deploy()
    {
        $this->print_("Not implemented yet");
    }
}

/* main */
$tool = new Tools;

/*
 * According to the action received the related Tools method is called
 */
if(isset($_POST['action']) /*&& function_exists($_POST['action'])*/) {
    $action = $_POST['action'];
    switch($action) {
        case 'pull':
            $tool->pull();
            break;
        case 'deploy':
            $tool->deploy();
            break;
        case 'update':
            $tool->update();
            break;
        default:
            $tool->print_("Access denied for this function!");
    }
}

?>