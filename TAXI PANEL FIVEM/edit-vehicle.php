<?php
        
include "header.php";


if (strlen($_SESSION['id']==0)) {
  header('logoff');
  } else{ 

    if(isset($_POST['Submit']))
    {
      $name=$_POST['name'];
      $id=intval($_GET['id']);
      $result = $con->query("UPDATE vehicles set name='$name' where id='$id'");
      $msg = '<div class="alert alert-success" role="alert">Vehicle Edited</div>';
    }

      
$result = $con->query(
  "SELECT * FROM vehicles"
  );

$vehicles = [];

while ($data = $result->fetch_assoc()) 
{ 
$vehicles[] = $data;
}
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Vehicle</h1>
                        <div class="row">
                        <center>
                      

<?php echo $msg ?>
<form method="post" action="">
<?php $result = $con->query("SELECT * from vehicles WHERE id='".$_GET['id']."'"); while ($data = $result->fetch_assoc())  { ?>
  <input type="hidden" name="type" value="create">
  <div class="form-group">
    <label for="exampleFormControlInput1">Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>" required>
  </div>

  <div class="form-group">
    <button type="submit" name="Submit" class="btn btn-dark btn-add">Submit</button>
</div>
<?php } ?>
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
<?php } ?>