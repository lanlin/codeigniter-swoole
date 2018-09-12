
## Codeigniter Swoole Adapter

You want long-run task? timers? FPM to CLI? Code reusing in both FPM & CLI mode?

"It's so easy!"

This adapter would make it so easy to using swoole within Codeigniter framework.

With this adapter, you can start a task(CLI) any where(FPM) you want from your code.

That's means you can start a CLI task from a FPM process.


## Install

```shell
composer require lanlin/codeigniter-swoole
```


## How to

1. first, of course you must install `codeigniter-swoole` to your codeigniter project.
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


## A little more

The step 2 copied files were config files for this adapter.

`swoole.php` file can set host, port, log file and so on.

`timers.php` file can set some timer methods for swoole server, these timers will be started once the server inited.

You can copy `tests/application` to your `application` for testing. The demos are same as below shows.


```php
class Test extends CI_Controller
{

    // ------------------------------------------------------------------------------

    /**
     * here's the task 'tests/test/task'
     */
    public function task()
    {
        $data = $this->input->post();     // as you see, params worked like normally post data

        log_message('info', var_export($data, true));
    }

    // ------------------------------------------------------------------------------

    /**
     * here's the timer method
     *
     * you should copay timers.php to your config folder,
     * then add $timers['tests/test/task_timer'] = 10000; and start the swoole server.
     *
     * this method would be called every 10 seconds per time.
     */
    public function task_timer()
    {
        log_message('info', 'timer works!');
    }

    // ------------------------------------------------------------------------------

    /**
     * send data to task
     */
    public function send()
    {
        try
        {
            \CiSwoole\Core\Client::send(
            [
                'route'  => 'tests/test/task',
                'params' => ['hope' => 'it works!'],
            ]);
        }
        catch (\Exception $e)
        {
            log_message('error', $e->getMessage());
            log_message('error', $e->getTraceAsString());
        }
    }

    // ------------------------------------------------------------------------------

}
```


## License

This project is licensed under the MIT license.
