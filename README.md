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
