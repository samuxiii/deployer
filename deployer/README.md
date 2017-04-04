## Installation
- 'server' folder must be placed under the '/var/www' or any public folder. It uses php.
- 'client' folder can be place in the same server or another.

## Important
In order to perform 'git' operations in a correct way, the apache user has to be included into *sudoers*.
_Example_:
```
www-data ALL = NOPASSWD: /usr/bin/git
```