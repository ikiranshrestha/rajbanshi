<?php
include_once('../navbar.php');
require_once('../config/config.php');
require_once('../functions/functions.php');

// FOR RAW STOCK
$showStock = "SELECT stock_heading, stock_quantity FROM stock_raw";

if (isset($_POST['reduceRawStock'])) {
    $stockHeading = $_POST['stockHeading'];
    $stockQuantityReduction = $_POST['stockQuantityReduction'];

    $query = "SELECT * FROM stock_raw WHERE stock_heading = '$stockHeading'";
    $fireStockUpdateQuery = mysqli_query($conn, $query);

    if (mysqli_num_rows($fireStockUpdateQuery) > 0) {
        while ($row = mysqli_fetch_assoc($fireStockUpdateQuery)) {
            $stockQuantity = $row['stock_quantity'];
            echo $stockQuantity . " - " . $stockQuantityReduction;
            $stockQuantity -= $stockQuantityReduction;

            $stockUpdateQuery = "UPDATE `stock_raw` SET `stock_quantity`= '$stockQuantity' WHERE stock_heading = '$stockHeading'";
            $fire = mysqli_query($conn, $stockUpdateQuery);
        }
    }
}

// END OF RAW STOCK

//MENU STOCK

$showMenuStock = "SELECT menu_item_name, menu_item_quantity FROM menulist";

if(isset($_POST['reduceMenuStock'])){
    $menuHeading = $_POST['menuItemHeading'];
    $menuQuantityReduction = $_POST['menuQuantityReduction'];
    $query = "SELECT * FROM menulist where menu_item_name = '$menuHeading'";
    
    $fireMenuQuantityUpdate = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($fireMenuQuantityUpdate) > 0) {
        while($row = mysqli_fetch_assoc($fireMenuQuantityUpdate)){
            $menuItemQuantity = $row['menu_item_quantity'];
            $menuItemQuantity -= $menuQuantityReduction;

            $menuUpdateQuery = "UPDATE `menulist` SET `menu_item_quantity`= '$menuItemQuantity' WHERE menu_item_name = '$menuHeading'";
            $fire = mysqli_query($conn, $menuUpdateQuery);
        }
    }
}
//END OF MENU STOCK
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <div class="container">

        <div class="row">
            <div class="col-sm-6">
                <h3>Raw Material Stock</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <form action="" method="POST">
                            <div class="form-group">
                                <select name="stockHeading" id="" class="form-control">
                                    <option value="default" selected disabled>--Raw Material--</option>
                                    <?php
                                    $fire = mysqli_query($conn, $showStock);
                                    if (mysqli_num_rows($fire) > 0) {
                                        while ($row = mysqli_fetch_assoc($fire)) {
                                            echo "<option  value='" . $row['stock_heading'] . "'>" . $row['stock_heading'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" min="0" class="form-control" name="stockQuantityReduction" id="stockQuantityReduction" placeholder="Used-up Stock quantity">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Insert" class="btn btn-success" name="reduceRawStock">
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Stock Heading</th>
                                    <th>Stock Quantity</th>
                                </tr>

                            </thead>

                            <tbody>
                                <?php
                                $fire = mysqli_query($conn, $showStock);
                                if (mysqli_num_rows($fire) > 0) {
                                    while ($row = mysqli_fetch_assoc($fire)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['stock_heading'] . "</td>";
                                        echo "<td>" . $row['stock_quantity'] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <h3>Menu Item Stock</h3>
                <div class="row">
                    <div class="col-sm-6">
                    <form action="" method="POST">
                            <div class="form-group">
                                <select name="menuItemHeading" id="menuItemHeading" 
                                value ="menuItemHeading"
                                class="form-control">
                                    <option value="default" selected disabled>--Menu Item--</option>
                                    <?php
                                    $fire = mysqli_query($conn, $showMenuStock);
                                    if (mysqli_num_rows($fire) > 0) {
                                        while ($row = mysqli_fetch_assoc($fire)) {
                                            echo "<option  value='" . $row['menu_item_name'] . "'>" . $row['menu_item_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" min="0" class="form-control" name="menuQuantityReduction" id="menuQuantityReduction" placeholder="Used-up Stock quantity">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Insert" class="btn btn-success" name="reduceMenuStock">
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                    <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Menu Item Heading</th>
                                    <th>Menu Item Quantity</th>
                                </tr>

                            </thead>

                            <tbody>
                                <?php
                                $fire = mysqli_query($conn, $showMenuStock);
                                if (mysqli_num_rows($fire) > 0) {
                                    while ($row = mysqli_fetch_assoc($fire)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['menu_item_name'] . "</td>";
                                        echo "<td>" . $row['menu_item_quantity'] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    </div>
    </div>
    <?php
    include('footer.php');
    ?>
</body>

</html>