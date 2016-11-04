<?php

namespace Lari\Furgonetka;


use App\User;

class Package
{
    protected $client;

    protected $sender;

    protected $receiver;

    protected $query = [
        'type' => 'package',
        'width' => 20,
        'weight' => 1,
        'height' => 10,
        'depth' => 10,
    ];
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
     * Set sender
     * @param \App\User $user
     * @return $this
     */
    public function from(User $user)
    {
        $this->sender = $user;
        
        $this->query += $this->getDataFromModel($user, 'sender');

        return $this;
    }

    /**
     * Set receiver
     * @param \App\User $user
     * @return $this
     */
    public function to(User $user)
    {
        $this->receiver = $user;

        $this->query += $this->getDataFromModel($user, 'receiver');

        return $this;
    }

    /**
     * Get package price
     * @return mixed
     * @throws \Exception
     */
    public function price()
    {
        $this->checkSenderAndReceiver();

        return $this->client->get('packageCheckPrice', $this->query);
    }

    /**
     * Create new package
     * @param $service
     * @return mixed
     * @throws \Exception
     */
    public function add($service)
    {
        $this->checkSenderAndReceiver();

        $this->query['service'] = $service;

        if($service == "dpd")
        {
            $this->addParameter('wrapping', 0);
            $this->addParameter('shape', 0);
        }

        return $this->client->get('packageAdd', $this->query);
    }

    /**
     * Get package details
     * @param $id
     * @return mixed
     */
    public function details($id)
    {
        return $this->client->get('packageDetails', ['package_no' => $id ]);
    }

    /**
     * Cancel package with given id
     * @param $id
     * @return mixed
     */
    public function cancel($id)
    {
        return $this->client->get('packagesOrder', ['package_no' => $id ]);
    }

    /**
     * Order courier for package with given id
     * @param $packages
     * @return mixed
     */
    public function order($packages)
    {
        return $this->client->get('packagesOrder', ['packages_ids' => $packages ]);
    }

    /**
     * Delete package with given id
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->client->get('packageDelete', [
            'package_id' => $id
        ]);
    }

    /**
     * Get awaiting packages
     * @return mixed
     */
    public function getWaiting()
    {
        return $this->client->get('packagesGetWaiting');
    }

    /**
     * Add new parameter to global query
     * @param $name
     * @param $value
     * @return $this
     */
    public function addParameter($name, $value)
    {
        $this->query[$name] = $value;
        return $this;
    }

    /**
     * Extract data
     * @param $model
     * @param $prefix
     * @return array
     */
    public function getDataFromModel($model, $prefix)
    {
        return [
            $prefix . '_email' =>  $model->email,
            $prefix . '_street' =>  $model->street,
            $prefix . '_city' =>  $model->city,
            $prefix . '_postcode' =>  $model->postal,
            $prefix . '_name' =>  $model->name,
            $prefix . '_surname' =>  $model->surname,
            $prefix . '_phone' =>  '605850745',
        ];
    }

    /**
     * Set package type
     * @param $type
     */
    public function ofType($type)
    {
        $this->query['type'] = $type;
    }


    /**
     * Check if sender and receiver were provided
     * @throws \Exception
     */
    protected function checkSenderAndReceiver()
    {
        if (!$this->sender) throw new \Exception('Należy poprawnie zdefiniować nadawcę');
        if (!$this->receiver) throw new \Exception('Należy poprawnie zdefiniować odbiorcę');
    }

}