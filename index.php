<?php
include('navbar.php');
include('functions/functions.php');
require_once('config/config.php');

// $name = "&lt;item&gt;";
// $qty = 0;
// $rate = 0;
// $amount = "&lt;amount&gt;";


if (isset($_POST['insert'])) {
    $name = $_POST['expense_heading'];
    $qty = $_POST['expenseQuantity'];
    $rate = $_POST['expenseRate'];
    $amount = $qty * $rate;
    $date = date("Y/m/d");

    $query = "INSERT INTO expenses(product_name, product_quantity, product_rate, amount, purchase_date) VALUES('$name', '$qty', '$rate', '$amount', '$date')";
    $fire = mysqli_query($conn, $query);



    $stockUpdateQuery = "SELECT * FROM stock_raw where stock_heading = '$name'";
    $fireStockUpdateQuery = mysqli_query($conn, $stockUpdateQuery);

    if (mysqli_num_rows($fireStockUpdateQuery) > 0) {
        while ($row = mysqli_fetch_assoc($fireStockUpdateQuery)) {
            $stockQuantity = $row['stock_quantity'];
            // echo $stockQuantity." + ". $qty;
            $stockQuantity = $stockQuantity + $qty;

            $stockUpdateQuery2 = "UPDATE `stock_raw` SET `stock_quantity`= '$stockQuantity' WHERE stock_heading = '$name'";
            $fire2 = mysqli_query($conn, $stockUpdateQuery2);

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ya:Mari</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles.css">
    <script src="assets/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <form action="" method="POST">
            <h3>Stock Refill and Expenses Record</h3>
            <div class="form-group">
                <!-- <input type="text" class="form-control" name="expenseName" id="expenseName" placeholder="Expense Heading"> -->
                <select name="expense_heading" class="form-control" id="expense_heading">
                    <option value="default" selected disabled>--Select the Expense Heading--</option>
                    <?php
                    loadExpensesHeadings();
                    // $fire = mysqli_query($conn, $)
                    if (mysqli_num_rows($fire) > 0) {
                        while ($row = mysqli_fetch_assoc($fire)) {
                            echo "<option  value='" . $row['stock_heading'] . "'>" . $row['stock_heading'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="expenseQuantity" id="expenseQuantity" placeholder="Expense Quantity">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="expenseRate" id="expenseRate" placeholder="Expense Rate">
            </div>
            <div class="form-group">
                <input type="submit" value="Insert" class="btn btn-success" name="insert">
            </div>
        </form>

    </div>
    <?php
    include('pages/footer.php');
    ?>
    <script src="assets/jquery.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</body>
</html>