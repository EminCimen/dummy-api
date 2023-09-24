<?php

use EminCimen\DummyApi\ValueObjects\UserDTO;
use PHPUnit\Framework\TestCase;

class UserDTOTest extends TestCase
{
    public function testCreateUserDTOFromData()
    {
        $userData = (object) [
            'id' => '1',
            'email' => 'test@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'avatar' => 'https://example.com/avatar.jpg',
        ];

        $userDTO = UserDTO::fromData($userData);

        $this->assertInstanceOf(UserDTO::class, $userDTO);
        $this->assertEquals('1', $userDTO->id);
        $this->assertEquals('test@example.com', $userDTO->email);
        $this->assertEquals('John', $userDTO->first_name);
        $this->assertEquals('Doe', $userDTO->last_name);
        $this->assertEquals('https://example.com/avatar.jpg', $userDTO->avatar);
    }

    public function testCreateUserDTOAsJson()
    {
        $userData = (object) [
            'id' => '1',
            'email' => 'test@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'avatar' => 'https://example.com/avatar.jpg',
        ];

        $userJson = UserDTO::fromData($userData, true);

        $this->assertIsString($userJson);

        $decodedUser = json_decode($userJson, true);

        $this->assertEquals('1', $decodedUser['id']);
        $this->assertEquals('test@example.com', $decodedUser['email']);
        $this->assertEquals('John', $decodedUser['first_name']);
        $this->assertEquals('Doe', $decodedUser['last_name']);
        $this->assertEquals('https://example.com/avatar.jpg', $decodedUser['avatar']);
    }
}
