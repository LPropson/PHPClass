<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

 /* Put = Update
 * Post = Insert
 * Get = Select
 * Delete = Delete
 */

 $app = new \Slim\Slim();

 $app->get('/getHello','getHello');
 $app->get('/showMember/:MemberName','showMember');
 $app->post('/addMember/:MemberName','addMember');
 $app->post('/addJSon','addJSon');
 $app->delete('/delUser/:userID','delUser');

 $app->get('/get_races','get_races');
 $app->get('/get_runners/:Race_id','get_runners');
 $app->post('/add_runner','add_runner');
 $app->delete('/del_runner','del_runner');
 $app->put('/update_runner','update_runner');
 $app->run();


 function getHello(){
     echo "Hello World";
 }

 function showMember($MemberName){
     echo "Hello $MemberName";
 }

function addMember($MemberName){
    echo "Hello $MemberName";
}

function addJSon(){
     $request = \Slim\Slim::getInstance()->request();
     $post_json = json_decode($request->getBody(),TRUE);

     echo $post_json["fname"];
}

function delUser($userID){
     echo "User: $userID was DELETED";
}

function get_races(){

    include "../../Includes/dbConn.php";

    try {
        $db = new PDO($dsn,$username,$password,$options);

        //system prepares what needs to be executed
        $sql = $db->prepare("select * from race");

        //execute - returns all rows from table
        $sql->execute();

        //fetch - get first record in table
        $results = $sql->fetchAll();
        echo '{"Races":'. json_encode($results) . '}';
        $results = null;
        $db = null;

    } catch(PDOException $e){
    $error = $e ->getMessage();
    echo json_encode($error);
    }
}


function get_runners($Race_id){

    include "../../Includes/dbConn.php";

    try {
        $db = new PDO($dsn,$username,$password,$options);

        //system prepares what needs to be executed
        $sql = $db->prepare("SELECT DISTINCT memberLogin.memberName, memberLogin.memberEmail FROM memberLogin INNER JOIN member_race ON memberLogin.memberID = member_race.memberID WHERE member_race.raceID = :raceID");
        $sql->bindValue(":raceID",$Race_id);
        //execute - returns all rows from table
        $sql->execute();

        //fetch - get first record in table
        $results = $sql->fetchAll();
        echo '{"Runners":'. json_encode($results) . '}';
        $results = null;
        $db = null;

    } catch(PDOException $e){
        $error = $e ->getMessage();
        echo json_encode($error);
    }
}

function add_runner(){
    $request = \Slim\Slim::getInstance()->request();
    $post_add_runner = json_decode($request->getBody(),TRUE);

    $memberID = $post_add_runner["memberID"];
    $raceID =  $post_add_runner["raceID"];
    $memberKey = $post_add_runner["memberKey"];

    include "../../Includes/dbConn.php";

    try {
        $db = new PDO($dsn,$username,$password,$options);

        //system prepares what needs to be executed
        $sql = $db->prepare("SELECT member_race.raceID FROM member_race INNER JOIN memberLogin ON member_race.memberID = memberLogin.memberID WHERE member_race.raceID = 2 AND memberLogin.MemberKey = :APIKey");
        $sql->bindValue(":APIKey",$memberKey);
        $sql->execute();
        $results = $sql->fetch();

        if($results==null){
            echo "Bad API Key!";
        }else{
            $sql = $db->prepare("INSERT INTO member_race (memberID,raceID,RoleID) VALUES (:memberID,:raceID,3)");
            $sql->bindValue(":memberID",$memberID);
            $sql->bindValue(":raceID",$raceID);
            $sql->execute();
        }

        $results = null;
        $db = null;

    } catch(PDOException $e){
        $error = $e ->getMessage();
        echo json_encode($error);
    }

}

function del_runner(){
    $request = \Slim\Slim::getInstance()->request();
    $delete_del_runner = json_decode($request->getBody(),TRUE);

    $memberID = $delete_del_runner["memberID"];
    //$raceID =  $delete_del_runner["raceID"];
    $memberKey = $delete_del_runner["memberKey"];

    include "../../Includes/dbConn.php";

    try {
        $db = new PDO($dsn,$username,$password,$options);

        //system prepares what needs to be executed
        $sql = $db->prepare("SELECT member_race.raceID FROM member_race INNER JOIN memberLogin ON member_race.memberID = memberLogin.memberID WHERE member_race.raceID = 2 AND memberLogin.MemberKey = :APIKey");
        $sql->bindValue(":APIKey",$memberKey);
        $sql->execute();
        $results = $sql->fetch();

        if($results==null){
            echo "Bad API Key!";
        }else{
            $sql = $db->prepare("DELETE FROM member_race WHERE memberID = :memberID");
            $sql->bindValue(":memberID",$memberID);
            $sql->execute();
        }

        $results = null;
        $db = null;

    } catch(PDOException $e){
        $error = $e ->getMessage();
        echo json_encode($error);
    }
}

function update_runner(){
    $request = \Slim\Slim::getInstance()->request();
    $put_update_runner = json_decode($request->getBody(),TRUE);

    echo $put_update_runner["raceName"];
    echo ":";
    echo $put_update_runner["runnerName"];
    echo " was updated!";
}

?>