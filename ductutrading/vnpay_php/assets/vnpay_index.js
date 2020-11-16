function getTotal() {
    var total = new URLSearchParams(window.location.search);
    var parameter = total.get("Total");
    console.log(parameter);
    document.getElementById("amount").value = parameter;
}