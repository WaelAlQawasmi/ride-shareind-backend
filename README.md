# about
this project create to be backe end of flutter app
## intallation
- after clone the project  change the name of __.env.example__ to __.env__
-  cd to the directory of the project
- install compser on the project 

> composer install
- __incase use windows__ 
> composer self-update --1


- create a new database and get the name of it and the username and password of it and put on __.env__
- build the tables

> php artisan migrate

 - install passport

 > php artisan passport:install

- generate key

> php artisan key:generate

- start
> php artisan serve

- in case you want to change the gurde
> php artisan cache:clear
> php artisan config:cache
