<?php

namespace My\Framework\Core;

class Response
{
    public function setResponseCode(int $code = 404): void
    {
        http_response_code($code);
    }
}
