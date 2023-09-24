<?php

namespace EminCimen\DummyApi;

use EminCimen\DummyApi\Utils\RequestHelper;
use EminCimen\DummyApi\Utils\UserHelper;
use EminCimen\DummyApi\ValueObjects\UserDTO;
use Exception;

class DummyApiCore
{
    public static function getSingleUser($id): string|UserDTO
    {
        try {
            $url = 'https://reqres.in/api/users/'.$id;
            $response = RequestHelper::get($url);

            if ($response && $response->data) {
                return UserDTO::fromData($response->data, true);
            }

            return 'Unexpected error or user not found';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getPaginatedUserList(int $page): string
    {
        try {
            $url = UserHelper::generateUrl($page);

            $response = UserHelper::makeRequest($url);

            if (! $response) {
                throw new Exception('Failed to fetch the user list');
            }

            $list = [
                'data' => UserHelper::mapUserData($response->data),
                'page' => $response->page,
                'total_pages' => $response->total_pages,
                'per_page' => $response->per_page,
                'next_page' => ($response->total_pages == $page || empty($response->data)) ? null : $page + 1,
            ];

            return json_encode($list);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function createUser($data): ?string
    {
        $url = 'https://reqres.in/api/users';
        $response = RequestHelper::post($url, $data);

        if ($response && $response->createdAt) {
            return $response->id;
        }

        return 'Unexpected error or user not found';
    }
}
