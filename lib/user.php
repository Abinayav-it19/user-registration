<?php
namespace Phppot;
class Member
{
    private $ds;
    function __construct()
    {
        require_once __DIR__ . '/../lib/connection.php';
        $this->ds = new DataSource();
    }
    /**
     * to signup / register a user
     *
     * @return string[] registration status message
     */
    public function registerMember()
    {
            if (! empty($_POST["signup-password"])) {
                $hashedPassword = password_hash($_POST["signup-password"], PASSWORD_DEFAULT);
            }
            $query = 'INSERT INTO tbl_member (username, password, email) VALUES (?, ?, ?)';
             $paramType = 'sss';
            $paramValue = array(
                $_POST["username"],
                $hashedPassword,
                $_POST["email"]
            );
            $memberId = $this->ds->insert($query,$paramType, $paramValue);
            if (! empty($memberId)) {
                $response = array(
                    "status" => "success",
                    "message" => "You have registered successfully."
                );
            }
        return $response;
    }
    public function getMember($email)
    {
        $query = 'SELECT * FROM tbl_member where email = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }
    /**
     * to login a user
     *
     * @return string
     */
    public function loginMember()
    {
        $memberRecord = $this->getMember($_POST["email"]);
        $loginPassword = 0;
        if (! empty($memberRecord)) {
            if (! empty($_POST["login-password"])) {
                $password = $_POST["login-password"];
            }
            $hashedPassword = $memberRecord[0]["password"];
            $loginPassword = 0;
            if (password_verify($password, $hashedPassword)) {
                $loginPassword = 1;
            }
        } else {
            $loginPassword = 0;
        }
        if ($loginPassword == 1) {
            $_GET["email"] = $memberRecord[0]["email"];
            $uName=$_GET["email"];
            $url = "./home.php?email=$uName";
            header("Location: $url");
        } else if ($loginPassword == 0) {
            $loginStatus = "Invalid email or password";
            return $loginStatus;
        }
    }
}






