
## Codeigniter Swoole Adapter

This adapter would make it easy to using swoole within Codeigniter framework.

With this adapter, you can start a task(CLI) any where(FPM) you want from your code.

That's means you can start a CLI task from a FPM process.


## Install

```shell
composer require lanlin/codeigniter-swoole
```


## How to

1. first, of course you must install `codeigniter-swoole` in your codeigniter project.
2. (this step is option) copy these two config files `swoole.php` and `timers.php` from `src/Helper` to your `application/config` folder.
3. start swoole server `php index.php swoole/server/start`
4. you can use `\CiSwoole\Core\Client::send($data)` to start a task now!
5. there's no step 5.


## What is a task?
A task is just a method of your codeigniter controlloer, so almost any controller method can be used as a task.

Let's see the code

```php
\CiSwoole\Core\Client::send(
[
    'route'  => 'your/route/uri/to/a/method'
    'params' => ['test' => 666]
]);
```

The `route` is used for find which method to be call as a task, and `params` is the parameters array that you may want to pass to the task.

So, that's all of it!


## Server CLI Commands

```shell

// start the swoole server
php index.php swoole/server/start

// stop the swoole server
php index.php swoole/server/stop

// reload all wokers of swoole server
php index.php swoole/server/reload

```


## License

This project is licensed under the MIT license.
