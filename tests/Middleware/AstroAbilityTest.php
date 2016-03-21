<?php

use Mockery as m;
use Roketin\Astro\Middleware\AstroAbility;

class AstroAbilityTest extends MiddlewareTest
{
    public function testhandleIsguestwithnoabilityShouldabort403()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard[guest]');
        $request = $this->mockRequest();

        $middleware = new AstroAbility($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(true);
        $request->user()->shouldReceive('ability')->andReturn(false);

        $middleware->handle($request, function () {}, null, null, true);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertAbortCode(403);
    }

    public function testhandleIsguestwithabilityShouldabort403()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard');
        $request = $this->mockRequest();

        $middleware = new AstroAbility($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(true);
        $request->user()->shouldReceive('ability')->andReturn(true);

        $middleware->handle($request, function () {}, null, null);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertAbortCode(403);
    }

    public function testhandleIsloggedinwithnoabilityShouldabort403()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard');
        $request = $this->mockRequest();

        $middleware = new AstroAbility($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(false);
        $request->user()->shouldReceive('ability')->andReturn(false);

        $middleware->handle($request, function () {}, null, null);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertAbortCode(403);
    }

    public function testhandleIsloggedinwithabilityShouldnotabort()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
         */
        $guard   = m::mock('Illuminate\Contracts\Auth\Guard');
        $request = $this->mockRequest();

        $middleware = new AstroAbility($guard);

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
         */
        $guard->shouldReceive('guest')->andReturn(false);
        $request->user()->shouldReceive('ability')->andReturn(true);

        $middleware->handle($request, function () {}, null, null);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
         */
        $this->assertDidNotAbort();
    }

    protected function mockRequest()
    {
        $user = m::mock('_mockedUser')->makePartial();

        $request = m::mock('Illuminate\Http\Request')
            ->shouldReceive('user')
            ->andReturn($user)
            ->getMock();

        return $request;
    }
}
