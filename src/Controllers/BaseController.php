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
    public function put(int $id): void
    {
        http_response_code(405);
    }
    public function patch(): void
    {
        http_response_code(405);
    }
    public function delete(int $id): void
    {
        http_response_code(405);
    }
}