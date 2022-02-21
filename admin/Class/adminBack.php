<?php 


class adminBack{
    private $conn;


    public function __construct()
    {
        $dbhost ="localhost";
        $dbuser ="root";
        $dbpass ="";
        $dbname ="petshop";

        $this->conn = mysqli_connect
        ($dbhost,$dbuser,$dbpass,$dbname);

        if(!$this->conn){
            die("Database Connection Error!");
        }
    }

    function admin_login($data){

        $admin_email = $data['admin_email'];
        $admin_pass = md5($data['admin_pass']);

        $query = "SELECT * FROM adminlog WHERE 
        admin_email='$admin_email' AND
        admin_pass='$admin_pass'";

        if(mysqli_query($this->conn,$query)){
            $result = mysqli_query($this->conn,$query);
            $admin_info = mysqli_fetch_assoc($result);

            if($admin_info){
                header('location:dashboard.php');
                session_start();
                $_SESSION['id'] = $admin_info['id'];
                $_SESSION['adminEmail'] = $admin_info['admin_email'];
            }else{
                $errmsg= "Your Username or Password is Incorrect!";

                return $errmsg;
            }
        }

    }

}













?>