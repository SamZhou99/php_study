<?php
/*
# @copyright: 分享在线传媒公社 Yuan 2013
# @filename; PHPnew.class.php
# @version: PHPnew CACHE_TPL 7.3.1;
*/

class PHPnew {
	public $templates_dir         = './Data/default/';     //模板路径;
	public $templates_default     = './Data/default/';  //默认模板路径;
    public $templates_cache       = './Data/cache_tpl/'; //缓存模板路径;
    public $templates_source      = null;              // css, js目录
	public $templates_postfix     = '.html';           //模板后缀;
    public $templates_caching     = '.php';            //缓存后缀;
    public $templates_var         = 'All';                //变量获取模式, All,ASSIGN;
	public $templates_auto        = true;                 //自动更新模板;
	public $templates_new         = false;                 //设置当次更新, 系统更新可强制配置为true;
	public $templates_space       = false;               //清除无意义字符
    public $templates_ankey       = false;               // 加密模板文件名,避免被猜测到.
    public $templates_php         ='<?php defined(\'PHPNEW_STATIC_TPL\') === false && exit(\'PHPnew CACHE_TPL 7.3.1\');?>'; //为每个缓存头部增加PHP码;
    
    //结果集;
    public $templates_lang = array();          // 语言数组.
    public $templates_autofile = array();      // 自动匹配文件数组.
	public $templates_file = array();          //模板文件
	public $templates_cache_file = array();    //缓存文件;
	public $templates_name = null;             //标识名
	public $templates_message = null;          //html内容;
	public $templates_update = 0;              //更新次数
	public $templates_assign = array();        //用户用smarty模式;
    public $templates_static_assign = array(); // 静态变量数组. 用于css.
    public $templates_debug = array();         //错误信息;
    public $templates_viewcount  = 0;          // 视图次数.
	public $PHPnew = 'PHPnew CACHE_TPL 7.3.1';
	public $templates_replace = array();
    public $templates_static  = 'jpg|gif|png|css|js'; // 静态文件列表.
    
    // 初始化方法
    public function __construct(){define('PHPNEW_STATIC_TPL',true);}
    
	//公共方法: 文件名, 是否返回缓存文件.
	public function display($PHPnew_file_name, $returnpath = false){
	    if(isset($this->templates_debug[$PHPnew_file_name]) === true || !$PHPnew_file_name){
            $this->preg__debug('Prohibit repeated reference template: '. basename($PHPnew_file_name));
        }
        strpos($PHPnew_file_name,'.') === false && $PHPnew_file_name .= $this->templates_postfix;
        $this->templates_name = $PHPnew_file_name;
        $temp_var = $this->__get_path($this->templates_name);
        $true_check = $this->__check_update($temp_var);
        
        $this->templates_cache_file[$this->templates_name] = $temp_var['cache'];
        $this->templates_file[$this->templates_name] = $temp_var['tpl'];
        $this->templates_debug[$this->templates_name] = array();
        if($true_check === true){
            $PHPnew_path = $this->templates_cache_file[$this->templates_name];
        }else{
            if(!$this->templates_message = $this->preg__file($this->templates_file[$this->templates_name]))
             $this->preg__debug('Template file could not be opened: '. basename($PHPnew_file_name));
             
            if($this->templates_message){
                $this->templates_message = $this->__parse_html($this->templates_message);
                $PHPnew_path = $this->templates_cache_file[$this->templates_name];
                if(!$this->preg__file($PHPnew_path,$this->templates_message,true))
                    $this->preg__debug('Cache file could not be written: '. basename($PHPnew_file_name));
                $this->templates_message = null;
                $this->templates_update += 1;
            }
        }
        unset($temp_var , $PHPnew_file_name);
        $this->templates_viewcount += 1;
        if($this->templates_viewcount === 1 && $returnpath === false){
            $this->__parse_var();
            include $PHPnew_path;
        }else{
            return $PHPnew_path;
        }
	}
	//公共方法: 用户用强制性变量赋值;
	public function assign($phpnew_var, $phpnew_value = null){
		if(!$phpnew_var) return false;
		if($phpnew_value === null && is_array($phpnew_var) === true){
			foreach ($phpnew_var as $php_key => $php_val){
                $this->templates_assign[$php_key] = $php_val;
            }
		} else{
            $this->templates_assign[$phpnew_var] = $phpnew_value;
		}
	}
    //公共方法: 定义静态变量, 主要用于css, js.
    public function set_static_assign($var1=null, $var2 = null){
        if($var2 === null && is_array($var1) === true){
            foreach($var1 AS $key => $var){
                $this->templates_static_assign[$key] = $var;
            }
        }else{
            $this->templates_static_assign[$var1] = $var2;
        }
    }
    //公共方法: 设置语言数组, 模板中就可以用{lang str}
    public function set_language($var1=null, $var2 = null){
        if($var2 === null && is_array($var1) === true){
            foreach($var1 AS $key => $var){
                $this->templates_lang[$key] = $var;
            }
        }else{
            $this->templates_lang[$var1] = $var2;
        }
        return $this->templates_lang;
    }
    //公共方法: 设置自动匹配的路径, 默认先不工作, 等有此语法再读取目录.
    public function set_autofile($set_path = null){
        # 不再一开始就读文件.
        static $path = array();
        if($set_path === true)
            return $path;
        $path[] = $set_path;
    }
    
    //私有方法: 当语法有自动匹配功能时, 此方法会被调用. 
    private function run_autofile($path = 'static dir', $cls = false){
        static $local = false;
        # 处理缓存. 它自动分析是否为本地环境
        if($local === false && $cls === false && strpos($_SERVER['HTTP_HOST'],'ww.') === false && substr_count($_SERVER['HTTP_HOST'],'.') === 3){
            $local = true;
        }
        
        # 处理缓存. 读取. run_autofile 可调用多次, 以实现多目录文件索引.
        if($cls === false && $local === false){
            $data = $this->preg__file($this->templates_cache.'auto_'.md5($path).'_cache.php');
            if($data){
                $data = strtr($data , array($this->templates_php."\n"=>''));
                $allfile = unserialize(gzuncompress($data));
                foreach($allfile AS $key => $val)
                    $this->templates_autofile[$key] = $val;
                return $this->templates_autofile;
            }
        }
        
        if($cls ===false && is_dir($path) === false)
            return false;
        $path = './'.ltrim($path,'./');
        $tem = scandir($path);
        foreach($tem AS $val){
            if($val === '.' || $val === '..')
                continue;
            if(is_dir($path.$val.'/') === true){
                $this->run_autofile($path.$val.'/', true);
            }else{
                $this->templates_autofile[$val] = $path.$val;
            }
        }
        # 处理缓存. 写入.
        if($cls === false && $local === false && $this->templates_autofile){
            $data = $this->templates_php."\n";
            $data .= gzcompress(serialize($this->templates_autofile),9);
            $this->preg__file($this->templates_cache.'auto_'.md5($path).'_cache.php',$data,true);
        }
        return $this->templates_autofile;
    }
    
    // 内部方法: 检查是否应该更新, 参数:当前配置数组.
    private function __check_update($html_array){
        if(empty($html_array['tpl']) === true)
            $this->preg__debug('File does not exist: '. $this->templates_name);
        if($this->templates_new === true)
            return false;
        if(is_file($html_array['cache']) === false)
            return false;
        return true;
    }
    
	// 内部方法: 取得路径信息.
	private function __get_path($htmlfile){
        # 修改时, 请搜索全局, 免得影响到其它方法. 
        // 兼容所有目录的反斜线写法.
        $this->templates_dir     = strtr($this->templates_dir, array('\\'=>'/','\\\\'=>'/','//'=>'/'));
        $this->templates_default = strtr($this->templates_default, array('\\'=>'/','\\\\'=>'/','//'=>'/'));
        $this->templates_cache     = strtr($this->templates_cache, array('\\'=>'/','\\\\'=>'/','//'=>'/'));
        
	    // 无路径及后缀时. 路径用下列组合方式.
	    if(stripos($htmlfile,'/') === false){
	        $templates_dir_path = $this->templates_dir . $htmlfile;
            $templates_default_path = $this->templates_default . $htmlfile;
            if(is_file($templates_dir_path) === true){
                $htmlfile = $templates_dir_path;
            }else if(is_file($templates_default_path) === true){
                $htmlfile = $templates_default_path;
            }else{
                $htmlfile = false;
            }
        }else{
            if(is_file($htmlfile) === false){
                $htmlfile = false;
            }
        }
        
        if($htmlfile !== false){
            $md5 = $this->templates_auto === true? md5_file($htmlfile):md5($htmlfile.$this->templates_ankey);
            return array('tpl'=>$htmlfile,'cache'=>$this->templates_cache . $md5 . '_tpl' . $this->templates_caching);
       }
	}
    // 内部方法: 取得全局变量并且赋予模板.
	private function __parse_var(){
		static $savevar = 0;
        if($savevar === 0 && $this->templates_var === 'All'){
            $allvar = array_diff_key($GLOBALS, array ('GLOBALS'=>0,'_ENV'=>0,'HTTP_ENV_VARS'=>0,'ALLUSERSPROFILE'=>0,'CommonProgramFiles'=>0,'COMPUTERNAME'=>0,'ComSpec'=>0,'FP_NO_HOST_CHECK'=>0,'NUMBER_OF_PROCESSORS'=>0,'OS'=>0,'Path'=>0,'PATHEXT'=>0,'PROCESSOR_ARCHITECTURE'=>0,'PROCESSOR_IDENTIFIER'=>0,'PROCESSOR_LEVEL'=>0,'PROCESSOR_REVISION'=>0,'ProgramFiles'=>0,'SystemDrive'=>0,'SystemRoot'=>0,'TEMP'=>0,'TMP'=>0,'USERPROFILE'=>0,'VBOX_INSTALL_PATH'=>0,'windir'=>0,'AP_PARENT_PID'=>0,'uchome_loginuser'=>0,'supe_cookietime'=>0,'supe_auth'=>0,'Mwp6_lastvisit'=>0,'Mwp6_home_readfeed'=>0,'Mwp6_smile'=>0,'Mwp6_onlineindex'=>0,'Mwp6_sid'=>0,'Mwp6_lastact'=>0,'PHPSESSID'=>0,'HTTP_ACCEPT'=>0,'HTTP_REFERER'=>0,'HTTP_ACCEPT_LANGUAGE'=>0,'HTTP_USER_AGENT'=>0,'HTTP_ACCEPT_ENCODING'=>0,'HTTP_HOST'=>0,'HTTP_CONNECTION'=>0,'HTTP_COOKIE'=>0,'PATH'=>0,'COMSPEC'=>0,'WINDIR'=>0,'SERVER_SIGNATURE'=>0,'SERVER_SOFTWARE'=>0,'SERVER_NAME'=>0,'SERVER_ADDR'=>0,'SERVER_PORT'=>0,'REMOTE_ADDR'=>0,'DOCUMENT_ROOT'=>0,'SERVER_ADMIN'=>0,'SCRIPT_FILENAME'=>0,'REMOTE_PORT'=>0,'GATEWAY_INTERFACE'=>0,'SERVER_PROTOCOL'=>0,'REQUEST_METHOD'=>0,'QUERY_STRING'=>0,'REQUEST_URI'=>0,'SCRIPT_NAME'=>0,'PHP_SELF'=>0,'REQUEST_TIME'=>0,'argv'=>0,'argc'=>0,'_POST'=>0,'HTTP_POST_VARS'=>0,'_GET'=>0,'HTTP_GET_VARS'=>0,'_COOKIE'=>0,'HTTP_COOKIE_VARS'=>0,'_SERVER'=>0,'HTTP_SERVER_VARS'=>0,'_FILES'=>0,'HTTP_POST_FILES'=>0,'_REQUEST'=>0));
            foreach($allvar as $key => $val){
                $this->templates_assign[$key] = $val;
			}
            $savevar = 1;
            unset($allvar);
		}
	}
 
    // 内部方法: 读文件与写文件的公用方法.
    private function preg__file($path, $lock='rb' ,$cls = false){
        $mode = $cls === true?'wb':$lock;
        if($cls === false && is_file($path) === false) return false;
        if(!$fp = fopen($path, $mode))
        if(!$fp = fopen($path, $mode))
        if(!$fp = fopen($path, $mode))
        if(!$fp = fopen($path, $mode))
        if(!$fp = fopen($path, $mode))
            return false;
        
        if($cls === true){
            flock($fp, LOCK_EX | LOCK_NB);
            if(!$ints = fwrite($fp, $lock))
            if(!$ints = fwrite($fp, $lock))
            if(!$ints = fwrite($fp, $lock))
            if(!$ints = fwrite($fp, $lock))
            if(!$ints = fwrite($fp, $lock))
                return 0;
            flock($fp, LOCK_UN);
            fclose($fp);
            return $ints;
        }else{
            $data = '';
            flock($fp, LOCK_SH | LOCK_NB);
                while(!feof($fp)){
                    $data .= fread($fp, 4096);
                }
            flock($fp, LOCK_UN);
            fclose($fp);
            return $data;
        }
    }
    
    // 内部方法: css,js静态文件解析方法.
    private function __preg_source_parse($template){
        if(!$template || is_file($template) === false)
            return false;
        $this->cssname = $template;
        $static_file = $template;
        
        $template = $this->preg__file($static_file);
        
  		//替换直接变量输出
        $template = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", '{$1}', $template);
        $varRegexp = "((\\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*(\-\>)?[a-zA-Z0-9_\x7f-\xff]*)(\[[a-zA-Z0-9_\-\.\"\'\[\]\$\x7f-\xff]+\])*)";
		$const_regexp = "([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)";
		$template = preg_replace("/\{(\\\$[a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\}/s", '<?=$1?>', $template);
		$template = preg_replace_callback("/$varRegexp/is", array(&$this,'preg__var'), $template);
        $template = preg_replace_callback("/\<\?\=\<\?\=$varRegexp\?\>\?\>/is",array(&$this,'preg__var'), $template);
		$template = preg_replace_callback("/<\?\=$varRegexp\?\>/is",array(&$this,'preg_cssjs_var'), $template);
		$template = preg_replace_callback("/\{$const_regexp\}/s", array(&$this,'preg_cssjs_var'), $template);
        
        $staticfile = $this->templates_static;
        $template = preg_replace_callback("/\{__([^\s]*\.($staticfile))\}/is", array(&$this, 'preg_static_autofile'), $template);
        $template = preg_replace_callback("/__([^\s]*\.($staticfile))/is", array(&$this, 'preg_static_autofile'), $template);
        
        $tem = explode('.',$static_file);
        $caename_file = $this->templates_cache.'static_'.md5(basename($static_file)).'.'.end($tem);
        $this->preg__file($caename_file,$template,true);
        return $caename_file;
    }
    
    // 内部方法: css,js静态文件路径计算方法, 跟preg__autofile有小小区别.
    private function preg_static_autofile($math){
        static $reals = '';
        $file = call_user_func_array(array($this,'preg__autofile'),func_get_args());
        
        if(!$reals){
            # 计算回调多少层.
            $tem = explode('/', rtrim($this->templates_cache,'/'));
            foreach($tem AS $key => $val){
                if($val !== '.' && $val){
                    if($key !== 0){
                        $tem[$key] = '..';
                    }else{
                        if($val !== '..')
                        $tem[$key] = '.';
                    }
                }else{
                    if(!$val)
                        unset($tem[$key]);
                }
            }
            $reals = implode('/', $tem).'/';
        }
        
        if(is_file($file) === true){
            if(strpos($this->cssname,'.css') !== false){
                return $reals.ltrim($file,'./');
            }else{
                return $file;
            }
        }
            
    }
     // 内部方法: css,js静态文件变量计算方法.
   	private function preg_cssjs_var($math){
	    if(is_string($math) === false)
            $math = $math[1];
        if($math && strpos($math,'$') !== false){
            $math = strtr($math, array('"'=>'',"'"=>''));
            # 直接返回变量的值.
            $math = strtr(ltrim($math,'$'),array(']['=>'.'));
            $math = strtr(ltrim($math,'$'),array(']'=>'','['=>'.'));
            
            $tem = explode('.',$math);
            if(!$this->templates_css_assign){
                $this->__parse_var();
                $this->templates_css_assign = $this->templates_assign;
            }
            
            $travar = $this->templates_css_assign;
            foreach($tem AS $val){
                $travar = $travar[$val];
            }
    		return $travar;
        }else{
            #常量替换
            $tem = get_defined_constants(true);
            $tem = $tem['user'];
            return $tem[$math];
        }
	}
    // 内部方法: css文件引用规范方法.
    private function preg__css($math){
        if(!$math[1])
            return false;
        if(strpos($math[0],'link') !== false){
            if(strpos($math[0],'/php') !== false){
                $css_file_path = $this->__preg_source_parse($math[1]);
                $math[0] = preg_replace('/ href="[^"]*"/is','', $math[0]);
                $math[0] =preg_replace('/ type="[^"]*"/is','', $math[0]);
                $math[0] = strtr($math[0], array('<link'=>"<link type=\"text/css\" href=\"{$css_file_path}\""));
            }
            return $math[0];
        }else{
            $css_file_path = $this->__preg_source_parse($math[1]);
            return '<link rel="stylesheet" type="text/css" href="'.$css_file_path.'" />';
        }
    }
    // 内部方法: js文件引用规范方法.
    private function preg__js($math){
        if(strpos($math[0],'src') !== false){
            if(strpos($math[0],'/php') !== false){
                $js_file_path = $this->__preg_source_parse(trim($math[1]));
                $math[0] = preg_replace('/ src="[^"]*"/is'," src=\"$js_file_path\"", $math[0]);
            }
            return $math[0];
        }else{
            $js_file_path = $this->__preg_source_parse(trim($math[1]));
            return '<script type="text/javascript" src="'.$js_file_path.'"></script>';
        }
    }
    
    // 内部方法: html代码自动匹配路径方法
    private function preg__autofile($math){
        if($math)
            $mathfile = $math[1];
        
        $allpath = $this->set_autofile(true);
        foreach($allpath AS $val){
            $this->run_autofile($val);
        }
        
        if(!$this->templates_autofile[$mathfile])
            return $math[0];
        
        return $this->templates_autofile[$mathfile];
    }
    
	//内部函数: 模板语法处理替换
	private function __parse_html($template){
	    if(empty($template) === true)
            return $template;
        if(strpos($template,'defined(\'PHPNEW_STATIC_TPL\')') === false)
            $defined = 1;
        
        $template = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", '{$1}', $template);
        $template = str_ireplace(array('{loads','{load','{block $'),array('{templatesub','{template','{block '),$template);

		$template = preg_replace_callback("/\{templatesub\s+([^\s]+?)\}/is", array(&$this,'preg__contents'), $template);
		$template = preg_replace_callback("/\{template\s+([^\s]+?)\}/is", array(&$this,'preg__template'), $template);
   
        // 处理所有静态文件加载{__a.css}
        $staticfile = $this->templates_static;
        $template = preg_replace_callback("/\{__([^\s]*\.($staticfile))\}/is", array(&$this, 'preg__autofile'), $template);
        $template = preg_replace_callback("/__([^\s]*\.($staticfile))/is", array(&$this, 'preg__autofile'), $template);

        # 处理掉所有的路径问题.
        $template = preg_replace_callback("/\{block\s+([a-zA-Z0-9_]+)\}(.+?)\{\/block\}/is", array(&$this, 'preg__stripblock'), $template);
        $template = preg_replace_callback("/\<link[^>]*?href=\"([^\s]*)\".*?\/\>/is",array(&$this,'preg__css'), $template);
        $template = preg_replace_callback("/\<style[^>]*?\>([^\s]*\.css)\<\/style\>/is",array(&$this,'preg__css'), $template);
        $template = preg_replace_callback("/\<script[^>]*?src=\"([^\s]*)\".*?\>\<\/script\>/is",array(&$this,'preg__js'), $template);
        $template = preg_replace_callback("/\<script[^>]*?\>([^\s]*\.js)\<\/script\>/is",array(&$this,'preg__js'), $template);
        
        //替换语言包/静态变量/php代码.
        $template = preg_replace_callback("/\{eval\s+(.+?)\}/is",array(&$this,'preg__evaltags'), $template);
        $template = preg_replace_callback("/\<\?php\s+(.+?)\\?\>/is", array(&$this,'preg__base'), $template);
        $template = preg_replace_callback("/\{lang\s+(.+?)\}/is", array(&$this,'preg__language'), $template);
		$template = preg_replace_callback("/\{html\s+(.+?)\}/is",array(&$this,'preg__static'), $template);
        
		$template = str_replace("{LF}", '<?="\\n"?>', $template);
        
		//替换直接变量输出
        $varRegexp = "((\\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*(\-\>)?[a-zA-Z0-9_\x7f-\xff]*)(\[[a-zA-Z0-9_\-\.\"\'\[\]\$\x7f-\xff]+\])*)";
		$const_regexp = "([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)";
		$template = preg_replace("/\{(\\\$[a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\}/s", '<?=$1?>', $template);
		$template = preg_replace_callback("/$varRegexp/is", array(&$this,'preg__var'), $template);
		$template = preg_replace_callback("/\<\?\=\<\?\=$varRegexp\?\>\?\>/is",array(&$this,'preg__var'), $template);
        
		//替换特定函数
		$template = preg_replace_callback("/\{if\s+(.+?)\}/is",array(&$this,'preg__if'), $template);
		$template = preg_replace_callback("/\{else[ ]*if\s+(.+?)\}/is",array(&$this,'preg__ifelse'), $template);
		$template = preg_replace("/\{else\}/is", "<? } else { ?>", $template);
		$template = preg_replace("/\{\/if\}/is", "<? } ?>", $template);
		$template = preg_replace_callback("/\{loop\s+(\S+)\s+(\S+)\}/is", array(&$this,'preg__loopone'), $template);
		$template = preg_replace_callback("/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/is",array(&$this,'preg__looptwo'), $template);
		$template = preg_replace("/\{\/loop\}/is", "<? }} ?>", $template);

		//常量替换
		$template = preg_replace("/\{$const_regexp\}/s", "<?=$1?>", $template);
		//$template = preg_replace("/ \?\>[\n\r]*\<\? /s", " \n", $template);

		//其他替换
		$template = preg_replace_callback("/\"(http)?[\w\.\/:]+\?[^\"]+?&[^\"]+?\"/is", array(&$this, 'preg__transamp'), $template);
		$template = preg_replace_callback("/\<script[^\>]*?src=\"(.+?)\".*?\>\s*\<\/script\>/is",array(&$this, 'preg__stripscriptamp'), $template);
		
		if($this->templates_space === true){
			$template = preg_replace(array('/\r\n/isU', '/<<<EOF/isU'), array('', "\r\n<<<EOF\r\n"), $template);
		}
        
		$template = strtr($template, array('<style>' => '<style type="text/css">', '<script>' => '<script type="text/javascript">'));
        
        if($this->templates_viewcount === 0)
            $template = '<?php extract($this->templates_assign);?>'.$template;
        
        # 释放变量功能移出.
		if(empty($this->templates_php) === false && $defined === 1){
			$template = $this->templates_php.$template;
        }
        
		$template = strtr($template, array('<?php' => '<?', '<?php echo' => '<?='));
		$template = strtr($template, array('<?' => '<?php', '<?=' => '<?php echo '));
        $template = preg_replace_callback("/\/\/[ ]*?(?:TODO|BUG)\:([^\n]*)[;\n\r]*/is",array(&$this, 'preg__todobug'),$template);
        if($this->templates_replace)
		  $template = strtr($template, $this->templates_replace);
        
        # input 修复兼容
        if(stripos($template, '<input') !== false){
           $template = preg_replace_callback('/<input.*type="([^"]*)".*\/>/isU',array(&$this,'preg__input'), $template);
        }
        
        # 最终再释放所有的php代码.
        $template = preg_replace_callback('/\[base\](.*)\[\/base\]/isU',array(&$this, 'preg__debase'), $template);
        
        return $template;
	}
    
	protected function preg__evaltags($math) {
	    $php = rtrim(trim($math[1]),';');
		$php = str_replace('\"', '"', $php);
		return $this->preg__base("<?php $php; ?>");
	}
    protected function preg__todobug($math){
        return ''; //默认todo, bug全部隐藏.
    }
    protected function preg__if($math){
        $expr = "<? if({$math[1]}){ ?>";
        return $this->preg__stripvtags($expr);
    }
    protected function preg__ifelse($math){
        $expr = "<? }else if({$math[1]}){ ?>";
        return $this->preg__stripvtags($expr);
    }
    protected function preg__loopone($math){
        $expr = "<? if(is_array({$math[1]})===true){foreach({$math[1]} AS {$math[2]}){ ?>";
        return $this->preg__stripvtags($expr);
    }
    protected function preg__looptwo($math){
        $expr = "<? if(is_array({$math[1]})===true){foreach({$math[1]} AS {$math[2]} => {$math[3]}){ ?>";
        return $this->preg__stripvtags($expr);
    }
    protected function preg__template($math){
        if(is_string($math) === false)
            $math = trim($math[1]);
        
        if($math){
            if(strpos($math,'$') !== false){
                $retunrstr = '<?php include $this->display('.$math.');?>'."\n";
            }else{
                $retunrstr = '<?php include $this->display(\''.$math.'\');?>'."\n";
            }
            return $this->preg__base($retunrstr);
        }
    }

    protected function preg__language($math){
        if(is_string($math) === false){
	       $math = $math[1];
           return $this->preg__base("<?php echo \$this->preg__language('$math'); ?>");
        }else{
            $varname = ltrim($math, '$');
            $returnstr = $varname;
            
            if($this->templates_lang[$varname])
                $returnstr = $this->templates_lang[$varname];
            return $returnstr;
        }
    }

	protected function preg__var($math){
	    if(is_string($math) === false)
            $math = $math[1];
        if($math){
    	    $varname = "<?={$math}?>";
            $returnstr = str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $varname));
    		return $returnstr;
        }
	}
    
    protected function preg__base($math){
        if(is_string($math) === false)
	       $math = $math[0];
        if($math){
            $returnstr = '[base]'.base64_encode($math).'[/base]';
		      return $returnstr;
        }
    }
    protected function preg__debase($math){
        if(is_string($math) === false)
	       $math = $math[1];
        if($math){
            $returnstr = base64_decode($math);
		    return $returnstr;
        }
    }
	protected function preg__stripvtags($math){
	    if(is_string($math) === false)
	       $math = $math[1];
        if($math){
            $returnstr = str_replace("\\\"", "\"", preg_replace("/\<\?\=(\\\$.+?)\?\>/s", "\\1", $math));
		    return $returnstr;
        }
	}
    
    protected function preg__input($math){
        $inputvar = trim($math[0]);
        $type = trim($math[1]);
        if(stripos($inputvar, 'id=') === false){
            if(stripos($inputvar, 'class=') !== false){
               $inputvar = preg_replace('/class="([^"]*)"/isU','class="$1 input'.$type.'"', $inputvar);
            }else{
                $inputvar = strtr($inputvar, array('type='=>"class=\"input{$type}\" type="));
            }
        }
        return $inputvar;
    }
    
	protected function preg__contents($math){
        static $savearray = array();
        $filename = trim($math[1]);
        if($savearray[$filename] >= 2){
            return '';
        }
        $savearray[$filename] += 1;
        strpos($filename,'.') === false && $filename .= $this->templates_postfix;
        $html_array = $this->__get_path($filename);
		if(empty($html_array['tpl']) === false){
		    $filedata = $this->preg__file($html_array['tpl']);
            $filedata = strtr($filedata, array('{loads'=>'{templatesub'));
            $filedata = str_ireplace(array('{loads','{load','{block $'),array('{templatesub','{template','{block '),$filedata);
            // 让叠加数据也兼容模板化处理.
            $filedata = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", '{$1}', $filedata);
            if(stripos($filedata, '{templatesub') !== false){
              $filedata = preg_replace_callback("/{templatesub\s+(.+?)\}/is", array($this,'preg__contents'),$filedata);
            }
			return $filedata;
		}
		return '';
	}

	protected function preg__transamp($math){
	   $s = trim($math[0]);
       if($s){
    		$s = str_replace('&', '&amp;', $s);
    		$s = str_replace('&amp;amp;', '&amp;', $s);
    		$s = str_replace('\"', '"', $s);
    		return $s;
        }
	}

	protected function preg__stripscriptamp($math){
	    $s = trim($math[1]);
        if($s){
		  $s = str_replace('&amp;', '&', $s);
		  return "<script src=\"$s\" type=\"text/javascript\"></script>";
        }
	}
    
    protected function preg__static($math){
        if(is_string($math) === false)
	       $math = $math[1];
        if($math){
            $varname = ltrim(trim($math),'$');
            $varname = $this->templates_assign[$varname];
            $returnstr = $this->preg__base($varname);
    		return $returnstr;
        }
    }
	protected function preg__stripblock($math){
        $var = $math[1];
        $s   = $math[2];
        if($s){
            $const_regexp = "([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)";
            $s = preg_replace("/\{$const_regexp\}/s", "<?=$1?>", $s);
            $s = str_replace('\\"', '"', $s);
            $s = preg_replace("/<\?=\\\$(.+?)\?>/is", "{\$\\1}", $s);
            preg_match_all("/<\?=(.+?)\?>/s", $s, $constary);
        }
        
        if($constary[1] && $s){
            $constadd = '';
            $constary[1] = array_unique($constary[1]);
            foreach($constary[1] as $const) {
            	$constadd .= '$__'.$const.' = '.$const.';';
            }
        }
        
        if($s){
            $s = preg_replace("/<\?=(.+?)\?>/s", "{\$__\\1}", $s);
            $s = str_replace('?>', "\n\$$var .= <<<EOF\n", $s);
            $s = str_replace('<?', "\nEOF;\n", $s);
            $this->assign($var, "<?php echo <<<EOF".$s."EOF;\n?>");
            return $this->preg__base("<?php \n$constadd\$$var = <<<EOF".$s."EOF;\n?>");
        }
	}
    private function preg__debug($mess){
        if($mess){
            echo '<div style="background-color: #498BBC; border: 2px solid #F2F8FB; padding: 2px; color: white;"><strong>PHPnew</strong>: '.$mess.'</div>';
            exit();
        }
    }
    
	//公共方法: 删除模板缓存,假如不传入参数, 将默认删除缓存目录的所有文件.;
	public function cache_dele($path = null){
		if($path === null){
			$path = $this->templates_cache;
    		$file_arr = scandir($path);
    		foreach ($file_arr as $val){
    			if($val === '.' || $val === '..'){
    				continue;
    			}
    			if(is_dir($path . $val) === true)
    				$this->cache_dele($path . $val . '/');
    			if(is_file($path . $val) === true && $val !== 'index.html')
    				unlink($path . $val);
    		}
        }else{
            if(is_file($path) === true)
                unlink($path);
        }
	}
}