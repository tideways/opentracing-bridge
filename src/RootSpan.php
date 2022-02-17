<?php

namespace Tideways\OpenTracing;

use DateTimeInterface;
use OpenTracing\Span;
use OpenTracing\SpanContext;

class RootSpan implements Span
{
    public function getOperationName(): string
    {
        return 'php';
    }

    public function getContext(): SpanContext
    {

    }

    public function finish($finishTime = null): void
    {
    }

    public function overwriteOperationName(string $newOperationName): void
    {
        // This does nothing
    }

    public function setTag(string $key, $value): void
    {
        \Tideways\Profiler::setCustomVariable($key, $value);
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