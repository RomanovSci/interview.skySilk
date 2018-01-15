#### Task

Реализовать приложение, отвечающее требованиям MVC, которое:
1. Позволяет пользователю зарегистрироваться.(при регистрации отправляется email с адресом для активации аккаунта)
2. Позволяет залогиниться
3. Изменить настройки.
фреймворки нельзя использовать.
Проект должен отвечать требованиям по безопасности и работать на последней версии php. 
В качестве базы данных нужно использовать sqlite. 
Проект должен свободно запускаться через встроенный в пхп веб сервер.


#### How to run
* Install all dependencies `composer install_all`
* Setup db connection at `config/env-local.php` file (`DB_DRIVER = pdo_sqlite, DB_NAME = somename.db`)
* Create tables `composer create_tables`
* Build front-end `npm run build`
* Run server `composer serve`

#### Testing
* Run `./vendor/bin/phpunit` from project directory

#### Notes
* (Simulating mail sending for development env) When you create new user, activation link write to `PROJECT_PATH/storage/logger/application.log` for `development` environment
