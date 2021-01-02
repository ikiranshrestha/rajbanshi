<?php
include_once('../navbar.php');
require_once('../config/config.php');

if (isset($_POST['insert'])) {
    $menu_item_name = $_POST['menuItemName'];
    $menu_item_rate = $_POST['menuItemRate'];

    $query = "INSERT INTO menulist(menu_item_name, menu_item_rate) VALUES('$menu_item_name', '$menu_item_rate')";
    $fire =  mysqli_query($conn, $query);
}

$selectionQuery = "SELECT * from menulist";
$fire = mysqli_query($conn, $selectionQuery);
// $row = mysqli_fetch_assoc($fire);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2>Insert New Menu Item</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="menuItemName" id="menuItemName" placeholder="Menu Heading">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="menuItemRate" id="menuItemRate" placeholder="Expense Rate">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Insert" class="btn btn-success" name="insert">
                    </div>
                </form>
            </div>

            <div class="col-sm-6">
                <h2>Menu Chart</h2>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search menu Item" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr class="table table-striped">
                            <!-- <th>S.no</th> -->
                            <th>Menu Item Name
                            </th>
                            <th>Menu Item Rate</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (mysqli_num_rows($fire) > 0) {
                            while ($row = mysqli_fetch_assoc($fire)) {
                                echo "<tr>";
                                echo "<td>" . $row['menu_item_name'] . "</td>";
                                echo "<td> Rs. " . $row['menu_item_rate'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
        include('footer.php');
    ?>
</body>

</html>