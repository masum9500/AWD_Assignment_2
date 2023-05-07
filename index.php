<?php include "inc/header.php"; ?>
<?php include "Classes/Student.php"; ?>

<?php 
    spl_autoload_register(function($class){
        include "Classes".$class.".php";
    });

    

?>
<section class="mainleft">
    <?php 
    $user = new Student();
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];


        $user->setName($name);
        $user->setEmail($email);
        $user->setPhone($phone);
    }

    if ($user->insert()) {
        echo "<span class='insert'>Data Inserted Successfully..</span";
    }


    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];


        $user->setName($name);
        $user->setEmail($email);
        $user->setPhone($phone);

        if ($user->update($id)) {
        echo "<span class='insert'>Data Updated Successfully..</span";
    }
    }

    


    ?>

    <?php 

        if (isset($_GET['action']) && $_GET['action']=='delete') {
            $id = (int)$_GET['id'];
            if ($user->delete($id)) {
                echo "<span class='delete'>Data Deleted Successfully..</span";
            }
        }
    ?>

    <?php 

        if (isset($_GET['action']) && $_GET['action']=='edit') {
            $id = (int)$_GET['id'];
            $result = $user->getById($id);
    ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $result['id'];?>" required="1"/>
 <table>
    <tr>
        <td>Name: </td>
        <td><input type="text" name="name" value="<?php echo $result['name'];?>" required="1"/></td>    
    </tr>

    <tr>
       <td>Email: </td>
        <td><input type="text" name="email" value="<?php echo $result['email'];?>" required="1"/></td>
    </tr>

    <tr>
      <td>Phone: </td>
        <td><input type="text" name="phone" value="<?php echo $result['phone'];?>" required="1"/></td>
    </tr>
    <tr>
      <td></td>
        <td>
        <input type="submit" name="update" value="Update"/>
        </td>
    </tr>
  </table>
</form>
<?php }else{ ?>
<form action="" method="post">
 <table>
    <tr>
        <td>Name: </td>
        <td><input type="text" name="name" required="1"/></td>    
    </tr>

    <tr>
       <td>Email: </td>
        <td><input type="text" name="email" required="1"/></td>
    </tr>

    <tr>
      <td>Phone: </td>
        <td><input type="text" name="phone" required="1"/></td>
    </tr>
    <tr>
      <td></td>
        <td>
        <input type="submit" name="submit" value="Submit"/>
        <input type="reset" value="Clear"/>
        </td>
    </tr>
  </table>
</form>
<?php } ?>
</section>



<section class="mainright">
  <table class="tblone">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Department</th>
        <th>Age</th>
        <th>Action</th>
    </tr>
<?php 
$i = 0;
    foreach($user->readAll() as $key => $value){
        $i++;
?>
    <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $value['name'];?></td>
        <td><?php echo $value['email'];?></td>
        <td><?php echo $value['phone'];?></td>
        <td>
            <?php echo "<a href='index.php?action=edit&id=".$value['id']."'>Edit</a>";?>
         ||
        <?php echo "<a href='index.php?action=delete&id=".$value['id']."' onClick = 'return confirm(\"Are You Sure..\")'>Delete</a>";?>
        </td>
    </tr>
<?php } ?>

  </table>
</section>










<?php include "inc/footer.php"; ?>