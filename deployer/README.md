## Installation
* You will need a http server with php support (assumption: the root directory is /var/www)
* 'server' folder must be placed under the '/var/www' or any public folder. It uses php.
* 'client' folder can be placed in the same server. If you choose another one you will have to be care of the url callbacks.

```
Note:
Currently the implemented 'update' option forces to store the whole git folder under /var/www
```

### Access the application
* Open browser http://localhost/client/tools.html

### Important
In order to perform 'git' operations in a correct way, the apache user has to be included into *sudoers*.
_Example_:
```
www-data ALL = (www-data) NOPASSWD: /usr/bin/git
```

#### ToDo's
* Also it's going to be necessary to create a service which retrieves the correct oauth token from the git service.
  + _Note:_ The current approach is a php file that retrieves the token according to the configuration.
* Creating a config.json, config.php or both so that the urls definitions can be stored and secured.
* UX:
 + Upon entering, click 'log in' to gain access in git service.
 + Click in buttons to perform the options
