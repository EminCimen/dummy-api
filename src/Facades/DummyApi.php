<?php

namespace EminCimen\DummyApi\Facades;

use EminCimen\DummyApi\DummyApiCore;
use Illuminate\Support\Facades\Facade;

/**
 * @see \EminCimen\DummyApi\DummyApi
 */
class DummyApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \EminCimen\DummyApi\DummyApiCore::class;
    }

    public static function getSingleUser($id)
    {
        return DummyApiCore::getSingleUser($id);
    }

    public static function getPaginatedUserList($page)
    {
        return DummyApiCore::getPaginatedUserList($page);
    }

    public static function createUser($data)
    {
        return DummyApiCore::createUser($data);
    }
}
