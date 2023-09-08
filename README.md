# CRUD Laravel React

Demo CRUD Laravel React

## Structure

```
Project structure
|- laravel: Api for app using laravel 10
|- webapp: Web appliaction using NextJs                        

```

### Framework

- Backend: [Laravel 10](https://laravel.com/docs/10.x)
- Frontend: [NextJs 13](https://nextjs.org/docs)

### Require server

- Php 8.2
- Node v18.14.0
- [Docker](https://docs.docker.jp) 
- Docker compose

### Run Application

#### 1 Run api
#### 1.1 Build docker

```sh
cd laravel
make build && make up
```

#### 1.2 Create env

```sh
cd laravel
cp .env.example .env
```

#### 1.3 Install packages

```sh
cd laravel
docker-compose exec app bash
composer install
```

#### 2 Run web application

#### 2.1 Install node with nvm

```sh
$ nvm install v18.14.0
$ nvm use v18.14.0
$ node -v

v18.14.0
```

#### 2.2 Run web application

```sh
cd webapp
npm install
npm run dev
```

#### 3. Access to application
- Api: http://localhost:8002
- Web app: http://localhost:3000/users

#### 4. Down application

```sh
cd laravel
make down
```
