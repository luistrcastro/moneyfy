<?php

namespace App\Services;

use Cog\Laravel\Optimus\Facades\Optimus;
use Exception;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Throwable;

class HashableService
{

    private static array $hashMap;

    /**
     * Gets hashmap array from config.
     * @return array
     */
    public static function hashMap(): array
    {
        if (isset(self::$hashMap)) {
            return self::$hashMap;
        }

        return self::$hashMap = config('optimusRelationships.hashMap');
    }

    /**
     * Encodes value
     *
     * @param string $hashableConnection
     * @param $value
     *
     * @return null|int
     */
    public static function getHash(?int $value, string $hashableConnection = 'main'): ?int
    {
        if (is_null($value)) {
            return null;
        }

        try {
            $hash = Optimus::connection($hashableConnection);

            return $hash->encode($value);
        } catch (InvalidArgumentException) {
            $hashMap = self::hashMap();
            $hash = Optimus::connection($hashMap[$hashableConnection]);

            return $hash->encode($value);
        }
    }

    /**
     * Returns id from hashed value.
     *
     * @param int|null    $hashId
     * @param string|null $providedHashableConnection
     *
     * @return null|int
     * @throws Exception
     */
    public static function decodeHash(?int $hashId, string $hashableConnection = 'main'): ?int
    {
        if (is_null($hashId)) {
            return null;
        }

        try {
            $hash = Optimus::connection($hashableConnection);

            return $hash->decode($hashId);
        } catch (Throwable $e) {
            try {
                $hashMap = self::hashMap();
                $hash = Optimus::connection($hashMap[$hashableConnection]);
                return $hash->decode($hashId);
            } catch (Throwable $e) {
                Log::warning('No Hash for Provided Hash Key Found', ['providedHashKey' => $hashableConnection]);
                return $hashId;
            }
        }
    }
}
