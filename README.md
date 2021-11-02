# <p align="center">BetMe Laravel Project</p>

</p>

## Requirements

- PHP 8
- PostGres
- Account on Pusher

## Step Up

* Create a Database for the project
* Create an account on Pusher for the project
* Run `cp .env.example .env` in the root folder of the project
* Next command `composer install`
* Then run `npm install`
* Ensure to fill the environment variable with the right credentials (Odds API secret, and Pusher credentials)
* Run `php artisan migrate --seed`
* Run `php artisan fetch-sports:all` to preload the database with all sports
* Run `php artisan serve`, `php artisan websockets:serve`, and `npm run watch` in different terminals

The websocket is for us to be get a reallife update of the upcoming matches odd, which will be updated in the background every minute through a cron job running in the server 
