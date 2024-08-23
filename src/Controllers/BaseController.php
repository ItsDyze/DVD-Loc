<?php

namespace Controllers;

abstract class BaseController
{
    public function get(): void
    {
        http_response_code(405);
    }
    public function post(): void
    {
        http_response_code(405);
    }
    public function put(): void
    {
        http_response_code(405);
    }
    public function patch(): void
    {
        http_response_code(405);
    }
    public function delete(): void
    {
        http_response_code(405);
    }
}