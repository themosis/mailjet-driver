<?php

namespace Themosis\MailJet;

use Illuminate\Mail\MailServiceProvider as IlluminateMailServiceProvider;

class MailServiceProvider extends IlluminateMailServiceProvider
{
    /**
     * Register the Swift Transport instance.
     */
    protected function registerSwiftTransport()
    {
        $this->app->singleton('swift.transport', function () {
            return new TransportManager($this->app);
        });
    }
}
