<?php
namespace laililmahfud\starterkit\helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtToken
{
    protected static $algorithm = 'HS256';

    public static function createToken($data, $exp = '+1 days')
    {
        $iss = env('APP_NAME');
        $expired = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . $exp));
        $expired = new \DateTime($expired);
        $expired = $expired->getTimestamp();
        $payload = [
            'exp' => $expired,
            'iss' => $iss,
            'data' => $data,
        ];

        return [
            'token' => JWT::encode($payload, config('starterkit.jwt_secret'), self::$algorithm),
            'expiredAt' => $expired
        ];
    }

    public static function decode($token){
        $token = str_replace('Bearer ','',$token);
        return JWT::decode($token, new Key(config('starterkit.jwt_secret'), self::$algorithm));
    }
}
