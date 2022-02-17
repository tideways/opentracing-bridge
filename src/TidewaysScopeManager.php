<?php

namespace Tideways\OpenTracing;

use OpenTracing\Scope;
use OpenTracing\ScopeManager;
use OpenTracing\Span;

class TidewaysScopeManager implements ScopeManager
{
    public function activate(Span $span, bool $finishSpanOnClose = self::DEFAULT_FINISH_SPAN_ON_CLOSE): Scope
    {
        return new TidewaysScope($span);
    }

    public function getActive(): ?Scope
    {
        return new TidewaysScope(new RootSpan());
    }
}