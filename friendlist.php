<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="js.js"></script>
    <title>login for web chatting</title>

</head>
<body>
<?php
    require_once 'SqlHelper.php';
    $sqlHelper = new SqlHelper();
    $sql = "select * from user";
    $arr = $sqlHelper->excute_dql2($sql);
    $sqlHelper->close_connect();
?>
    <h1>Friend list</h1>
    <ul>
        <?php
        session_start();
        //echo "User: ".$_SESSION['sender_id'];
        foreach($arr as $row){
            if($row['user_id'] != $_SESSION['sender_id']){
                echo '<li onclick="openChatRoom(this)" value="'.$row['user_id'].'" >'.$row['user_name'].'</li>';
            }
        }
        ?>
    </ul>


</body>

</html>