<?php

namespace Curl\Responses;

use \InvalidArgumentException;
use Curl\Responses\AResponse;

class JsonResponse extends AResponse {

    /**
     * Konstruktor.
     */
    public function __construct(string $s_responseString, int $i_statusCode) {
        parent::__construct($s_responseString, $i_statusCode);
    }

    /**
     * Dekodiert den Response-String als ein JSON-Objekt.
     */
    public function decode(): array|string {
        $_retArr = json_decode($this->s_responseString, true);
        /*TODO: Exception-Handling*/
        if (false === $_retArr) throw new InvalidArgumentException('AAAAAAAA', 1);
        return $_retArr;
    }
}