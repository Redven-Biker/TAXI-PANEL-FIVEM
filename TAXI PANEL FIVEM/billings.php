<?php
        
include "header.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "delete")
    {

        if (!$con->query(
                       "DELETE FROM billings WHERE id = ".$con->real_escape_string($_POST['id']))
                       ) 
        {
            echo "Error";
            exit();
        }
    }

$result = $con->query(
    "SELECT * FROM billings ORDER BY id DESC"
    );

$billings = [];

while ($data = $result->fetch_assoc()) 
{ 
$billings[] = $data;
}

?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Billings</h1>
                        <div class="row">
                        <center>
                          <a href="add-billing"><button type="button" class="btn btn-dark btn-add">Add Billing</button></a>
                      
                        <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "delete")
                        {?>

                            <?php echo '<div class="alert alert-success" role="alert">Billing Deleted</div>'; ?>

                        <?php 
                        } ?></center>

                        
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for customer names.." title="Type in a name">

<table id="myTable">
  <tr class="header">
    <th style="width:10%;">Customer Name</th>
    <th style="width:10%;">Driver</th>
    <th style="width:10%;">Km</th>
    <th style="width:10%;">Date</th>
    <th style="width:10%;">Price</th>
    <th style="width:10%;">Pay</th>
    <th style="width:10%;">Services</th>
    <th style="width:10%;">Vehicle Type</th>
    <?php if ($_SESSION["role"] == "admin") { ?>
    <th style="width:10%;">Action</th>
    <?php } ?>
  </tr>
  <?php foreach($billings as $billings) { ?>
  <tr>
    <td><?php echo $billings['customer']; ?></td>
    <td><?php echo $billings['driver']; ?></td>
    <td><?php echo $billings['km']; ?></td>
    <td><?php echo $billings['date']; ?></td>
    <td><?php echo $billings['price']; ?>$</td>
    <td><?php echo $billings['pay']; ?></td>
    <td><?php echo $billings['services']; ?></td>
    <td><?php echo $billings['vehicle_type']; ?></td>
    <?php if ($_SESSION["role"] == "admin") { ?>
    <td class="center">
    <form method="post">
    <a href="edit-billing?id=<?php echo $billings['id']; ?>"><button type="button" class="btn btn-dark"><i class="fas fa-edit"></i></button></a>
    <input type="hidden" name="type" value="delete">
    <input type="hidden" name="id" value="<?php echo $billings['id']; ?>">
    <button type="submit" name="create" class="btn btn-danger"><i class="fas fa-trash"></i></button></form></td>
  <?php } ?>
  </tr>
  <?php } ?>
</table>

                        
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
