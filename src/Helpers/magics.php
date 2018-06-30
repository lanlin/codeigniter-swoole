<?php

// ------------------------------------------------------------------------------

/**
 * get CI swoole config
 *
 * @param string $name
 * @return array
 */
function getCiSwooleConfig(string $name)
{
    $pathA = APPPATH. "config/{$name}.php";

    $pathB = dirname(__FILE__). "/{$name}.php";

    $data = file_exists($pathA) ? include($pathA) : include($pathB);

    if (!is_array($data))
    {
        throw new \Exception("{$name} config file must return as array");
    }

    return $data;
}

// ------------------------------------------------------------------------------

/**
 * CI swoole intercepter
 *
 */
function ____intercepter____()
{
    try
    {
        if (!is_cli()) { return; }

        $command = trim($_SERVER['argv'][1] ?? '', '/');

        switch ($command)
        {
            // start server
            case 'swoole/server/start':
                $start = \CiSwoole\Core\Server::start();
                die("Start Server: {$start}\n");

            // stop server
            case 'swoole/server/stop':
                \CiSwoole\Core\Client::shutdown();
                die("Stop Server.\n");

            // reload server
            case 'swoole/server/reload':
                \CiSwoole\Core\Client::reload();
                die("Reload Workers.\n");

            default: return;
        }
    }
    catch (\Throwable $e)
    {
        $log  = "{$e->getMessage()}\n";
        $log .= "{$e->getTraceAsString()}\n";

        die("Operation Failed.\n{$log}");
    }
}

// ------------------------------------------------------------------------------

/**
 * Let's start perform magic tricks
 */
____intercepter____();

// ------------------------------------------------------------------------------
