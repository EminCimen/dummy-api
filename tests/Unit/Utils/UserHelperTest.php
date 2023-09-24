<?php

use EminCimen\DummyApi\Utils\UserHelper;
use Mockery;
use PHPUnit\Framework\TestCase;

class UserHelperTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testGenerateUrl()
    {
        $page = 2;
        $expectedUrl = 'https://reqres.in/api/users?page=2';
        $generatedUrl = UserHelper::generateUrl($page);

        $this->assertEquals($expectedUrl, $generatedUrl);
    }
}
