<?php

class Tools
{
    //private
    private function do_($cmd)
    {
        $output = shell_exec("sudo -u www-data $cmd 2>&1");
        $this->print_($output);
    }

    function print_($text)
    {
        echo "<pre>Response:<br>$text</pre>";
    }

    //public
    function update()
    {
        $this->do_('git pull --rebase');
    }

    function pull()
    {
        $this->print_("Not implemented yet");
    }

    function deploy()
    {
        $this->print_("Not implemented yet");
    }
}

$tool = new Tools;

// function selector
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