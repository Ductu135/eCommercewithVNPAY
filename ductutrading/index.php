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
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/bootstrap-4.5.2-dist/css/bootstrap.min.css">
<!--    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>-->
    <script type="text/javascript" src="Javascript/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="Javascript/index.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="row wrapper">
        <div class="col-md-3">
            <div class="category-side">
                <ul>
                    <?php
                    $category = new Category();
                    $arr_category = $category->fetchAllCategory();
                    for ($i = 0; $i < count($arr_category); $i++)
                    {
                        $cateID = $arr_category[$i]["CategoryID"];
                        echo "<li>".
                                "<a class='submitCategory' id='$cateID' name='$cateID' onclick='filterbyCategory(this.id);'>" . $arr_category[$i]["CategoryName"] . "</a>"
                            ."</li>";
                    }
                    ?>
                </ul>
                <a class="cartLink" onclick="sendtocart();">VISIT YOUR CART</a>
            </div>

        </div>
        <div class="col-md-9">
            <div class="product-side">
                <div>
                    <h4>THE PRODUCT LIST</h4>
                </div>
                <table class="table-ajax" style="display: none; min-height: 100%;">
                    <tbody class="ajax-result"></tbody>
                </table>
                <table class="table-default">
                    <tbody>
                    <?php
                        $product = new Product();
                        $arr_product = $product->fetchProduct();
                        $row = 0;
                    for ($i = 0; $i < count($arr_product); $i++)
                        {
                            $id = $arr_product[$i]["ProductID"];
                            $productImage = "<div class='table-element'><img class='productImage' src='". $arr_product[$i]["ProductImage"] . "'></div>";
                            $productName = "<div class='table-element'>". $arr_product[$i]["ProductName"] . "</div>";
                            $Price = "<div class='table-element'>". number_format($arr_product[$i]["Price"]) . "</div>";
                            $btnAddtocart = "<div class='table-element'><button class='btnAdd' id='$id' onclick='addtocart(this.id);'>Add To Cart</button></div>";
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
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script>
        function filterbyCategory(id) {
            if (id.toString() != "")
            {
                $.ajax({
                    type: "GET",
                    url: "data_ajax.php",
                    data: {
                        "CategoryID": id
                    },
                    success: function (msg) {
                        $('.table-default').css('display','none');
                        $('.table-ajax').css('display','block');
                        $('.ajax-result').html(msg);
                    }
                });
            }
            else {

            }
        }
</script>
</body>
</html>