<?php

namespace App\Routing\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Get
{
    public string $uri;
    public ?string $name;
    public array $middleware;
    public ?string $when;

    public function __construct(string $uri, ?string $name = null, array $middleware = [], ?string $when = null)
    {
        $this->uri = $uri;
        $this->name = $name;
        $this->middleware = $middleware;
        $this->when = $when;
    }
}
