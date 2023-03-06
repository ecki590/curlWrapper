<?php

namespace Curl\Responses;

class StringResponse extends AResponse
{
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
        return $this->s_responseString;
    }
}