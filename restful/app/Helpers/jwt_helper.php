<?php

use App\Models\AuthModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($header)
{
    if (is_null($header)) {
        throw new Exception("Signature authentication failed");
    }
    return explode(" ", $header)[1];
}

function validateJWT($encodedToken)
{
    $key = getenv('JWT_SECRET_KEY');
    $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));

    $modelAuth = new AuthModel();
    $modelAuth->getUsername($decodedToken->username);
}

function createJWT($username)
{
    $waktuRequest = time();
    $durasiToken = getenv('JWT_TIME_TO_LIVE');
    $waktuExpired = $waktuRequest + $durasiToken;
    $key = getenv('JWT_SECRET_KEY');

    $payload = [
        'time'      => $waktuRequest,
        'username'  => $username,
        'iat'       => $waktuRequest,
        'exp'       => $waktuExpired
    ];
    $jwt = JWT::encode($payload, $key, 'HS256');

    return $jwt;
}
