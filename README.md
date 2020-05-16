## Ucenter Client For The Laravel

### 说明
本项目在参考了多个相关类似项目的基础上修改调整。

### 安装

* [Packagist](https://packagist.org/packages/timeshow/ucenter)
* [GitHub](https://github.com/timeshow/ucenter)

只要在你的 `composer.json` 文件require中加入下面内容，就能获得最新版.

~~~
"timeshow/ucenter": "dev-master"
~~~

然后需要运行 "composer update" 来更新你的项目  

或运行
~~~
composer require timeshow/ucenter
~~~

安装完后，在 `config/app.php` 文件中找到 `providers` 键，

~~~
'providers' => [

    TimeShow\UCenter\UCenterServiceProvider::class

]
~~~

找到 `aliases` 键，

~~~
'aliases' => [

    'UCenter' => TimeShow\UCenter\UCenterServiceProvider::class

]
~~~

## 配置
运行以下命令发布配置文件
~~~
php artisan vendor:publish  --provider="TimeShow\UCenter\UCenterServiceProvider"
~~~
ucenter配置项
~~~
//config.php
'url'		=> '', // 网站UCenter接收数据的Api地址前缀，一般默认留空。
'api'		=> 'http://localhost/ucenter', // UCenter 的 URL 地址, 在调用头像时依赖此常量
'connect'	=> 'mysql', // 连接 UCenter 的方式: mysql/NULL, 默认为空时为 fscoketopen()
'dbhost'	=> 'localhost', // UCenter 数据库主机
'dbuser'	=> 'root', // UCenter 数据库用户名
'dbpw'		=> 'root', // UCenter 数据库密码
'dbname'	=> 'ucenter', // UCenter 数据库名称
'dbcharset'	=> 'utf8',// UCenter 数据库字符集
'dbtablepre'=> '`uc`.uc_', // UCenter 数据库表前缀
'key'		=> '666cLXgFsrl6TcvDflhrvdcziY8SnhP1eexl1eQ', // 与 UCenter 的通信密钥, 要与 UCenter 保持一致
'charset'	=> 'utf-8', // UCenter 的字符集
'ip'		=> '127.0.0.1', // UCenter 的 IP, 当 UC_CONNECT 为非 mysql 方式时, 并且当前应用服务器解析域名有问题时, 请设置此值
'appid'		=> 1, //当前应用的 ID
'ppp'		=> 20, //当前应用的 ID


'apifilename'    => env('UC_APIFILENAME', 'uc'),   //这里是uc_server调用你的程序的接口，配置成uc的话，将会和前面的UC_URL配置一起形成这样的地址 url/api/uc

'service'        => env('UC_SERVICE', 'TimeShow\UCenter\Services\Api'),   //这里如果要异步登陆，可以直接继承这个类实现其中的方法，也可以创建app/Service/UCenter.php(文件放哪里都可以，这里只是推荐) 实现该类实现的接口【*】


~~~

## 环境变量

在 `.env` 环境变量中配置:

~~~
UC_CONNECT=mysql
UC_DBHOST=localhost
UC_DBUSER=root
UC_DBPW=root
UC_DBNAME=ucenter
UC_DBTABLEPRE=`ucenter`.uc_
UC_KEY=123456789
UC_API=http://localhost/uc_server
UC_IP=127.0.0.1
UC_APPID=1

UC_APIFILENAME=uc
~~~

把配置项添加到 .env 文件底部


## 路由

在`routes/web.php`中写入:

`Ucenter::routes();`

这个会添加一个api地址，用于同步登陆和退出


## 使用
例如：获取用户名为test的信息
~~~
$result = Ucenter::uc_get_user('test');
var_dump($result);
~~~


更多函数请参考 [Ucenter 文档](http://faq.comsenz.com/library/UCenter/interface/interface_user.htm)
或 [Github 参考文档](https://github.com/timeshow/ucenter/tree/master/doc) 
## 帮助
1、ucenter 在PHP 7以上版本出现错误
~~~
修正不兼容php7+，mysql_connect()不可用等问题
使用 mysqli_connect 方式连接
~~~
2、UCenter 后台应用管理列表通信失败问题
~~~
一、查看以上配置是否正确
二、在 routes/web.php 中修改
//$result = Ucenter::uc_get_user('test');
//var_dump($result);
~~~

## 联系我
有问题，请提交issue
