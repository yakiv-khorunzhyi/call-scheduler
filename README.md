## Deployment

#### Requirements:

- Installed docker and docker-compose

We have several steps, please execute commands from root path of project

#### Copy environment variables:
```cp .env.example .env```

#### Download and run our containers in background:

```docker-compose up -d```

#### Install packages:

```docker exec -it app composer install --ignore-platform-reqs```

#### Execute tests:

```docker exec -it app php artisan test```

#### Start listening queue:

```docker exec -it app php artisan queue:work```

#### Start our server:

```docker exec -it app php -S 0.0.0.0:8000 -t public```

#### Open one of these links in your browser: 

- For Windows:
http://localhost:8000/

- For Linux:
http://0.0.0.0:8000/

#### Enjoy it
