<?php
include('../navbar.php');
include('../functions/functions.php');
require_once('../config/config.php');

$getSales = "SELECT * from sales ORDER BY sales_id DESC";
$getExpenses = "SELECT * from expenses ORDER BY expense_id DESC";

$fireSales = mysqli_query($conn, $getSales);
$fireExpenses = mysqli_query($conn, $getExpenses);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ya:Mari</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
    <script src="../assets/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <table class="table table striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Expenses Amount</th>
                        <th>Sales Amount</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                        <!-- <?php
                                if(mysqli_num_rows($fireExpenses) > 0){
                                    while($row = mysqli_fetch_assoc($fireExpenses)){
                                        echo "<tr>";
                                            echo "<td>".$row['purchase_date']."</td>";
                                            // $expensesSum =
                                            echo "<td>".$row['amount']."</td>";
                                    }
                                }

                                if(mysqli_num_rows($fireSales) > 0){
                                    while($row = mysqli_fetch_assoc($fireSales)){
                                        echo "<td>" . $row['current_sales_amount'] . "</td>";
                                        
                                    }
                                    echo "</tr>";
                                }
                            ?> -->
                        <td></td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <?php
    include('../pages/footer.php');
    ?>
    <script src="assets/jquery.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</body>
</html>