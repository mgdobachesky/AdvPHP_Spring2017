<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        class dog {
          public $name;

          public function __construct($name) {
            $this->name = $name;
          }

          public function bark() {
            echo "$this->name is barking <br />";
          }
        }

        $pet = 'dog';
        $dogBark = 'bark';
        $dogName = 'name';

        $dog = new $pet('Seabiscut');
        echo $dog->$dogBark();
        echo $dog->$dogName;

        ?>
    </body>
</html>
