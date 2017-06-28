## Requirements
This application based on Laravel 5.4. [see the requirements](https://laravel.com/docs/5.4#server-requirements)
In addition to that this application use MySQL as database (developed on MariaDB 10.1).
To run the tests you have to make sure PHPUnit is configured correctly on your machine.
Also you need to have a working internet connection because this application uses CDN to pull some javascript libraries.
( Of course who doesn't have internet connection these days. Even cats have it ! )


## Setup Instructions

1). Create two MySQL databases,
- techassessmentlaravelphp ( this will be the application main database)
- techassessmentlaravelphp_test ( this will be the application test database)
- execute provided SQL dumps on relevant database 
- techassessmentlaravelphp.sql => techassessmentlaravelphp database
- techassessmentlaravelphp_test.sql =>  techassessmentlaravelphp_test database

2). Create .env file on project root and configure your database connection. ( See .env.example).

2). Fire up a terminal, navigate to the project root and run **composer install**.

3). That's it !

## Running the Application

Fire up a terminal, navigate to the project root and issue **php artisan serve** .
Now you can view the retention curve chart by visiting The [localhost](http://localhost:8000/)

## Running the Tests

Fire up a terminal, navigate to the project root and issue **phpunit** .
