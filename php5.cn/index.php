<?php
/*
# @category: 分享工作室;
# @copyright: 分享在线传媒公社;
# @var; index PHPnew ;
# @version: PHPnew 7.3.1 CACHE_TPL;
*/

$get_usage = memory_get_usage();
$get_peak_usage = memory_get_peak_usage();
define('PHPnew','index');
header('Content-Type: text/html; Charset=utf-8');
define('TIME', microtime(true));
error_reporting(E_ALL ^ E_NOTICE);

//引入类库文件;
include('./PHPnew.class.php');
$PHPnew = new PHPnew();
$PHPnew->templates_new = false; // 是否实时更新

############################# 变量开始产生 ###########################################################3
# 第一步
$install1 = highlight_string("
	<?php 
    # 开始前， 我们先了解一下几个概念：
    
 	//引入类库文件, 类库文件可换成任意路径。
	include('./PHPnew.class.php');
	//模板引擎实例;
	\$PHPnew = new PHPnew();
	//display方法第一个参数是模板文件名，此模板文件默认放置在./Data/cache_tpl/目录下， 具体配置参考PHPnew.class.php
    // 参数同时也支持绝对路径。即读取指定的模板文件。类似： \$PHPnew->display('./dir/phpnew.tpl');
	\$PHPnew->display('phpnew');
",true);

# 第二步
$install2 = highlight_string("
	<?php 
    // php执行代码
    \$new_var = '我是新的变量';
    
 	//引入类库文件, 等php执行完成后再引入模板类库即可。以下三行,可自行封装成函数或者类方法.
	include('./PHPnew.class.php');
	//模板引擎实例;
	\$PHPnew = new PHPnew();
	//最后输出页面. phpnew.html 模板中写代码{\$new_var}即可显示变量内容。非常方便。
	\$PHPnew->display('phpnew');
",true);

# 第三步
$install3 = highlight_string("
	<?php 
	include('./PHPnew.class.php');
	\$PHPnew = new PHPnew();
    // 普通赋值.
    \$new_var = '我是新的变量';
    // 兼容smarty的模式， 如果你以前学过, 仍然可以使用.
    \$PHPnew->assign('user_pay',15.26);
    
    # 两种模式可以同时使用, 互不影响.
    
	//最后输出页面. phpnew.html 模板中写代码{\$new_var},{\$user_pay} 即可显示两个变量内容。
	\$PHPnew->display('phpnew'); 
",true);

# 第四步
$install4 = highlight_string("
	<?php 
	include('./PHPnew.class.php');
	\$PHPnew = new PHPnew();
    \$new_var = '我是php变量';
    \$PHPnew->assign('user_pay',15.26);
    
    # 事实上模板引擎还支持php原生态. 这对于许多喜欢原生态的朋友来说, 也是很好地兼容.
    
	//phpnew.html 模板中写代码{\$new_var},{\$user_pay} <?php echo strlen(52356345234);?> 即可显示三个变量内容。
	\$PHPnew->display('phpnew'); 
",true);

# 第五步
$install5 = highlight_string("
	<?php 
	include('./PHPnew.class.php');
	\$PHPnew = new PHPnew();
    // 定义一个数组.
    \$new_arr = array('yuan'=>'1200','tom'=>'1300','lisa'=>'1500')
    
	//phpnew.html 模板代码:
    <!--{loop \$new_arr \$key \$val}-->
        {\$key} 的工资是:{\$val}
    <!--{/loop}-->
    
	\$PHPnew->display('phpnew'); 
    # 然后访问看看, 是否已经循环出数组在模板中了?
",true);

# 第六步
$install6 = highlight_string("
	<?php 
	include('./PHPnew.class.php');
	\$PHPnew = new PHPnew();
    // 定义一个数组.
    \$new_arr = array('yuan'=>'1200','tom'=>'1300','lisa'=>'1500')
    
	//phpnew.html 模板代码:
    <!--{if is_array(\$new_arr) === true}-->
        \$new_arr是数组.
    <!--{else}-->
        \$new_arr不是数组.
    <!--{/if}-->
    
	\$PHPnew->display('phpnew'); 
",true);

# 第七步
$install7 = highlight_string('
	<?php
          # 以下代码规则是针对html模板文件而讲解.
	      "<?php ?>" 直接写法, 此方法可像写php一样方便.
	      "{eval echo 111}"	 智能模式.简单运行php代码;
	      "{block name}{/block}" block代码运行块, 当你写完一块后, 后续可以多次调用;
	      "{LF}" 为提示产生换行符, 即\n\r
	      "{lang zn}" 语言模板语法, 可配置数组:\$language 实现支持.
          "{template header}" 普通常用的模板文件相互引入;
	      "{template $footer}"	模板文件相互引入的过程支持变量;
	      "{templatesub header}" 模板文件相互引入支持静态引入;
          "{html static}" 模板变量静态解析, 位置将被变量的值替换.
          "{load header}" 普通常用的模板文件相互引入;
          "{loads header}" 模板文件相互引入支持静态引入;
          "// TODO: 需要标注的信息" 新版本支持todo写法.
          "// BUG: 需要标注的bug信息" 新版本支持bug写法.
          * 另外支持CSS, JS引入时套入模板语法. 引入路径将被改变.
	?>
	',true);
# 第八步
$install8 = highlight_string("
	<?php
	include('./PHPnew.class.php');
	\$PHPnew = new PHPnew();
    
    # 以下配置为默认, 可以实例化后自行修改.
	\$PHPnew->templates_dir = './Data/default/'; //模板路径, 首先搜索此路径;
	\$PHPnew->templates_cache = './Data/cache_tpl/'; //缓存模板路径, 此路径需要777写入权限;
	\$PHPnew->templates_default = './Data/default/'; //默认模板路径, 当模板路径下搜索不到文件时, 搜索默认路径;
	\$PHPnew->templates_new = false; //设置当次更新, 系统更新可强制配置为true;
	\$PHPnew->templates_postfix = '.html'; //模板后缀;
    \$PHPnew->templates_var     = 'All';   /变量获取模式, All,ASSIGN;
	\$PHPnew->templates_auto = true; //自动更新模板;
	\$PHPnew->templates_caching = '.php'; //缓存后缀;
	\$PHPnew->templates_space = false; //清除无意义字符
	\$PHPnew->templates_php ='<?php defined(\'PHPNEW_TPL\') === false && exit(\'PHPnew CACHE_TPL 7.3.1\'); ?>'; //为每个缓存头部增加PHP码;
    \$PHPnew->templates_replace = array(); //用于智能更新,可以将模板中的内容直接替换;
    
    //以下为 结果集;
	\$PHPnew->templates_file = array(); //模板文件
	\$PHPnew->templates_cache_file = array(); //缓存文件;
	\$PHPnew->templates_name = null; //标识名
	\$PHPnew->templates_message = null; //html内容;
	\$PHPnew->templates_update = 0; //更新次数
	\$PHPnew->templates_assign = array(); //用户用smarty模式;
    \$PHPnew->templates_debug = array(); //错误信息;
	\$PHPnew->PHPnew = 'PHPnew CACHE_TPL 7.3.1';
    \$PHPnew->templates_static  = 'jpg|gif|png|css|js'; // 静态文件列表.可修改此属性增加自动匹配的文件类型.
	?>
	",true);

# 第九步
$install9 = highlight_string("
	<?php 
	include('./PHPnew.class.php');
	\$PHPnew = new PHPnew();
	\$var = 'phpnew cache_tpl';
	\$PHPnew->display('phpnew');
    
    # 如果你需要全局查看, 可以在display调用后一行进行实例变量打印,
    print_r(\$PHPnew);
    
",true);



# 第十步
$install10 = highlight_string("
	<?php 
	include('./PHPnew.class.php');
	\$PHPnew = new PHPnew();
	#建议使用assign方法设置变量. 会让架构整体更明朗, 知道哪些变量是释放到模板的.
    
    // 关闭系统自动捕捉全局变量
    \$PHPnew->templates_var = 'assign'; // 可省略步骤!
    \$PHPnew->assign('vars', 100); // 设置\$vars为100;
    
    // 当然, 你可以进行数组释放变量
    \$arr = array('vars'=>100,   'vardemo'=> 200);
    \$PHPnew->assign($arr);
 
    # 即可释放出两个变量. 在模板{$vardemo} 即可显示200; 方法可以使用多次.
    
    \$PHPnew->display('phpnew');
",true);


# 第十一步
$install11 = highlight_string("
	<?php 
	include('./PHPnew.class.php');
	\$PHPnew = new PHPnew();
	# 静态文件自动匹配功能. 为了解决图片, js, css文件路径问题而生.
    
    // 首先你需要告诉引擎, 图片, js, css文件放在哪个目录, 即静态文件.
    \$PHPnew->set_autofile('./Static/');  
    # 以站点根目录为起点寻找Static目录, 方法会自动搜寻目录中的所有文件, 无论里面放了多少层目录, 它都会找到. 
    
    // 请不要在目录中存放相同文件名的文件, 一个文件名为唯一, 否则引擎无法知道匹配哪个.
    // 接着在模板中就可以用以下两种方法使用此功能. {__demo.jpg}  __a.css 均可以匹配. html, css, js中均可以这样使用, 以下是一些示例.
    
    '<style>{__comon.css}</style>'   # 引入comon.css 缓存文件, 是缓存文件.
    '<script>__jquery.js</script>'   # 引入jquery.js 缓存文件,
    '<img src=\"{__1.jpg}\" />'        # html中引入图片的快速写法,
    '<div style=\"background: url(__bg.jpg);\">div string</div>' # 背景图片引入.

    # 在引擎环境中, 用{__file.js} 引入文件将大大改善混乱问题, 路径问题交给程序解决吧.
    
    # !{load } 语法不能使用自动匹配!
    \$PHPnew->display('phpnew');
",true);


# 第十二步
$install12 = highlight_string("
	<?php 
	include('./PHPnew.class.php');
	\$PHPnew = new PHPnew();
	# 静态文件除了可解析自动路径外, 也支持简单的变量解析了.
    
    # 建议手工释放静态文件中的变量. 此步也可省略, 它会自动继承全局assign.
    \$PHPnew->set_static_assign('color','red');
    \$PHPnew->set_static_assign('color',array('keys'=>'red'));  // \$color['keys'];
    
    # css, js 文件如普通模板一样写 {$color} {$color['keys']} 都可以得到 red的值. 仅此标准.
    # css, js 文件中可以取得全局常量. {DEFINE}  跟普通模板语法一致.
    # css, js 文件中可以{__a.jpg} 取得静态文件路径, 见上一步详细.
    
    # 解析后的静态文件被写入在缓存目录中.
    
    \$PHPnew->display('phpnew');
",true);

# 第十三步
$install13 = highlight_string("
	<?php 
    # 公共方法共6个, 
	/*
    [1] => display             显示模板信息,重要方法
    [2] => assign              赋值变量.
    [3] => set_static_assign   静态文件赋值变量, 主要针对css, js等静态文件.
    [4] => set_language        数言变量方法, 基本跟assign相似.
    [5] => set_autofile        设置自动匹配路径.
    [6] => cache_dele          删除缓存
    */
",true);

################################ 变量生成完成 ################################



//然后， 用下列方法， 最后输出页面.
$PHPnew->display('phpnew');


# 内以下为存监控.
function convert($size){
     $unit=array('b','kb','mb','gb','tb','pb');
     return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

$usermemory = convert(memory_get_usage() - $get_usage); // 123 kb
$peakmemory = convert(memory_get_peak_usage() - $get_peak_usage); // 123 kb

echo "<div style=\"color:#FFFFFF\">页面内存: $usermemory; 最高占用: $peakmemory</div>";