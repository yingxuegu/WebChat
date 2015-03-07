<?php
//这是一个工具类
class SqlHelper{
    public $conn;
    public $dbname="Webchat";
    var $username="root";
    var $password="root";
    public $host="localhost";

    //写个构造函数
    public function __construct(){
        $this->conn=mysql_connect($this->host,
            $this->username,
            $this->password);

        if (!$this->conn){
            die("连接失败".mysql_errno());
        }

        mysql_select_db($this->dbname,$this->conn);
        mysql_query("set names utf8",$this->conn) or die(mysql_errno());
    }

    //执行dql语句
    public function excute_dql($sql){
        $res=mysql_query($sql,$this->conn) or die(mysql_errno());//哪里开放的资源哪里关闭$array
        return $res;

        //这里需要关闭连接吗？关闭后会有什么后果？多条语句执行会否受影响
    }

    //执行dql语句但是返回的是一个数组,玩得到早释放，效率会很高
    public function excute_dql2($sql){
        $arr=array();
        $res=mysql_query($sql,$this->conn) or die(mysql_errno());//哪里开放的资源哪里关闭$array
        $i=0;

        //$res=>$arr
        while ($row=mysql_fetch_assoc($res)){
            $arr[$i++]=$row;
        }
        //这里就可以立即释放资源
        mysql_free_result($res);
        return $arr;
    }

    //考虑分页情况的查询，这是一个比较通用，这是一个面向OOP思想的代码
    //sql1:"select * from tbname limit 0,6"
    //sql2:"select count(id) from tbname"
    public function excute_dql_fenye($sql1,$sql2,&$fenyePage){
        $i=0;
        //查询到了分页显示的数据
        $res=mysql_query($sql1,$this->conn) or die(mysql_errno());
        //$res放到数组中
        $arr=array();

        //把res转移到arr内
        while ($row=mysql_fetch_assoc($res)){
            $arr[]=$row;
        }
        mysql_free_result($res);

        $res2=mysql_query($sql2,$this->conn) or die(mysql_errno());
        if ($row=mysql_fetch_row($res2)){
            $fenyePage->rowCount=$row[0];
            $fenyePage->pageCount=ceil($row[0]/$fenyePage->pageSize);
        }
        //把arr赋值给分页
        $fenyePage->res_array=$arr;
        mysql_free_result($res2);

        //$fenyePage->navigate=$this->get_fenye_navigate($fenyePage);
    }

    //执行dml语句
    public function excute_dml($sql){
        //3
        $b=mysql_query($sql,$this->conn) or die(mysql_errno());

        if (!$b){
            return 0;
        }else {
            if(mysql_affected_rows($this->conn)){
                return 1;
            }else {
                return 2;//表示行没有收到影响
            }
        }
    }

    //关闭连接
    public function close_connect()
    {
        if (!empty($this->conn))
        {
            mysql_close($this->conn);
        }
    }

    //导航分开
    public function get_fenye_navigate(&$fenyePage){
        //导航也封装到该类中
        //显示上一页和下一页
        $navigate="";
        if($fenyePage->pageNow>1){
            $prePage=$fenyePage->pageNow-1;
            $navigate="<a href='empList.php?pageNow=$prePage'>上一页</a>&nbsp;";
        }

        //整体每十页前翻
        //如果pagenow在1-10，不需要向前翻
        $page_Whole=10;
        $start=floor(($fenyePage->pageNow-1)/$page_Whole)*$page_Whole+1;
        $index=$start;

        if($fenyePage->pageNow>$page_Whole)
        {
            $navigate.="&nbsp;&nbsp;<a href='empList.php?pageNow=";
            $navigate.=$start-1;
            $navigate.="'><<<</a>&nbsp;&nbsp;";
        }

        if ($start+$page_Whole>$fenyePage->pageCount)
        {
            for (;$start<=$fenyePage->pageCount;$start++){
                $navigate.="<a href='empList.php?pageNow=$start'>[$start]</a>&nbsp";
            }
        }else{
            for (;$start<$index+$page_Whole;$start++){
                $navigate.="<a href='empList.php?pageNow=$start'>[$start]</a>&nbsp";
            }
        }
        //整体每十页翻

        if ($start<=$fenyePage->pageCount){
            $navigate.="&nbsp;&nbsp;<a href='empList.php?pageNow=$start'>>>></a>&nbsp;&nbsp;";
        }

        if($fenyePage->pageNow<$fenyePage->pageCount){
            $nextPage=$fenyePage->pageNow+1;
            if ($nextPage<$fenyePage->pageCount)
            {
                $navigate.="<a href='empList.php?pageNow=$nextPage'>下一页</a>&nbsp;";
            }
        }

        //显示当前也和共有多少页
        $navigate.="当前第{$fenyePage->pageNow}/共{$fenyePage->pageCount}页";

        //指定跳转到某页
        $navigate.="</br></br>";
        $fenyePage->navigate=$navigate;
    }
}
?>