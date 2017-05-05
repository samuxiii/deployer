<?php

$url = 'http://domain.com';

return (object) array(
    'url_home' => $url.'/deployer/client/tools.html',
    'deploy_path' => './deployed',
    'bitbucket' => array(
        'clientId' => '',
        'clientSecret' => '',
        'redirectUri' => $url.'/deployer/server/access.php'
        )
);

?>
