<?php

declare(strict_types=1);

namespace Pest\Gwt;

use Closure;
use Pest\PendingObjects\TestCall;
use Pest\Support\Backtrace;
use Pest\TestSuite;

final class BehaviorDescriptor
{
    /**
     * @var Closure|null
     */
    private $arranging = null;

    /**
     * @var Closure
     */
    private $acting;

    /**
     * @var string
     */
    private $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return BehaviorDescriptor
     */
    public function given(Closure $arrange)
    {
        $this->arranging = $arrange;

        return $this;
    }

    /**
     * @return self
     */
    public function when(Closure $act)
    {
        $this->acting = $act;

        return $this;
    }

    /**
     * @return TestCall
     */
    public function then(Closure $asserting)
    {
        $arranging = $this->arranging;
        $acting    = $this->acting;

        $filename = Backtrace::testFile();

        return new TestCall(TestSuite::getInstance(), $filename, $this->description, function () use ($arranging, $acting, $asserting) {
            $params = [];

            if (!is_null($arranging)) {
                $params = (array) $arranging();
            }

            $params = $acting(...$params);

            $params = (array) $params;

            $asserting(...$params);
        });
    }

    /**
     * @return TestCall
     */
    public function throws(string $exception, string $exceptionMessage = null)
    {
        return $this->then(function () {})->throws($exception, $exceptionMessage);
    }
}
