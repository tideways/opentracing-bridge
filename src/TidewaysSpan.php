<?php

namespace Tideways\OpenTracing;

use OpenTracing\Span;
use OpenTracing\SpanContext;

class TidewaysSpan implements Span
{
    private \Tideways\Profiler\Span $span;
    private string $operationName;

    public function __construct(\Tideways\Profiler\Span $span, string $operationName)
    {
        $this->span = $span;
        $this->operationName = $operationName;
    }

    public function getOperationName(): string
    {
        return $this->operationName;
    }

    public function getContext(): SpanContext
    {
        return new TidewaysSpanContext();
    }

    public function finish($finishTime = null): void
    {
        $this->span->finish();
    }

    public function overwriteOperationName(string $newOperationName): void
    {
    }

    public function setTag(string $key, $value): void
    {
        $this->span->annotate([$key => $value]);
    }

    public function log(array $fields = [], $timestamp = null): void
    {
    }

    public function addBaggageItem(string $key, string $value): void
    {
    }

    public function getBaggageItem(string $key): ?string
    {
        return null;
    }
}