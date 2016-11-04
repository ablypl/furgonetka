# Furgonetka API

Laravel API wrapper for furgonetka.pl


### Installation

```
composer require lari/furgonetka
```

Then in your php file:

```
use Lari\Furgonetka\Client as Furgonetka;

// Get user info
(new Furgonetka())->user()->get();

// Add new package
(new Furgonetka())
    ->package()
    ->from(App\User $sender)
    ->to(App\User $receiver)
    ->addParameter('sender_paczkomat', 'XXXX')
    ->addParameter('receiver_paczkomat', 'XXXX')
    ->add('inpost');
```

### Methods
##### User // (new Furgonetka())->user()
* get()


##### Billing // (new Furgonetka())->billing()
* pay(float $amount)
 

##### Package // (new Furgonetka())->package()
* from($user)
* to($user)
* price()
* add($service_name)
* details($package_id)
* cancel($package_id)
* order(array $packages_ids) // orders a courier
* delete($pacakge_id)
* getWaiting() // get list of awaiting packages
* addParameter($name, $value) // add parameter to global query
* ofType($name = "package") // package | dox | palette

##### Paczkomaty // (new Furgonetka())->paczkomaty()
* user($user)
* get()

### Development

Want to contribute? Great!

Contact me at sebastian@ably.pl

### License
MIT

