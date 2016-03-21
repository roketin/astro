<?php

use Mockery as m;
use Roketin\Astro\Middleware\AstroPermission;

class AstroPermissionTest extends MiddlewareTest
{
    public function testhandleIsguestwithnopermissionShouldabort403()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard[guest]');
        $request = $this->mockRequest();

        $middleware = new AstroPermission($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(true);
        $request->user()->shouldReceive('can')->andReturn(false);

        $middleware->handle($request, function () {}, null, null, true);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertAbortCode(403);
    }

    public function testhandleIsguestwithpermissionShouldabort403()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard');
        $request = $this->mockRequest();

        $middleware = new AstroPermission($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(true);
        $request->user()->shouldReceive('can')->andReturn(true);

        $middleware->handle($request, function () {}, null, null);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertAbortCode(403);
    }

    public function testhandleIsloggedinwithnopermissionShouldabort403()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard');
        $request = $this->mockRequest();

        $middleware = new AstroPermission($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(false);
        $request->user()->shouldReceive('can')->andReturn(false);

        $middleware->handle($request, function () {}, null, null);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertAbortCode(403);
    }

    public function testhandleIsloggedinwithpermissionShouldnotabort()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard');
        $request = $this->mockRequest();

        $middleware = new AstroPermission($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(false);
        $request->user()->shouldReceive('can')->andReturn(true);

        $middleware->handle($request, function () {}, null, null);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertDidNotAbort();
    }
}
