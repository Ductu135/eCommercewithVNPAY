function getTotal() {
    var total = new URLSearchParams(window.location.search);
    var parameter = total.get("Total");
    console.log(parameter);
    document.getElementById("amount").value = parameter;
}

function check(value) {
    var total = new URLSearchParams(window.location.search);
    var parameter = total.get("Total");
    var input_param = parseInt(value);
    var url_param = parseInt(parameter);
    console.log(input_param);
    console.log(url_param);
    if(input_param != url_param)
    {
        document.getElementById("btnpay").style.display = "none";
    }
    else {
        document.getElementById("btnpay").style.display = "block";
    }
}

function validateSending() {
    var email = document.getElementById("order_email").value;
    if(email == "")
    {
        alert("Please input your email");
        return false;
    }
    else
    {
        return true;
    }
}