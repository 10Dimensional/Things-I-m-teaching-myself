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

// Messages

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

?>