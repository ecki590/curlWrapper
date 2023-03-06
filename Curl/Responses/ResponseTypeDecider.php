<?php

namespace Curl\Responses;

final class ResponseTypeDecider
{
    public static function decideFromData(string $ps_data, int $pi_statusCode): AResponse {
        if (false === json_decode($ps_data, false)) {
            //TODO: Andere Content-Typen implementieren, Catch-All(String) dann irgendwann entfernen!
            return new StringResponse($ps_data, $pi_statusCode);
        } else {
            return new JsonResponse($ps_data, $pi_statusCode);
        }
    }
}