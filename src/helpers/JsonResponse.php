<?php
namespace Laililmahfud\Starterkit\helpers;

class JsonResponse
{
    public static function Oke($data)
    {
        response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $data,
        ], 200)->send();
        exit();
    }

    public static function Data($data, $message)
    {
        response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data,
        ], 200)->send();
        exit();
    }

    public static function Message($message)
    {
        response()->json([
            'status' => 200,
            'message' => $message
        ], 200)->send();
        exit();
    }

    public static function Unauthorized($message,$err)
    {
        response()->json([
            'status' => 401,
            'error' => $err,
            'message' => $message
        ], 401)->send();
        exit();
    }

    public static function BadRequest($message)
    {
        response()->json([
            'status' => 400,
            'error' => 'bad_request',
            'message' => $message
        ], 400)->send();
        exit();
    }

    public static function Forbidden($message)
    {
        response()->json([
            'status' => 403,
            'error' => 'forbidden',
            'message' => $message
        ], 403)->send();
        exit();
    }
}
