<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>登录系统</title>
 <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>  

     <script>
     
   

    function btnSubmit(){
    //用户名
            var nameInput = document.reForm.account.value;
            if(nameInput.length < 1){

                document.getElementById("span1").innerHTML="<span><font color='red'>用户名不能为空</font></span>"
                return;
            }
        //密码
    var pwdInput = document.reForm.pwd.value;
            if(pwdInput.length < 1){
                document.getElementById("span2").innerHTML="<span><font color='red'>密码不能为空</font></span>"
                return;
            }

    //

            //var formData = $("#reForm").serialize();  
                //serialize() 方法通过序列化表单值，创建 URL 编码文本字符串,这个是jquery提供的方法  
                $.ajax({  
                    type:"post",  
                    url:"http://www.test1.com/index.php/use",  
                     data: {
              //  "_token": "{{ csrf_token() }}",
            },//这里data传递过去的是序列化以后的字符串  

                    success:function(data){  
                        alert('data');
                //获取成功以后输出返回值  
               if(data=='0'){
            window.location="{:url('index/daodu')}";
            alert(data);
        }
        else {
            //alert(data);
    document.getElementById("msg").innerHTML="<span><font color='red'>"+data+"</font></span>"
        }

                    }  
                });  
            } 
    function btn1(){
        document.getElementById("span1").innerHTML="";
    } 
    function btn2(){
        document.getElementById("span2").innerHTML="";
    } 
    </script>
</head>
 
<body style="width: 100%;height: 100%;margin: 0;padding: 0">

<div style="position:absolute;z-index: -1;width: 100%;height: 100%;margin:0;padding:0;background-size: cover"></div>
<form name='reForm' id="reForm">
    <center>
        <div style="padding-top:24%" >
            <table border="0" width="60%" valign="middle"  >
                <tr>
                    <td width="55%"></td>
                    <td width="9%" height="50px"><nobr><font size="4" >用户名:</font></nobr></td>
                    <td width="18%" ><input  name="account" style="width: 140px;height: 20px" 　id="username" type="text" value="" onclick="btn1()" /></td>
                    <td width="18%"><nobr><span id="span1"></span></nobr></td>
                </tr>
                <tr>
                    <td width="55%"></td>
                    <td width="9%" height="50px"><font size="4" >密码:</font></td>
                    <td width="18%"><input  name="pwd" style="width: 140px;height: 20px" id="repwd"  type="password" value=""  onclick="btn2()" /></td>
                    <td width="18%"><nobr><span id="span2"></span></nobr></td>
                </tr>
                <tr>
                    <td width="55%" height="50px"></td>
                    <td colspan="2" align="center"> <input type="button" value='登录' class="dlau"  onclick="btnSubmit()" style="height: 30px;width: 100px;font-size: large;background-color: #4682B4"  /></td>
                    <td width="18%"></td>
                </tr>
                <tr>
                    <td width="55%" height="50px"></td>
                    <td colspan="2" align="center"><span id="msg"></span></td>
                    <td width="18%"></td>
                </tr>
            </table>
        </div>
    </center>
</form>
<center>
<div style="position:absolute;bottom: 25px; text-align: center;display: block;width:100%"  >
  <font style="font-family: 微软雅黑;font-size: small">河北科技大学党委组织部</font>
</div>
</center>
</body>
</html>