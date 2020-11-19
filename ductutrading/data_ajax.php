<?php
include 'Connection/Connection.php';
include "Database/Database.php";
include "Model/AbstractModel.php";
include "Model/Category.php";
include "Model/Product.php";
include "Model/CartItem.php";

use Connection\Connection;
use Model\Category;
use Model\Product;
use Model\CartItem;
use Model\AbstractModel;
if($_GET["CategoryID"] != "")
{
    $product = new Product();
    $param = $_GET["CategoryID"];
    $arr_pro = $product->fetchFilterByCategory($param);
    $row = 0;
    for ($i = 0; $i < count($arr_pro); $i++)
    {
        $id = $arr_pro[$i]["ProductID"];
        $productImage = "<div class='table-element-ajax'><img class='productImage' src='". $arr_pro[$i]["ProductImage"] . "'></div>";
        $productName = "<div class='table-element-ajax'>". $arr_pro[$i]["ProductName"] . "</div>";
        $Price = "<div class='table-element-ajax'>". number_format($arr_pro[$i]["Price"]) . "</div>";
        $btnAddtocart = "<div class='table-element-ajax'><button class='btnAdd' id='$id' onclick='addtocart(this.id);'>Add To Cart</button></div>";
        if($i == 0 || $i == ($row + 3))
        {
            $row = $i;
            echo "<tr><td>".
                $productImage.
                $productName.
                $Price.
                $btnAddtocart;
            echo "</td>";
        }
        else if($i < ($row + 3))
        {
            echo "<td>".
                $productImage.
                $productName.
                $Price.
                $btnAddtocart.
                "</td>";
        }
    }
}
?>