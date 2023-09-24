<?php

namespace EminCimen\DummyApi\Utils;

use Exception;

class RequestHelper
{
    public static function get($url, $headers = [])
    {
        return self::request('GET', $url, [], $headers);
    }

    public static function post($url, $data = [], $headers = [])
    {
        return self::request('POST', $url, $data, $headers);
    }

    public static function put($url, $data = [], $headers = [])
    {
        return self::request('PUT', $url, $data, $headers);
    }

    public static function delete($url, $headers = [])
    {
        return self::request('DELETE', $url, [], $headers);
    }

    public static function head($url, $headers = [])
    {
        return self::request('HEAD', $url, [], $headers);
    }

    private static function request($method, $url, $data = [], $headers = [], $timeout = 30, $maxRetries = 3)
    {
        $retryCount = 0;
        $waitTime = 1;  // starting with 1 second

        while ($retryCount <= $maxRetries) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

            switch (strtoupper($method)) {
                case 'POST':
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    break;
                case 'PUT':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                    break;
                case 'DELETE':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    break;
                case 'HEAD':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD');
                    break;
            }

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                $error = curl_error($ch);
                curl_close($ch);
                if ($retryCount >= $maxRetries) {
                    throw new Exception("Request error: {$error}");
                } else {
                    $retryCount++;
                    sleep($waitTime);
                    $waitTime *= 2;  // exponential backoff

                    continue;
                }
            }

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode == 404) {
                return null;
            }

            if ($httpCode >= 400) {
                if ($retryCount >= $maxRetries) {
                    throw new Exception("Request failed with status code {$httpCode}", $httpCode);
                } else {
                    $retryCount++;
                    sleep($waitTime);
                    $waitTime *= 2;  // exponential backoff

                    continue;
                }
            }

            return json_decode($response);
        }
    }
}
