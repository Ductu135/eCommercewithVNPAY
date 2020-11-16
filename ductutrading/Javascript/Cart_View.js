
function deleteItem(id)
{
    var parameters = new URLSearchParams(window.location.search);
    var result = parameters.get("ProductID");
    var arr = result.split(",");
    for(var i = 0; i < arr.length; i++)
    {
        if(arr[i] == id)
        {
            arr.splice(i, 1);
            var data = arr.join(",");
            var url = "Cart_View.php?ProductID=" + data;
            window.location.href = url;
        }

    }
}

function updateQuantity(id, price)
{
    var quantity = document.getElementById(id).value;
    var cost = (quantity * price);
    // var total = parseInt(document.getElementById("totalMoney").textContent);
    // var totalMoney = (total + cost);
    document.getElementById("lbcost"+id).innerText = cost;

    // console.log(totalMoney);
    var total = 0;
    var parameters = new URLSearchParams(window.location.search);
    var result = parameters.get("ProductID");
    var arr = result.split(",");
    for(var i = 0; i < arr.length; i++)
    {
        var detailPrice = document.getElementById("lbcost"+arr[i]).textContent;
        if(detailPrice == "" && detailPrice != 0)
        {
            total += price;
        }
        else if (detailPrice != "")
        {
            total += parseInt(detailPrice);
        }
    }
    document.getElementById("totalMoney").textContent = total;
}

function back()
{
    var parameters = new URLSearchParams(window.location.search);
    var result = parameters.get("ProductID");
    var arr = result.split(",");
    if(arr.length == 0 || arr.length == 1 && arr[0] == "")
    {
        var url = "index.php";
        window.location.href = url;
    }
    else if(arr.length > 0)
    {
        var data = arr.join(",");
        var url = "index.php?ProductID=" + data;
        window.location.href = url;
    }
    console.log(arr.length);
}



