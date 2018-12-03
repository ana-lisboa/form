<?php

namespace AnaLisboa\Form;

use AnaLisboa\Form\ErrorStore\IlluminateErrorStore;
use AnaLisboa\Form\OldInput\IlluminateOldInputProvider;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function register()
    {
        $this->registerErrorStore();
        $this->registerOldInput();
        $this->registerFormBuilder();
    }

    protected function registerErrorStore()
    {
        $this->app->singleton('ana-lisboa.form.errorstore', function ($app) {
            return new IlluminateErrorStore($app['session.store']);
        });
    }

    protected function registerOldInput()
    {
        $this->app->singleton('ana-lisboa.form.oldinput', function ($app) {
            return new IlluminateOldInputProvider($app['session.store']);
        });
    }

    protected function registerFormBuilder()
    {
        $this->app->singleton('ana-lisboa.form', function ($app) {
            $formBuilder = new FormBuilder;
            $formBuilder->setErrorStore($app['ana-lisboa.form.errorstore']);
            $formBuilder->setOldInputProvider($app['ana-lisboa.form.oldinput']);
            $formBuilder->setToken($app['session.store']->token());

            return $formBuilder;
        });
    }

    public function provides()
    {
        return ['ana-lisboa.form'];
    }
}
