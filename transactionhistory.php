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
        <h2 class="text-center pt-4">Transaction History</h2>
        
       <br>
       <div class="table-responsive-sm">
    <table class="table table-hover table-striped table-condensed table-bordered">
        <thead>
            <tr>
                <th class="text-center">S.No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Date and Time</th>
                <th class="text-center">Amount Transferred</th>
            </tr>
        </thead>
        <tbody>
        <?php

            include 'config.php';

            $sql ="select * from transactions";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr>
            <td class="py-2 text-center"><?php echo $rows['Sno']; ?></td>
            <td class="py-2 text-center"><?php echo $rows['Sender']; ?></td>
            <td class="py-2 text-center"><?php echo $rows['Receiver']; ?></td>
            <td class="py-2 text-center"><?php echo $rows['Time']; ?> </td>
            <td class="py-2 text-center"><?php echo $rows['Balance']; ?> </td>
                
        <?php
            }

        ?>
        </tbody>
    </table>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> 
     
</body>
<br>
         <!-- Footer -->
   <footer class="p-2 bg-dark text-white text-center position-relative">
<div class="container">
    <p >
    Copyright &copy;2021. 
         Project for The Sparks Foundation
    </p>
    <a href="#" class="position-absolute bottom-0 end-0 p-5">
        <i class="bi bi-arrow-up-circle.h1"></i>
    </a>
</div>
   </footer>
</html>