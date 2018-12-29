<?php


namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as AdminModel;
use think\Db;
class Forget extends Controller
{
    public function index()
    {
        if (request()->isPost()) { //判断是否post提交
            //创建admin的model实例
            $admin = new AdminModel;
            //通过email查询对应的中介用户
            $result = $admin->where(array('username'=> $_POST["username"],'type'=>1))->find();

            if ($result) {
                if($result['email']==$_POST['email']){
                    //随机生成8位密码
                    $code = generate_password(8);
                    $toemail = $_POST["email"];
                    $subject = "房屋中介管理系统【忘记密码】邮件";
                    $body = "您好，我们已对您在房屋中介网站上对应邮箱帐号的密码进行重置，重置的密码为：" . $code . "。请及时登录修改密码！";
                    if ($this->send_email($toemail, $subject, $body)) { //发送电子邮箱
                        //更新数据
                        $res = Db::name('admin')->where(array('username'=>$result["username"],'email'=>$result['email']))->update(['password'=>sha256($code)]);
                        if ($res) {
                            $msg = "重置密码成功！";
                            ajaxReturn('',$msg,1);
                        } else {
                            $msg = "重置密码失败！";
                            ajaxReturn('',$msg,0);
                        }

                    } else {
                        $msg = "邮件发送失败！";
                        ajaxReturn('',$msg,0);
                    }
                }else{
                    $msg = "该帐号对应邮箱不存在，请重新输入！";
                    ajaxReturn('',$msg,0);
                }

            } else {
                $msg = "该帐号不存在，请重新输入！";
                ajaxReturn('',$msg,0);
            }
        }

    }

    /**
     * 发送email
     * @param $toemail array|string 要发送到的email地址
     * @param $subject string  email标题
     * @param $body string  email主体内容
     * @return bool
     */
    function send_email($toemail, $subject, $body)
    {

        $mail = new \app\common\PHPMailer\PHPMailer();

        $mail->SMTPDebug = 0;

        $mail->isSMTP();
        //加密方式 "ssl" or "tls"
        $mail->SMTPSecure = config('email_config.secure');
        //smtp需要鉴权
        $mail->SMTPAuth = true;
        $mail->Host = config('email_config.host');
        $mail->Port = config('email_config.port');
        $mail->Username = config('email_config.username');
        $mail->Password = config('email_config.psw');

        $mail->From = config('email_config.From');
        $mail->FromName = config('email_config.FromName');
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);

        if (is_array($toemail)) {
            foreach ($toemail as $to_email) {
                $mail->AddAddress($to_email);
            }
        } else {
            $mail->AddAddress($toemail);
        }
        //添加该邮件的主题
        $mail->Subject = $subject;
        //添加邮件正文
        $mail->Body = $body;
        //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
        //$mail->addAttachment('./d.jpg','mm.jpg');
        //同样该方法可以多次调用 上传多个附件
        //$mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');
        //dump($mail);exit;

        $status = $mail->send();

        if ($status) {
            return true;
        } else {
            return false;
        }
    }

}