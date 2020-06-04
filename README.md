  .--.      .-'.      .--.      .--.      .--.      .--.      .`-.      .--.
:::::.\::::::::.\::::::::.\::::::::.\::::::::.\::::::::.\::::::::.\::::::::.\
'      `--'      `.-'      `--'      `--'      `--'      `-.'      `--'      `

                                    PAPERSS
                                    _______

A RSS Agregator project with Symfony5 / Vuejs.


## Clone Repo:
```bash
git clone git@github.com:Azimaet/paperss.git
```
_____


## Install PHP Libraries:
```bash
composer install
```
_____


## DDB:
- Create MySql DDB with name "paperss" and run migrations schemas:

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```
_____


## Assets (Img + css + js):
- to build: 
```bash
./node_modules/.bin/encore dev
```
- to watch: 
```bash
./node_modules/.bin/encore dev --watch
```
(can use Yarn directly)
_____


## Run Local Webserver:
```bash
- symfony server:start
```
_____