<?php
require 'Slim/Slim.php';
\Slim\Slim:registerAutoloader();

 /* Put = Update
 * Post = Insert
 * Get = Select
 * Delete = Delete
 */

 $app = new \Slim\Slim();

 $app->get('/getHello','getHello');
 $app->run();

 function getHello(){
     echo "Hello World";
 }

?>