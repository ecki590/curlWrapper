<?php

namespace Curl\Responses;

abstract class AResponse {
    
    /**
     * @var string Antwort-String eines Requests (Response) BEVOR dieser dekodiert oder weiter behandelt wird.
     */
    protected string $s_responseString;

    /**
     * @var int HTTP-Status-Code der Antwort.
     */
    protected int $i_statusCode;

    /**
     * Konstruktor.
     */
    protected function __construct(string $s_responseString, int $i_statusCode) {
        $this->s_responseString = $s_responseString;
        $this->i_statusCode = $i_statusCode;
    }

    /**
     * Funktion zum Dekodieren des Ergebnisses; wird in den Unterklassen implementiert.
     */
    abstract public function decode(): array|string;
}