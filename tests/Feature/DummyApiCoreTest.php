<?php

namespace EminCimen\DummyApi\Tests\Feature;

use EminCimen\DummyApi\DummyApiCore;
use EminCimen\DummyApi\Tests\TestCase;
use Mockery;

class DummyApiCoreTest extends TestCase
{
    /** @test */
    public function testCanGetSingleUser()
    {
        $mockResponse = Mockery::mock('alias:Response');
        $mockDTO = Mockery::mock('EminCimen\DummyApi\ValueObjects\UserDTO');
        $mockRequestHelper = Mockery::mock('alias:RequestHelper');

        $mockResponse->data = (object) [
            'id' => '1',
            'email' => 'george.bluth@reqres.in',
            'first_name' => 'George',
            'last_name' => 'Bluth',
            'avatar' => 'https://reqres.in/img/faces/1-image.jpg',
        ];

        $mockRequestHelper->shouldReceive('get')
            ->with('https://reqres.in/api/users/1')
            ->andReturn($mockResponse);

        $userJson = DummyApiCore::getSingleUser(1);

        $expectedJson = json_encode([
            'id' => '1',
            'email' => 'george.bluth@reqres.in',
            'first_name' => 'George',
            'last_name' => 'Bluth',
            'avatar' => 'https://reqres.in/img/faces/1-image.jpg',
        ]);

        $mockDTO->shouldReceive('fromData')
            ->with($mockResponse->data, true)
            ->andReturn($mockResponse->data);

        $this->assertSame($expectedJson, $userJson);
    }

    /** @test */
    public function testReturnsErrorForMissingUser()
    {
        $mockRequestHelper = Mockery::mock('alias:RequestHelper');
        $mockRequestHelper->shouldReceive('get')
            ->with('https://reqres.in/api/users/999')
            ->andReturnNull();

        $errorMessage = DummyApiCore::getSingleUser(999);

        $this->assertSame('Unexpected error or user not found', $errorMessage);
    }

    /** @test */
    public function testGetPaginatedUserList()
    {
        $mockResponse = Mockery::mock('alias:Response');
        $mockRequestHelper = Mockery::mock('alias:RequestHelper');

        $mockResponse->data = [
            (object) [
                'id' => '7',
                'email' => 'michael.lawson@reqres.in',
                'first_name' => 'Michael',
                'last_name' => 'Lawson',
                'avatar' => 'https://reqres.in/img/faces/7-image.jpg',
            ],
            (object) [
                'id' => '8',
                'email' => 'lindsay.ferguson@reqres.in',
                'first_name' => 'Lindsay',
                'last_name' => 'Ferguson',
                'avatar' => 'https://reqres.in/img/faces/8-image.jpg',
            ],
            (object) [
                'id' => '9',
                'email' => 'tobias.funke@reqres.in',
                'first_name' => 'Tobias',
                'last_name' => 'Funke',
                'avatar' => 'https://reqres.in/img/faces/9-image.jpg',
            ],
            (object) [
                'id' => '10',
                'email' => 'byron.fields@reqres.in',
                'first_name' => 'Byron',
                'last_name' => 'Fields',
                'avatar' => 'https://reqres.in/img/faces/10-image.jpg',
            ],
            (object) [
                'id' => '11',
                'email' => 'george.edwards@reqres.in',
                'first_name' => 'George',
                'last_name' => 'Edwards',
                'avatar' => 'https://reqres.in/img/faces/11-image.jpg',
            ],
            (object) [
                'id' => '12',
                'email' => 'rachel.howell@reqres.in',
                'first_name' => 'Rachel',
                'last_name' => 'Howell',
                'avatar' => 'https://reqres.in/img/faces/12-image.jpg',
            ],
        ];

        $mockPage = 2;
        $mockUrl = 'https://reqres.in/api/users?page='.$mockPage;

        $mockRequestHelper->shouldReceive('get')
            ->with($mockUrl)
            ->andReturn($mockResponse);

        $result = DummyApiCore::getPaginatedUserList($mockPage);

        $expectedResult = json_encode([
            'data' => [
                json_encode([
                    'id' => '7',
                    'email' => 'michael.lawson@reqres.in',
                    'first_name' => 'Michael',
                    'last_name' => 'Lawson',
                    'avatar' => 'https://reqres.in/img/faces/7-image.jpg',
                ]),
                json_encode([
                    'id' => '8',
                    'email' => 'lindsay.ferguson@reqres.in',
                    'first_name' => 'Lindsay',
                    'last_name' => 'Ferguson',
                    'avatar' => 'https://reqres.in/img/faces/8-image.jpg',
                ]),
                json_encode([
                    'id' => '9',
                    'email' => 'tobias.funke@reqres.in',
                    'first_name' => 'Tobias',
                    'last_name' => 'Funke',
                    'avatar' => 'https://reqres.in/img/faces/9-image.jpg',
                ]),
                json_encode([
                    'id' => '10',
                    'email' => 'byron.fields@reqres.in',
                    'first_name' => 'Byron',
                    'last_name' => 'Fields',
                    'avatar' => 'https://reqres.in/img/faces/10-image.jpg',
                ]),
                json_encode([
                    'id' => '11',
                    'email' => 'george.edwards@reqres.in',
                    'first_name' => 'George',
                    'last_name' => 'Edwards',
                    'avatar' => 'https://reqres.in/img/faces/11-image.jpg',
                ]),
                json_encode([
                    'id' => '12',
                    'email' => 'rachel.howell@reqres.in',
                    'first_name' => 'Rachel',
                    'last_name' => 'Howell',
                    'avatar' => 'https://reqres.in/img/faces/12-image.jpg',
                ]),
            ],
            'page' => 2,
            'total_pages' => 2,
            'per_page' => 6,
            'next_page' => null,
        ]);

        $this->assertSame($expectedResult, $result);
    }

    /** @test */
    public function testReturnsErrorForMissingPage()
    {
        $mockRequestHelper = Mockery::mock('alias:RequestHelper');
        $mockRequestHelper->shouldReceive('get')
            ->with('https://reqres.in/api/users?page=999')
            ->andReturnNull();

        $result = DummyApiCore::getPaginatedUserList(999);
        $errorMessage = '{"data":[],"page":999,"total_pages":2,"per_page":6,"next_page":null}';

        $this->assertSame($errorMessage, $result);
    }
}
