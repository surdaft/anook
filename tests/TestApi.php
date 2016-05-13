<?php namespace surdaft\tests;

use surdaft\tests\BaseTest;

use surdaft\anook\helpers\Debug;

use surdaft\anook\libs\api\Api;

class TestApi extends BaseTest
{
    public function testApiQuery()
    {
        $api_call = Api::query('users/surdaft', ['debug' => true])->curl();
        
        // is it returning a request
        $this->assertTrue(is_a($api_call, 'surdaft\anook\libs\api\Request'));
        
        Debug::printExit($api_call);
    }
}