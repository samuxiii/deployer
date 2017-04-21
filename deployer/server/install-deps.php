<?php

$path = __DIR__."/vendor/";

if (file_exists($path)) {
    echo "Do nothing, dependencies are already installed\n";
    return;
} else {
    if(!mkdir($path, 0777, true)) {
        die('Error creating dependencies directory');
    }
}

//download composer setup
copy('https://getcomposer.org/installer', 'composer-setup.php');

//check downloaded file
if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') {
    echo "Installer verified\n";
} else {
    echo "Installer corrupt\n";
    unlink('composer-setup.php');
    return;
}
echo PHP_EOL;

//install composer
putenv('COMPOSER_HOME='.$path);
$output = shell_exec("php composer-setup.php");
echo "{$output}\n";

//install dependencies
$output = shell_exec("php composer.phar require stevenmaguire/oauth2-bitbucket");
echo "{$output}\n";

//cleaning not needed files
unlink('composer-setup.php');
unlink('composer.phar');
unlink('composer.json');
unlink('composer.lock');

?>