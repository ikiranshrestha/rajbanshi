<?php
include('../navbar.php');
require_once('../config/config.php');
include_once('../functions/functions.php');
$currentDate = date("Y/m/d");
$fire;
$conn;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Sheet</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>

    <div class="container">

        <div class="row">
            <!-- Current Day's expenses -->
            <div class="col-sm-6">
                <h3>Today's Expenses</h3>
                <table class="table table-striped">
                    <thead>
                        <tr class="table table-striped">
                            <!-- <th>S.no</th> -->
                            <th>Particulars</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>

                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        selectExpensesOfCurrentday();
                        if (mysqli_num_rows($fire) > 0) {
                            while ($row = mysqli_fetch_assoc($fire)) {
                                echo "<tr>";
                                // echo "<td>1.</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['product_quantity'] . "</td>";
                                echo "<td>" . $row['product_rate'] . "</td>";
                                echo "<td>" . $row['amount'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="bold" scope="row">
                            <th colspan="2">Total</th>
                            <th colspan="2" text>
                                <?php
                                selectExpensesOfCurrentday();
                                $sum = 0;
                                while ($row = mysqli_fetch_assoc($fire)) {
                                    $sum += $row['amount'];
                                }
                                echo "Rs. " . $sum;
                                ?>
                            </th>
                        </tr>
                    </tfoot>


                </table>
            </div>

            <!-- All Expenses -->
            <div class="col-sm-6">
                <h3>All Expenses</h3>
                <table class="table table-striped">
                    <thead>
                        <tr class="table table-striped">
                            <!-- <th>S.no</th> -->
                            <th>Particulars</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>

                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        // $select = "SELECT * FROM expenses";
                        // $fire = mysqli_query($conn, $select);
                        selectAllFromExpensesTable();
                        if (mysqli_num_rows($fire) > 0) {
                            while ($row = mysqli_fetch_assoc($fire)) {
                                echo "<tr>";
                                // echo "<td>1.</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['product_quantity'] . "</td>";
                                echo "<td>Rs. " . $row['product_rate'] . "</td>";
                                echo "<td>Rs. " . $row['amount'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="bold" scope="row">
                            <th colspan="2">Total</th>
                            <th colspan="2" text>
                                <?php
                                // $select = "SELECT amount FROM expenses";
                                // $fire = mysqli_query($conn, $select);
                                selectAllFromExpensesTable();
                                $sum = 0;
                                while ($row = mysqli_fetch_assoc($fire)) {
                                    $sum += $row['amount'];
                                }
                                echo "Rs. " . $sum;
                                ?>
                            </th>
                        </tr>
                    </tfoot>


                </table>

            </div>
        </div>

    </div>
    <?php
        include('footer.php');
    ?>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>

</html>