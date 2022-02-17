<?php

namespace Tideways\OpenTracing;

use OpenTracing\Scope;
use OpenTracing\Span;

class TidewaysScope implements Scope
{
    private Span $span;

    public function __construct(Span $span)
    {
        $this->span = $span;
    }

    public function close(): void
    {
        $this->span->finish();
    }

    public function getSpan(): Span
    {
        return $this->span;
    }
}