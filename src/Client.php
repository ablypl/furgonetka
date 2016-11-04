<?php 

namespace Lari\Furgonetka;

class Client
{
    protected $url = 'http://furgonetka.pl/api/';

    protected $client;
    
    protected $hash;
    
    /**
     * Client constructor.
     *
     */
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => $this->url ]);
        $this->authorize();
    }

    /**
     *
     */
    public function authorize()
    {
        $response = $this->client->request('GET', 'login.json', [
            'query' => [
                'email' => config('services.furgonetka.email'),
                'password' =>  config('services.furgonetka.password')
            ],
        ]);
        $this->hash = json_decode((string) $response->getBody())->success->hash;        
    }

    /**
     * @param       $method
     * @param array $data
     * @return \Illuminate\Support\Collection
     */
    public function get($method, $data = [])
    {
        return collect(json_decode($this->client->request('GET', "{$method}.json", [
            'query' => array_merge([
                'hash' => $this->hash
            ], $data)
        ])->getBody()->getContents()));
    }


    /**
     * @return \Lari\Furgonetka\User
     */
    public function user()
    {
        return new User($this);
    }

    /**
     * @return \Lari\Furgonetka\Package
     */
    public function package()
    {
        return new Package($this);
    }

    /**
     * @return \Lari\Furgonetka\Paczkomaty
     */
    public function paczkomaty()
    {
        return new Paczkomaty($this);
    }

    /**
     * @return \Lari\Furgonetka\Billing
     */
    public function billing()
    {
        return new Billing($this);
    }
}