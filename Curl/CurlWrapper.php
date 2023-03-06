<?php

namespace Curl;

use Curl\Requests\GetRequest;
use Curl\Requests\PostRequest;
use Curl\Responses\AResponse;
use Curl\Responses\ResponseTypeDecider;
use CurlHandle;
use InvalidArgumentException;
use Curl\Requests\ARequest;

class CurlWrapper{
    /**
     * @var CurlHandle cURL-Resourcen-Instanz
     */
    private CurlHandle $r_curl;

    /**
     * @var string Basis-URL für alle Aufrufe.
     */
    private string $s_baseUrl;

    /**
     * Konstruktor; Initialisiert cURL.
     * 
     * @param ?string $s_url Zu setzende URL; optional.
     */
    public function __construct(?string $s_url = null){
        $this->r_curl = curl_init();
        $this->s_baseUrl = $s_url??null;
    }

    /**
     * Ändert die Abzurufende URL des Wrappers.
     * 
     * @param string $s_url Zu setzende URL.
     * 
     * @return void
     */
    public function setUrl(string $s_url): void {
        curl_setopt($this->r_curl, CURLOPT_URL, $s_url);
    }

    /**
     * Wrapper zum Setzen von cURL-Optionen.
     * 
     * @param array $a_options Optionen, die zu setzen sind.
     * 
     * @return void
     */
    public function setOptions(array $a_options): void {
        curl_setopt_array($this->r_curl, $a_options);
    }

    /**
     * Wrapper zum Setzen von Headern. Zur Übersichtlichkeit ausgegliedert.
     * 
     * @param array $a_headers Header. die zu setzen sind.
     * 
     * @return void
     */
    public function setHeaders(array $a_headers): void {
        curl_setopt($this->r_curl, CURLOPT_HTTPHEADER, $a_headers);
    }

    /**
     * @var ARequest $o_request Request-Objekt für den Request.
     * 
     * @return AResponse Antwort des cURL Requests.
     *
     */
    public function request(ARequest $o_request): AResponse {

        if ($o_request instanceof GetRequest) {
            $s_queryString = $o_request->buildGetQueryString();
            curl_setopt($this->r_curl, CURLOPT_URL, $this->s_baseUrl . $s_queryString);
        } elseif ($o_request instanceof PostRequest) {
            curl_setopt($this->r_curl, CURLOPT_POSTFIELDS, $o_request->getData());
        } else {
            throw new InvalidArgumentException('Requests of types other than GET or POST not yet implemented!');
        }

        $s_response = curl_exec($this->r_curl);
        $i_statusCode = curl_getinfo($this->r_curl, CURLINFO_HTTP_CODE);
//        var_dump(curl_getinfo($this->r_curl)); //debugging
        return ResponseTypeDecider::decideFromData($s_response, $i_statusCode);
    }

    /**
     * Schließen der cURL-Resource.
     * 
     * @return void
     */
    public function dispose(): void {
        curl_close($this->r_curl);
    }
}