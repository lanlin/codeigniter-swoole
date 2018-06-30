<?php namespace CiSwooleTests;

use CiSwoole\Core\Client;
use PHPUnit\Framework\TestCase;

/**
 * ----------------------------------------------------------------------------------
 * CI Swolle Client Tests
 * ----------------------------------------------------------------------------------
 *
 * @update lanlin
 * @change 2018/06/30
 */
class TestUtil extends TestCase
{

    // ------------------------------------------------------------------------------

    public function testClientSend()
    {
        try
        {
            $check = true;

            Client::send(
            [
                'route'  => 'tests/test/abc',
                'params' => ['demo' => '666'],
            ]);
        }
        catch (\Exception $e)
        {
            $check = false;

            print_r($e->getMessage());
            print_r($e->getTraceAsString());
        }

        $this->assertTrue($check);
    }

    // ------------------------------------------------------------------------------

}
