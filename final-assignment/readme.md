# PHP186 2024Spring - Final Project - Pokemon Google Map

You can learn about the final result by watching the video posted on the portal.

## PART 0

In `php82.local` folder, create a folder called `itas186_pokemon_war` and you will create files and write code there. Once you finish all tasks, you should zip `itas186_pokemon_war` and submit it in portal.

## PART 1

Create a Pokemon class (in the file `Pokemon.php`).

This class should have the following private fields:

* `name`
* `image`
* `weight`
* `hp(Hit Points)`
* `latitude`
* `longitude`
* `type`

Write methods to get each of the fields, and setters for latitude and longitude (All fields can be set initially by the constructor) \
Write a `__toString()` method that returns a String containing information from all the fields. For example:
> “Bulbasaur Image:bulbasaur.png Weight:35 HP:20 Type:Grass latitude:49.134 longitude: 123.456”

(You can update the code for better HTML table format later)

Write an attack method that echos out “Base class, no attack”.

Create a Bulbasaur class (in a file called Bulbasaur.php)
Bulbasaur should inherit from Pokemon (manually import the Pokemon class with `require_once`) \
The constructor for Bulbasaur should only take weight, HP, latitude and longitude – name should be set to “Bulbasaur”, type should be set to “grass”, and image set to “bulbasaur.png” – see the slides above about calling the parent class constructor. For example:

```php
function __construct($weight, $hp, $latitude, $longitude) {
    parent::__construct("Bulbasaur", "bulbasaur.png", $weight, $hp, $latitude, $longitude, "grass");
}
```

Override the attack method to print out “Bulbasuar attacking!!”

## PART 2

Similar to Bulbasaur, create a Pikachu(Type: electric) and Paras(Type: bug) class that inherit from the Pokemon class – these should each have unique attack methods that print out something different.

## PART 3

Create a Trainer class (in Trainer.php) \
Manually import the Pokemon class with `require_once` (this is the only class Trainer needs to be aware of)
This class should have the following fields:
* An array to store pokemon (you might call this `$pokedex`)
* A String to store a trainer name
* A String to store an image for the Trainer (we might want to show this on the map* later)
* Variables for latitude and longitude

Write a constructor for Trainer that accepts the name and the image of the trainer and initializes the array to store Pokemon objects.

Write an `add()` method that accepts a Pokemon parameter (use type hinting) and this method should add the passed Pokemon to the array.

Write a method called `printAll()`, that loops through all the Pokemon objects stored in the array and echos these out in a readable format – use HTML markup as necessary for line breaks etc.. If you want to get fancy you could format these in an HTML table, add bootstrap CSS, and output some img tags with sample images found from the Internet e.g. 
```html
<img src="images/bulbasaur.png" alt="bulbasaur pic">
```

Write a method called `attackAll()`, that loops through all the Pokemon and calls the `attack()` method upon each object retrieved while iterating through – this is Polymorpishm!


## PART 4

Let's add some testing code to test.php file
Use the `spl_autoload_register` statement to import all our Pokemon classes that we will be testing:
```php
// Simple test script to test our pokemon classes
spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});
```
Create a Trainer object
Instantiate 3 Bulbasaur, 1 Pikachu and 3 Paras Pokemon

| Name       | Weight     | Hit Points    | Lat    | Long    |
| :------------- | :----------: | -----------: | -----------: | -----------: |
|  bulbasaur1 | 150   | 100    | 49.178561    | -123.857631    |
|  bulbasaur2 | 90   | 70    | 49.162736    | -123.892478    |
|  bulbasaur3 | 100   | 80    | 49.182936     | -123.894500    |
|  pikachu | 200   | 145    | 49.192936    | -123.994400    |
|  Paras1 | 80   | 60    | 49.192146    | -123.564534    |
|  Paras2 | 70   | 50    | 49.192580    | -123.224530    |
|  Paras3 | 70   | 60    | 49.195580    | -123.228530    |

and add these to the Trainer
* Call the `printAll()` method on the Trainer object
* Call the `attackAll()` method on the Trainer object

See what classes PHP has loaded into memory – try the following code (you can comment this out later):

```php
$classes = get_declared_classes(); 

foreach($classes as $class) {
  echo $class . PHP_EOL;
}
```

## PART 5

**Make the Pokemon class abstract**

Write an abstract `getDamage()` function

In each of the child classes (Bulbasaur, Paras etc..), override the getDamage function to return a number value (Bulbasaur might return 2, Paras return 3 etc...). I will be giving you specific values to return in Week 3 or Week 4. The intention for now is that each subtype of Pokemon has a unique damage returned.

Modify Pokemon's `attack` method to accept a Pokemon parameter, and reduce the others hitpoints:

```
// note I am type hinting to ensure $other is actually a Pokemon object
function attack(Pokemon $other)
{
    // the other pokemon's hitpoints will be reduced by the amount of 
    // damage the current pokemon ($this) can inflict
    $other->hp = $other->hp - $this->getDamage();
}
```

---

## PART 6

**Flyer Interface and Pidgey class**

Write an Interface called Flyer, this should have the following functions declared:

```
	function takeOff();

	function land();

	function getFlying(); // return true or false if flying

	function getSpeed();

	function getDirection();
```

Write a new Pokemon class called Pidgey, this class should also inherit from Pokemon

Modify the Pidgey class to implement the Flyer interface (you will need to define the five methods from the interface). In order to be useful (to the extent that this lab could be...), you will need to add some fields to the Pidgey class. For example, you can store fields in the Pidgey class for:

	$isFlying; // to remember if currently on land or taken off, and return this from takeOff() and land()
	$speed;  // remember current speed - can just be some number for now
	$direction; // remember current direction - can just be some number for now

You will then use the fields when writing the functions from the Flyer interface, for example:

```
function getSpeed() {
  return $this->speed;
}
```
And the `Pidgey` class will look like:

```
public function __construct($weight, $hp, $lat, $long, $isFlying = true, $speed = 0, $direction = 0)
{
    parent::__construct("Pidgey", "pidgey.png", $weight, $hp, $lat, $long, "flying");
    $this->isFlying = $isFlying;
    // Note this adds support just for isFlying, you will also need $speed, $direction etc..
}
```
## PART 7

**Refactoring Pokemon and Trainer with a common base class**

I will discuss this step in greater depth in the next class. We are going to 
write a new abstract Character class and move any variables that are common between Trainer
and Pokemon into this class - we are trying to eliminate anything repetitive between classes.

Pokemon class should be refactored to use the new abstract Character as the base class

Move some fields/methods not unique to Pokemon to the Character class (e.g. name, lat, long, image etc..)

Note if done properly, you shouldn’t need to modify your other Pokemon classes (Pidgey etc..)

Trainer class\
  Trainer should extend Character in order to have support for lat, long etc..


## PART 8

**World.php**

World class
* Should be a Singleton (there is only one world of course) - this should already be completed for you but understand how it works!
* public static function `getInstance()`
* Contain one Trainer in private construct
* Contain an array of Wild Pokemon ($wildPokemon - currently this array can be empty)
* Should store a string called message, can be empty
* `addMessage()` // add a String to the current message 			 //queue to be sent back with JSON
* `getMessage()`  // return the current jsonMessage
* `clearMessage()` // reset the current jsonMessage

	Method `getJSON()` that returns the valid JSON to represent a marker for each of the wild pokemon, the trainer, the trainer’s pokemon and the current "message" to send back - see directions to support this below in Part 10


## PART 9

**LOAD FILES**

I put two text files on the portal that contain a list of ’Wild Pikachu’ and a list of Pikachu for the trainer's array to contain.

Write a method in the World - `loadPokemon($filename)` that takes a filename as a parameter, reads in the `file()`, and depending and creates a Pokemon for each pokemon description in the file. This function should return an array

Call `loadPokemon("wildPokemon.txt")` to set the array in the World\
Call `loadPokemon("trainerPokemon.txt")` to set the array in the Trainer (the World class should contain one Trainer object)

## PART 10

**Generate JSON**

Complete the rest work of the `getJSON` method for the `World` class such that when you call `World::getInstance()->getJSON()` it returns a JSON string that looks something like the one I currently have hard-coded in `World.php`, but has the data from the actual Pokemon and Trainer in the World. To do this you will need to loop through all the wildPokemon array in the world, and for each pokemon create a JSON string, get all the trainers pokemon/loop through them and make Json strings, and add a json object for the trainer. In a word, wildPokemon + trainer + trainer's pokemon = json string

In the `Character` class, write a method called `getMarketJSON` that returns the info (name, lat, long, image) for this object as a JSON String. Note that this method is from abstract class, so any derived class (Pokemon and Trainer) can use it.

NOTE: You will have to carefully reverse engineer what I have hard-coded as a JSON String in World.php
to actually use the lat, long, image etc. from each Pokemon class. The client (in the case the JavaScript in `map.php` is expecting each marker will have JSON data for name, lat, long and image).

The `getMakerJSON` method in the Character class should return something like (including the quotes!):

```javascript
{"lat":  49.159720,"long":  -123.907773,"name": "Paras","image": "paras.png" }

```

Once you have completed a `getMarkerJSON` method in the `Character` class, complete the `getJSON()` method in `World.php`
It should loop through all the wild pokemon plus the Trainer and all his/her Pokemon.

The complete JSON string returned by calling `$world->getJSON()` will look something like:

```javascript
{
  "markers": [
    {
      "lat": 49.159706,
      "long": -123.905757,
      "name": "Trainer",
      "image": "trainer.png"
    }, {
      "lat": 49.159706,
      "long": -123.907757,
      "name": "bulbasaurT",
      "image": "bulbasaur.png"
    },{
      "lat": 49.159836,
      "long": -123.908857,
      "name": "parasT",
      "image": "paras.png"
    },{
      "lat": 49.159966,
      "long": -123.903657,
      "name": "pikachuT", 
      "image": "pikachu.png"
    },{
      "lat": 49.159720,
      "long": -123.907773,
      "name": "paras1", 
      "image": "paras.png"
    },{
      "lat": 49.171154,
      "long": -123.971443,
      "name": "pidgey1", 
      "image": "pidgey.png"
    },{
      "lat": 49.152864,
      "long": -123.94873,
      "name": "paras2", 
      "image": "paras.png"
    },{
      "lat": 49.1350026,
      "long": -123.9220046,
      "name": "paras3", 
      "image": "paras.png"
    },{
      "lat": 49.178561,
      "long": -123.857631,
      "name": "bulb1", 
      "image": "bulb.png"
    },{
      "lat": 49.162736,
      "long": -123.892478,
      "name": "bulb2", 
      "image": "bulb.png"
    },{
      "lat": 49.1790103,
      "long": -123.9199447,
      "name": "pidgey2", 
      "image": "pidgey.png"
    },{
      "lat": 49.1675630,
      "long": -123.9383125,
      "name": "pidgey2", 
      "image": "pidgey.png"
    }
  ],
  "message": "Attack counter is: ' . $_SESSION['counter']  . ' " 
  }
  ```

Note: "message" is the final key-value pair returned from the World to map.php. It is a simple mechanism to allow us to send messages from the World to be displayed in the browser... to help debug code or send messages from your server-side scripts you can call:

```php
$world = World::getInstance();
$world->addMessage("Hello from stuff happening on the server");
```

If you look in the getPokemon.php script, the message is cleared at the end of this file, so that we only get new messages each time we call getPokemon.php().

## PART 11

**getDamage()**

Each type of Pokemon will need to override the abstract `getDamage()` function in Pokemon class for each of the types of Pokemon to return the damage each does. So that we end up with the same results please use the following `getDamage()` functions:

```php
// Bulbasaur:
  function getDamage() {
    return $this->getWeight()*0.3;
  }

// Pikachu:
  function getDamage() {
    return $this->getWeight()*1.5;
  }

// Paras:
  public function getDamage() {
    return $this->getWeight()*0.8;
  }

// Pidgey:
  function getDamage() {
    return $this->getWeight()*0.4;
  }

```

## PART 12

**battle()**

To complete the battle function, you will need to:

12.1 - Loop through the array of wild pokemon, and find which wild pokemon is closest to the trainer's latitude and longitude. You can use the World's built-in distance function to calculate the distance. For example:

```php
$nearestWildPokemon = null;
$nearestDistance = 0;

foreach ($this->getWildPokemon as $wildPokemon) {
    
    // If this is first loop, we assume the first wildPokemon is the nearest pokemon
    // And its distance is the nearest distance
    if ($nearestWildPokemon === null) {
        $nearestWildPokemon = $wildPokemon;
        $nearestDistance = $theDistance;
    }

    // the next time through, you'll need an else if statement to check if the next $wild's distance is less than $nearestDistance, and if so set this as $nearestWildPokemon
    #Finish code here
  }
```

Reminder - to help debug your code you can pass messages back to the browser with the addMessage() function for each loop:

```php
$this->addMessage("Found the next nearest wild pokemon: " . $nearestWildPokemon->getName());
```

12.2 - After you find the next nearest wild pokemon, update the trainer and all of the trainer's pokemon to match the wild pokemon location:

```php
// update the Trainer and the Trainer's pokemon to these co-ordinates
$this->trainer->setLat($nearestWildPokemon->getLat());
$this->trainer->setLong($nearestWildPokemon->getLong());

// same way - update the lat/long for each of the trainer's $tPoke
foreach ($this->trainer->getPokedex() as $tPoke) {
    # Finish code here
}
```

12.3 - Now that you have found the nearest pokemon and moved the trainer and trainer's pokedex to the same location, let the battle begin! Basically the idea is to let the trainer's first pokemon (random one) attack the wild pokemon, and if the wild pokemon survives the first attack, it gets to attack back. Use a loop to keep attacking back and forth until either the trainer's first pokemon dies, or the wild pokemon dies.

If the wild pokemon dies first (HP less than 0) - go back to 12.1 and search again for the next nearest wild pokemon.

If the trainer's first pokemon dies before the wild pokemon, use the trainer's second pokemon to attack the wild pokemon, and keep going back and forth until either one has HP less than 0. Note when one of the Trainer's pokemon has HP less than or equal to 0, remove this dead pokemon from the array containing the trainer's pokemon.

Here is some code to get you started:
```php
foreach ($this->trainer->getPokedex() as $warrior) {

    // The loop round status
    $roundEnd = false;

    while (!$roundEnd) {
        // Trainer pokemon attacks wild pokemon
        $warrior->attack($nearestWildPokemon);

        $this->addMessage("Trainer_" . $tPoke->getName() . " attacked Wild_" .$nearestWildPokemon->getName() . " HP:" . $nearestWildPokemon->getHp());

        // if $nearestWildPokemon has getHp() > 0, then let the nearest wild attack $tPoke

        # Finsh code here
    }
}
```
Clue: Regard the attack forth and back round is one loop.

## PART 13

After you move the trainer and trainer's pokedex to the nearest wild pokemon location, they are all overlapped together, we need a better way to view the Trainer and the Trainer's pokemon collection. Modify the lat/long for each of the Trainer's pokemon so that they are offset by a few lat/long points to display on the google map in a staggered function. (see the image on the portal)

## PART 14


Feel free to add your own ideas/features to make this project fun! i.e. When the trainer won the war, make a popup message to celebrate!

## PART 15

Submitting - please see the direction on portal for marking criteria, and how to submit.