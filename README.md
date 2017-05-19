## Installation
* You will need a http server with php support (assumption: the root directory is /var/www)
* 'server' folder must be placed under the '/var/www' or any public folder. It uses php.
  + _Note:_ edit the 'config.example.php' file with your specifications and rename it as 'config.php'.
  + Run 'deployer/server/install-deps.php' to download the php dependencies (oauth2).
* 'client' folder can be placed in the same server. If you choose another one you will have to care about the url callbacks.

```
Note:
Currently the implemented 'update' option forces to store the whole git folder under /var/www
```

### Access the application
* Open browser http://localhost/deployer/client/tools.html

### Important
In order to perform 'git' operations in a correct way, the apache user has to be included into *sudoers*.
_Example_:
```
www-data ALL = (www-data) NOPASSWD: /usr/bin/git
```


