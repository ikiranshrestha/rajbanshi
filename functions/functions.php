<?php


/** 
 * Functions for trackExpenses.php UI
 * This set of functions is to query the database to view the expenses data to the trackExpenses.php UI
 */

$currentDate = date("Y/m/d");
$fire;
$conn;

function selectAllFromExpensesTable()
{
    global $select;
    global $conn;
    $select = "SELECT * FROM expenses ORDER BY expense_id desc";
    global $fire;
    $fire = mysqli_query($conn, $select);
}

function selectExpensesOfCurrentday()
{
    global $currentDate;
    global $select;
    global $conn;
    $select = "SELECT * FROM expenses where purchase_date = '$currentDate' ORDER BY expense_id desc";
    global $fire;
    $fire = mysqli_query($conn, $select);
}

/**
 * End of Functions for trackExpenses.php UIviber/media
 */


/** 
 * Functions for trackSales.php UI
 * This set of functions is to query the database to view the expenses data to the trackSales.php UI
 */

$fire;
$conn;

function selectAllFromMenu()
{
    global $fire, $conn;
    $menuItemSelection = "SELECT * from menulist";
    $fire = mysqli_query($conn, $menuItemSelection);
    // $row = mysqli_fetch_assoc($fire);

    if (isset($_POST['insert'])) {
        $menu_item_name = $_POST['menu_item_name'];
        $menu_item_quantity = $_POST['menu_item_quantity'];
    }
}

/**
 * End of Functions for trackExpenses.php UI
 */


 /** 
 * Functions for trackSales.php UI
 * This set of functions is to query the database to view the expenses data to the trackSales.php UI
 */

function loadExpensesHeadings(){
    global $fire, $conn;
    $selectExpenseHeading = "SELECT stock_heading FROM stock_raw";
    $fire = mysqli_query($conn, $selectExpenseHeading);
}
/**
 * End of Functions for trackExpenses.php UIviber/media
 */


  /** 
 * Functions for updating stock quantity
 * This function updates the values for the existing stock upon user's expenses update
 * User -> updates the daily expenses (includes stock_heading, quantity and rate) 
 *      on particular stock_headings --> adds the quantity to the existing quantity
 */

function updateStock(){
    
    global $fire, $conn;
    $selectExpenseHeading = "SELECT stock_heading FROM stock_raw";
    $fire = mysqli_query($conn, $selectExpenseHeading);
}
/**
 * End of Functions for trackExpenses.php UIviber/media
 */

   /** 
 * Functions for fetching menu Item Stock
 */
function fetchMenuItemStock(){
global $conn;
$select = "SELECT * FROM menulist";
$fire = mysqli_query($conn, $select);
}
/**
 * End of Functions for fetch menu Item Stock
 */

 //MENU STOCK
function fetchMenuItemStockUpdate(){
    global $conn;
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
}
//END OF MENU STOCK



/** 
 * Functions for trackSales.php UI
 * This set of functions is to query the database to view the expenses data to the trackSales.php UI
 */

$currentDate = date("Y/m/d");
$fire;
$conn;

function selectAllFromSalesTable()
{
    // global $select;
    global $conn;
    $select = "SELECT * FROM `sales` ORDER BY `sales_id` DESC;";
    // global $fire;
    $fire = mysqli_query($conn, $select);
}

function selectSalesOfCurrentday()
{
    global $currentDate;
    // global $select;
    global $conn;
    $select = "SELECT * FROM sales where sales_date = '$currentDate' ORDER BY expense_id desc";
    global $fire;
    $fire = mysqli_query($conn, $select);
}

/**
 * End of Functions for trackSales.php UIviber/media
 */
