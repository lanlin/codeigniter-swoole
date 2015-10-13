# CodeIgniter-Swoole

CodeIgniter-Swoole (You need using it within CodeIgniter)

This simple package is combind with CodeIgniter.

So that we can use Swoole in a single CI framework.

Normally we only want to start a single server side in CLI,

but connect with multi client side. codeigniter-swoole is the one.

Detail useage see the demo directory, if you formiliar with

CI.

Before start the server side, you should make sure has swoole installed

aready, and of course CI required.

------------------------------------------------------------------------------

CLI Commond:> cd "to your ci root directory"

CLI Commond:> php index.php swoole start      // start server from swoole.php

CLI Commond:> php index.php swoole stop       // stop server

CLI Commond:> php index.php swoole reload     // reload all workers

------------------------------------------------------------------------------

That's all, @end, sorry about my english.
