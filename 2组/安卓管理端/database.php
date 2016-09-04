
<?php
class DB{

    private $mysql;
    function __construct($charset="GBK"){

        //使用sae接口连接到数据库  
        $this->mysql = new SaeMysql();
        $this->mysql->setCharset($charset);       //设置字符集  
    }
    /**
     * @return:成功返回数组，失败时返回false
     */
    public function select($sql){
        $result = $this->mysql->getData($sql);
        if ($this->mysql->errno() != 0){
            die( "Error:" . $this->mysql->errmsg());
        }
        return $result;
    }
    /**
     * @return:运行Sql语句，不返回结果集
     */
    public function query($sql){
        $this->mysql->runSql($sql);
        if ($this->mysql->errno() != 0){
            die( "Error:".$this->mysql->errmsg());
        }

    }
    public function exec($sql){
        $this->query($sql);
    }
    function __destruct(){

        $this->mysql->closeDb();

    }
    public function get_con(){
        return $this->mysql;
    }
}
?>
