<html>
<head>
    <?php
    $username=$_GET['username'];
    $username = trim($username);
    $receiver_id = $_GET['r_id'];
    echo "receiver ".$receiver_id;
    session_start();
    $loginuser=$_SESSION['login'];
    $sender_id = $_SESSION['sender_id'];
    ?>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="js.js"></script>
    <script>
        window.resizeTo(800,800);
        function sendMessage(){
            //alert("a");
            var myxml = getXMLHttpObj();

            if(myxml){
                var url="messagecontroller.php";
                var data= "con="+$('con').value+"&receiver_id=<?php echo $receiver_id;?>&sender_id=<?php echo $sender_id;?>";
                alert(data);
                //alert(url+data);
                myxml.open("post",url,true);
                myxml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                myxml.onreadystatechange = function(){
                    if(myxml.readyState==4 && myxml.status==200){

                    }
                };
                myxml.send(data);
                $('space').value+="You said: "+$('con').value+" "+ " at " +new Date().toLocaleDateString()+"\r\n";

            }
        }

        function getMessage(){
            //alert("a");
            var myxml = getXMLHttpObj();

            if(myxml){
                var url="getmessagecontroller.php";
                var data= "receiver_id=<?php echo $receiver_id;?>&sender_id=<?php echo $sender_id;?>";
                //alert(data);
                //alert(url+data);
                myxml.open("post",url,true);
                myxml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                myxml.onreadystatechange = function(){
                    if(myxml.readyState==4 && myxml.status==200){
                    // receive XML data
                        //alert("haha");
                        var mes = myxml.responseXML;
                        //alert(mes);
                        var content =mes.getElementsByTagName("content");
                        var sendTime = mes.getElementsByTagName("sendTime");


                        //alert(sendTime[0].childNodes[0].nodeValue);
                        // if there are some messages
                        //alert(sendTime.length);
                        if(content.length != 0){
                            for(var i=0;i<content.length;i++){
                                $('space').value += "<?php echo $username; ?>"+" said to "+"<?php echo $loginuser; ?>"+" "+content[i].childNodes[0].nodeValue+" at "+sendTime[i].childNodes[0].nodeValue;
                                //$('space').value += "a"+"<?php echo $loginuser; ?>"+"talked to"+"<?php echo $username; ?>";
                                $('space').value += "\r\n";
                            }

                        }


                    }
                };
                myxml.send(data);

            }
        }

        setInterval("getMessage()",2000);
    </script>
</head>

<body>

<center>
    <h1>you are chatting with <a><?php echo $username?></a></h1>
    <textarea cols="60" rows="20" id="space"></textarea>
    </br>
    <input type="text" style="width:400px" id="con"/></br>
    <input type="button" value="send message" onclick="sendMessage()"/>
</center>

</body>
</html>