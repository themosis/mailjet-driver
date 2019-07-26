<?php

namespace Themosis\MailJet;

use Illuminate\Mail\TransportManager as IlluminateTransportManager;
use Mailjet\Client;
use Themosis\MailJet\Transport\MailJetTransport;

class TransportManager extends IlluminateTransportManager
{
    /**
     * Create an instance of the MailJet Swift Transport driver.
     *
     * @return MailJetTransport
     */
    protected function createMailjetDriver()
    {
        $config = $this->app['config']->get('services.mailjet', []);

        $mailJetClient = new Client(
            $config['public'],
            $config['secret'],
            true,
            [
                'version' => $config['version']
            ]
        );

        return new MailJetTransport($mailJetClient);
    }
}
