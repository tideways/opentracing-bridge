<?php

namespace Tideways\OpenTracing;

use OpenTracing\SpanContext;

class TidewaysSpanContext implements SpanContext
{
    public function getIterator()
    {
        return new \ArrayIterator([]);
    }

    public function getBaggageItem(string $key): ?string
    {
        return null;
    }

    public function withBaggageItem(string $key, string $value): SpanContext
    {
        return $this;
    }
}