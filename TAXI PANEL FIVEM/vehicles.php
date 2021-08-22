<?php
        
include "header.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "delete") //Checks if it is a delete event.
    {

        if (!$con->query(
                       "DELETE FROM vehicles WHERE id = ".$con->real_escape_string($_POST['id']))
                       ) 
        {
            echo "Error";
            exit();
        }
    }

$result = $con->query(
    "SELECT * FROM vehicles"
    );

$vehicles = [];

while ($data = $result->fetch_assoc()) 
{ 
$vehicles[] = $data;
}

if ($_SESSION["role"] == "admin") { ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Vehicles</h1>
                        <div class="row">
                        <center>
                        <?php if ($_SESSION["role"] == "admin") { ?>
                          <a href="add-vehicle"><button type="button" class="btn btn-dark btn-add">Add Vehicle</button></a>
                        <?php } ?>
                      
                        <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "delete") //Checks if the law was removed.
                        {?>

                            <?php echo '<div class="alert alert-success" role="alert">Vehicle Deleted</div>'; ?>

                        <?php 
                        } ?></center>

                        
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

<table id="myTable">
  <tr class="header">
    <th style="width:15%;">Name</th>
    <th style="width:10%;">Action</th>
  </tr>
  <?php foreach($vehicles as $vehicles) { ?>
  <tr>
    <td><?php echo $vehicles['name']; ?></td>
    <td class="center">
    <form method="post">
    <a href="edit-vehicle?id=<?php echo $vehicles['id']; ?>"><button type="button" class="btn btn-dark"><i class="fas fa-edit"></i></button></a>
    <input type="hidden" name="type" value="delete">
    <input type="hidden" name="id" value="<?php echo $vehicles['id']; ?>">
    <button type="submit" name="create" class="btn btn-danger"><i class="fas fa-trash"></i></button></form></td>
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
<?php } ?>
