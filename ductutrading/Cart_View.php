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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart View</title>
    <link rel="stylesheet" href="CSS/Cart_View.css">
    <link rel="stylesheet" href="CSS/bootstrap-4.5.2-dist/css/bootstrap.min.css">
    <script language="JavaScript" type="text/javascript" src="Javascript/jquery-3.5.1.js"></script>
    <script language="JavaScript" type="text/javascript" src="Javascript/Cart_View.js"></script>
<!--    <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>-->
<!--    <script>paypal.Buttons().render('body');</script>-->
</head>
<body>
<div>
    <h4 style="text-align: center">YOUR CART</h4>
</div>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ProductID</th>
            <th>ProductName</th>
            <th>Price</th>
            <th>Category Name</th>
            <th>Product Image</th>
            <th>Quantity</th>
            <th>Cost</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(empty($_GET['ProductID']) == false)
            {
                $arr_ProductID = explode(',',$_GET['ProductID']);
                $cartItems = new CartItem();
                $arr_cartItems = array();
                for ($i = 0; $i < count($arr_ProductID); $i++)
                {
                    $arr_cartItems[$i] = $cartItems->load_items($arr_ProductID[$i]);
                    for($row = 0; $row < count($arr_cartItems[$i]); $row++)
                    {
                        $id = $arr_cartItems[$i][$row]["ProductID"];
                        $price = $arr_cartItems[$i][$row]["Price"];
                        echo "<tr>".
                                "<td>" . $arr_cartItems[$i][$row]["ProductID"] . "</td>".
                                "<td>" . $arr_cartItems[$i][$row]["ProductName"] . "</td>".
                                "<td>" . $arr_cartItems[$i][$row]["Price"] . "</td>".
                                "<td>" . $arr_cartItems[$i][$row]["CategoryName"] . "</td>".
                                "<td><img class='productImage' src='" . $arr_cartItems[$i][$row]["ProductImage"] . "'></td>".
                                "<td><input type='number' min='0' id='$id' onclick='updateQuantity(this.id, $price);'  class='txtQuantity'></td>".
                                "<td><label id='lbcost$id'  class='lbCost'></td>".
                                "<td><button class='btn btn-info' id='$id' onclick='deleteItem(this.id)' name='delete'>Delete</button></td>".
                             "</tr>";
                    }
                }
            }
        ?>
    </tbody>
</table>
<div class="paying">
    <div class="total">
        <div class="title">
            <label style="font-style: oblique; font-size: 30px">Total:</label>
            <label style="font-style: oblique; font-size: 20px" id="totalMoney" >0</label>
        </div>
    </div>
    <div class="action">
        <button class="btn btn-danger" onclick="back();">Back</button>
        <button class="btn btn-info btnPay" id="" >Pay</button>
    </div>
</div>
<!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">-->
<!--    <input type="hidden" name="cmd" value="_s-xclick">-->
<!--    <input type="hidden" name="hosted_button_id" value="PUEEJ7KL8FEEL">-->
<!--    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">-->
<!--    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">-->
<!--</form>-->

<script>
    $(".btnPay").click(function() {
        var total = $('#totalMoney').text();
        if(total != "0")
        {
            console.log(total);
            url = "./vnpay_php/index.php?Total=" + total.toString();
            window.location.href = url;
        }
        else if (total == "0")
        {
            alert("Please pick a number of products");
        }
    });
</script>
</body>
</html>
