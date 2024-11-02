<?php 
class baiduseo_common{
    public function init(){
        add_action('wp',[$this,'baiduseo_init_session']);
        $baiduseo_zz = get_option('baiduseo_zz');
        
        //兼容所有文章类型的推送
        if(isset($baiduseo_zz['status']) && strpos($baiduseo_zz['status'],'2') !== false){
            $tuisong = explode(',',$baiduseo_zz['post_type']);
            
            foreach($tuisong as $k=>$v){
                add_action('publish_'.$v,[$this,'baiduseo_articlepublish']);
                add_action('publish_future_'.$v,[$this,'baiduseo_articlepublish']);
                add_action('wp_trash_'.$v,[$this,'baiduseo_delete_post'],91);
            }
            if(is_array($tuisong) && !in_array('post',$tuisong)){
                add_action('publish_post',[$this,'baiduseo_articlepublish']);
                add_action('publish_future_post',[$this,'baiduseo_articlepublish']);
            }
        }else{
            add_action('publish_post',[$this,'baiduseo_articlepublish']);
                add_action('publish_future_post',[$this,'baiduseo_articlepublish']);
        }
        if(is_admin()){
            add_action( 'admin_enqueue_scripts', [$this,'baiduseo_enqueue'] );
            add_filter('plugin_action_links_'.BAIDUSEO_NAME, [$this,'baiduseo_plugin_action_links']);
            add_action('admin_menu', [$this,'baiduseo_addpages']);
        }else{
            add_action( 'wp_head', [$this,'baiduseo_mainpage'],1);
             
        }
        //由于插件需求，有一些数据是其他服务器推送过来的，无法满足随机字符串验证
        if(isset($_POST['data']) && is_string($_POST['data'])){
            //过滤json数据
            $BaiduSEO = baiduseo_seo::sanitizing_json($_POST['data']);
            
            if(is_array($BaiduSEO) && isset($BaiduSEO['BaiduSEO'])){
                baiduseo_youhua::post($BaiduSEO);
            }
        }
        add_action('wp_footer', [$this,'baiduseo_wztkjseo']);
        add_shortcode('baiduseofriends', [$this,'baiduseo_get_shortcode']);
        add_action('manage_posts_custom_column', [$this,'baiduseo_yuanchuang_column_content'], 10, 2); 
        add_filter('manage_posts_columns' , [$this,'baiduseo_yuanchuang_column']);
        add_action('wp_ajax_baiduseo_liuliang_log', [$this,'baiduseo_liuliang_log']);
        add_action('wp_ajax_nopriv_baiduseo_liuliang_log', [$this,'baiduseo_liuliang_log']);

    }
    public function baiduseo_init_session(){
        if (!session_id()) {
            ob_start();
            session_start();
            ob_end_flush();
        }
    }
     public function baiduseo_liuliang_log(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $currnetTime = current_time('Y-m-d H:i:s');
            $shibie = md5($_POST['userAgent'].$_POST['allCookies'].$_POST['ip'].$_POST['currentUrl'].$_POST['referrer'].$_POST['baiduseo_time']);
            $res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_liuliang where shibie="%s"',$shibie),ARRAY_A);
            if(!empty($res[0])){
                $wpdb->update($wpdb->prefix . 'baiduseo_liuliang',['updatetime'=>$currnetTime],['id'=>$res[0]['id']]);
            }else{
                if(!sanitize_url($_POST['referrer'])){
                    $res = $wpdb->get_results($wpdb->prepare(' select id from  '.$wpdb->prefix.'baiduseo_liuliang where session="%s" and status=1 order by id desc limit 1',sanitize_text_field($_POST['session'])),ARRAY_A);
                    $count = $wpdb->query($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_liuliang where session="%s" and status=1',sanitize_text_field($_POST['session'])),ARRAY_A);
                    if(!empty($res[0])){
                        $wpdb->insert($wpdb->prefix . 'baiduseo_liuliang',['source'=>$_POST['referrer']?sanitize_url($_POST['referrer']):'直接访问','url'=>sanitize_url($_POST['currentUrl']),'time'=>$currnetTime,'ip'=>sanitize_text_field($_POST['ip'])=='unknown'?'':sanitize_text_field($_POST['ip']),'shibie'=>$shibie,'session'=>sanitize_text_field($_POST['session']),'type'=>(int)$_POST['baiduseo_type'],'status'=>1,'lan'=>sanitize_text_field($_POST['baiduseo_language']),'pla'=>sanitize_text_field($_POST['baiduseo_pla']),'liulanqi'=>sanitize_text_field($_POST['baiduseo_liulanqi']),'is_new'=>1,'pinci'=>$count]);
                    }else{
                        $wpdb->insert($wpdb->prefix . 'baiduseo_liuliang',['source'=>$_POST['referrer']?sanitize_url($_POST['referrer']):'直接访问','url'=>sanitize_url($_POST['currentUrl']),'time'=>$currnetTime,'ip'=>sanitize_text_field($_POST['ip'])=='unknown'?'':sanitize_text_field($_POST['ip']),'shibie'=>$shibie,'session'=>sanitize_text_field($_POST['session']),'type'=>(int)$_POST['baiduseo_type'],'status'=>1,'lan'=>sanitize_text_field($_POST['baiduseo_language']),'pla'=>sanitize_text_field($_POST['baiduseo_pla']),'liulanqi'=>sanitize_text_field($_POST['baiduseo_liulanqi']),'is_new'=>0]);
                    }
                }else{
                    $res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_liuliang where session="%s" and status=1 order by id desc limit 1',sanitize_text_field($_POST['session'])),ARRAY_A);
                    if(isset($res[0])){
                        $wpdb->insert($wpdb->prefix . 'baiduseo_liuliang',['source'=>$_POST['referrer']?sanitize_url($_POST['referrer']):'直接访问','url'=>sanitize_url($_POST['currentUrl']),'time'=>$currnetTime,'ip'=>sanitize_text_field($_POST['ip'])=='unknown'?'':sanitize_text_field($_POST['ip']),'shibie'=>$shibie,'session'=>sanitize_text_field($_POST['session']),'type'=>(int)$_POST['baiduseo_type'],'pid'=>$res[0]['id'],'lan'=>sanitize_text_field($_POST['baiduseo_language']),'pla'=>sanitize_text_field($_POST['baiduseo_pla']),'liulanqi'=>sanitize_text_field($_POST['baiduseo_liulanqi'])]);
                        $wpdb->update($wpdb->prefix . 'baiduseo_liuliang',['shendu'=>$res[0]['shendu']+1],['id'=>$res[0]['id']]);
                    }
                }
            }
        }
        
    }
    public function baiduseo_wztkjseo(){
       
        global $baiduseo_wzt_log;
        
        if(!$baiduseo_wzt_log){
         echo '<script>
            console.log("\n%c 沃之涛科技 %c https://rbzzz.com \n", "color: #fff;background-image: linear-gradient(90deg, red 0%, red 100%);padding:5px 1px;", "color: #fff;background-image: linear-gradient(90deg, red 0%, rgb(255, 255, 255) 100%);padding:5px 0;width: 200px;display: inline-block;");
            </script>';
        }
        $baiduseo_liuliang = get_option('baiduseo_liuliang');
    
        if(isset($baiduseo_liuliang['open']) && $baiduseo_liuliang['open']){
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $baiduseo_ip = sanitize_text_field($_SERVER['HTTP_X_FORWARDED_FOR']);
            }elseif(isset($_SERVER['REMOTE_ADDR'])){
                $baiduseo_ip = sanitize_text_field($_SERVER['REMOTE_ADDR']);
            }else{
                $baiduseo_ip = '';
            }
            $baiduseo_time = time();
            if(!isset($_SESSION['baiduseo_liulan'])){
                $_SESSION['baiduseo_liulan'] = md5($baiduseo_ip.rand(1000000,999999));
            }
            
            ?>
                 <script>
                 function baiduseo_getBrowserType() {
                    
                      // 获取浏览器 userAgent
                      var ua = navigator.userAgent
                      
                      // 是否为 Opera
                      var isOpera = ua.indexOf('Opera') > -1
                      // 返回结果
                      if (isOpera) { return 'Opera' }
                    
                      // 是否为 IE
                      var isIE = (ua.indexOf('compatible') > -1) && (ua.indexOf('MSIE') > -1) && !isOpera
                      var isIE11 = (ua.indexOf('Trident') > -1) && (ua.indexOf("rv:11.0") > -1)
                      // 返回结果
                      if (isIE11) { return 'IE11'
                      } else if (isIE) {
                        // 检测是否匹配
                        var re = new RegExp('MSIE (\\d+\\.\\d+);')
                        re.test(ua)
                        // 获取版本
                        var ver = parseFloat(RegExp["$1"])
                        // 返回结果
                        if (ver == 7) { return 'IE7'
                        } else if (ver == 8) { return 'IE8'
                        } else if (ver == 9) { return 'IE9'
                        } else if (ver == 10) { return 'IE10'
                        } else { return "IE" }
                      }
                    
                      // 是否为 Edge
                      var isEdge = ua.indexOf("Edge") > -1
                      // 返回结果
                      if (isEdge) { return 'Edge' }
                    
                      // 是否为 Firefox
                      var isFirefox = ua.indexOf("Firefox") > -1
                      // 返回结果
                      if (isFirefox) { return 'Firefox' }
                    
                      // 是否为 Safari
                      var isSafari = (ua.indexOf("Safari") > -1) && (ua.indexOf("Chrome") == -1)
                      // 返回结果
                      if (isSafari) { return "Safari" }
                    
                      // 是否为 Chrome
                      var isChrome = (ua.indexOf("Chrome") > -1) && (ua.indexOf("Safari") > -1) && (ua.indexOf("Edge") == -1)
                      // 返回结果
                      if (isChrome) { return 'Chrome' }
                    
                      // 是否为 UC
                      var isUC= ua.indexOf("UBrowser") > -1
                      // 返回结果
                      if (isUC) { return 'UC' }
                    
                      // 是否为 QQ
                      var isQQ= ua.indexOf("QQBrowser") > -1
                      // 返回结果
                      if (isUC) { return 'QQ' }
                    
                      // 都不是
                      return ''
                    }
                 function baiduseo_getUserOsInfo() {
                    const userAgent = navigator.userAgent;
                    if (userAgent.indexOf("Windows NT 10.0") !== -1) return "Windows 10";
                    if (userAgent.indexOf("Windows NT 6.2") !== -1) return "Windows 8";
                    if (userAgent.indexOf("Windows NT 6.1") !== -1) return "Windows 7";
                    if (userAgent.indexOf("Windows NT 6.0") !== -1) return "Windows Vista";
                    if (userAgent.indexOf("Windows NT 5.1") !== -1) return "Windows XP";
                    if (userAgent.indexOf("Windows NT 5.0") !== -1) return "Windows 2000";
                    if (userAgent.indexOf("Mac") !== -1) return "Mac/iOS";
                    if (userAgent.indexOf("X11") !== -1) return "UNIX";
                    if (userAgent.indexOf("Linux") !== -1) return "Linux";
                    return "Other";
                 }
             // 定义发送请求的函数
             function baiduseo_sendRequest() {
                      var baiduseo_ip = '<?php echo $baiduseo_ip?>'
                    var baiduseo_nonce = '<?php echo esc_attr(wp_create_nonce('baiduseo'));?>'
                      var baiduseo_action = 'baiduseo_liuliang_log'
                    var baiduseo_userAgent = navigator.userAgent
                      var baiduseo_referrer = document.referrer;
                     var baiduseo_currentUrl = window.location.href;
                      var baiduseo_allCookies = document.cookie;
                     var baiduseo_session ='<?php echo $_SESSION['baiduseo_liulan'];?>';
                     var baiduseo_time = '<?php echo $baiduseo_time;?>';
                      var baiduseo_language = navigator.language || navigator.userLanguage;
                     var baiduseo_pla = baiduseo_getUserOsInfo();
                      var baiduseo_liulanqi = baiduseo_getBrowserType();
                     if(/mobile/i.test(baiduseo_userAgent)){
                         var baiduseo_type =2;
                     }else{
                          var baiduseo_type =1;
                       }
                       var xhr = new XMLHttpRequest();
                       xhr.open('POST', '<?php echo esc_url(admin_url('admin-ajax.php')); ?>', true);
                       xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                       xhr.onreadystatechange = function () {
                       };
                       var requestData = 'ip=' + baiduseo_ip + '&userAgent=' + baiduseo_userAgent + '&referrer=' + baiduseo_referrer + '&currentUrl=' + baiduseo_currentUrl + '&allCookies=' + baiduseo_allCookies + '&nonce=' + baiduseo_nonce + '&action=' + baiduseo_action+'&baiduseo_time='+baiduseo_time+'&session='+baiduseo_session+'&baiduseo_type='+baiduseo_type+'&baiduseo_language='+baiduseo_language+'&baiduseo_pla='+baiduseo_pla+'&baiduseo_liulanqi='+baiduseo_liulanqi;
                       xhr.send(requestData);
             }
            
             // 每5秒执行一次请求
             baiduseo_sendRequest();
             setInterval(baiduseo_sendRequest, 6000);
             </script>
             <?php   
        }
    }
    public function baiduseo_yuanchuang_column($columns) {
        $baiduseo_youhua = get_option('baiduseo_youhua');
        if(!isset($baiduseo_youhua['listbtn']) || !$baiduseo_youhua['listbtn']){
        // if(1){
            $columns['yuanchuang'] = 'seo合集';
            // $columns['gaixie'] = '智能改写';
            // $columns['kuaisu'] = '快速推送';
            echo "
            <style>
                .wzt_mask {
                    position: fixed;
                    width: 100%;
                    height: 100%;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    overflow: hidden;
                    background-color: rgba(0, 0, 0, 0.8);
                    z-index: 9999;
                    opacity: 0.7;
                }
                .wzt_loading{
                    width: 80px;
                    height: 40px;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                }
                .wzt_loading span{
                    display: inline-block;
                    width: 8px;
                    height: 100%;
                    border-radius: 4px;
                    background: #99CCFF;
                    -webkit-animation: load 1s ease infinite;
                    animation: load 1s ease infinite;
                }
                @-webkit-keyframes load{
                    0%,100%{
                        height: 40px;
                        background: #99CCFF;
                    }
                    50%{
                        height: 70px;
                        margin: -15px 0;
                        background: #0099FF;
                    }
                }
                .wzt_loading span:nth-child(2){
                    -webkit-animation-delay:0.2s;
                    animation-delay:0.2s;
                }
                .wzt_loading span:nth-child(3){
                    -webkit-animation-delay:0.4s;
                    animation-delay:0.4s;
                }
                .wzt_loading span:nth-child(4){
                    -webkit-animation-delay:0.6s;
                    animation-delay:0.6s;
                }
                .wzt_loading span:nth-child(5){
                    -webkit-animation-delay:0.8s;
                    animation-delay:0.8s;
                }
            </style>
            
            
            <script>
                jQuery(document).ready(function($){
                    function popupInformation(msg) {
                        $('body').append(`<div class='wzt_popupInfo' 
                            style='position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            padding: 10px 20px;
                            color: #FFF;
                            background-color: rgba(0, 0, 0, .4);
                            border-radius: 5px;
                            z-index: 10000;'><span>`+ msg +`</span></div>`
                        );
                            
                        setTimeout(() => {
                            $('.wzt_popupInfo').remove();
                        }, 3000);
                    }
                
                    $('.baiduseo_yuanchuangwzt').click(function() {
                        $('body').append(`
                        <!-- 加载遮罩层 -->
                        <div class='wzt_mask'>
                            <div class='wzt_loading'>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        `)
                        var id = $(this).attr('data-id');
                        $.ajax({
                            url: '".esc_url(admin_url( 'admin-ajax.php' ))."',
                            data: {
                                \"id\": id ,\"nonce\":\"".esc_attr(wp_create_nonce('baiduseo_yuanchuang'))."\",\"action\":\"baiduseo_yuanchuang\"
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                if(res.msg!='0'){
                                    popupInformation('提交成功，请等待处理');
                                    location.reload();
                                }else{
                                    if(res.data){
                                        popupInformation(res.data);
                                        $('.wzt_mask').remove()
                                    }else{
                                        popupInformation('提交失败,失败的原因可能为：1.网络波动，请刷新后重试。2.远端服务器压力过大，请稍后重试。'); 
                                        $('.wzt_mask').remove()
                                    }
                                }
                            }
                        })
                        return false;
                    })
                    $('.kuaisuwzt').click(function() {
                        $('body').append(`
                        <!-- 加载遮罩层 -->
                        <div class='wzt_mask'>
                            <div class='wzt_loading'>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        
                        `)
                        var id = $(this).attr('data-id');
                        $.ajax({
                            url: '".esc_url(admin_url( 'admin-ajax.php' ))."',
                            data: {
                                \"id\": id ,\"nonce\":\"".esc_attr(wp_create_nonce('baiduseo_kuaisu'))."\",\"action\":\"baiduseo_kuaisu\"
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                if(res.msg!='0'){
                                    $('.wzt_mask').remove()
                                    popupInformation('提交成功');
                                    location.reload();
                                }else{
                                    popupInformation('提交失败,失败原因可能为：1.可能你的网站没有快速推送的权限。2.你的快速推送配额不足。3.站长信息填写的api链接不正确。');
                                    $('.wzt_mask').remove()
                                }
                            }
                        })
                        return false;
                    });
                    
                    $('.baiduseo_gaixiewzt').click(function() {
                        $('body').append(`
                        <!-- 加载遮罩层 -->
                        <div class='wzt_mask'>
                            <div class='wzt_loading'>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        
                        `)
                        var id = $(this).attr('data-id');
                        $.ajax({
                            url: '".esc_url(admin_url( 'admin-ajax.php' ))."',
                            data: {
                                \"id\": id ,\"nonce\":\"".esc_attr(wp_create_nonce('baiduseo_gaixie'))."\",\"action\":\"baiduseo_gaixie\"
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                               
                                if(res.msg=='1'){
                                    $('.wzt_mask').remove()
                                    popupInformation('提交成功');
                                    location.reload();
                                }else if(res.msg=='2'){
                                     $('.wzt_mask').remove();
                                    popupInformation('通道维护中，请等待更新');
                                }else{
                                    $('.wzt_mask').remove()
                                    popupInformation('提交失败,积分不足');
                                }
                            }
                        })
                        return false;
                    });
                    $('.putongwzt').click(function(){
                        $('body').append(`
                        <!-- 加载遮罩层 -->
                        <div class='wzt_mask'>
                            <div class='wzt_loading'>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>`)
                         var id = $(this).attr('data-id');
                        $.ajax({
                            url: '".esc_url(admin_url( 'admin-ajax.php' ))."',
                            data: {
                                \"id\": id ,\"nonce\":\"".esc_attr(wp_create_nonce('baiduseo_ptts'))."\",\"action\":\"baiduseo_ptts\"
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                if(res.msg!='0'){
                                    $('.wzt_mask').remove()
                                    let remind = '提交成功,剩余配额:'+ res.remind +'条';
                                    popupInformation(remind);
                                    location.reload();
                                }else{
                                    $('.wzt_mask').remove()
                                    popupInformation(res.data);
                                }
                            }
                        })
                        return false;
                    })
                })
            </script>";
        }
        return $columns;   
    }
    public function baiduseo_yuanchuang_column_content($column_name, $post_id) { 
        if(current_user_can('level_10')){
            $post_extend = get_post_meta( $post_id, 'baiduseo', true );
            if ($column_name == 'yuanchuang') {
                if(isset($post_extend['status']) && $post_extend['status']==2){
                    echo '检测中...<br />';
                }elseif(isset($post_extend['status']) && $post_extend['status']==1){
                    if(isset($post_extend['hyc']) && $post_extend['hyc']){
                        if($post_extend['hyc']=='102'){
                            echo '无效内容';
                        }elseif($post_extend['hyc']=='101'){
                            echo '无效内容';
                        }else{
                            echo '原创率：'.esc_attr($post_extend['hyc']).'% <br/>';
                        }
                    }else{
                         if($post_extend['yc']=='102'){
                            echo '无效内容';
                        }elseif($post_extend['yc']=='101'){
                            echo '无效内容';
                        }else{
                        echo '原创率：'.esc_attr($post_extend['yc']).'% <br />';
                        }
                    }
                }elseif(isset($post_extend['status']) && $post_extend['status']==3){
                    if(isset($post_extend['yc'])){
                         if($post_extend['yc']=='102'){
                            echo '无效内容';
                        }elseif($post_extend['yc']=='101'){
                            echo '无效内容';
                        }else{
                        echo '原创率：'.esc_attr($post_extend['yc']).'% <br />';
                        }
                    }else{
                        echo '检测中...<br />';
                    }
                }else{
                    echo "
                    <style>
                        .baiduseo_yuanchuangwzt {
                            padding:0px 8px;
                            display: block;
                            margin: 5px 0;
                        }
                    </style>
                    <button class='baiduseo_yuanchuangwzt' data-id=".(int)$post_id." type='button'>原创检测</button>
                    ";
                }
                
                if(isset($post_extend['status']) && $post_extend['status']==3){
                    echo '智能改写中...<br />';
                }elseif(isset($post_extend['yc']) && $post_extend['yc'] && (!isset($post_extend['hyc']) || !$post_extend['hyc'])){
                    echo "<style>
                        .baiduseo_gaixiewzt {
                            padding:0px 8px;
                            display: block;
                            margin: 5px 0;
                        }
                    </style>
                    <button class='baiduseo_gaixiewzt' data-id=".esc_attr($post_id)." type='button'>智能改写</button>
                    ";
                }else{
                    
                    if(isset($post_extend['hyc']) && $post_extend['hyc']){
                        echo '改写后：'.esc_attr($post_extend['yc']).'%';
                    } else {
                        echo "<style>
                        .baiduseo_gaixiewzt {
                            padding:0px 8px;
                            display: block;
                        }
                        </style>
                        <button class='baiduseo_gaixiewzt' data-id=".(int)$post_id." type='button'>智能改写</button>
                    ";
                    }
                }
                $link = get_permalink($post_id);
                global $wpdb;
                $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=2 and link=%s order by id desc ",$link),ARRAY_A);
                if(!empty($post1)){
                    echo '已推送';
                }else{
                    echo "<style>
                    .kuaisuwzt,
                    .putongwzt {
                        display: block;
                        padding:0px 8px;
                        margin: 5px 0;
                    }
                </style><button class='kuaisuwzt' data-id=".(int)$post_id." type='button'>快速推送</button>";
                }
                echo '<button class="putongwzt" data-id="'.(int)$post_id.'" type="button">普通推送</button>';
           
            } 
        }
    }
    public function baiduseo_get_shortcode($atts, $content = null){
        
        return  baiduseo_seo::baiduseo_friends_hh(md5(baiduseo_common::baiduseo_url(0)));
    }
    public function baiduseo_mainpage(){
        
        $baiduseo_zz = get_option('baiduseo_zz');
        if(isset($baiduseo_zz['toutiao_key']) && $baiduseo_zz['toutiao_key'] ){
            echo '<script>
                  /*seo合集头条推送*/
                (function(){
                var el = document.createElement("script");
                el.src = "https://sf1-scmcdn-tos.pstatp.com/goofy/ttzz/push.js?'.esc_attr($baiduseo_zz['toutiao_key']).'";
                el.id = "ttzz";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(el, s);
                })(window)
                </script>';
        }
         $shouye = sanitize_text_field($_SERVER['REQUEST_URI']);
        if($shouye=='/' || $shouye==''){
            
            if (is_front_page() && is_home()) {
                 $seo = get_option('seo_init');
                if($seo){
                    if(isset($seo['keywords']) && $seo['keywords']){
                        echo '<meta name="keywords" content="'.esc_attr($seo['keywords']).'">'."\n\r";
                    }
                    if(isset($seo['description']) && $seo['description']){
                        echo '<meta name="description" content="'.esc_attr($seo['description']).'">'."\n\r";
                    }
                }
            } elseif (is_front_page()) {
                 $seo = get_option('seo_init');
                if($seo){
                    if(isset($seo['keywords']) && $seo['keywords']){
                        echo '<meta name="keywords" content="'.esc_attr($seo['keywords']).'">'."\n\r";
                    }
                    if(isset($seo['description']) && $seo['description']){
                        echo '<meta name="description" content="'.esc_attr($seo['description']).'">'."\n\r";
                    }
                }
            } elseif (is_home()) {
                 $seo = get_option('seo_init');
                if($seo){
                    if(isset($seo['keywords']) && $seo['keywords']){
                        echo '<meta name="keywords" content="'.esc_attr($seo['keywords']).'">'."\n\r";
                    }
                    if(isset($seo['description']) && $seo['description']){
                        echo '<meta name="description" content="'.esc_attr($seo['description']).'">'."\n\r";
                    }
                }
            }
        }
       if(is_category()){
            $cate = get_the_category();
            
            if(isset($cate[0]->cat_ID)){
                $seo = get_option('baiduseo_cate_'.$cate[0]->cat_ID);
                
                if(!empty($seo)){
                    if(isset($seo['keywords']) && $seo['keywords']){
                        
                        echo sprintf('<meta name="keywords" content="%s" />'."\n",esc_attr($seo['keywords']));
                    }
                    if(isset($seo['description']) && $seo['description']){
                        echo sprintf('<meta name="description" content="%s" />'."\n",esc_attr($seo['description']));
                    }
                }
            }
        }elseif(is_single()){
            add_action( 'the_content', [$this,'BaiduSEO_addlink']);
        }elseif(is_page()){
            
            
            global $post;
           
             $baiduseo_page = get_post_meta( $post->ID, 'baiduseo_page', true );
             if(isset($baiduseo_page['keywords']) && $baiduseo_page['keywords']){
                        
                echo sprintf('<meta name="keywords" content="%s" />'."\n",esc_attr($baiduseo_page['keywords']));
            }
            if(isset($baiduseo_page['description']) && $baiduseo_page['description']){
                echo sprintf('<meta name="description" content="%s" />'."\n",esc_attr($baiduseo_page['description']));
            }
        }
    }
    public function BaiduSEO_addlink($content){
       
        global $wpdb,$baiduseo_wzt_log;
        $alt = get_option('seo_alt_auto');
        
        $post_title = get_the_title();
        if((isset($alt['alt']) && $alt['alt']) || (isset($alt['title']) && $alt['title'])){
            if(preg_match_all('#<img([^>]+)>#is',$content,$match)){
                $img_seo = array();
                $img_idx = -1;
                foreach($match[0] as $k=>$img){
                    if(!preg_match('#src=.+#',$img)){
                        continue;
                    }
                    $src_img = $img;
                   
                    $img = str_replace(array('alt=""',"alt=''",'title=""',"title=''"),'',$img);
                    
                    $img_key = md5($img);
                    if(!isset($img_seo[$img_key])){
                        $img_idx ++;
                        $img_seo[$img_key] = $img_idx;
                    }
                    $img_k = $img_seo[$img_key];
                    $add_html = '';
                   
                    if(isset($alt['title']) && $alt['title'] ){
                       
                        if($alt['title']=='2'){
                            if(preg_match('#/.+?\.(jpg|jpeg|gif|webp|png|bmp)#is',$img,$name_match)){
                                $add_html .= ' title="'.esc_attr(basename($name_match[0])).'"';
                            }
                        }else if($post_title){
        
                            $add_html .= ' title="'.esc_attr($post_title).'"';
                        }
                    }                                             
                    
                    if(isset($alt['alt']) && $alt['alt'] ){
        
                        if($alt['alt'] == '2'){
                            if(preg_match('#/.+?\.(jpg|jpeg|gif|webp|png|bmp)#is',$img,$name_match)){
                                $add_html .= ' alt="'.esc_attr(basename($name_match[0])).'"';
                            }
                        }else if($post_title){
                            $add_html .= ' alt="'.esc_attr($post_title).'"';
                        }
                    }
                    if(!$add_html){
                        continue;
                    }
                    $original = str_replace(array('alt=""',"alt=''",'title=""',"title=''"),'',$match[1][$k]);
        
                    $new_img = '<img'.$add_html.' '.$original.'>';
                    $content = str_replace($src_img,$new_img,$content);
                }
            }
        }
       
        $id = get_the_ID();
        if($baiduseo_wzt_log){
            // $log = baiduseo_zz::pay_money();
            $log = 1;
            if($log){
                $Tag_manage = get_option('baiduseo_tag');
                
                if(!empty($Tag_manage)){
                    if((isset($Tag_manage['bqgl']) && is_string($Tag_manage['bqgl']) && strpos($Tag_manage['bqgl'],'2')!==false  )){ 
                        if(isset($Tag_manage['link']) && ($Tag_manage['link']==1)){
                            $tags = $wpdb->get_results($wpdb->prepare('select a.* from ('.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id) left join '.$wpdb->prefix . 'term_relationships as c on b.term_taxonomy_id =c.term_taxonomy_id  where b.taxonomy="post_tag" and c.object_id=%d group by a.name',$id),ARRAY_A);
                            if(!empty($tags)){
                                foreach ($tags as $val)
                                {
                                    
                                    $val['url'] =get_tag_link($val['term_id']);
                                    if(isset($Tag_manage['hremove']) && $Tag_manage['hremove']==1){
                                            if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$content,$matches))
                                            {
                                                if(isset($Tag_manage['bold']) &&isset($Tag_manage['color']) && $Tag_manage['color']){
                                                    if($Tag_manage['bold']==1){
                                                        
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'"><b style="color:'.$Tag_manage['color'].'">'.$val['name'].'</b></a>',$content,1);
                                                        
                                                    }else{
                                                        
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'" style="color:'.$Tag_manage['color'].'">'.$val['name'].'</a>',$content,1);
                                                        
                                                    }
                                                    
                                                }elseif(isset($Tag_manage['bold']) && (!isset($Tag_manage['color'])||(!$Tag_manage['color']))){
                                                    if($Tag_manage['bold']==1){
                                                            
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'"><b>'.$val['name'].'</b></a>',$content,1);
                                                    }else{
                                                        
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'">'.$val['name'].'</a>',$content,1);
                                                        
                                                    }
                                                }elseif(!isset($Tag_manage['bold']) && isset($Tag_manage['color']) && $Tag_manage['color']){
                                                    
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'" style="color:'.$Tag_manage['color'].'">'.$val['name'].'</a>',$content,1);
                                                }else{
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'">'.$val['name'].'</a>',$content,1);
                                                    
                                                }
                                                
                                            }
                                    }else{
                                        if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$content,$matches))
                                        {
                                            if(isset($Tag_manage['bold']) &&isset($Tag_manage['color']) && $Tag_manage['color']){
                                                if($Tag_manage['bold']==1){
                                                    
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'"><b style="color:'.$Tag_manage['color'].'">'.$val['name'].'</b></a>',$content,1);
                                                    
                                                }else{
                                                    
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'" style="color:'.$Tag_manage['color'].'">'.$val['name'].'</a>',$content,1);
                                                    
                                                }
                                                
                                            }elseif(isset($Tag_manage['bold']) && (!isset($Tag_manage['color'])||(!$Tag_manage['color']))){
                                                if($Tag_manage['bold']==1){
                                                        
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'"><b>'.$val['name'].'</b></a>',$content,1);
                                                }else{
                                                    
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'">'.$val['name'].'</a>',$content,1);
                                                    
                                                }
                                            }elseif(!isset($Tag_manage['bold']) && isset($Tag_manage['color']) && $Tag_manage['color']){
                                                
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'" style="color:'.$Tag_manage['color'].'">'.$val['name'].'</a>',$content,1);
                                            }else{
                                                $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['url'].'">'.$val['name'].'</a>',$content,1);
                                                
                                            }
                                            
                                        }
                                    }
                                    
                                   
                                }
                            }
                        }else{
                            $tags = $wpdb->get_results($wpdb->prepare('select a.* from ('.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id) left join '.$wpdb->prefix . 'term_relationships as c on b.term_taxonomy_id =c.term_taxonomy_id  where b.taxonomy="post_tag" and c.object_id=%d group by a.name',$id),ARRAY_A);
                            
                            if(!empty($tags))
                            {
                                foreach ($tags as $val)
                                {
                                    if(isset($Tag_manage['hremove']) && $Tag_manage['hremove']==1){
                                        if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$content,$matches))
                                        { 
                                            if(isset($Tag_manage['bold']) && isset($Tag_manage['color']) &&$Tag_manage['color']){
                                                if($Tag_manage['bold']==1){
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<b style="color:'.$Tag_manage['color'].'">'.$val['name'].'</b>',$content,1);
                                                }else{
                                                    if($val['tag_target'] && $val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'" target="_blank" rel="nofollow">'.$val['name'].'</a>',$content,1);
                                                    }elseif($val['tag_target'] && !$val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'" target="_blank">'.$val['name'].'</a>',$content,1);
                                                    }elseif(!$val['tag_target'] && $val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'"  rel="nofollow">'.$val['name'].'</a>',$content,1);
                                                    }else{
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'">'.$val['name'].'</a>',$content,1);
                                                    }
                                                }
                                                
                                            }elseif(isset($Tag_manage['bold']) && (!isset($Tag_manage['color']) || !$Tag_manage['color'])){
                                                if($Tag_manage['bold']==1){
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<b>'.$val['name'].'</b>',$content,1);
                                                }
                                            }elseif(!isset($Tag_manage['bold']) && isset($Tag_manage['color']) && $Tag_manage['color']){
                                                    if($val['tag_target'] && $val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'" target="_blank" rel="nofollow">'.$val['name'].'</a>',$content,1);
                                                    }elseif($val['tag_target'] && !$val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'" target="_blank" >'.$val['name'].'</a>',$content,1);
                                                    }elseif(!$val['tag_target'] && $val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'" rel="nofollow">'.$val['name'].'</a>',$content,1);
                                                    }else{
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'">'.$val['name'].'</a>',$content,1);
                                                    }
                                            }
                                            
                                        }
                                    }else{
                                    
                                        if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$content,$matches))
                                        { 
                                            if(isset($Tag_manage['bold']) && isset($Tag_manage['color']) &&$Tag_manage['color']){
                                                if($Tag_manage['bold']==1){
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<b style="color:'.$Tag_manage['color'].'">'.$val['name'].'</b>',$content,1);
                                                }else{
                                                    if($val['tag_target'] && $val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'" target="_blank" rel="nofollow">'.$val['name'].'</a>',$content,1);
                                                    }elseif($val['tag_target'] && !$val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'" target="_blank">'.$val['name'].'</a>',$content,1);
                                                    }elseif(!$val['tag_target'] && $val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'"  rel="nofollow">'.$val['name'].'</a>',$content,1);
                                                    }else{
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'">'.$val['name'].'</a>',$content,1);
                                                    }
                                                }
                                                
                                            }elseif(isset($Tag_manage['bold']) && (!isset($Tag_manage['color']) || !$Tag_manage['color'])){
                                                if($Tag_manage['bold']==1){
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<b>'.$val['name'].'</b>',$content,1);
                                                }
                                            }elseif(!isset($Tag_manage['bold']) && isset($Tag_manage['color']) && $Tag_manage['color']){
                                                    if($val['tag_target'] && $val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'" target="_blank" rel="nofollow">'.$val['name'].'</a>',$content,1);
                                                    }elseif($val['tag_target'] && !$val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'" target="_blank" >'.$val['name'].'</a>',$content,1);
                                                    }elseif(!$val['tag_target'] && $val['tag_nofollow']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'" rel="nofollow">'.$val['name'].'</a>',$content,1);
                                                    }else{
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a  style="color:'.$Tag_manage['color'].'">'.$val['name'].'</a>',$content,1);
                                                    }
                                            }
                                            
                                        }
                                    }
                                }
                    
                            }
                        }
                    }
                    //内链未处理
                     if((isset($Tag_manage['bqgl']) && is_string($Tag_manage['bqgl'])&& strpos($Tag_manage['bqgl'],'1')!==false )||!isset($Tag_manage['bqgl'])){ 
                   
                            //定义自增数量
                            $nladdnum = 0;
                            //处理优先级
                             if(isset($Tag_manage['bqgl']) && is_string($Tag_manage['bqgl']) &&strpos($Tag_manage['bqgl'],'2')!==false){
                                if(!empty($tags)){
                                    $sql ="SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where keywords not in(";
                                    foreach($tags as $k=>$v){
                                        $sql.='"'.$v['name'].'",';
                                    }
                                    $sql = trim($sql,',');
                                    $sql .=')  order by sort desc';
                                  
                                    $post1 = $wpdb->get_results($sql,ARRAY_A);
                                }else{
                                    $post1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian   order by sort desc",ARRAY_A);
                                }
                            }else{
                                $post1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian  order by sort desc",ARRAY_A);
                            }
                            
                            if(!empty($post1)){
                                foreach($post1 as $key=>$val){
                                    
                                    if($val['target']==1){
                                        $target ='target=_blank';
                                    }else{
                                        $target ='';
                                    }
                                    if($val['nofollow']==1){
                                        $nofollow = 'rel="nofollow"';
                                    }else{
                                        $nofollow = '';
                                    }
                                     if(isset($Tag_manage['hremove']) && $Tag_manage['hremove']==1){
                                         if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$content,$matches)){
                                            $nladdnum++;
                                            if(isset($Tag_manage['bold']) &&isset($Tag_manage['color']) && $Tag_manage['color']){
                                                
                                                if($Tag_manage['bold']==1){
                                                    
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'><b style="color:'.$Tag_manage['color'].'">'.$val['keywords'].'</b></a>',$content,1);
                                                    
                                                }else{
                                                    
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" style="color:'.$Tag_manage['color'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                    
                                                }
                                                
                                            }elseif(isset($Tag_manage['bold']) && (!isset($Tag_manage['color'])||(!$Tag_manage['color']))){
                                                if($Tag_manage['bold']==1){
                                                        
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'><b>'.$val['keywords'].'</b></a>',$content,1);
                                                    
                                                }else{
                                                    
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                    
                                                }
                                            }elseif(!isset($Tag_manage['bold']) && isset($Tag_manage['color']) && $Tag_manage['color']){
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" style="color:'.$Tag_manage['color'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                            }else{
                                                $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                            }
                                            if( isset($Tag_manage['nlnum']) && $Tag_manage['nlnum']!=11 && $nladdnum>=$Tag_manage['nlnum'] ){
                                                break;
                                            }
                                        }
                                     }else{
                                        if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$content,$matches)){
                                            $nladdnum++;
                                            if(isset($Tag_manage['bold']) &&isset($Tag_manage['color']) && $Tag_manage['color']){
                                                
                                                if($Tag_manage['bold']==1){
                                                    
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'><b style="color:'.$Tag_manage['color'].'">'.$val['keywords'].'</b></a>',$content,1);
                                                    
                                                }else{
                                                    
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" style="color:'.$Tag_manage['color'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                    
                                                }
                                                
                                            }elseif(isset($Tag_manage['bold']) && (!isset($Tag_manage['color'])||(!$Tag_manage['color']))){
                                                if($Tag_manage['bold']==1){
                                                        
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'><b>'.$val['keywords'].'</b></a>',$content,1);
                                                    
                                                }else{
                                                    
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                    
                                                }
                                            }elseif(!isset($Tag_manage['bold']) && isset($Tag_manage['color']) && $Tag_manage['color']){
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" style="color:'.$Tag_manage['color'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                            }else{
                                                $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                            }
                                            if( isset($Tag_manage['nlnum']) && $Tag_manage['nlnum']!=11 && $nladdnum>=$Tag_manage['nlnum'] ){
                                                break;
                                            }
                                        }
                                    }
                                }
                            }
                            if( isset($Tag_manage['nlnum']) && ($nladdnum<$Tag_manage['nlnum'] || $Tag_manage['nlnum']==11)){
                                if(isset($Tag_manage['pp']) && $Tag_manage['pp']==1){
                                     if(isset($Tag_manage['bqgl']) && is_string($Tag_manage['bqgl']) && strpos($Tag_manage['bqgl'],'2')!==false){
                                        if(!empty($tags)){
                                            $sql ="SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where keywords not in(";
                                            foreach($tags as $k=>$v){
                                                $sql.='"'.$v['name'].'",';
                                            }
                                            $sql = trim($sql,',');
                                            $sql .=') where sort=0  order by LENGTH(keywords) desc';
                                            $post1 = $wpdb->get_results($sql,ARRAY_A);
                                        }else{
                                            $post1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where sort=0    order by LENGTH(keywords) desc",ARRAY_A);
                                        }
                                    }else{
                                        $post1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where sort=0    order by LENGTH(keywords) desc",ARRAY_A);
                                    }
                                    
                                }elseif(isset($Tag_manage['pp']) && $Tag_manage['pp']==2){
                                     if(isset($Tag_manage['bqgl']) && is_string($Tag_manage['bqgl']) && strpos($Tag_manage['bqgl'],'2')!==false){
                                        if(!empty($tags)){
                                            $sql ="SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where keywords not in(";
                                            foreach($tags as $k=>$v){
                                                $sql.='"'.$v['name'].'",';
                                            }
                                            $sql = trim($sql,',');
                                            $sql .=') where sort=0  order by LENGTH(keywords) asc';
                                            $post1 = $wpdb->get_results($sql,ARRAY_A);
                                        }else{
                                            $post1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where sort=0   order by LENGTH(keywords) asc",ARRAY_A);
                                        }
                                    }else{
                                        $post1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where sort=0   order by LENGTH(keywords) asc",ARRAY_A);
                                    }
                                    
                                }else{
                                    if(isset($Tag_manage['bqgl']) && is_string($Tag_manage['bqgl'])&&strpos($Tag_manage['bqgl'],'2')!==false){
                                        if(!empty($tags)){
                                            $sql ="SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where keywords not in(";
                                            foreach($tags as $k=>$v){
                                                $sql.='"'.$v['name'].'",';
                                            }
                                            $sql = trim($sql,',');
                                            $sql .=') and sort=0 order by id desc';
                                            $post1 = $wpdb->get_results($sql,ARRAY_A);
                                        }else{
                                            $post1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where sort=0  order by id desc",ARRAY_A);
                                        }
                                    }else{
                                        $post1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where sort=0  order by id desc",ARRAY_A);
                                    }
                                }
                            
                                if(!empty($post1)){
                                    foreach($post1 as $key=>$val){
                                        if($val['target']==1){
                                            $target ='target=_blank';
                                        }else{
                                            $target ='';
                                        }
                                        if($val['nofollow']==1){
                                            $nofollow = 'rel="nofollow"';
                                        }else{
                                            $nofollow = '';
                                        }
                                        if(isset($Tag_manage['hremove']) && $Tag_manage['hremove']==1){
                                            if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$content,$matches)){
                                                 $nladdnum++;
                                                if(isset($Tag_manage['bold']) &&isset($Tag_manage['color']) && $Tag_manage['color']){
                                                    
                                                    if($Tag_manage['bold']==1){
                                                        
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'><b style="color:'.$Tag_manage['color'].'">'.$val['keywords'].'</b></a>',$content,1);
                                                        
                                                    }else{
                                                        
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" style="color:'.$Tag_manage['color'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                        
                                                    }
                                                    
                                                }elseif(isset($Tag_manage['bold']) && (!isset($Tag_manage['color'])||(!$Tag_manage['color']))){
                                                    if($Tag_manage['bold']==1){
                                                            
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'><b>'.$val['keywords'].'</b></a>',$content,1);
                                                        
                                                    }else{
                                                        
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                        
                                                    }
                                                }elseif(!isset($Tag_manage['bold']) && isset($Tag_manage['color']) && $Tag_manage['color']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" style="color:'.$Tag_manage['color'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                }else{
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                }
                                            }
                                        }else{
                                            if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$content,$matches)){
                                                 $nladdnum++;
                                                if(isset($Tag_manage['bold']) &&isset($Tag_manage['color']) && $Tag_manage['color']){
                                                    
                                                    if($Tag_manage['bold']==1){
                                                        
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'><b style="color:'.$Tag_manage['color'].'">'.$val['keywords'].'</b></a>',$content,1);
                                                        
                                                    }else{
                                                        
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" style="color:'.$Tag_manage['color'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                        
                                                    }
                                                    
                                                }elseif(isset($Tag_manage['bold']) && (!isset($Tag_manage['color'])||(!$Tag_manage['color']))){
                                                    if($Tag_manage['bold']==1){
                                                            
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'><b>'.$val['keywords'].'</b></a>',$content,1);
                                                        
                                                    }else{
                                                        
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                        
                                                    }
                                                }elseif(!isset($Tag_manage['bold']) && isset($Tag_manage['color']) && $Tag_manage['color']){
                                                        $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg( $val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" style="color:'.$Tag_manage['color'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                }else{
                                                    $content=preg_replace('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($val['keywords']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i','<a href="'.$val['link'].'" '.$target.' '.$nofollow.'>'.$val['keywords'].'</a>',$content,1);
                                                }
                                            }
                                        }
                                        if(isset($Tag_manage['nlnum']) && $Tag_manage['nlnum']!=11 && $nladdnum>=$Tag_manage['nlnum']){
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                
                
        }
        return $content;
    }
    public  function baiduseo_addpages() {
        add_menu_page(__('SEO合集','seo_title_baidu_html'), __('SEO合集','seo_title_baidu_html'), 'manage_options', 'baiduseo', [$this,'baiduseo_toplevelpage'] );
    }
    public function baiduseo_toplevelpage(){
        echo "<div id='baiduseo_wztkj-app'></div>";
    }
    public  function baiduseo_enqueue($hook){
        if( 'toplevel_page_baiduseo' != $hook ) return;
        require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/admin/assets.php';
        foreach($assets as $key=>$val){
            if($val['type']=='css'){
                 wp_enqueue_style( $val['name'],  plugin_dir_url( BAIDUSEO_FILE ).'inc/admin/'.$val['url'],false,'','all');
            }elseif($val['type']=='js'){
                wp_enqueue_script( $val['name'], plugin_dir_url( BAIDUSEO_FILE ).'inc/admin/'.$val['url'], '', '', true);
            }
        }
        wp_register_script('baiduseo.js', false, null, false);
        wp_enqueue_script('baiduseo.js');
        $url1 = baiduseo_common::baiduseo_url(0);
        $baiduseo_yindao = get_option('baiduseo_yindao');
        $baiduseo_yindao = $baiduseo_yindao?$baiduseo_yindao:0;
        $baiduseo_version  = esc_url_raw(admin_url('plugin-install.php?tab=plugin-information&plugin=baiduseo'));
        $baiduseo_indexnow = md5(esc_url(baiduseo_common::baiduseo_url(1)));
        
        $baiduseo_google = baiduseo_common::baiduseo_url(1).'/wp-sitemap.xml';
        wp_add_inline_script('baiduseo.js', 'var baiduseo_wztkj_url="'.plugins_url('baiduseo').'/inc/admin",baiduseo_nonce="'. wp_create_nonce('baiduseo').'",baiduseo_ajax="'.esc_url(admin_url('admin-ajax.php')).'",baiduseo_tag ="'.esc_url(admin_url('edit-tags.php?taxonomy=post_tag')).'",baiduseo_url="'.$url1.'",baiduseo_yindao='.$baiduseo_yindao.',baiduseo_v="'.$baiduseo_version.'",baiduseo_indexnow="'.$baiduseo_indexnow.'",baiduseo_google="'.$baiduseo_google.'";', 'before');
    }
    public  function baiduseo_plugin_action_links ( $links) {
        $links[] = '<a href="' . admin_url( 'admin.php?page=baiduseo&nonce='.esc_attr(wp_create_nonce('baiduseo')) ) . '">设置</a>';
        return $links;
    }
    public function baiduseo_delete_post($post_ID){
        global $baiduseo_wzt_log;
        if($baiduseo_wzt_log){
            $log = baiduseo_zz::pay_money();
            $url = get_permalink($post_ID);
            if($log){
                $baiduseo_zz = get_option('baiduseo_zz');
                if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'4') !== false){
                    baiduseo_zz::google(['url'=>$url,'type'=>"URL_DELETED"]);
                }
            }
        }
    }
    public function  baiduseo_articlepublish($post_ID){
        ini_set('memory_limit','-1');
        set_time_limit(0);
        global $wpdb,$baiduseo_wzt_log;
        
        if($baiduseo_wzt_log){
            $log = baiduseo_zz::pay_money();
            if($log){
                $currnetTime= current_time( 'Y-m-d H:i:s');
                $baiduseo_zz = get_option('baiduseo_zz');
                if(!$baiduseo_zz['indexnow_key']){
                    $baiduseo_zz['indexnow_key'] = md5(esc_url(baiduseo_common::baiduseo_url(1)));
                }
                $url = get_permalink($post_ID);
                $urls =explode(',',$url);
                
                $baiduseo_indexnow_record = get_option('baiduseo_indexnow_record');
               if(isset($baiduseo_zz['status']) && strpos($baiduseo_zz['status'],'2') !== false){
                if(isset($baiduseo_zz['indexnow_pingtai'])){
                    $data = array(
                            'host' =>baiduseo_common::baiduseo_url(2) ,
                            'key' => $baiduseo_zz['indexnow_key'],
                            'keyLocation' => get_home_url() . '/' . $baiduseo_zz['indexnow_key'] . '.txt',
                            'urlList' => $urls
                        );
                         
                    if(strpos($baiduseo_zz['indexnow_pingtai'],'1')!==false){
                        
                        $re = wp_remote_post('https://www.bing.com/indexnow', array(
                            'body' => json_encode($data),
                            'sslverify' => false,
                            'timeout' => 4000,
                            'headers' => array(
                                'Host' => 'www.bing.com',
                                'Content-Type' => 'application/json; charset=utf-8'
                            )
                        ));
                      
                        if(!is_wp_error($re)){
                            if(isset($re['response']['code']) && $re['response']['code']>202){
                                if($re['response']['code']=='400'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'无效的格式']);
                                }elseif($re['response']['code']=='403'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'根目录没有密钥文件']);
                                }elseif($re['response']['code']=='422'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'URL与密钥不匹配']);
                                }elseif($re['response']['code']=='429'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'请求过多（潜在的垃圾邮件）']);
                                }
                            }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>1,'type'=>5,'message'=>'']);
                            }
                            if($baiduseo_indexnow_record!==false){
                                update_option('baiduseo_indexnow_record',['num'=>++$baiduseo_indexnow_record['num']]);
                            }else{
                                add_option('baiduseo_indexnow_record',['num'=>1]);
                            }
                        }
                        
                    }
                    
                    if(strpos($baiduseo_zz['indexnow_pingtai'],'2')!==false){
                       $re = wp_remote_get('https://search.seznam.cz/indexnow?url='.$urls[0].'&key='.$baiduseo_zz['indexnow_key']);
                      
                        
                        if(!is_wp_error($re)){
                            if(isset($re['response']['code']) && $re['response']['code']>202){
                                
                                if($re['response']['code']=='400'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'无效的格式']);
                                }elseif($re['response']['code']=='403'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'根目录没有密钥文件']);
                                }elseif($re['response']['code']=='422'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'URL与密钥不匹配']);
                                }elseif($re['response']['code']=='429'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'请求过多（潜在的垃圾邮件）']);
                                }
                            }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>1,'type'=>5,'message'=>'']);
                            }
                            if($baiduseo_indexnow_record!==false){
                                update_option('baiduseo_indexnow_record',['num'=>++$baiduseo_indexnow_record['num']]);
                            }else{
                                add_option('baiduseo_indexnow_record',['num'=>1]);
                            }
                        }
                       
                    }
                   
                    if(strpos($baiduseo_zz['indexnow_pingtai'],'3')!==false){
                        $re = wp_remote_post('https://yandex.com/indexnow', array(
                            'body' => json_encode($data),
                            'sslverify' => false,
                            'timeout' => 4000,
                            'headers' => array(
                                'Host' => 'yandex.com',
                                'Content-Type' => 'application/json; charset=utf-8'
                            )
                        ));
                        if(!is_wp_error($re)){
                            if(isset($re['response']['code']) && $re['response']['code']>202){
                                if($re['response']['code']=='400'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'无效的格式']);
                                }elseif($re['response']['code']=='403'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'根目录没有密钥文件']);
                                }elseif($re['response']['code']=='422'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'URL与密钥不匹配']);
                                }elseif($re['response']['code']=='429'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'请求过多（潜在的垃圾邮件）']);
                                }
                            }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>1,'type'=>5,'message'=>'']);
                            }
                            if($baiduseo_indexnow_record!==false){
                                update_option('baiduseo_indexnow_record',['num'=>++$baiduseo_indexnow_record['num']]);
                            }else{
                                add_option('baiduseo_indexnow_record',['num'=>1]);
                            }
                        }
                        
                    }
                     
                    if(strpos($baiduseo_zz['indexnow_pingtai'],'4')!==false){
                        $re = wp_remote_post('https://api.indexnow.org/indexnow', array(
                            'body' => json_encode($data),
                            'sslverify' => false,
                            'timeout' => 40000,
                            'headers' => array(
                                'Host' => 'api.indexnow.org',
                                'Content-Type' => 'application/json; charset=utf-8'
                            )
                        ));
                        if(!is_wp_error($re)){
                            if(isset($re['response']['code']) && $re['response']['code']>202){
                                if($re['response']['code']=='400'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'无效的格式']);
                                }elseif($re['response']['code']=='403'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'根目录没有密钥文件']);
                                }elseif($re['response']['code']=='422'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'URL与密钥不匹配']);
                                }elseif($re['response']['code']=='429'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'请求过多（潜在的垃圾邮件）']);
                                }
                            }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>1,'type'=>5,'message'=>'']);
                            }
                             if($baiduseo_indexnow_record!==false){
                                update_option('baiduseo_indexnow_record',['num'=>++$baiduseo_indexnow_record['num']]);
                            }else{
                                add_option('baiduseo_indexnow_record',['num'=>1]);
                            }
                        }
                       
                    }
                      if(strpos($baiduseo_zz['indexnow_pingtai'],'5')!==false){
                    // if(1){
                        $re = wp_remote_post('https://searchadvisor.naver.com/indexnow', array(
                            'body' => json_encode($data),
                            'sslverify' => false,
                            'timeout' => 40000,
                            'headers' => array(
                                'Host' => 'searchadvisor.naver.com',
                                'Content-Type' => 'application/json; charset=utf-8'
                            )
                        ));
                        if(!is_wp_error($re)){
                            if(isset($re['response']['code']) && $re['response']['code']>202){
                                if($re['response']['code']=='400'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'无效的格式']);
                                }elseif($re['response']['code']=='403'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'根目录没有密钥文件']);
                                }elseif($re['response']['code']=='422'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'URL与密钥不匹配']);
                                }elseif($re['response']['code']=='429'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'请求过多（潜在的垃圾邮件）']);
                                }
                            }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>1,'type'=>5,'message'=>'']);
                            }
                             if($baiduseo_indexnow_record!==false){
                                update_option('baiduseo_indexnow_record',['num'=>++$baiduseo_indexnow_record['num']]);
                            }else{
                                add_option('baiduseo_indexnow_record',['num'=>1]);
                            }
                        }
                       
                    }
                    
                
                    if(strpos($baiduseo_zz['indexnow_pingtai'],'6')!==false){
                    // if(1){
                        $re = wp_remote_post('https://indexnow.yep.com/indexnow', array(
                            'body' => json_encode($data),
                            'sslverify' => false,
                            'timeout' => 40000,
                            'headers' => array(
                                'Host' => 'indexnow.yep.com',
                                'Content-Type' => 'application/json; charset=utf-8'
                            )
                        ));
                        if(!is_wp_error($re)){
                            if(isset($re['response']['code']) && $re['response']['code']>202){
                                if($re['response']['code']=='400'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'无效的格式']);
                                }elseif($re['response']['code']=='403'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'根目录没有密钥文件']);
                                }elseif($re['response']['code']=='422'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'URL与密钥不匹配']);
                                }elseif($re['response']['code']=='429'){
                                    $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>2,'type'=>5,'message'=>'请求过多（潜在的垃圾邮件）']);
                                }
                            }elseif(isset($re['response']['code']) &&($re['response']['code']==200 || $re['response']['code']==202)){
                                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$url,'ts'=>1,'type'=>5,'message'=>'']);
                            }
                             if($baiduseo_indexnow_record!==false){
                                update_option('baiduseo_indexnow_record',['num'=>++$baiduseo_indexnow_record['num']]);
                            }else{
                                add_option('baiduseo_indexnow_record',['num'=>1]);
                            }
                        }
                       
                    }
                    
                }
                   
                    
                
               
               
                    
                    $url = get_permalink($post_ID);
                    $urls =explode(',',$url);
                    
                    if(isset($baiduseo_zz['baiduseo_type']) && strpos($baiduseo_zz['baiduseo_type'],'1')!==false){
                    
                        if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'1')!==false){
                            baiduseo_zz::bdts($urls);
                        }
                        if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'2')!==false){
                            baiduseo_zz::bing($urls);
                        }
                        // if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'3')!==false){
                        //     baiduseo_zz::sm($urls);
                        // }
                        if(isset($baiduseo_zz['pingtai']) && strpos($baiduseo_zz['pingtai'],'4')!==false){
                    
                            baiduseo_zz::google(['url'=>$url,'type'=>"URL_UPDATED"]);
                        }
                    }
                   
                    if(isset($baiduseo_zz['baiduseo_type']) && strpos($baiduseo_zz['baiduseo_type'],'2')!==false){
                        baiduseo_zz::bddayts($urls);
                    }
               }
                $baiduseo_tag = get_option('baiduseo_tag');
                
                $types = get_post($post_ID)->post_type;
               
                if(isset($baiduseo_tag['auto']) && $baiduseo_tag['auto'] && $types=='post'){
                   
                    if(!isset($baiduseo_tag['num']) || !$baiduseo_tag['num'] || $baiduseo_tag['num']==11){
                        
                        if(isset($baiduseo_tag['pp']) && $baiduseo_tag['pp']==1){
                            
                            $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms ORDER BY LENGTH(name) DESC',ARRAY_A);
                        }elseif(isset($baiduseo_tag['pp']) && $baiduseo_tag['pp']==2){
                            $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms ORDER BY LENGTH(name) ASC',ARRAY_A);
                        }else{
                            $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms',ARRAY_A);
                        }
                        foreach($tags as $k=>$v){
                            if(isset($baiduseo_tag['hremove']) && $baiduseo_tag['hremove']==1){
                                if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',get_post($post_ID)->post_content,$matches))
                                {
                                    $res = $wpdb->get_results('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id='.$v['term_id'],ARRAY_A);
                                    if($res){
                                        $re = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where object_id=%d and term_taxonomy_id=%d',$post_ID,$res[0]['term_taxonomy_id']),ARRAY_A);
                                        if(!$re){
                                            $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$post_ID,'term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$res[0]['term_taxonomy_id']),ARRAY_A);
                                        
                                            $count = $term_taxonomy[0]['count']+1;
                                            $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                                        }
                                    }
                                }
                            }else{
                                if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',get_post($post_ID)->post_content,$matches))
                                {
                                    $res = $wpdb->get_results('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id='.$v['term_id'],ARRAY_A);
                                    if($res){
                                        $re = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where object_id=%d and term_taxonomy_id=%d',$post_ID,$res[0]['term_taxonomy_id']),ARRAY_A);
                                        if(!$re){
                                            $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$post_ID,'term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$res[0]['term_taxonomy_id']),ARRAY_A);
                                        
                                            $count = $term_taxonomy[0]['count']+1;
                                            $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                                        }
                                    }
                                }
                            }
                        }
                    }else{
                        
                         $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d' ,$post_ID));
                         
                            if($shu<$baiduseo_tag['num']){
                                if(isset($baiduseo_tag['pp']) && $baiduseo_tag['pp']==1){
                                    $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms ORDER BY LENGTH(name) DESC',ARRAY_A);
                                }elseif(isset($baiduseo_tag['pp']) && $baiduseo_tag['pp']==2){
                                    $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms ORDER BY LENGTH(name) ASC',ARRAY_A);
                                }else{
                                    $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms',ARRAY_A);
                                }
                                foreach($tags as $k=>$v){
                                    $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d' ,$post_ID));
                                    if($shu<$baiduseo_tag['num']){
                                        if(isset($baiduseo_tag['hremove']) && $baiduseo_tag['hremove']==1){
                                              if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',get_post($post_ID)->post_content,$matches))
                                                {
                                                    $res = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id=%d' ,$v['term_id']),ARRAY_A);
                                                    if($res){
                                                        $re = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where object_id=%d and term_taxonomy_id=%d',$post_ID,$res[0]['term_taxonomy_id']),ARRAY_A);
                                                        if(!$re){
                                                            
                                                            $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$post_ID,'term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                                                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$res[0]['term_taxonomy_id']),ARRAY_A);
                                                        
                                                            $count = $term_taxonomy[0]['count']+1;
                                                            $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                                                        }
                                                    }
                                                
                                            }
                                        }else{
                                          if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',get_post($post_ID)->post_content,$matches))
                                            {
                                                $res = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id=%d' ,$v['term_id']),ARRAY_A);
                                                if($res){
                                                    $re = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where object_id=%d and term_taxonomy_id=%d',$post_ID,$res[0]['term_taxonomy_id']),ARRAY_A);
                                                    if(!$re){
                                                        
                                                        $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$post_ID,'term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                                                        $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$res[0]['term_taxonomy_id']),ARRAY_A);
                                                    
                                                        $count = $term_taxonomy[0]['count']+1;
                                                        $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                                                    }
                                                }
                                            
                                            }
                                        }
                                      
                                }
                            }
                        }
                    }
                }
                
            }
        }
    }
    public static function baiduseo_url($type=0){
        if($type==1){
            $url1 = get_option('siteurl');
            $url1 = parse_url($url1);
            $url1 = $url1['scheme'].'://'.$url1['host'];
            return $url1;
        }else{
            $url1 = get_option('siteurl');
            $url1 = str_replace('https://','',$url1);
            $url1 = str_replace('http://','',$url1);
            $url1 = trim($url1,'/');
            $url1 = explode('/',$url1);
            return $url1[0];
        }
    }
    public static function baiduseo_tongxun(){
        $baiduseo_tongxun = get_option('baiduseo_tongxun');
        if($baiduseo_tongxun!==false){
            return $baiduseo_tongxun;
        }else{
            $siteurl = get_option('siteurl');
            $code = time().rand(1,999999).$siteurl;
            $code = md5($code);
            add_option('baiduseo_tongxun',$code);
            return $code;
        }
        
    }
   
}
?>