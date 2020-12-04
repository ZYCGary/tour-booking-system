# tour-booking-system

[![Generic badge](https://img.shields.io/badge/Laravel-8.x-green.svg)](https://laravel.com/docs/8.x/)
[![Generic badge](https://img.shields.io/badge/Nginx-1.19-green.svg)](https://www.nginx.com/)
[![Generic badge](https://img.shields.io/badge/Mysql-5.7-green.svg)](https://www.mysql.com/)
[![Generic badge](https://img.shields.io/badge/PHP-7.4-green.svg)](https://www.php.net/downloads.php#v7.4.13)

## Installation

1. ```git clone https://github.com/ZYCGary/tour-booking-system```
2. ```composer install``` or ```composer update```
3. ```npm install -d```

## Functions need to be done:

1. List all “Public” tours
    - Go to the home page, click on **TOURS** at the header bar.
2. Edit a tour
3. Create a tour
4. Make a booking for a “Public” tour, and can only booking a “Enabled” tour date
5. Edit a booking and allow user to add/remove passenger in this booking

## Ad hoc

### Tours

1. A user can view the list of "Public" tours
2. Create a tour draft:
    1. A guest cannot view tour creation page
    2. A logged-in user can view tour creation page
    3. A guest cannot create a tour
    4. A logged-in user can create a tour draft
    5. A guest cannot view the list of tour drafts
    6. A logged-in user can view the list of tours he/she created
    7. Only the tour creator can view the list of tours he/she created
3. Publish a tour draft:
    1. A guest cannot publish a tour draft
    2. A logged-in user can publish a tour draft he/she created
    3. Only the tour creator can publish the tour draft
4. Edit a tour draft:
    1. A guest cannot edit a tour draft
    2. A logged-in user can edit a tour draft he/she made.
