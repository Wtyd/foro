<?php

use App\User;
use Tests\CreatesApplication;
use Tests\TestHelper;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use CreatesApplication, TestHelper;
}
