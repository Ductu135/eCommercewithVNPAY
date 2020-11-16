var arr_productID = [];

function addtocart(id) {
    arr_productID.push(id);
    alert("add to cart sucessfully");
}

function sendtocart() {
    var parameters = new URLSearchParams(window.location.search);
    var result = parameters.get("ProductID");
    var arr_length = arr_productID.length;
    if(result == null )
    {
        var data = arr_productID.join(',');
        var url = "Cart_View.php?ProductID=" + data;
        window.location.href = url;
    }
    else if (result != null && arr_length == 0)
    {
        var url = "Cart_View.php?ProductID=" + result;
        window.location.href = url;
    }
    else if (result != null && arr_length != 0)
    {
        var data = arr_productID.join(',');
        var url = "Cart_View.php?ProductID=" + result + "," + data;
        window.location.href = url;
    }
    console.log(result);
}
