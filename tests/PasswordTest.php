<?php

use AnaLisboa\Form\Elements\Password;

class PasswordTest extends PHPUnit_Framework_TestCase
{
    use TextSubclassContractTest;

    protected function newTestSubjectInstance($name)
    {
        return new Password($name);
    }

    protected function getTestSubjectType()
    {
        return 'password';
    }
}
