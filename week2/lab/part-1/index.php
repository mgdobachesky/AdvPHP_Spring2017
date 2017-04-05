<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once './autoload.php';


        $test = new ErrorMessage();

        $test->addMessage("test1", 'Testing Error Message 1');
        $test->addMessage("test2", 'Testing Error Message 2');
        $test->addMessage("test3", 'Testing Error Message 3');

        $test->removeMessage("test2");

        var_dump('<br />', $test->getAllMessages());


        $test2 = new Message();

        $test2->addMessage("test1", 'Testing Error Message 1');
        $test2->addMessage("test2", 'Testing Error Message 2');
        $test2->addMessage("test3", 'Testing Error Message 3');

        $test2->removeMessage("test3");

        var_dump('<br />', $test2->getAllMessages());


        $test3 = new SuccessMessage();

        $test3->addMessage("test1", 'Testing Error Message 1');
        $test3->addMessage("test2", 'Testing Error Message 2');
        $test3->addMessage("test3", 'Testing Error Message 3');

        $test3->removeMessage("test1");

        var_dump('<br />', $test3->getAllMessages());

        ?>
    </body>
</html>
