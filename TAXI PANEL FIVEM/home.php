<?php include "header.php";


// Total Employees
$result = $con->query(
    "SELECT count(*) AS total FROM accounts"
    );

$account = [];

while ($data = $result->fetch_assoc()) 
{ 
$account[] = $data;
}

// Total Billings
$result = $con->query(
    "SELECT count(*) AS total FROM billings"
    );

$billings = [];

while ($data = $result->fetch_assoc()) 
{ 
$billings[] = $data;
}

//   Total Money Company
$result = $con->query(
    "SELECT SUM(price) AS total FROM billings"
    );

$billings_money = [];

while ($data = $result->fetch_assoc()) 
{ 
$billings_money[] = $data;
}


?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <div class="row">
                        <?php foreach($account as $account) { ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4 card-home">
                                    <div class="card-body m-2">Total Employees<br>
                                        <h3><?php echo $account['total']; ?></h3>
                                    </div>
                                </div>
                            </div>
                        <?php } foreach($billings as $billings) { ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4 card-home">
                                    <div class="card-body m-2">Total Billings<br>
                                        <h3><?php echo $billings['total']; ?></h3>
                                    </div>
                                </div>
                            </div>
                        <?php } foreach($billings_money as $billings_money) { if ($_SESSION["role"] == "admin") { ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4 card-home">
                                    <div class="card-body m-2">Total Money Company<br>
                                        <h3><?php echo $billings_money['total']; ?>$</h3>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
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
    </body>
</html>
