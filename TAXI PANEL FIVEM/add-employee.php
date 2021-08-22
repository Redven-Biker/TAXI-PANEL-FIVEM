<?php
        
include "header.php";?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST")
{

    if (trim($_POST['type']) == NULL) 
    {
        Header("Location:employees");
    }
    if ($_POST['type'] == "create")
        {
            $insert = $con->query(
                                 "INSERT INTO accounts (username,password,name,role,rank,seen) VALUES('".$con->real_escape_string($_POST['username'])."','".password_hash($con->real_escape_string($_POST['password']),PASSWORD_BCRYPT)."','".$con->real_escape_string($_POST['fullname'])."','user','".$con->real_escape_string($_POST['rank'])."','".date('Y-m-d')."')"
                                 );
            
            if ($insert)
            {
              $msg ='<div class="alert alert-success" role="alert">Employee Added</div>';
            }

        }
      }

      
$result = $con->query(
  "SELECT * FROM ranks"
  );

$ranks = [];

while ($data = $result->fetch_assoc()) 
{ 
$ranks[] = $data;
}
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Add Employee</h1>
                        <div class="row">
                        <center>
                          <?php echo $msg ?>
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "create") ?>
                      

         
<form method="post">
  <input type="hidden" name="type" value="create">
  <div class="form-group">
    <label for="exampleFormControlInput1">Full Name</label>
    <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Username</label>
    <input type="text" class="form-control" name="username" placeholder="Username" required>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password" required>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Rank</label>
<select class="form-control" name="rank" required>
  <?php foreach($ranks as $ranks) { ?>
    <option value="<?php echo $ranks['name']; ?>"><?php echo $ranks['name']; ?></option>
  <?php } ?>
</select>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Role</label>
<select class="form-control" name="role" required>
    <option value="user">User</option>
    <option value="admin">Admin</option>
</select>
  </div>

  <div class="form-group">
    <button type="submit" name="create" class="btn btn-dark btn-add">Submit</button>
</div>
</form></center>
                        
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
    </body>
</html>
