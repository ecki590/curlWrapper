<?php

namespace Curl\Requests;

class PostRequest extends ARequest {
    /**
     * @var array Array der Daten, die in den Request sollen.
     */
    protected array $a_data;

    public function __construct(array $a_data) {
        parent::__construct($a_data);
    }


    public function getData(): array {
        return $this->a_data;
    }
}