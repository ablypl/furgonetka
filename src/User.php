<?php 

namespace Lari\Furgonetka;

class User
{
    private $client;

    /**
     * User constructor.
     *
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     * Get User Data
     */
    public function get()
    {
        return $this->client->get('getUserInfo');
    }
}