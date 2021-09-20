<?php
include('config.php');

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from user where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from user where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

  //  to check if amount is negative
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Sorry, Amount cannot be negative! ")';  
        echo '</script>';
    }

    //  to check for insufficient balance.
    else if($amount > $sql1['Balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Sorry, Insufficient Balance!")'; 
        echo '</script>';
    }
   
    //  to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Sorry, Amount cannot be zero!')";
         echo "</script>";
     }

    else {
        //deducting amount from sender's account
                $newbal = $sql1['Balance'] - $amount;
                $sql = "UPDATE user set Balance=$newbal where id=$from";
                mysqli_query($conn,$sql);
               // adding amount to reciever's account
                $newbal = $sql2['Balance'] + $amount;
                $sql = "UPDATE user set Balance=$newbal where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['Name'];
                $receiver = $sql2['Name'];
                $sql = "INSERT INTO transactions(`sender`, `Receiver`, `Balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);
                if($query){
                     echo "<script> alert('Amount has been successfully transfered!');
                                     window.location='transactionhistory.php';
                           </script>";
                    
                }

                $newbal= 0;
                $amount =0;
        }
    
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Sparks Bank</title>
</head>
<body>

 <!-- Navigation bar -->
 <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3">
       <div class="container">
        <img src="img/logo.png" alt="logo" style="width:60px; padding-right: 10px;">
        <a href="#" class="navbar-brand">  Sparks Bank</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="index.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="index.html" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="index.html" class="nav-link">Services</a>
                </li>
            </ul>
        </div>
       </div>
   </nav>
   <!-- End of Navigation -->

	<div class="container">
    <h2 class="text-center pt-4" style="color : black;">Transaction</h2>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  user where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr style="color : white;" class="table-dark">
                    <th class="text-center">UserId</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr>
                    <td class="py-2 text-center"><?php echo $rows['id'] ?></td>
                    <td class="py-2 text-center"><?php echo $rows['Name'] ?></td>
                    <td class="py-2 text-center"><?php echo $rows['Email'] ?></td>
                    <td class="py-2 text-center"><?php echo $rows['Balance'] ?></td>
                </tr>
            </table>
        </div>
        <br>
        <label>Transfer To:</label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM user where id!=$sid"; 
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['Name'] ;?> 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label>Amount:</label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button class="btn btn-primary" name="submit" type="submit" id="btn">Proceed to Pay</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> 
     
</body>

</html>