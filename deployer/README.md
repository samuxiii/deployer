## Installation
* You will need a http server with php support (assumption: the root directory is /var/www)
* 'server' folder must be placed under the '/var/www' or any public folder. It uses php.
* 'client' folder can be placed in the same server. If you choose another one you will have to be care of the url callbacks.

### Access the application
* Open browser http://localhost/client/tools.html

### Important
In order to perform 'git' operations in a correct way, the apache user has to be included into *sudoers*.
_Example_:
```
www-data ALL = (www-data) NOPASSWD: /usr/bin/git
```
