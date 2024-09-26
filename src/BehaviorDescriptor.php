<?php

declare(strict_types=1);

namespace Pest\Gwt;

use Closure;
use Pest\PendingCalls\TestCall;
use Pest\Support\Backtrace;
use Pest\TestSuite;

final class BehaviorDescriptor
{
    private ?Closure $arranging = null;

    private Closure $acting;

    public function __construct(private readonly string $description) {}

    public function given(Closure $arrange): BehaviorDescriptor
    {
        $this->arranging = $arrange;

        return $this;
    }

    public function when(Closure $act): self
    {
        $this->acting = $act;

        return $this;
    }

    public function then(Closure $asserting): TestCall
    {
        $arranging = $this->arranging;
        $acting = $this->acting;

        $filename = Backtrace::testFile();

        return new TestCall(TestSuite::getInstance(), $filename, $this->description, function () use ($arranging, $acting, $asserting): void {
            $params = [];

            if (! is_null($arranging)) {
                $params = $arranging();
                if (! is_array($params)) {
                    $params = [$params];
                }
            }

            $params = $acting(...$params);

            if (! is_array($params)) {
                $params = [$params];
            }

            $asserting(...$params);
        });
    }

    public function throws(string|int $exception, ?string $exceptionMessage = null): TestCall
    {
        return $this->then(function (): void {})->throws($exception, $exceptionMessage);
    }
}
