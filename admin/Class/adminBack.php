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
                $_SESSION['adminPass'] = $admin_info['admin_pass'];
            }else{
                $errmsg= "Your Username or Password is Incorrect!";

                return $errmsg;
            }
        }

    }

    function adminLogout(){
        unset($_SESSION['id']);
        unset($_SESSION['adminEmail']);
        unset($_SESSION['adminPass']);
        header('location:index.php');

    }

    function add_category($data){
        $ctg_name = $data['ctg_name'];
        $ctg_des = $data['ctg_des'];
        $ctg_status = $data['ctg_status'];

        $query = "INSERT INTO category(ctg_name,ctg_des,ctg_status)
        VALUE('$ctg_name','$ctg_des',$ctg_status)";
        
        if(mysqli_query($this->conn,$query)){
            $message = "Category Add Successfull !";
            return  $message;
        }else{
            $message = "Category Not Added!";
            return  $message;
        }

    }

    function display_category(){
        $query = "SELECT * FROM category"; 
        if(mysqli_query($this->conn,$query)){
            $return_ctg = mysqli_query($this->conn,$query);
            return $return_ctg;
        }

    }

    function  publish_category($id){
        $query = "UPDATE category SET ctg_status=1 WHERE ctg_id=$id";
        mysqli_query($this->conn,$query);

    }
    function  unpublish_category($id){
        $query = "UPDATE category SET ctg_status=0 WHERE ctg_id=$id";
        mysqli_query($this->conn,$query);
 
    }
    function  delete_category($id){
        $query = "DELETE FROM category WHERE ctg_id=$id";
        mysqli_query($this->conn,$query);
        $msg = "Category Deleted Successfully !";
        return $msg;
 
    }
    function  getCatinfo_toupdate($id){
        $query = "SELECT * FROM category WHERE ctg_id=$id"; 
        if(mysqli_query($this->conn,$query)){
            $cat_info = mysqli_query($this->conn,$query);
            $ct_info =  mysqli_fetch_assoc($cat_info);
            return $ct_info;
        }       
    } function update_category($receive_data){
       $ctg_name = $receive_data['u_ctg_name'];
       $ctg_des = $receive_data['u_ctg_des'];
       $ctg_id = $receive_data['u_ctg_id'];

       $query = "UPDATE category SET ctg_name='$ctg_name',
       ctg_des= '$ctg_des' WHERE ctg_id =$ctg_id ";

        if(mysqli_query($this->conn,$query)){
            $return_msg = "Category Updated Successfully !";
            return $return_msg;
        }
    }       


}


?>