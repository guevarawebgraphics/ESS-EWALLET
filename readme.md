<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

############################################################################################################
#        ______                                                               ________ __________          #
#        |             \          /\          /  /\       |         |         |            |               #
#        |              \        /  \        /  /  \      |         |         |            |               #
#        |_____  _____   \      /    \      /  /__ _\     |         |         |_____       |               #
#        |                \    /      \    /  /      \    |         |         |            |               #
#        |                 \  /        \  /  /        \   |         |         |            |               #
#        |_____             \/          \/  /          \  |________ |________ |_____       |               #
#                                                                                                          #
############################################################################################################
  
E-Wallet Project
Getting Started
------------------------------------------------
git clone http://mmsilvano@192.168.0.250:9090/scm/ess2/e-wallet.git .
git checkout develop
cp .env.example .env
composer install
php artisan key:generate
composer dump-autoload
npm install
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan passport:install
php artisan db:seed
php artisan serve

if you are using php artisan serve change .env find and change APP_URL=http://127.0.0.1:8000 (Port depending on your port)
run php artisan config:clear
then php artisan serve
npm run dev

# .env Configuration

Database Configuration
------------------------------------------------
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e-wallet
DB_USERNAME=root
DB_PASSWORD=essdev2019

DB_CONNECTION_SECOND=mysql
DB_HOST_SECOND=127.0.0.1
DB_PORT_SECOND=3306
DB_DATABASE_SECOND=v0.13.2_clean
DB_USERNAME_SECOND=root
DB_PASSWORD_SECOND=essdev2019

DB_CONNECTION_THIRD=mysql
DB_HOST_THIRD=127.0.0.1
DB_PORT_THIRD=3306
DB_DATABASE_THIRD=e-wallet-transactions
DB_USERNAME_THIRD=root
DB_PASSWORD_THIRD=admin

# For vue js Local and Production Mode
MIX_APP_ENV=local

For any further concerns regarding the project please contact the project owner.

## To the Future Developer of this project good luck.

# ######################################################################################################
# Accounts For ESS Project                                                                             #
#                                                                                                      #
# #### Gmail #######                                                                                   #
# username: essample@gmail.com                                                                         #
# password: @dmin123                                                                                   #
#                                                                                                      #
# #### Mailtrap #######                                                                                #
# For Testing Email in Local Development                                                               #
# use Gmail logged in                                                                                  #
# username: esssample@gmail.com                                                                        #
# password: @dmin123                                                                                   #
#                                                                                                      #
# ### Trello #####                                                                                     #
# username: esssample@gmail.com                                                                        #
# password: @dmindev                                                                                   #
# ######################################################################################################



# #############################################################################################################
# Guide for Creating another module                                                                           #
# SOLID Design (SRP)                                                                                          #
# PSR-2 style                                                                                                 #
# All Database changes should be created in migrations (php artisan make:migration create_test_table)         #
# make controller for Api (php artisan make:controller Api/ModuleFolder/Modulename)                           #
# make repository for controller (php artisan make:repository RepsitoryFolder/RepositoryName)                 #
# make model (php artisan make:model Models/ModelFoler/ModelName)                                             #
# make request (php artisan make:request RequestFolder/RequestName)                                           #
# Vue Js Create Component open resources/js/components create module ModuleFolder/ModuleName                  #
# and register it to the Vue Router resources/js/router/index.js check the bottom part of the code for guards #  
# #############################################################################################################
