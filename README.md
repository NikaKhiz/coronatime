
<div style="display:flex; align-items: center">
  <img src="readme/assets/logo.png" alt="drawing" width="100" style="margin-right: 20px" />
  <h1 style="position:relative; top: -6px" ></h1>
</div>

---
Coronatime is a web application where people can find out about worldwide covid statistics which updates daily.the application is bilingual.users can see content of web app either at english or georgian. 
In order to see covid statistic user should be registered and validated via email link which is sent to the  user after succesful registration.
The application has login,register,verify email and reset passwords functionality.

#

### Table of Contents

-   [Prerequisites](#prerequisites)
-   [Tech Stack](#tech-stack)
-   [Getting Started](#getting-started)
-   [Migrations](#migration)
-   [Development](#development)
-   [Project Structure](#project-structure)
-   [Database Structure](#database-structure)

#

### Prerequisites

-   <img src="readme/assets/php.svg" width="35" style="position: relative; top: 4px" /> *PHP@8.1 and up*
-   <img src="readme/assets/mysql.png" width="35" style="position: relative; top: 4px" /> _MYSQL@8 and up_
-   <img src="readme/assets/npm.png" width="35" style="position: relative; top: 4px" /> _npm@8 and up_
-   <img src="readme/assets/composer.png" width="35" style="position: relative; top: 6px" /> *composer@2.3.10 and up*

#

### Tech Stack

-   <img src="readme/assets/laravel.png" height="18" style="position: relative; top: 4px" /> [Laravel@10.x](https://laravel.com/docs/10.x) - back-end framework
-   <img src="readme/assets/spatie.png" height="19" style="position: relative; top: 4px" /> [Spatie Translatable](https://github.com/spatie/laravel-translatable) - package for translation
-   <img src="readme/assets/alpine.png" height="19" style="position: relative; top: 4px" /> [Alpine Js](https://https://github.com/alpinejs/alpine) - package for javascript features
-   <img src="readme/assets/tailwind.png" height="18" style="position: relative; top: 4px" /> [TailwindCSS](https://tailwindcss.com/) - css framework

#

### Getting Started

1\. First of all you need to clone Coronatime repository from github:

```sh
git clone https://github.com/NikaKhiz/coronatime.git
```

2\. Next step requires you to run _composer install_ in order to install all the dependencies.

```sh
composer install
```

3\. after you have installed all the PHP dependencies, it's time to install all the JS dependencies:

```sh
npm install
```

4\. Now we need to set our env file. Go to the root of your project and execute this command.

```sh
cp .env.example .env
```

And now you should provide **.env** file all the necessary environment variables:

#

**MYSQL:**

> DB_CONNECTION=mysql

> DB_HOST=127.0.0.1

> DB_PORT=3306

> DB_DATABASE=**\***

> DB_USERNAME=**\***

> DB_PASSWORD=**\***

**MAIL:**

> MAIL_DRIVER=smtp

> MAIL_HOST=smtp.gmail.com

> MAIL_PORT=465

> MAIL_USERNAME=<Enter your Gmail address>

> MAIL_PASSWORD=<See instruction below>

> MAIL_ENCRYPTION=ssl

> MAIL_FROM_NAME=Newsletter

5\. Now execute in the root of you project following:

```sh
  php artisan key:generate
```

Which generates auth key.


#

### Migration

if you've completed getting started section, then migrating database if fairly simple process, just execute:

```sh
php artisan migrate
```


##### Now, you should be good to go!

#

### Development

You can run Laravel's built-in development server by executing:

```sh
  php artisan serve
```

when working on JS you may run:

```sh
  npm run dev
```

it builds your js files into executable scripts.
If you want to watch files during development, execute instead:

```sh
  npm run watch
```

it will watch JS files and on change it'll rebuild them, so you don't have to manually build them.

#

### Project Structure

```bash
├─── app
│   ├─── Console
│   ├─── Exceptions
│   ├─── Http
│   │... Models
│   ├─── Providers
│   ├─── Services
├─── bootstrap
├─── config
├─── database
├─── lang
├─── public
├─── resources
├─── routes
├─── storage
├─── tests
- .env
- artisan
- composer.json
- package.json
- phpunit.xml
```

Project structure is fairly straitforward(at least for laravel developers)...

For more information about project standards, take a look at these docs:

-   [Laravel](https://laravel.com/docs/10.x)

#

### Database Structure

In order to see database structure visit

-   [Drawsql](https://drawsql.app/teams/musketeers/diagrams/coronatime)