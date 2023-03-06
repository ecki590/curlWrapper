<?php

namespace Curl\Requests;

abstract class ARequest {
    /** TODO!! */

    /**
     * @var array Daten, die in den Request gepackt werden sollen.
     */
    protected array $a_data;

    protected function __construct(array $a_data) {
        $this->a_data = $a_data;
    }
}