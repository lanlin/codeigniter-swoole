# CodeIgniter-Swoole

CodeIgniter-Swoole (You need using it within CodeIgniter)

This simple package is combind with CodeIgniter.

So that we can use Swoole in a single CI framework.

Normally we only want to start a single server side in CLI,

but connect with multi client side. codeigniter-swoole is the one.

Detail useage see the demo directory, if you formiliar with CI.
 
# Useage

Please view the code in demo directory. 

The [b]"Swoole.php"[/b] controller

file you must copy into your 

[b]"codeigniter/application/controllers/Swoole.php"[/b]

Use this package, you can run your CI with nginx, and same time run CI
 
in CLI. So, you can call the CI run in CLI through fpm, post data to it,
  
make a long run time possible.  

# Require

Before start the server side, you should make sure has swoole installed

aready, and of course CI required.

# Command

#------------------------------------------------------------------------------

CLI Command:> cd "to your ci root directory"

CLI Command:> php index.php swoole start      // start server from swoole.php

CLI Command:> php index.php swoole stop       // stop server

CLI Command:> php index.php swoole reload     // reload all workers

#------------------------------------------------------------------------------

That's all, @end, sorry about my english.
