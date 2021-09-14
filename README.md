# Subscription Management

This study is developed by using Symfony Framework, MySQL Database by following Chain Of Responsibility Design Pattern.

#### Local Development

- First, clone the docker project by this link: [https://github.com/alperenuzun/docker-nginx-php-mysql](https://github.com/alperenuzun/docker-nginx-php-mysql)
- Then clone this repository in the same directory with docker project.
- Run `docker-compose -f docker-compose.yml up -d`
- Go to php container `docker exec -it php73 bash`
- Set up the libraries `composer install`
- Start the server `symfony server:start`

Also, to be able to have tables, create the migration command like:
* bin/console make:migration

#### Database Schemas 

DB schemas can be found in `migrations` folder.

Subscription table is designed as unique for every client to obtain better the performance in the worker.

**Note**: Token schema is created in Mysql database for now, 
but it will be implemented by cache(redis or memcached).

#### Module Structure

In this project, Chain of Responsibility pattern is used. So, in `Modules` folder, different modules are placed
for the infrastructure, and they have manager, chain handlers and some other helpers.

#### Event Dispatchers

All dispatched events assumed that they are handled by asynchronous events using Rabbitmq. So, events will be dispatched 
through producer and the event subscribers will be inside the consumers.

#### Token Handler Middleware

In the project, token controls are handled by `TokenAuthenticatedController` interface.

#### Global Error Handling

If we encounter with an error, it will be caught by `ResponseListener`. 
Could be error mapping here by using Symfony translations.

#### Worker Command

The command can be run in php container by this command: `bin/console subscription:update:command`.
In this command, the subscription table is assumed that every client has only a row for their subscription status.
So, the count of rows to fetch is determined as 10000. This number could be changed according to the execution time of 
the cron job, the period of the rows updated etc.

**Recommendation**: Can be a reader command fetching determined count of rows in the database and then dispatch 
the data to the queue, and if we have many workers that update these lines, like a load balancer we could obtain faster
results. Even further, the reader command can have many instance by processing another check table. So, simultaneously 
many lines can be processed.

#### Todo

- Handle tokens by caching.
- Event dispatchers will fix as async events.
- Worker command should work like a load balancer as mentioned above.

