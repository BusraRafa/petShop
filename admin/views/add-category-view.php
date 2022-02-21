<?php 
    $obj_adminBack = new adminBack();
    if(isset($_POST['ctg_btn'])){
        $return_mesg = $obj_adminBack->add_category($_POST);
    }

?>

<h1>Add Category</h1>

<form action="" method = "post">
    <div class="form-group">
        <lebel for = "ctg_name">Category Name </lebel>  
        <input type="text" name = "ctg_name"
        class="form-control">
    </div>
   
    <div class="form-group">
        <lebel for = "ctg_des">Category Description </lebel>  
        <input type="text" name = "ctg_des"
        class="form-control">
    </div>
    <div class="form-group">
        <lebel for = "ctg_status">Category Status </lebel>  
         <select  name = "ctg_status" class="form-control">
            <option value="1">Published</option>
            <option value="0">Unpublished</option>

        </select>
    </div>

    <input type="submit" value ="Add category"
    name = "ctg_btn" class = "btn btn-primary"
    >
    <?php 
        if(isset($return_mesg)){
            echo($return_mesg);
        }
    ?>

</form>