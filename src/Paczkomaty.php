<?php

namespace Lari\Furgonetka;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class Paczkomaty
{
    /**
     * @var
     */
    private $client;

    /**
     * @var array
     */
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
     * @param string $postcode
     * @return Paczkomaty $this
     */
    public function setPostcode($postcode): Paczkomaty
    {
        $this->setQueryKey('postcode', $postcode);

        return $this;
    }

    /**
     * @param string $city
     * @return Paczkomaty $this
     */
    public function setCity(string $city): Paczkomaty
    {
        $this->setQueryKey('city', $city);

        return $this;
    }

    /**
     * @param string $street
     * @return Paczkomaty $this
     */
    public function setStreet(string $street): Paczkomaty
    {
        $this->setQueryKey('street', $street);

        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return Paczkomaty $this
     */
    private function setQueryKey($key, $value): Paczkomaty
    {
        $this->query[$key] = $value;

        return $this;
    }

    /**
     * @param object
     * @return Paczkomaty $this
     */
    public function setUser($user): Paczkomaty
    {
        $this->query = [
            'postcode' => $user->postal,
            'city'     => $user->city,
            'street'   => $user->street,
        ];

        return $this;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->client->get('getPaczkomaty', $this->query);
    }
}