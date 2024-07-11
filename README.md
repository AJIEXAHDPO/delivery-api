## About 
Api for delivery service to create and orders and assign it to the couriers. 
Powered by Laravel framework.
## Functional 
Api supports bearer token authentication. To log in use `email` and `password` to get a new token.
- `POST /api/login` - log in to a server. Creates a new bearer token and returns it in response.
- `POST /api/login` - logout from a server. Delete all current user tokens.
- `POST /api/couriers` - creating couriers. Returns created couriers info with Id.
- `POST /api/orders` - creating orders. Return an array of created orders with Id.
- `POST /api/orders/assign` - assign an order. Returns created courier info with Id.
## Testing 
For testing api by the Swagger UI open 
`/api/documentation`
## Install
Clone repository on your device.
into the project folder `cd delivery -api`
Run docker container
```sh
docker-compose up --build d
```
Get into php container bash
```
docker-compose exec -it delivery_php bash
```
Execute the comands below under the php container
Got to the app folder `cd /var/www/http`
Install all dependencies `composer install`
Migrate database and seed it
`php artisan migrate`
`php artisan db:seed`
Allow credentials for current user to a storage folder
`chmod +rwx storage`
Go to the `localhost:8000` to start the app