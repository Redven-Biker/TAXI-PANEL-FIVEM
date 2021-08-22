<?php
        
include "header.php";


if (strlen($_SESSION['id']==0)) {
  header('logoff');
  } else{ 

    if(isset($_POST['Submit']))
    {
      $customer=$_POST['customer'];
      $km=$_POST['km'];
      $price=$_POST['price'];
      $pay=$_POST['pay'];
      $services=$_POST['services'];
      $vehicle_type=$_POST['vehicles'];
      $id=intval($_GET['id']);
      $result = $con->query("UPDATE billings set customer='$customer', km='$km', price='$price', pay='$pay', services='$services', vehicle_type='$vehicle_type' where id='$id'");
      $msg = '<div class="alert alert-success" role="alert">Billing Edited</div>';
    }

    
$result = $con->query(
  "SELECT * FROM services"
  );

$services = [];

while ($data = $result->fetch_assoc()) 
{ 
$services[] = $data;
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
                        <h1 class="mt-4">Edit Billing</h1>
                        <div class="row">
                        <center>
                      

<?php echo $msg ?>
<form method="post" action="">
<?php $result = $con->query("SELECT * from billings WHERE id='".$_GET['id']."'"); while ($data = $result->fetch_assoc())  { ?>
  <input type="hidden" name="type" value="create">
  <div class="form-group">
    <label for="exampleFormControlInput1">Customer Name</label>
    <input type="text" class="form-control" name="customer" value="<?php echo $data['customer']; ?>" required>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Km</label>
    <input type="number" class="form-control" name="km" value="<?php echo $data['km']; ?>" required>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Price</label>
    <input type="number" class="form-control" name="price" value="<?php echo $data['price']; ?>" required>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Pay</label>
<select class="form-control" name="pay" required>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Service</label>
<select class="form-control" name="services" required>
  <?php foreach($services as $services) { ?>
    <option value="<?php echo $services['name']; ?>"><?php echo $services['name']; ?></option>
  <?php } ?>
</select>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Vehicles</label>
<select class="form-control" name="vehicles" required>
  <?php foreach($vehicles as $vehicles) { ?>
    <option value="<?php echo $vehicles['name']; ?>"><?php echo $vehicles['name']; ?></option>
  <?php } ?>
</select>
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