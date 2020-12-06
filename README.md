# tour-booking-system

[![Generic badge](https://img.shields.io/badge/Laravel-8.x-green.svg)](https://laravel.com/docs/8.x/)
[![Generic badge](https://img.shields.io/badge/Nginx-1.19-green.svg)](https://www.nginx.com/)
[![Generic badge](https://img.shields.io/badge/Mysql-5.7-green.svg)](https://www.mysql.com/)
[![Generic badge](https://img.shields.io/badge/PHP-7.4-green.svg)](https://www.php.net/downloads.php#v7.4.13)
## Introduction
This Laravel application is a demo of Online Tour Booking System. It is developed via TDD(Test-drive Development).

In addition to the basic requirements, an authentication procedure is added in the application for tours creation 
and publication. 

Practically, authentication should also be used in booking functions, so that further optimisations should be made.

## Installation

1. ```> git clone https://github.com/ZYCGary/tour-booking-system```
2. ```> composer install``` or ```> composer update```
3. ```> npm install -d```
4. Data migration & seeding: ```$ php artisan migrate:refresh --seed```
5. **Docker** is recommended to run the application

## Testing
Run ```$ phpunit``` to run testing code.

## Functions need to be done:

1. List all “Public” tours
    - Go to the home page, click on **TOURS** at the header bar
2. Create a tour
    - A user must log in to create a tour
3. Edit a tour
    - A user must log in to edit his/her tours
    - A user must log in to publish his/her draft tours
4. Make a booking for a “Public” tour, and can only booking a “Enabled” tour date
5. Edit a booking and allow user to add/remove passenger in this booking

## Ad hoc

### Tours

1. View tours
    1. A user can view the list of "Public" tours
    2. A user can view the detail of "Public" tours
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
    2. A logged-in user can edit a tour he/she made.
    3. A logged-in user can only edit his/her tours.

### Bookings

1. View bookings
    1. A user can view the booking list
2. Book a tour
    1. A user can book a public tour on an enabled tour date
    2. A user can only book a public tour
    3. A user cannot book a tour on a disabled tour date
3. Edit a booking
    1. A user can go to the booking editing page
    2. A user can add/remove passengers
4. Update a booking:
    1. Booking details will be updated
    2. New passengers will be added
    3. New booking-passenger link will be added
    4. Links between the booking and deleted passengers will be deleted

## Analysis
According to the given business architecture, following functions are expected to be realised:

### Authentication
1. Authentication for "Tours" operations
2. Authentication for "Bookings" operations

### Tours
1. User can delete a tour (draft/public)
2. User can set price for a tour

### Bookings
1. User can confirm a tour booking
2. User can cancel a tour booking

### Payment
1. An invoice can be generated after a booking
2. User can purchase an invoice

### Advanced
1. User can re-schedule a booking after purchasing
2. User can cancel a purchased tour can get refund
3. Tour capacity may be added to enable multiple tour booking for a same date
4. The administration dashboard is needed for customer service and management
