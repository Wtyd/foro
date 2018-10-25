<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\CreatesApplication;
use Tests\TestHelper;
use Laravel\BrowserKitTesting\TestCase;

class FeatureTestCase extends TestCase
{
    use CreatesApplication, DatabaseTransactions, TestHelper;

    public function seeErrors(array $fields)
    {
        foreach ($fields as $name => $errors) {
            foreach ((array)$errors as $message) {
                $this->seeInElement(
                    "#field_$name.has-error .help-block", $message
                );
            }
        }
        return $this;
    }
}
