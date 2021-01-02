<?php
include_once('../navbar.php');
require_once('../config/config.php');
require_once('../functions/functions.php');
$fire;
$conn;

/**
 *  Enter sales Records
 */
if (isset($_POST['markSales'])) {
    $menuSoldItem = $_POST['soldItem'];
    $menuSoldQuantity = $_POST['soldItemQuantity'];
    $query = "SELECT * FROM menulist where menu_item_name = '$menuSoldItem'";
    $menu_item_rate;
    $sales_date = date("Y/m/d");
    $fireMenuQuantityUpdate = mysqli_query($conn, $query);

    if (mysqli_num_rows($fireMenuQuantityUpdate) > 0) {
        while ($row = mysqli_fetch_assoc($fireMenuQuantityUpdate)) {
            $menuItemQuantity = $row['menu_item_quantity'];
            $menuItemQuantity -= $menuSoldQuantity;
            $menu_item_rate = $row['menu_item_rate'];

            $menuUpdateQuery = "UPDATE `menulist` SET `menu_item_quantity`= '$menuItemQuantity' WHERE menu_item_name = '$menuSoldItem'";
            $fire = mysqli_query($conn, $menuUpdateQuery);

            //to update sales table
            $current_sales_amount = $menu_item_rate * $menuSoldQuantity;
            $recordSales =
                "INSERT INTO sales(sales_heading, current_sales_quantity, current_sales_amount, sales_date) 
        VALUES('$menuSoldItem', '$menuSoldQuantity', '$current_sales_amount', '$sales_date')";
        }
        $fireRecordSales = mysqli_query($conn, $recordSales);
    }
}
/**
 * End of Sales Record
 */


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <form action="" method="POST">
                    <h3>Sales Entry</h3>
                    <div class="form-group">
                        <select name="soldItem" id="" class="form-control">
                            <option value="default" selected disabled>--Select Menu Item--</option>
                            <?php
                            selectAllFromMenu();
                            if (mysqli_num_rows($fire) > 0) {
                                while ($row = mysqli_fetch_assoc($fire)) {
                                    echo "<option  value='" . $row['menu_item_name'] . "' name = '" . $row['menu_item_name'] . "'>" . $row['menu_item_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="soldItemQuantity" id="soldItemQuantity" placeholder="Sales Item Quantity">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Mark Sales" class="btn btn-success" name="markSales">
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <h3>Today's Expenses</h3>
                <table class="table table-striped">
                    <thead>
                        <tr class="table table-striped">
                            <!-- <th>S.no</th> -->
                            <th>Sales Heading</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Sales Date</th>

                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        // selectSalesOfCurrentday();
                        $select = "SELECT * FROM `sales` ORDER BY `sales_id` DESC;";
                        // global $fire;
                        $fire = mysqli_query($conn, $select);

                        if (mysqli_num_rows($fire)) {
                            while ($row = mysqli_fetch_assoc($fire)) {
                                echo "<tr>";
                                echo "<td>" . $row['sales_heading'] . "</td>";
                                echo "<td>" . $row['current_sales_quantity'] . "</td>";
                                echo "<td>" . $row['current_sales_amount'] . "</td>";
                                echo "<td>" . $row['sales_date'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="bold" scope="row">
                            <th colspan="2">Total</th>
                            <th colspan="2">
                                <?php
                                // selectAllFromSalesTable();
                                $select = "SELECT current_sales_amount FROM `sales`";
                                // global $fire;
                                $fire = mysqli_query($conn, $select);   
                                $sum = 0;

                                while($row = mysqli_fetch_assoc($fire)){
                                    $current_sales_amount = $row['current_sales_amount'];
                                    $sum += $current_sales_amount;
                                    // echo $row['current_sales_amount'];
                                }
                                echo $sum;
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
</body>

</html>