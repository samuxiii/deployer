## Installation
* You will need a http server with php support (assumption: the root directory is /var/www)
* 'server' folder must be placed under the '/var/www' or any public folder. It uses php.
  + _Note:_ edit the 'config.example.php' file with your specifications and rename it as 'config.php'.
  + Run 'deployer/server/install-deps.php' to download the php dependencies (oauth2).
* 'client' folder can be placed in the same server. If you choose another one you will have to be care of the url callbacks.

```
Note:
Currently the implemented 'update' option forces to store the whole git folder under /var/www
```

### Access the application
* Open browser http://localhost/lab/client/tools.html

### Important
In order to perform 'git' operations in a correct way, the apache user has to be included into *sudoers*.
_Example_:
```
www-data ALL = (www-data) NOPASSWD: /usr/bin/git
```

#### ToDo's
* Also it's going to be necessary to create a service which retrieves the correct oauth token from the git service.
  + _Note:_ The current approach is a php file that retrieves the token according to the configuration.
  + Timeout to remove the token when it has expired.
* ~~Creating a config.json, config.php or both so that the urls definitions can be stored and secured.~~ Check if config.php has been initialized stopping the server and notifying to the user.
* UX
  + ~~Upon entering, click 'log in' in order to gain access in git service and enable the operation buttons.~~
  + ~~Click in buttons to perform the options.~~
  + Find a way to ease the procedure to add a new project.
