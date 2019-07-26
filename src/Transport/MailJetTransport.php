<?php

namespace Themosis\MailJet\Transport;

use Illuminate\Mail\Transport\Transport as IlluminateMailTransport;
use Mailjet\Client;
use Mailjet\Resources;
use Swift_Mime_SimpleMessage;

class MailJetTransport extends IlluminateMailTransport
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given Message.
     *
     * Recipient/sender data will be retrieved from the Message API.
     * The return value is the number of recipients who were accepted for delivery.
     *
     * This is the responsibility of the send method to start the transport if needed.
     *
     * @param Swift_Mime_SimpleMessage $message
     * @param string[] $failedRecipients An array of failures by-reference
     *
     * @return int
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $this->client->post(Resources::$Email, [
            'body' => $this->payload($message)
        ]);

        $this->sendPerformed($message);

        return $this->numberOfRecipients($message);
    }

    /**
     * Return HTTP client payload to perform the send email request.
     *
     * @param Swift_Mime_SimpleMessage $message
     *
     * @return array
     */
    private function payload(Swift_Mime_SimpleMessage $message)
    {
        return [
            'Messages' => [
                [
                    'From' => $this->getRecipients($message->getFrom(), true),
                    'To' => $this->getRecipients($message->getTo()),
                    'Cc' => $this->getRecipients($message->getCc()),
                    'Bcc' => $this->getRecipients($message->getBcc()),
                    'Subject' => $message->getSubject(),
                    'HTMLPart' => $message->getBody()
                ]
            ]
        ];
    }

    /**
     * Return the recipients payload based on given list.
     *
     * @param array|null $recipients
     * @param bool $first
     *
     * @return array
     */
    private function getRecipients($recipients, bool $first = false)
    {
        $items = collect($recipients)->map(function ($display, $email) {
            return [
                'Email' => $email,
                'Name' => $display
            ];
        })->values();

        if ($first) {
            return $items->first();
        }

        return $items->toArray();
    }
}
