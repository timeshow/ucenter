<?php
namespace TimeShow\UCenter\Services;

use TimeShow\UCenter\Services\Help;

class Api implements \TimeShow\UCenter\Contracts\Api
{
    use Help;

    public $get = [];
    public $post = [];

    public function test()
    {
        // TODO: Implement test() method.
        return API_RETURN_SUCCEED;
    }

    public function deleteuser()
    {
        // TODO: Implement deleteuser() method.
        $uids = $this->get['ids'];

        //同步删除用户代码


        return API_RETURN_SUCCEED;
    }

    public function renameuser()
    {
        // TODO: Implement renameuser() method.
        $uid = $this->get['uid'];
        $oldusername = $this->get['oldusername'];
        $newusername = $this->get['newusername'];

        //同步重命名用户代码

        return API_RETURN_SUCCEED;
    }

    public function updatepw()
    {
        // TODO: Implement updatepw() method.
        $username = $this->get['username'];
        $password = $this->get['password'];

        //同步更新用户密码

        return API_RETURN_SUCCEED;
    }

    public function gettag()
    {
        // TODO: Implement gettag() method.
        $name = $this->get['id'];

        $return = [];
        return $this->serialize($return,1);
    }

    public function synlogin()
    {
        // TODO: Implement synlogin() method.
        $uid = $this->get['uid'];
        $username = $this->get['username'];

        //同步登陆代码

        return API_RETURN_SUCCEED;
    }

    public function synlogout()
    {
        // TODO: Implement synlogout() method.
        //同步注销代码

        return API_RETURN_SUCCEED;
    }

    public function updatebadwords()
    {
        // TODO: Implement updatebadwords() method.
        $cachefile = API_ROOT.'uc_client/data/cache/badwords.php';
        $fp = fopen($cachefile,'w');
        $data = array();
        if(is_array($this->post)){
            foreach ($this->post as $k=>$v){
                $data['findpattern'][$k] = $v['findpattern'];
                $data['replace'][$k] = $v['replacement'];
            }
        }
        $s = "<?php\r\n";
        $s .= '$_CACHE[\'badwords\'] = '.var_export($data,true).";\r\n";
        fwrite($fp,$s);
        fclose($fp);

        return API_RETURN_SUCCEED;
    }

    public function updatehosts()
    {
        // TODO: Implement updatehosts() method.
        $cachefile = API_ROOT.'uc_client/data/cache/hosts.php';
        $fp = fopen($cachefile,'w');
        $s = "<?php\r\n";
        $s .= '$_CACHE[\'HOSTS\'] = '.var_export($this->post,true).";\r\n";
        fwrite($fp,$s);
        fclose($fp);

        return API_RETURN_SUCCEED;
    }

    public function updateapps()
    {
        // TODO: Implement updateapps() method.
        $cachefile = API_ROOT.'uc_client/data/cache/apps.php';
        $fp = fopen($cachefile, 'w');
        $s = "<?php\r\n";
        $s .= '$_CACHE[\'apps\'] = '.var_export($this->post, true).";\r\n";
        fwrite($fp, $s);
        fclose($fp);

        return API_RETURN_SUCCEED;
    }

    public function updateclient()
    {
        // TODO: Implement updateclient() method.
        $cachefile = API_ROOT.'uc_client/data/cache/settings.php';
        $fp = @fopen($cachefile, 'w');
        $s = "<?php\r\n";
        $s .= '$_CACHE[\'settings\'] = '.var_export($this->post, true).";\r\n";
        @fwrite($fp, $s);
        @fclose($fp);

        return API_RETURN_SUCCEED;
    }

    public function updatecredit()
    {
        // TODO: Implement updatecredit() method.
        $credit = $this->get['credit'];
        $amount = $this->get['amount'];
        $uid = $this->get['uid'];

        return API_RETURN_SUCCEED;
    }

    public function getcreditsettings()
    {
        // TODO: Implement getcreditsettings() method.
        $credits = [];
        return $this->serialize($credits);
    }

    public function updatecreditsettings()
    {
        // TODO: Implement updatecreditsettings() method.
        $credit = $this->get['credit'];

        return API_RETURN_SUCCEED;
    }

    public function getcredit()
    {
        // TODO: Implement getcredit() method.
        $uid = $this->get['uid'];
        $credit = $this->get['credit'];

        return API_RETURN_SUCCEED;
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        if(method_exists($this,$name)){
            return call_user_func_array([$this,$name],$arguments);
        }else{
            throw new Exception("function not exists");
        }
    }


}