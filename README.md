# OpenTracing Bridge for Tideways

This Composer package provides a bridge between OpenTracing PHP API and
Tideways traces.

## Installation

via Composer:

```
composer require tideways/opentracing-bridge=dev-master
```

## Setup

```php
<?php
use OpenTracing\GlobalTracer;
use Tideways\OpenTracing\TidewaysTracer;

GlobalTracer::set(new TidewaysTracer());
```

## Implementation Details

Tideways is not primarily a tracer that is working distributed and due to its
automated instrumentation already does most of the work. Both implementation
choices allow for the OpenTracing implementation to be simplified considerably.

- Tideways spans have no parent-child relationship and are sorted by start time
  and duration. As such creating new spans ignores the passed span contexts or
  parent spans.

- Tideways always automatically starts a root span at the beginning of a
  request, so creating a root span using OpenTracing API will create a sub-span
  to the Tideways root instead.
