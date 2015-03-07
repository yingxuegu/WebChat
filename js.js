/**
 * Created by guxueying on 04/03/15.
 */

var i=0;
//create an ajax object
function getXMLHttpObj(){
    var xmlhttp;
    if(window.XMLHttpRequest)
    {
    //alert("not ie5");
    xmlhttp = new XMLHttpRequest();
    }
else {
    //alert("ie 6 or less")
    xmlhttp= new ActiveXObject("Mircosoft.XMLHTTP");
    }
return xmlhttp;
}

var myXML;
//create ajax objects
function checkName(){
    // alert("OK");
    myXML = getXMLHttpObj();
    //alert(checkn)
    if(myXML){
    //alert("ajax successful")
    //alert($("username").value);
    //var url="registerprocess.php?time="+new Date()+"&username="+$("username").value;
    var url="registerprocess.php";
    var data= "username="+$('username').value;
    //alert(data)
    //myXML.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //alert("a")
    // alert(url);
    myXML.open("post",url, true);
    myXML.setRequestHeader("Content-type","application/x-www-form-urlencoded");

    // alert("e");
    myXML.onreadystatechange = handle;
    //line 2 send
    myXML.send(data);

    }
}
//get value by id
function $(id){
    return document.getElementById(id);
    }
//callback function
function handle(){

    //alert("the forth line stage "+myXML.readyState);
    if(myXML.readyState==4&&myXML.status==200){

    var mes =myXML.responseText;
    var mes_obj = eval("("+mes+")");
    // alert(mes);
    var x = mes_obj.res
    $("res").value = x;
    }
}
//Open  chat room
function openChatRoom(obj){
    //alert(obj.value);
    open("chat.php?username="+encodeURI(obj.innerText)+"&r_id="+obj.value,"_blank");
}
