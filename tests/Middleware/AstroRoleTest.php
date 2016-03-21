<?php

use Mockery as m;
use Roketin\Astro\Middleware\AstroRole;

class AstroRoleTest extends MiddlewareTest
{
    public function testhandleIsguestwithmismatchingroleShouldabort403()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard[guest]');
        $request = $this->mockRequest();

        $middleware = new AstroRole($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(true);
        $request->user()->shouldReceive('hasRole')->andReturn(false);

        $middleware->handle($request, function () {}, null, null, true);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertAbortCode(403);
    }

    public function testhandleIsguestwithmatchingroleShouldabort403()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard');
        $request = $this->mockRequest();

        $middleware = new AstroRole($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(true);
        $request->user()->shouldReceive('hasRole')->andReturn(true);

        $middleware->handle($request, function () {}, null, null);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertAbortCode(403);
    }

    public function testhandleIsloggedinwithmismatchroleShouldabort403()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard');
        $request = $this->mockRequest();

        $middleware = new AstroRole($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(false);
        $request->user()->shouldReceive('hasRole')->andReturn(false);

        $middleware->handle($request, function () {}, null, null);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertAbortCode(403);
    }

    public function testhandleIsloggedinwithmatchingroleShouldnotabort()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard');
        $request = $this->mockRequest();

        $middleware = new AstroRole($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(false);
        $request->user()->shouldReceive('hasRole')->andReturn(true);

        $middleware->handle($request, function () {}, null, null);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertDidNotAbort();
    }
}
