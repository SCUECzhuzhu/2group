<?php

define("TOKEN", "liyue");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();

class wechatCallbackapiTest
{
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
            if($keyword == "用户告警")
            {	
                
                $msgType = "text";
                $hour = date("H",time());
                if($hour>=9&&$hour<18){
						$low=0;
						$high=9;
					}
              	elseif($hour>=18&&$hour<24){
						$low=9;
						$high=18;
								}
				else {
							$low= 18;
							$high = 23;
								}
            
                   	
				$mysql	=	new SaeMysql();
				$sql="SELECT name, sum( frequency ) as sum
				FROM ((
				SELECT name, frequency
				FROM record
				WHERE HOUR
				BETWEEN $low
				AND $high
				AND time
				BETWEEN date_sub( now( ) , INTERVAL 1
				DAY )
				AND now( )
				) AS a)
				GROUP BY name limit 1";
				$mysql->runSql($sql);
				$row	=	$mysql->getLine($sql);

				$sql	=	"SELECT name, sum( frequency ) as sum
				FROM ((
				SELECT name, frequency
				FROM record
				WHERE HOUR
				BETWEEN $low
				AND $high
				AND time
				BETWEEN date_sub( now( ) , INTERVAL 1
				DAY )
				AND now( )
				) AS a)
				GROUP BY name";

				$result	=	$mysql->getData($sql);				
				foreach ($result as $row) { 
    				foreach ($row as $key => $value) {
       						      
        							$userName[]=$value;
    										
                    
                    } 
                }
                
                foreach($result as $row){
                	extract($row);
                    if($sum<500){                    	
                        $q[]=$name.":".$sum;
                    	$q_test[]="name='".$name."'";
                    }                        
                    
                }
                $warningTest=implode(" or ",$q_test);                
				
                $sql	=	"SELECT * FROM `userdatabase` where $warningTest limit 1";

				$row	=	$mysql->getLine($sql);

				$sql	=	"SELECT * FROM `userdatabase` where $warningTest ";

				$result	=	$mysql->getData($sql);
            	foreach($result as $row){
                	extract($row);
                    $warInformation[]="Id:".$user_id." 姓名:".$name." 密码:".$password." 个人电话:".$personal_tel." 家庭电话:".$urgent_tel." 地址".$address;                      
                    
                }
                $warningInformation=implode("\n\n",$warInformation);
                
                $warning=implode(",",$q);				                
                $text = implode(":", $userName);
                $zhengwen='在最近一天的'.$low.'时到'.$high.'时的时间段内                                           其中处于警告状态的用户为:'.$warning.'                     警告用户的信息为'.$warningInformation;
                $resultStr =sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$zhengwen);
                $mysql->closeDb();
                echo $resultStr;
            }
                
  			if($keyword == "用户信息")
            {	
                
                $msgType = "text";          	
            	$mysql	=	new SaeMysql();

				$sql	=	"SELECT * FROM `userdatabase` limit 1";

				$row	=	$mysql->getLine($sql);

				$sql	=	"SELECT * FROM `userdatabase`";

				$result	=	$mysql->getData($sql);
            	foreach($result as $row){
                	extract($row);
                    $userInformation[]="Id:".$user_id." 姓名:".$name." 密码:".$password." 个人电话:".$personal_tel." 家庭电话:".$urgent_tel." 地址".$address;                      
                    
                }
                $information=implode("\n\n",$userInformation);
                $resultStr =sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$information);
                $mysql->closeDb();
                echo $resultStr;
	            						}
        
            if(substr($keyword,0,2) == "id")
            {	
                $id=substr($keyword,2);
                $msgType = "text";          	
            	$mysql	=	new SaeMysql();

				$sql	=	"SELECT * FROM `userdatabase` where user_id=$id limit 1";

				$row	=	$mysql->getLine($sql);

				$sql	=	"SELECT * FROM `userdatabase` where user_id=$id";

				$result	=	$mysql->getData($sql);
            	foreach($result as $row){
                	extract($row);
                    $userInformation[]="Id:".$user_id." 姓名:".$name." 密码:".$password." 个人电话:".$personal_tel." 家庭电话:".$urgent_tel." 地址".$address;                      
                    
                }
                $idinformation=implode("\n\n",$userInformation);
                $idresultStr =sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$idinformation);
                $mysql->closeDb();
                echo $idresultStr;
	            						}
        }   
        
        
        
        else{
            echo "";
            exit;
        }
    
    }     
}
?>