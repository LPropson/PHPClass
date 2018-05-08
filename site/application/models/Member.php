<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Model {

	public function user_login($email,$pwd)
    {
        $this->load->database();
        $this->load->library('session');

        try {
            $db = new PDO($this->db->dsn, $this->db->username, $this->db->password, $this->db->options);

            //system prepares what needs to be executed
            $sql = $db->prepare("select memberID,memberPassword,MemberKey from memberLogin where memberEmail = :Email and RoleID = 2");

            //Bind Value for parameter
            $sql->bindValue(":Email", $email);

            //execute - returns all rows from table
            $sql->execute();

            //fetch - get first record in table
            $row = $sql->fetch();

            if($row!=null){
                $hashPassword = md5($pwd . $row["MemberKey"]);

                if($hashPassword == $row["memberPassword"]){
                    $this->session->set_userdata(array("UID"=>$row["memberID"]));
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }

        } catch(PDOException $e){
            return false;
        }
    }

    public function add_user($fullname,$email,$pwd)
    {
        $this->load->database();
        $this->load->library('session');

        $key = sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        $Role = 3;

        //Do DB work!!!

        include "../Includes/dbConn.php";

        try {
            $db = new PDO($this->db->dsn, $this->db->username, $this->db->password, $this->db->options);

            //system prepares what needs to be executed
            $sql = $db->prepare("insert into memberLogin (memberName,memberEmail,memberPassword,RoleID,MemberKey) VALUE (:Name,:Email,:Password,:RID,:Key)");

            $sql->bindValue(":Name", $fullname);
            $sql->bindValue(":Email", $email);
            $sql->bindValue(":Password", md5($pwd . $key));
            $sql->bindValue(":RID", $Role);
            $sql->bindValue(":Key", $key);

            //execute - returns all rows from table
            $sql->execute();

            return true;


        } catch (PDOException $e) {
            return false;
        }

        $FName = "";
        $Email = "";
        $mPassword = "";
        $Role="";
        $errmsg = "Member Added to Database!";

    }
}
