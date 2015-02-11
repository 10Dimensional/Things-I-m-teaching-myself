<?php 
    
//Class Example -- Task.php

/* Classes become objects when instantiated. */

class Task { //This is a class, can be created over and over again as separate objects.
    public $description;
    
    public $completed = false;
    
    public function __construct($title, $description) {
        //Everytime this task is instantiated, this wiill run.
        
        $this->description =$description;
        var_dump($description);
    }
    
    public function complete() {
        $this->completed = true;
    }
}

$task = new Task('Learn OOP', 'The teacher blah blah...'); //Object

$task2 = new Task('Pickup Groceries', 'Go to the grocery store you fuck'); //Object

var_dump($task->$description); // Output 'Learn OOP'

var_dump($task->completed); // Output 'true'

////////////////////////////////////////////////////////////////

// Getters and Setters/Encapsulation -- Person.php

/* Protection and security, if you manipluate properties directly--it's hard to attach certain behaviors associated with thode properties or add rules to manipulate them. 

Encapsulation -- Putting a black box around your objects, so that properties within them can only be accessed via methods.
*/

class Person() {
    
    private $name;
    
    private $age; //Need to set this property as private, so that variable cannot be manipulated directly. Will throw an error "Call to private method".

    public function __construct($name) {
        $this->name = $name;
    }
    
    public function setAge($age) { //Setter
        
        if ($age < 18) {
            throw new Exception('Person is not old enough');
        }
        else {
            $this->age = $age;
        }
    }
    
    public function getAge() { //Getter
        return $this->age * 730; //Days old -- hook introducing specific behavior, manipulate this property/variable more easily.
    }
}

$john = new Person('John Doe');

$john->setAge = 30;

var_dump($john);

////////////////////////////////////////////////////////////////

// Inheritance 

/* Retrieving properties from other classes for use in another */

class Mother {
    
    public function getEeyeCount() {
        return 2;
    }
}

class Father {

}

class Child extends Mother{

}

(new Child)->getEyeCount();

//Laravel Model

class Post extends Eloquent {

}

$post->update();


abstract class Shape { //There never really IS a generic shape, so make abstract. "Functionality can be added, but functionality can still be added". Cannot be instantiated, and  prevents user from accessing this class.
    
    //IF there's ever something similar across objects, put it here. You can also create a sort of "contract" between all objects, saying they MUST use a certain method/function
    
    protected $color;
    
    public function __construct($color = 'red') { //Defaults to red, otherwise color is definied by user
    
        $this->color = $color;
        
    }
    
    public function getColor {
    
        return $this->color;
        
    }
    
    abstract protected function getArea(); //Requires all shapes to have this method, template method.
    
}



class Square extends Shape {
    
    protected $length = 4;
    
    public function getArea() { 
        //No bueno, can't use the same algorithm, so..
        
        return pow($this->length, 2);    
    }

}

class Triangle extends Shape{
    
    protected $base = 4;
    
    protected $height = 7;
    
    public function getArea() { //You can override functionality of a parent class by recreating the method in a child class.
        return .5 * $this->base * $this->height;
    }

}

class Circle extends Shape {

    protected $radius = 30; 
        
    public function getArea() {
        return M_PI * pow($this->radius, 2);
    }

}

new Square('red');

echo (new Square('green'))->getColor(); //Will be green

echo (new Square())-->getColor(); //Will be red

echo (new Circle)->getArea(); //Will work now

////////////////////////////////////////////////////////////////

// Messages/Autoloading

/* Business hires person, person part of staff, exmaple of classes interacting with one another--sending "messages: to one another */

class Person {

    protected $name;
    
    public function __construct($name) {
    
        $this->name = $name;
        
    }
    
}

class Business {
    
    public function __construct(Staff $staff) {
    
        $this->staff = $staff; //Business depends on staff in order to run
    
    }

    public function hire(Person $person) {
        
    //add person to the staff collection
    $this->staff->add($person); //Adds Person to Staff object for THAT business    
        
    }
    
    public function members () { //People split on this, if it's a get you have to add the "get", but some say you don't need it
        return $this->members[]; //i kind of agree, prefer "get" identifier
    }

}

class Staff {
    
    protected $members = [];
    
    public function __construct(Staff $members = []) { //Cannot have staff without any members, if you don't NEED staff, it's okay to defualt to an array
    
        $this->members = $members; //The members of THIS staff
    
    }


    public function add (Person $person) {
    
        $this->members[] = $person;
    
    }

}


$sloane = new Person('Sloane');

$staff = new Staff([$Sloane]); //This makes more sense, because it's MY buiness, so there would already eb a staff member inside the array 

$laracasts = new Business($staff); //The staff portion of Business is a "dependency"

$laracasts->hire($sloane);

//After this staff should have one person inside of it

//Autoloading Example

require ('src/filename.php'); //Not good

require ('vendor/autoload.php') //Supes good

//Use composer instead, good for autloading

/* {

    "autoload": {
    
        "psr-4": { //Standard that specifies how the file will be autoloaded
            "Acme\\": "src/blah.php" --> Namespace is "Acme"
        
        }
    }


}

namespace Acme; //Cateogrizes php files for autoloading */
    
$sloane = new Person('Sloane'); //instead of this

$sloane = new Acme\Person('Sloane'); //better

//if you

use Acme\Person;

//you don't have to 

$sloane = new Acme\Person('Sloane');

//you can remove the "acme" and

$sloane = new Person('Sloane'); 

////////////////////////////////////////////////////////////////

//Statics and Constants

/* Most of the time, statics are NOT the right choice. They should be used for simple operations that are never going to change. */

class Math {

    public static function add(...$nums) { //Most of the time, statics are bad
    
        return array_sum(func_get_args($nums)); //If this method starts interacting with other parts, everything breaks
        
    }

}

//Without static

$math = new Math;

var_dump($math->add(1,2,3,4));

//With a static

echo Math::add(1,2,3); //in this case, this is okay because we're just adding numbers



class Person {

    public static $age = 1; //So wrong

}

Person::$age; //But does this make sense? No.

//Another example

class Person {

    public static $age = 1;
    
    public funtion haveBirthday() {
    
        static::$age += 1;
    
    }

}

$joe = new Person;

$joe->haveBirthday();

echo Person::$age; //Seems okay, but....

$jane = new Person;
$jane->haveBirthday();

echo Person::$age; //Will output 4, because the age variable is SHARED. It should be instanced, not global (encapsulated within the class and specific to each person)



//Constant example

class BankAccount {

    const TAX = .09; //Saying that this will NEVER be changed or manipulated

}


echo BankAccount::TAX;


////////////////////////////////////////////////////////////////

//Interfaces and Implementation

/* An interface is a type of contract. If there are ever classes or tasks that have multiple ways of executing, then you should create an interface. */

//Example 1

interface Animal { 

    public function communication(); //Forces all classes to use this function
    
}

class Dog implements Animal {

    public function communicate() {
    
        return "Bark";
    
    }
    
}

class Cat implements Animal {

    public function communicate() {
    
        return "Meow";
    
    }
    
}


//Example 2


interface logger {  
    
    public function execute($message);
    
}


class LogToFile implements Logger {

    public function execute($message) {
    
        var_dump('Log the message to a file');
    
    }

}


class LogToDatabase implements Logger {

    public function execute($message) {
    
        var_dump('Log the message to a database');
    
    }

}

// ....


class UsersController { //You don't need to change this class at all to use other funcitonalities 
    
    protected $logger;
    
    public function __construct(Logger $logger) { //Instead of specific class/function--now saying, hey in order for me to work, i need to have some kind of functionality, but it doesn't have to be specific.
        
        $this->logger = $logger;
    
    }

    public function show() {
    
        $user = "JohnDoe";
        
        //log this info
        
        $this->logger->execute($user);
    
    }

}

$controller = new UsersController(new LogToFile);

$controller = new UsersController(new LogToDatabase);

$controller->show();


//Example 3

interface CastsToJson {

    public function toJson();
    
}

class User implements CastsToJson {}

class Collection implements CastsToJson {}



//Example 4 


interface Repository {

    public function save($data);
    
}


class MongoRepository {
    
    public function save($data) {
    
    
    
    }


}

class FileRepository {
    
    public function save($data) {
    
    
    
    }


}



//Example 5

interface CanBeFiltered {

    public function filter();

}


class filterByDate implements CanBeFiltered {

    protected $data;
    
    public function filter($data) {
    
        //Filters data and stuff
    
    }

}

class filterByFave implements CanBeFiltered {

    protected $data;
    
    public function filter($data) {
    
        //Filters data and stuff
    
    }

}


///////////////////////////////////////////

//Abstract classes vs. interfaces

interface Provider {
    
    public function authorize();

}
    
function login(GithubProvider $provider) {

    $provider->authorize(); //Great until you need to use another form of login validation
    
    //You could do an if else
    
    if ($provider) 
        $provider->authorize();
    
} 

//It's better to do this

function login(Provider $provider) {

    $provider->authorize(); //This is an example of polymorphism
    
}

?>