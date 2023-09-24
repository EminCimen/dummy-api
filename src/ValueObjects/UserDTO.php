<?php

namespace EminCimen\DummyApi\ValueObjects;

class UserDTO
{
    public function __construct(
        public string $id,
        public string $email,
        public string $first_name,
        public string $last_name,
        public string $avatar,
    ) {
    }

    public static function fromData(mixed $data, bool $returnJson = false): UserDTO|string
    {
        $data = new self(
            id: $data->id,
            email: $data->email,
            first_name: $data->first_name,
            last_name: $data->last_name,
            avatar: $data->avatar,
        );

        if ($returnJson) {
            return json_encode($data);
        }

        return $data;
    }
}
