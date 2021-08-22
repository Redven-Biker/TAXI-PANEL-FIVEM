<?php
        
include "header.php";?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST")
{

    if (trim($_POST['type']) == NULL) 
    {
        Header("Location:billings");
    }
    if ($_POST['type'] == "create")
        {
            $insert = $con->query(
            "INSERT INTO billings (customer,km,date,price,driver,pay,services,vehicle_type) VALUES('".$con->real_escape_string($_POST['customer'])."','".$con->real_escape_string($_POST['km'])."','".date('m-d-Y H:i')."','".$con->real_escape_string($_POST['price'])."','".$con->real_escape_string($_POST['driver'])."','".$con->real_escape_string($_POST['pay'])."','".$con->real_escape_string($_POST['services'])."','".$con->real_escape_string($_POST['vehicles'])."')"
            );
            
            if ($insert)
            {
              $msg ='<div class="alert alert-success" role="alert">Billing Added</div>';
            }

        }
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
                        <h1 class="mt-4">Add Billing</h1>
                        <div class="row">
                        <center>
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "create") ?>
                          <?php echo $msg ?>
                      

         
<form method="post">
  <input type="hidden" name="type" value="create">
  <div class="form-group">
    <label for="exampleFormControlInput1">Customer Name</label>
    <input type="text" class="form-control" name="customer" placeholder="Customer Name" required>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Km</label>
    <input type="number" class="form-control" name="km" placeholder="Km" required>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlInput1">Price</label>
    <input type="number" class="form-control" name="price" placeholder="Price" required>
  </div>
  
  <div class="form-group">
    <input type="text" class="form-control" name="driver" value="<?php echo $_SESSION["name"] ?>" hidden>
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
