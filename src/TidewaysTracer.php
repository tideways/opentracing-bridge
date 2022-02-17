<?php

namespace Tideways\OpenTracing;

use OpenTracing\Scope;
use OpenTracing\ScopeManager;
use OpenTracing\Span;
use OpenTracing\SpanContext;
use OpenTracing\StartSpanOptions;
use OpenTracing\Tracer;
use Tideways\Profiler;

class TidewaysTracer implements Tracer
{
    private TidewaysScopeManager $scopeManager;

    public function __construct()
    {
        $this->scopeManager = new TidewaysScopeManager();
    }

    public function getScopeManager(): ScopeManager
    {
        return $this->scopeManager;
    }

    public function getActiveSpan(): ?Span
    {
        $scope = $this->getScopeManager()->getActive();

        if ($scope === null) {
            return null;
        }

        return $scope->getSpan();
    }

    public function startActiveSpan(string $operationName, $options = []): Scope
    {
        return new TidewaysScope($this->startSpan($operationName, $options));
    }

    public function startSpan(string $operationName, $options = []): Span
    {
        if (is_array($options)) {
            $options = StartSpanOptions::create($options);
        }

        $span = new TidewaysSpan(Profiler::createSpan($operationName), $operationName);

        foreach ($options->getTags() as $key => $value) {
            $span->setTag($key, $value);
        }

        return $span;
    }

    public function inject(SpanContext $spanContext, string $format, &$carrier): void
    {
    }

    public function extract(string $format, $carrier): ?SpanContext
    {
        return new TidewaysSpanContext();
    }

    public function flush(): void
    {
        // does nothing, Tideways stops the trace and flushes everything at once.
    }
}
