<?php

namespace EminCimen\DummyApi\Utils;

use EminCimen\DummyApi\ValueObjects\UserDTO;

class UserHelper
{
    public const BASE_URL_FOR_PAGINATED_USER = 'https://reqres.in/api/users?page=';

    public static function generateUrl(int $page): string
    {
        return self::BASE_URL_FOR_PAGINATED_USER.$page;
    }

    public static function makeRequest(string $url)
    {
        return RequestHelper::get($url);
    }

    public static function mapUserData(array $userData): array
    {
        return array_map(function ($user) {
            return UserDTO::fromData($user, true);
        }, $userData);
    }
}
