<?php


namespace Lari\Furgonetka;

use App\User;

class Paczkomaty
{
    private $client;

    protected $query = [];

    /**
     * Paczkomaty constructor.
     *
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param \App\User $user
     * @return $this
     */
    public function extract(User $user)
    {
        $this->query = [
            'postcode' => $user->postal,
            'city' => $user->city,
            'street' => $user->street
        ];
        return $this;
    }

    public function get()
    {
        return $this->client->get('getPaczkomaty', $this->query);
    }
}