function refreshStatus(url)
{
    document.getElementById("indicator").style.display = "block";

    var xmlhttp;
    if (window.XMLHttpRequest)
    {//IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {//IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            //FIXME: nie pobierać całej treści wraz z tagami <html><body>
            document.body.innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", url ,true);
    xmlhttp.send();
}
