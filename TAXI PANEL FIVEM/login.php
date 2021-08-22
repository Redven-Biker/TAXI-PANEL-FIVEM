<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Taxi Panel</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="login-background">
        
    <div class="wrapper">
    <form class="form-signin" method="post">       
      <h2 class="form-signin-heading">Login</h2>
      <?php if (isset($_GET['wrongcredentials'])) { ?>
        <p><strong>The information does not match</strong></p>
      <?php }?>
      <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
      <button class="btn btn-lg btn-warning btn-block" name="login" type="submit">Login</button>   
    </form>
  </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>

<?php // This php code is used for the main login screen, 

    require "database.php"; // Requires first the database connection

    if ($_SERVER['REQUEST_METHOD'] == "POST") 
    {
        if (trim($_POST['username']) == NULL) 
        {
            Header("Location:login?wrongcredentials");//Wrong Crendentials
        }
        if (trim($_POST['password']) == NULL) 
        {
            Header("Location:login?wrongcredentials"); //Wrong Crendentials
        }        

        $query = $con->query(
            "SELECT * FROM accounts WHERE username = '".$con->real_escape_string($_POST['username'])."'"  //Query to fetch accounts
        );

        if ($query->num_rows == 1) 
        {
            $row = $query->fetch_assoc();
            if (password_verify($_POST['password'],$row['password'])) 
            {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['rank'] = $row['rank'];
                $_SESSION['id'] = $row['id'];
                

                $con->query(
                    "UPDATE accounts SET seen = '".date('d-m-Y')."' WHERE id = '".$row['id']."'" //Updates the last time seen.
                );
                
                if ($_SERVER['HTTP_REFFER'] != "") {
                    header('Location: ' . $_SERVER['HTTP_REFERER']); //Referrer method goes here.
                } else {
                    Header("Location: home"); //Logs you in.
                }
                
            } else 
            {
                Header("Location: login?wrongcredentials"); //Wrong Credentials
            }
        } else 
        {
            Header("Location: login?wrongcredentials"); //Wrong Credentials
        }
    }
?> 
