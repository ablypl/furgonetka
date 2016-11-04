<?php 

namespace Lari\Furgonetka;

class Billing{
    
    private $client;

    /**
     * Billing constructor.
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     *
     * @param $amount
     * @return mixed
     */
    public function pay($amount)
    {
        return $this->client->get('pay', ['amount' => 'amount' ]);
    }
}