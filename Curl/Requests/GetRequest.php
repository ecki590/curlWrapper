<?php

namespace Curl\Requests;

class GetRequest extends ARequest {

    /**
     * @var array Array der Daten, die in den Request sollen.
     */
    protected array $a_data;


    public function __construct(array $a_data) {
        parent::__construct($a_data);
    }


    public function buildGetQueryString(): string {
        $i_arrLength = count($this->a_data);
        reset($this->a_data);

        $s_builtString = '';
        for($i = 0; $i < $i_arrLength;) {
            $i === 0 ? $s_builtString .= "?" : $s_builtString .= '&';
            $s_builtString .= (key($this->a_data) . '=' . current($this->a_data));
            next($this->a_data);
            ++$i;
        }

        return $s_builtString;
    }
}