## Test task

### Install

- ```git clone``` project from repo
- create database, change ```.env```
- optional. you can start local web-server ```php artisan serve```
- make migration ```php artisan migrate```
- make seed ```php artisan db:seed RoleSeed``` and ```php artisan db:seed UserSeed```
- enjoy )))

### Authorize and requests

- show created user. get login and password and create follow request ```/api/login```

``` {"login":"pharber@example.com","password":"password"} ```

and get request

```{"status": true,"data": {"token": "your_token"}}```

add this token to every request in header ```authorization```

### CRUDs

- CRUD for users ```/api/users``` (only for admin)
- CRUD for quizzes ```/api/quizzes``` (only for admin)
- Change grade here ```/api/quizzes/{id}/grade``` (only for manager)
