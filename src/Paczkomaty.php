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
    public function setPostcode($postcode)
    {
        $this->setQueryKey('postcode', $postcode);

        return $this;
    }

    /**
     * @param string $city
     * @return Paczkomaty $this
     */
    public function setCity(string $city)
    {
        $this->setQueryKey('city', $city);

        return $this;
    }

    /**
     * @param string $street
     * @return Paczkomaty $this
     */
    public function setStreet($street)
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
        $this->query = [
            $key => $value,
        ];

        return $this;
    }

    /**
     * @param User
     * @return $this
     */
    public function setUser($user)
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