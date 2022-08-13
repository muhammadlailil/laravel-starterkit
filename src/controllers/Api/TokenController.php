<?php

namespace laililmahfud\starterkit\controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use laililmahfud\starterkit\helpers\JwtToken;
use laililmahfud\starterkit\constanta\ErrorType;
use laililmahfud\starterkit\helpers\JsonResponse;

class TokenController extends Controller
{
    public function getToken(Request $request)
    {
        $token = $request->header('authorization');
        $token = str_replace('Bearer ', '', $token);
        $token = base64_decode($token);
        $tokens = explode('|', $token);
        if ($tokens[0] == date('Y-m-d') && $tokens[1] == config('starterkit.api_key')) {
            $token = JwtToken::createToken([
                'scope' => 'auth',
            ], '+1 hours');
            return Response::oke($token);
        }
        return JsonResponse::Unauthorized('Token invalid', ErrorType::$INVALID_TOKEN);
    }

    public function renewToken(Request $request)
    {
        $token = $request->header('authorization');
        try {
            $payload = JwtToken::decode($token);
            $token = JwtToken::createToken($payload->data);
            return JsonResponse::oke($token);
        } catch (\Exception $e) {
            if ($e->getMessage() == "Expired token") {
                list($header, $payload, $signature) = explode(".", $token);
                $payload = json_decode(base64_decode($payload));
                $token = JwtToken::createToken($payload->data);
                return JsonResponse::oke($token);
            }
        }
        return JsonResponse::Unauthorized('Token invalid', ErrorType::$INVALID_TOKEN);
    }
}
