function load()
{

    setTimeout(function(){
        var url = location.href;
        window.location.href = url;
    }, 10000);
}