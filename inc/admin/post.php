<?php
class baiduseo_post{
    public function init(){
        add_action('wp_ajax_baiduseo_zhizhu', [$this,'baiduseo_zhizhu']);
        add_action('wp_ajax_baiduseo_seo', [$this,'baiduseo_seo']);
        add_action('wp_ajax_baiduseo_wyc', [$this,'baiduseo_wyc']);
        add_action('wp_ajax_baiduseo_zz', [$this,'baiduseo_zz']);
        add_action('wp_ajax_baiduseo_youhua', [$this,'baiduseo_youhua']);
        add_action('wp_ajax_baiduseo_rank', [$this,'baiduseo_rank']);
        add_action('wp_ajax_baiduseo_keywords', [$this,'baiduseo_keywords']);
        add_action('wp_ajax_baiduseo_keywords_delete', [$this,'baiduseo_keywords_delete']);
        add_action('wp_ajax_baiduseo_shouquan', [$this,'baiduseo_shouquan']);
        add_action('wp_ajax_baiduseo_kp', [$this,'baiduseo_kp']);
        add_action('wp_ajax_baiduseo_kp_delete', [$this,'baiduseo_kp_delete']);
        add_action('wp_ajax_baiduseo_zhizhu_clear', [$this,'baiduseo_zhizhu_clear']);
        add_action('wp_ajax_baiduseo_tag', [$this,'baiduseo_tag']);
        add_action('wp_ajax_baiduseo_tag_add', [$this,'baiduseo_tag_add']);
        add_action('wp_ajax_baiduseo_301', [$this,'baiduseo_301']);
        add_action('wp_ajax_baiduseo_tag_pladd', [$this,'baiduseo_tag_pladd']);
        add_action('wp_ajax_baiduseo_neilian', [$this,'baiduseo_neilian']);
        add_action('wp_ajax_baiduseo_neilian_delete', [$this,'baiduseo_neilian_delete']);
        add_action('wp_ajax_baiduseo_neilian_delete_all', [$this,'baiduseo_neilian_delete_all']);
        add_action('wp_ajax_baiduseo_reci', [$this,'baiduseo_reci']);
        add_action('wp_ajax_baiduseo_5118', [$this,'baiduseo_5118']);
        add_action('wp_ajax_baiduseo_5118_daochu', [$this,'baiduseo_5118_daochu']);
        add_action('wp_ajax_baiduseo_add_tag', [$this,'baiduseo_add_tag']);
        add_action('wp_ajax_baiduseo_add_pltag', [$this,'baiduseo_add_pltag']);
        add_action('wp_ajax_baiduseo_linkhh', [$this,'baiduseo_linkhh']);
        add_action('wp_ajax_baiduseo_zhizhu_linkdelete', [$this,'baiduseo_zhizhu_linkdelete']);
        add_action('wp_ajax_baiduseo_wycsc', [$this,'baiduseo_wycsc']);
        add_action('wp_ajax_baiduseo_yuanchuang', [$this,'baiduseo_yuanchuang']);
        add_action('wp_ajax_baiduseo_kuaisu', [$this,'baiduseo_kuaisu']);
        add_action('wp_ajax_baiduseo_gaixie', [$this,'baiduseo_gaixie']);
        add_action('wp_ajax_baiduseo_ptts', [$this,'baiduseo_ptts']);
        add_action('wp_ajax_baiduseo_yanzheng', [$this,'baiduseo_yanzheng']);
        add_action('wp_ajax_baiduseo_pingbi', [$this,'baiduseo_pingbi']);
        add_action('wp_ajax_baiduseo_add_link', [$this,'baiduseo_add_link']);
        add_action('wp_ajax_baiduseo_address_delete', [$this,'baiduseo_address_delete']);
        add_action('wp_ajax_baiduseo_shenhe', [$this,'baiduseo_shenhe']);
        add_action('wp_ajax_baiduseo_ai_lishi', [$this,'baiduseo_ai_lishi']);
        add_action('wp_ajax_baiduseo_ai_lishiz', [$this,'baiduseo_ai_lishiz']);
        add_action('wp_ajax_baiduseo_ai_lishis', [$this,'baiduseo_ai_lishis']);
        add_action('wp_ajax_baiduseo_yindao_first', [$this,'baiduseo_yindao_first']);
        add_action('wp_ajax_baiduseo_yindao_second', [$this,'baiduseo_yindao_second']);
        add_action('wp_ajax_baiduseo_yindao_three', [$this,'baiduseo_yindao_three']);
        add_action('wp_ajax_baiduseo_yindao_four', [$this,'baiduseo_yindao_four']);
        add_action('wp_ajax_baiduseo_yindao_five', [$this,'baiduseo_yindao_five']);
        add_action('wp_ajax_baiduseo_percent', [$this,'baiduseo_percent']);
        add_action('wp_ajax_baiduseo_liuliang', [$this,'baiduseo_liuliang']);
        add_action('wp_ajax_baiduseo_liuliang_delete', [$this,'baiduseo_liuliang_delete']);
        add_action('wp_ajax_baiduseo_aidk', [$this,'baiduseo_aidk']);
        add_action('wp_ajax_baiduseo_yindao', [$this,'baiduseo_yindao']);
        add_action('wp_ajax_baiduseo_robots', [$this,'baiduseo_robots']);
        add_action('wp_ajax_baiduseo_pingfen', [$this,'baiduseo_pingfen']);
       
    }
    public function baiduseo_pingfen(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
           $baiduseo_pingfen = get_option('baiduseo_pingfen');
            if($baiduseo_pingfen!==false){
               update_option('baiduseo_pingfen',(int)$_POST['pingfen']);
            }else{
               add_option('baiduseo_pingfen',(int)$_POST['pingfen']);
            }
            echo json_encode(['code'=>1]);exit;
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_robots(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
             if(isset($_POST['robots'])){
                baiduseo_seo::robots(sanitize_textarea_field($_POST['robots']));
            }
            echo json_encode(['code'=>1]);exit;
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_yindao(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
           $baiduseo_yindao = get_option('baiduseo_yindao');
           if($baiduseo_yindao!==false){
               update_option('baiduseo_yindao',1);
           }else{
               add_option('baiduseo_yindao',1);
           }
            echo json_encode(['code'=>1]);exit;
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_liuliang_delete(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $res = $wpdb->query("DELETE FROM " . $wpdb->prefix . "baiduseo_liuliang");
            echo json_encode(['msg'=>'操作成功','code'=>1]);exit;
        }
        echo json_encode(['msg'=>'操作失败','code'=>0]);exit;
    }
    public function baiduseo_aidk(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            set_time_limit(0);
            ini_set('memory_limit','-1');
            $codea = (int)$_POST['codea'];
            $msg = sanitize_text_field($_POST['msg']);
            $defaults = array(
                'timeout' => 10000,
                'connecttimeout'=>10000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $url1 = baiduseo_common::baiduseo_url(0);
            $result = wp_remote_get('https://www.rbzzz.com/index/index/zhongzhuan1?codea='.$codea.'&msg='.$msg.'&url='.$url1,$defaults);
            if(!is_wp_error($result)){
                $content = wp_remote_retrieve_body($result);
                echo $content;exit;
            }
        }
        echo json_encode(['msg'=>'操作失败','code'=>0]);exit;
    }
    public function baiduseo_liuliang(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $ss  = baiduseo_zz::pay_money();
            if(!$ss){
                 echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $open = (int)$_POST['open'];
            $log = (int)$_POST['log'];
            
            $baiduseo_wyc = get_option('baiduseo_liuliang');
            if($baiduseo_wyc!==false){
                $res = update_option('baiduseo_liuliang',['open'=>$open,'log'=>$log]);
            }else{
                $res = add_option('baiduseo_liuliang',['open'=>$open,'log'=>$log]);
            }
            
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
            
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_wyc(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $wyc = (int)$_POST['wyc'];
            $gx = (int)$_POST['gx'];
            $wyc_min = (int)$_POST['wyc_min'];
            $baiduseo_wyc = get_option('baiduseo_wyc');
            if($baiduseo_wyc!==false){
                $res = update_option('baiduseo_wyc',['wyc'=>$wyc,'gx'=>$gx,'wyc_min'=>$wyc_min]);
            }else{
                $res = add_option('baiduseo_wyc',['wyc'=>$wyc,'gx'=>$gx,'wyc_min'=>$wyc_min]);
            }
            if($res){
                echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
            }
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_zhizhu(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
             global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                 echo json_encode(['code'=>'0','msg'=>'请先授权']);exit;
            }
            $log = baiduseo_zz::pay_money();
           
            if(!$log){
                echo json_encode(['code'=>'0','msg'=>'请先授权']);exit;
            }
           
            $list = [
                'open'=>(int)$_POST['open'],
                'log'=>(int)$_POST['log'],
                'type'=>sanitize_text_field($_POST['type']),
            ];
            $baiduseo_zhizhu = get_option('baiduseo_zhizhu');
            if($baiduseo_zhizhu!==false){
                update_option('baiduseo_zhizhu',$list);
            }else{
                add_option('baiduseo_zhizhu',$list);
            }
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_ai_lishi(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
             $current_time = current_time( 'Y/m/d H:i:s');
            $res = $wpdb->insert($wpdb->prefix."baiduseo_ai_lishi",['hexin'=>sanitize_text_field($_POST['hexin']),'guangjianci'=>sanitize_text_field($_POST['guangjianci']),'neirong'=>sanitize_text_field($_POST['neirong']),'riqi'=>$current_time,'jifen'=>'0.2']);
            if($res){
                echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
            }
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
        
    }
    public function baiduseo_ai_lishiz(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
            $start1 = ($p1-1)*20;
            $count = $wpdb->query(' select * from  '.$wpdb->prefix.'baiduseo_ai_lishi',ARRAY_A);
           
            $list = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_ai_lishi  order by id desc limit %d ,20',$start1),ARRAY_A);
           $jifen = baiduseo_kp::get_jifen();
            echo json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$list,'pagesize'=>20,'total'=>ceil($count/20),'jifen'=>$jifen]);exit;
           
        }
         echo json_encode(['code'=>0,'msg'=>'获取失败',]);exit;
        
    }
      public function baiduseo_ai_lishis(){
           if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $id  = (int)$_POST['id'];
             $res = $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_ai_lishi where id=  %d",(int)$id));
             
            if($res){
                echo json_encode(['code'=>1,'msg'=>'删除成功']);exit;
            }else{
                echo json_encode(['code'=>0,'msg'=>'删除失败']);exit;
            }
        }
        echo json_encode(['code'=>0,'msg'=>'删除失败']);exit;
      }
    public function baiduseo_5118_daochu(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $keywords = sanitize_text_field($_POST['keywords']);
            $total = (int)$_POST['total'];
            $long = (int)$_POST['long'];
            $collect = 0;
            $bidword = (int)$_POST['bidword'];
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $data =  baiduseo_common::baiduseo_url(1);
            $url = 'http://wp.seohnzz.com/api/rank/daochu?keywords='.$keywords.'&total='.$total.'&long='.$long.'&collect='.$collect.'&bidword='.$bidword.'&url='.$data;
            
            $result = wp_remote_get($url,$defaults);
            
            if(!is_wp_error($result)){
                $level = wp_remote_retrieve_body($result);
                $level = json_decode($level,true);
               
                if(isset($level['code']) && $level['code']==1){
                    $res = $wpdb->insert($wpdb->prefix."baiduseo_long",['keywords'=>$keywords,'total'=>$total,'longs'=>$long,'collect'=>$collect,'bidword'=>$bidword]);
                    echo json_encode(['code'=>1,'msg'=>'申请成功，请等待响应！']);exit;
                }elseif(isset($level['code']) && $level['code']==2){
                    echo json_encode(['code'=>0,'msg'=>'申请失败，积分不足']);exit;
                }
            }
        }
        echo json_encode(['code'=>0,'msg'=>'申请失败，请稍后重试！']);exit;
    }
    public function baiduseo_5118(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $name = sanitize_text_field($_POST['name']);
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $url = 'http://wp.seohnzz.com/api/rank/word_vip?keywords='.$name;
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                $level = wp_remote_retrieve_body($result);
                echo json_encode(['code'=>1,'data'=>$level]);exit;
                
            }
        }
        echo json_encode(['code'=>0,'msg'=>'获取失败']);exit;
    }
    public function baiduseo_percent(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $type = (int)$_POST['type']; 
            if($type==1){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $url = 'https://www.rbzzz.com/api/money/level1?url='.baiduseo_common::baiduseo_url(0);
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $level = wp_remote_retrieve_body($result);
                    $level = json_decode($level,true);
                    if($level['version']==BAIDUSEO_VERSION){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                    
                }
            }elseif($type==2){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://www.rbzzz.com/api/speed/keywords?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
               
            }elseif($type==3){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://www.rbzzz.com/api/speed/description?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==4){
                $seo_alt_auto = get_option('seo_alt_auto');
                if($seo_alt_auto!==false){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==5){
                $defaults = array(
                    'timeout' => 4000,
                    'redirection' => 4000,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                    );
                $site_url = baiduseo_common::baiduseo_url(0).'/';
                $site_url1 = baiduseo_common::baiduseo_url(1);
                $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                $url = str_replace('www.','',$site_url);
                $url_301['url1'] = $url;
                $url1 = $http_type.$url;
                $url_301['url2'] = 'www.'.$url;
                $url2 = $http_type.'www.'.$url;
                $url_301['status'] = 0;
                $result = wp_remote_get($url1,$defaults);
                if(!is_wp_error($result)){
                  $http = (array)$result['http_response'];
                  
                  $url_301['re_url1'] = $http["\0*\0response"]->url;
                }else{
                   $url_301['re_url1'] =''; 
                }
                $result1 = wp_remote_get($url2,$defaults);
                if(!is_wp_error($result1)){
                  $http1 = (array)$result1['http_response'];
                  
                  
                  $url_301['re_url2'] = $http1["\0*\0response"]->url;
                }else{
                    $url_301['re_url2'] =''; 
                }
                
                 if($url_301['re_url2'] && $url_301['re_url1'] && trim($url_301['re_url2'],'/')==trim($url_301['re_url1'],'/') && trim($url_301['re_url1'],'/')==trim($site_url1,'/')){
                    $url_301['status'] = 1;
                }else{
                    $url_301['status'] = 0;
                }
                if($url_301['status']==1){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
               
            }elseif($type==6){
                $rootbot = get_option('seo_robots_sc');
                if($rootbot!==false){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==7){
                $sitemap = get_option('seo_baidu_sitemap');
                if($sitemap!==false){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==8){
                $baiduseo_zz = get_option('baiduseo_zz');
                if(is_array($baiduseo_zz) && isset($baiduseo_zz['pingtai'])){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==9){
                $baiduseo_zz = get_option('baiduseo_zz');
                if(is_array($baiduseo_zz) && isset($baiduseo_zz['zz_link']) && $baiduseo_zz['zz_link']){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==10){
                $baiduseo_zz = get_option('baiduseo_zz');
                if(is_array($baiduseo_zz) && isset($baiduseo_zz['bing_key']) && $baiduseo_zz['bing_key']){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==11){
                $baiduseo_zz = get_option('baiduseo_zz');
                if(is_array($baiduseo_zz) && isset($baiduseo_zz['shenma_key']) && $baiduseo_zz['shenma_key']){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==12){
                $baiduseo_zz = get_option('baiduseo_zz');
                if(is_array($baiduseo_zz) && isset($baiduseo_zz['toutiao_key']) && $baiduseo_zz['toutiao_key']){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==13){
                $baidu3 = get_option('baiduseo_tag');
                if(isset($baidu3['auto']) && $baidu3['auto']==1){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==14){
                $silian = get_option('seo_baidu_silian');
                if($silian!==false){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==15){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  str_replace('www.','',baiduseo_common::baiduseo_url(0));
                $url = "https://www.rbzzz.com/api/speed/beian?url={$data}";
               
                $result = wp_remote_get($url,$defaults);
                $beian = get_option('baiduseo_beian');
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if($beian!==false){
                        update_option('baiduseo_beian',$content['data']);
                    }else{
                        add_option('baiduseo_beian',$content['data']);
                    }
                    if(isset($content['code']) && $content['code']==1){
                        
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }elseif($type==16){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://www.rbzzz.com/api/speed/wx_check?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    
                    if(isset($content['code']) && $content['code']==1){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==17){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://www.rbzzz.com/api/speed/h1?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==18){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://www.rbzzz.com/api/speed/iframe?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        echo json_encode(['code'=>1]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==19){
                $defaults = array(
                    'timeout' => 40000,
                    'connecttimeout'=>40000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "http://jiekou.seohnzz.com/api/index/go_sd?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    if($content){
                        echo json_encode(['code'=>1,'msg'=>$content,'num'=>ceil($content/10)]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==20){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "https://www.rbzzz.com/api/speed/gn_yc?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        if($content['msg']>1.5){
                            $num =2;
                        }elseif($content['msg']>0.5 && $content<=1.5){
                            $num =4;
                        }else{
                            $num = 6;
                        }
                        echo json_encode(['code'=>1,'msg'=>round($content['msg'],1).'s','num'=>$num]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }elseif($type==21){
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $data =  baiduseo_common::baiduseo_url(1);
                $url = "http://jiekou.seohnzz.com/api/index/gn_yc?url={$data}";
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    $content = json_decode($content,true);
                    if(isset($content['code']) && $content['code']==1){
                        if($content['msg']>1.5){
                            $num =1;
                        }elseif($content['msg']>0.5 && $content<=1.5){
                            $num =2;
                        }else{
                            $num = 4;
                        }
                        echo json_encode(['code'=>1,'msg'=>round($content['msg'],1).'s','num'=>$num]);exit;
                    }else{
                        echo json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo json_encode(['code'=>0]);exit;
                } 
            }
            
        }
    }
    public function baiduseo_yindao_five(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
             global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                 exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                exit;
            }
            baiduseo_tag::baiduseo_tag_set($_POST);
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_yindao_four(){
          global $wpdb,$baiduseo_wzt_log;
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            if(!$baiduseo_wzt_log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $indexnow_key = sanitize_text_field($_POST['indexnow_key']);
            
            $seo_baidu_xzh =[                               
                'zz_link'=>sanitize_url($_POST['zz_link']),                                   
                'bing_key'=>sanitize_text_field($_POST['bing_key']), 
                'shenma_key' =>sanitize_url($_POST['shenma_key']),
                'toutiao_key'=>sanitize_text_field($_POST['toutiao_key']),
                'indexnow_key'=>$indexnow_key,
                'google_api'=>sanitize_textarea_field(stripslashes($_POST['google_api'])),
                'indexnow_pingtai'=>sanitize_text_field($_POST['indexnow_pingtai']),
                'post_type'=>sanitize_text_field($_POST['post_type']),
                'baiduseo_type'=>sanitize_text_field($_POST['baiduseo_type']),
                'post_type'=>sanitize_text_field($_POST['post_type']),
                'status'=>sanitize_text_field($_POST['status']),
                'pingtai'=>sanitize_text_field($_POST['pingtai']),
                'bdpt_num'=>(int)$_POST['bdpt_num'],
                'bing_num'=>(int)$_POST['bing_num'],
                'sm_num'=>(int)$_POST['sm_num'],
                'log'=>sanitize_text_field($_POST['log']),
                'bd_log'=>(int)$_POST['bd_log'],
                'bdks_log'=>(int)$_POST['bdks_log'],
                'bing_log'=>(int)$_POST['bing_log'],
                'shenma_log'=>(int)$_POST['shenma_log'],
                'indexNow_log'=>(int)$_POST['indexNow_log'],
                'guge_log'=>(int)$_POST['guge_log'],
                
            ];
            if($indexnow_key){
                WP_Filesystem();
                global $wp_filesystem;
                $wp_filesystem->put_contents (ABSPATH.'/'.$indexnow_key.'.txt',$indexnow_key);
            }
            
            $baidu = get_option('baiduseo_zz');
            if($baidu!==false){
                update_option('baiduseo_zz',$seo_baidu_xzh);
            }else{
                add_option('baiduseo_zz',$seo_baidu_xzh);
            }
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
        
         echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_yindao_three(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                 echo json_encode(['code'=>'0','msg'=>'请先授权']);exit;
            }
            $log = baiduseo_zz::pay_money();
            
            if(!$log){
                echo json_encode(['code'=>'0','msg'=>'请先授权']);exit;
            }
            $sitemap = get_option('seo_baidu_sitemap');
            if($sitemap!==false && !is_array($sitemap)){
                // $data = $sitemap;
                $data['level1'] = (int)$_POST['level1'];
                $data['level2'] = (int)$_POST['level2'];
                $data['level3'] = (int)$_POST['level3'];
                $data['level4'] = (int)$_POST['level4'];
                $data['level5'] = (int)$_POST['level5'];
                $data['type1'] = (int)$_POST['type1'];
                $data['type2'] = (int)$_POST['type2'];
                $data['type3'] = (int)$_POST['type3'];
                $data['type4'] = (int)$_POST['type4'];
                $data['type5'] = (int)$_POST['type5'];
                $data['page_time'] = sanitize_text_field($_POST['page_time']);
                $data['post_time'] = sanitize_text_field($_POST['post_time']);
                $data['tag_time'] = sanitize_text_field($_POST['tag_time']);
                $data['other_time'] = sanitize_text_field($_POST['other_time']);
                $data['cate_time'] = sanitize_text_field($_POST['cate_time']);
                $data['sitemap_open'] = (int)$_POST['sitemap_open'];
                $data['silian_open'] = (int)$_POST['silian_open'];
                // $data['tag_open'] = (int)$_POST['tag_open'];
                
                update_option('seo_baidu_sitemap',$data);
            }elseif($sitemap!==false && is_array($sitemap)){
                $data = $sitemap;
                $data['level1'] = (int)$_POST['level1'];
                $data['level2'] = (int)$_POST['level2'];
                $data['level3'] = (int)$_POST['level3'];
                $data['level4'] = (int)$_POST['level4'];
                $data['level5'] = (int)$_POST['level5'];
                $data['type1'] = (int)$_POST['type1'];
                $data['type2'] = (int)$_POST['type2'];
                $data['type3'] = (int)$_POST['type3'];
                $data['type4'] = (int)$_POST['type4'];
                $data['type5'] = (int)$_POST['type5'];
                $data['page_time'] = sanitize_text_field($_POST['page_time']);
                $data['post_time'] = sanitize_text_field($_POST['post_time']);
                $data['tag_time'] = sanitize_text_field($_POST['tag_time']);
                $data['other_time'] = sanitize_text_field($_POST['other_time']);
                $data['cate_time'] = sanitize_text_field($_POST['cate_time']);
                $data['sitemap_open'] = (int)$_POST['sitemap_open'];
                $data['silian_open'] = (int)$_POST['silian_open'];
                // $data['tag_open'] = (int)$_POST['tag_open'];
                
                update_option('seo_baidu_sitemap',$data);
            }else{
                $data['level1'] = (int)$_POST['level1'];
                $data['level2'] = (int)$_POST['level2'];
                $data['level3'] = (int)$_POST['level3'];
                $data['level4'] = (int)$_POST['level4'];
                $data['level5'] = (int)$_POST['level5'];
                $data['type1'] = (int)$_POST['type1'];
                $data['type2'] = (int)$_POST['type2'];
                $data['type3'] = (int)$_POST['type3'];
                $data['type4'] = (int)$_POST['type4'];
                $data['type5'] = (int)$_POST['type5'];
                $data['page_time'] = sanitize_text_field($_POST['page_time']);
                $data['post_time'] = sanitize_text_field($_POST['post_time']);
                $data['tag_time'] = sanitize_text_field($_POST['tag_time']);
                $data['other_time'] = sanitize_text_field($_POST['other_time']);
                $data['cate_time'] = sanitize_text_field($_POST['cate_time']);
                 $data['sitemap_open'] = (int)$_POST['sitemap_open'];
                $data['silian_open'] = (int)$_POST['silian_open'];
                // $data['tag_open'] = (int)$_POST['tag_open'];
                add_option('seo_baidu_sitemap',$data);  
            }
            
            baiduseo_seo::alt((int)$_POST['alt'],(int)$_POST['title']);
            if($_POST['isrobots']==1){
                if(sanitize_textarea_field($_POST['robots'])){
                    baiduseo_seo::robots(sanitize_textarea_field($_POST['robots']));
                }
            }
            if((int)$_POST['sitemap_open']==1){
                baiduseo_seo::sitemap(1,1,1);
            }
            if((int)$_POST['silian_open']==1){
                baiduseo_seo::silian(1,1);
            }
            echo json_encode(['code'=>1,'msg'=>'保存成功']);exit;
        }
         echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_yindao_second(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $data = [
                'thumb'=>(int)$_POST['thumb'],
                'head_dy'=>(int)$_POST['head_dy'],
                'xml_rpc'=>(int)$_POST['xml_rpc'],
                'feed'=>(int)$_POST['feed'],
                'post_thumb'=>(int)$_POST['post_thumb'],
                'gravatar'=>(int)$_POST['gravatar'],
                'lan'=>(int)$_POST['lan'],
                'category'=>(int)$_POST['category'],
                'listbtn'=>(int)$_POST['listbtn']
                
            ];
           
            $baidu = get_option('baiduseo_youhua');
            if($baidu!==false){
                update_option('baiduseo_youhua',$data);
            }else{
                add_option('baiduseo_youhua',$data);
            }
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
         echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_yindao_first(){
        if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            if(isset($_POST['title'])){
                update_option('blogname',sanitize_text_field($_POST['title']));
            }
            if(isset($_POST['subtitle'])){
                update_option('blogdescription',sanitize_text_field($_POST['subtitle']));
            }
            baiduseo_seo::seo_index(sanitize_text_field($_POST['keywords']),sanitize_textarea_field($_POST['description']));
            if(isset($_POST['cate_id'])){
                baiduseo_seo::cate_seo(sanitize_text_field($_POST['cate_keywords']),sanitize_textarea_field($_POST['cate_description']),(int)$_POST['cate_id']);
            }
            if(isset($_POST['page'])){
                baiduseo_seo::page_seo(sanitize_text_field($_POST['page_keywords']),sanitize_text_field($_POST['page_description']),(int)$_POST['page']);
            }
            echo json_encode(['code'=>1]);exit;
            
        }
        echo json_encode(['code'=>0]);exit;
    }
   
    public function baiduseo_reci(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
           
            $type = (int)$_POST['type'];
            $keyword = sanitize_text_field($_POST['keyword']);
            $result = wp_remote_post('https://www.rbzzz.com/api/tag/index',['body'=>['type'=>$type,'keyword'=>$keyword,'url'=>baiduseo_common::baiduseo_url(0)]]);
           
            if(!is_wp_error($result)){
                $result = wp_remote_retrieve_body($result);
                $result = json_decode($result,true);
                
                if($result['code']){
                    $msg = array_map('sanitize_text_field',$result['msg']);
                    
                    echo json_encode(['data'=>$msg,'code'=>1]);exit;
                }else{
                    echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
            }
        }
        echo json_encode(['msg'=>'获取失败','code'=>0]);exit;
    }
    public function baiduseo_address_delete(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $id  = (int)$_POST['id'];
             $res = $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "wztkj_friends where id=  %d",(int)$id));
             
            if($res){
                echo json_encode(['code'=>1,'msg'=>'删除成功']);exit;
            }else{
                echo json_encode(['code'=>0,'msg'=>'删除失败']);exit;
            }
        }
         echo json_encode(['code'=>0,'msg'=>'删除失败']);exit;
    }
    public function baiduseo_add_link(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $current_time = current_time( 'Y/m/d H:i:s');
            $re = $wpdb->insert($wpdb->prefix."wztkj_friends",['link'=>sanitize_url($_POST['address']),'keywords'=>sanitize_text_field($_POST['keywords']),'time'=>$current_time,'status1'=>5]);
            if($re){
                echo json_encode(['code'=>1,'msg'=>'添加成功']);exit;
            }else{
                echo json_encode(['code'=>0,'msg'=>'添加失败']);exit;
            }
        }
        echo json_encode(['code'=>0,'msg'=>'添加失败']);exit;
    }
    public function baiduseo_shenhe(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $url = 'http://wp.seohnzz.com/api/wztkj/shenhe';
            $link2 = sanitize_url($_POST['url']);
            $link1 =  baiduseo_common::baiduseo_url(1);
            $result = wp_remote_post($url,['body'=>['data'=>['link1'=>$link1,'link2'=>$link2]]]);
            if(!is_wp_error($result)){
                $result = wp_remote_retrieve_body($result);
                if($result){
                    $wpdb->update($wpdb->prefix . 'wztkj_friends',['status3'=>2],['link'=>$link2]);
                    echo json_encode(['msg'=>'操作成功，请等待处理！','code'=>1]);exit;
                }else{
                    echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
                }
            }else{
                echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
            }
        }
        echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
    }
    public function baiduseo_pingbi(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $url = 'http://wp.seohnzz.com/api/wztkj/pb';
            $link2 = sanitize_url($_POST['url']);
            $status = (int)$_POST['status'];
            
            if($status==0){
                $sta = 1;
            }else{
                $sta = 0;
            }
            $link1 =  baiduseo_common::baiduseo_url(1);
            $result = wp_remote_post($url,['body'=>['data'=>['link1'=>$link1,'link2'=>$link2,'status'=>$sta]]]);
            if(!is_wp_error($result)){
                $result = wp_remote_retrieve_body($result);
                if($result){
                     
                    $wpdb->update($wpdb->prefix . 'wztkj_friends',['status1'=>$sta],['link'=>$link2]);
                    
                    echo json_encode(['msg'=>'操作成功！','code'=>1]);exit;
                }else{
                    echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
                }
            }else{
                echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
            }
        }
        echo json_encode(['msg'=>'请求失败，请稍后重试！','code'=>0]);exit;
    }
    public function baiduseo_yanzheng(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
        $defaults = array(
            'timeout' => 4000,
            'connecttimeout'=>4000,
            'redirection' => 3,
            'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
            'sslverify' => FALSE,
        );
        $url = get_option('siteurl');
        $result = wp_remote_get($url,$defaults);
        if(!is_wp_error($result)){
            $content = wp_remote_retrieve_body($result);
           
            if(strpos($content,md5(baiduseo_common::baiduseo_url(0))) !== false){ 
             echo json_encode(['code'=>1]);exit;
            }else{
             echo json_encode(['code'=>0]);exit;
            }
           
        }
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_linkhh(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            
            $data['link'] = (int)$_POST['link'];
            $data['keywords'] = sanitize_text_field($_POST['keywords']);
            $data['hhtype'] = (int)$_POST['hhtype'];
            $data['hhtj'] = (int)$_POST['hhtj'];
            if(isset($_POST['level']) ){
                $data['level'] = array_map('intval',explode(',',$_POST['level']));
            }
            if(isset($_POST['cate'])){
                $data['cate'] = array_map('intval',explode(',',$_POST['cate']));
            }
            $data['ystype'] = (int)$_POST['ystype'];
            $data['kqtype'] = (int)$_POST['kqtype'];
            $data['yswidth'] = sanitize_text_field($_POST['yswidth']);
            $data['mobilewidth'] = sanitize_text_field($_POST['mobilewidth']);
            
            $wztkj_linkhh = get_option('baiduseo_linkhh');
            if($wztkj_linkhh!==false){
                $res = update_option('baiduseo_linkhh',$data);
            }else{
                add_option('baiduseo_linkhh',$data);
            }
            echo json_encode(['code'=>1]);exit;
            
        }
       echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_ptts(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),$_POST['action'])){
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>0,'data'=>'请先授权']);exit;
            }
            $id = (int)$_POST['id'];
            $urls[] = get_permalink($id);
            $baiduseo_zz_record = get_option('baiduseo_zz_record');
            baiduseo_zz::bdts($urls,0);
            $baiduseo_zz_record1 = get_option('baiduseo_zz_record');
            if($baiduseo_zz_record['remind']!=$baiduseo_zz_record1['remind']){
                echo json_encode(['msg'=>1,'remind'=>$baiduseo_zz_record1['remind']]);exit;
            }else{
                echo json_encode(['msg'=>0,'data'=>'推送失败，配额不足！']);exit;
            }
        }
    }
    public function baiduseo_neilian_delete_all(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
           
            global $wpdb;
            $res = $wpdb->query("DELETE FROM " . $wpdb->prefix . "baiduseo_neilian ");
             if($res){
                echo json_encode(['code'=>1,'msg'=>'清空成功']);exit;
            }
        }
        echo json_encode(['code'=>0,'msg'=>'清空失败']);exit;
    }
    public function baiduseo_neilian_delete(){
      
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $dele = array_map('intval',wp_unslash(explode(',',$_POST['dele'])));
            if(!empty($dele) && is_array($dele)){
                global $wpdb;
                foreach($dele as $key=>$val){
                 $res = $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_neilian where id=  %d",(int)$val));
                }
            }
            if($res){
                echo json_encode(['code'=>1,'msg'=>'删除成功']);exit;
            }
            
        }
        echo json_encode(['code'=>0,'msg'=>'删除失败']);exit;
    }
    public function baiduseo_shouquan(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $key = sanitize_text_field($_POST['key']);
            
            $data =  baiduseo_common::baiduseo_url(0);
            $url1 = sanitize_text_field($_SERVER['SERVER_NAME']);
            $url = 'https://www.rbzzz.com/api/money/log2?url='.$data.'&url1='.$url1.'&key='.$key.'&type=1';
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                $content = wp_remote_retrieve_body($result);
                if($content){
                    $baiduseo_wzt_log = get_option('baiduseo_wzt_log');
                    if($baiduseo_wzt_log!==false){
                        update_option('baiduseo_wzt_log',$key);
                    }else{
                        add_option('baiduseo_wzt_log',$key);
                    }
                    echo json_encode(['code'=>1]);exit;
                }
            }
            
            
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_neilian(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb,$baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                echo json_encode(['code'=>0,'msg'=>'请先授权']);exit;
            }
            $log = baiduseo_zz::pay_money();
            
            if(!$log){
                echo json_encode(['code'=>0,'msg'=>'请先授权']);exit;
            }
            $id = (int)$_POST['id'];
            if(isset($_POST['keywords'])){
                $data['keywords'] = sanitize_text_field($_POST['keywords']);
            }
            if(isset($_POST['link'])){
                $data['link'] = sanitize_text_field($_POST['link']);
            }
            if(isset($_POST['target'])){
                $data['target'] = (int)$_POST['target'];
            }
            if(isset($_POST['nofollow'])){
                $data['nofollow'] = (int)$_POST['nofollow'];
            }
            if(isset($_POST['sort'])){
                $data['sort'] = (int)$_POST['sort'];
            }
            $res = $wpdb->update($wpdb->prefix . 'baiduseo_neilian',$data,['id'=>(int)$id]);
            if($res){
                
                echo json_encode(['code'=>1,'msg'=>'修改成功']);exit;
                
            }
        }
        echo json_encode(['code'=>0,'msg'=>'修改失败']);exit;
    }
    public function baiduseo_keywords_delete(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb,$baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                 echo json_encode(['code'=>0,'msg'=>'请先授权']);exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['code'=>0,'msg'=>'请先授权']);exit;
            }
            $id = (int)$_POST['id'];
            $list = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_keywords where id=%d',$id),ARRAY_A);
            $res = $wpdb->query($wpdb->prepare( "DELETE FROM " . $wpdb->prefix . "baiduseo_keywords where id=  %d",$id ));
            if($res){
                $defaults = array(
                    'timeout' => 4000,
                    'redirection' => 4000,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $url = 'http://wp.seohnzz.com/api/keywords/delete?url='.get_option('siteurl').'&keywords='.$list[0]['keywords'].'&type='.$list[0]['type'];
                wp_remote_get($url,$defaults);
                echo  json_encode(['msg'=>'删除成功','code'=>1]);exit;
            }
                
            
        }
        echo  json_encode(['msg'=>'删除失败,请稍后重试','code'=>0]);exit;
    }
    public function baiduseo_gaixie(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),sanitize_text_field($_POST['action']))){
            global $wpdb;
            $id = (int)$_POST['id'];
            $url = 'https://www.rbzzz.com/api/kp/jifen?url='.baiduseo_common::baiduseo_url(0);
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                $jifen = wp_remote_retrieve_body($result);
                $jifen =$jifen?$jifen:0;
            }else{
                $jifen = 0;
            }
            
            if($jifen>=0.28){
                $post = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."posts  where ID=%d ",$id),ARRAY_A);
                
                foreach($post as $ke=>$va){
                    $url = 'https://ceshig.zhengyouyoule.com/api/wyc/wyc_50';
                    $va['url'] = get_option('siteurl');
                    $result = wp_remote_post($url,['body'=>$va]);
                    $post_extend = get_post_meta( $id, 'baiduseo', true );
                    if($post_extend){
                        $post_extend['status'] = 3;
                       update_post_meta( $id,'baiduseo', $post_extend ); 
                    }else{
                        add_post_meta($id,'baiduseo',['status'=>3] );
                    }
                    break;
                }
                echo json_encode(['msg'=>'1']);exit;
            }else{
                echo json_encode(['msg'=>0]);exit;
            }
            
        }
    }
    public function baiduseo_kuaisu(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),sanitize_text_field($_POST['action']))){
            
            $id = (int)$_POST['id'];
            $urls[] = get_permalink($id);
            baiduseo_zz::bddayts1($urls);
        }
    }
    public function baiduseo_yuanchuang(){
        set_time_limit(0);
        ini_set('memory_limit','-1');
        global $baiduseo_wzt_log;
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),sanitize_text_field($_POST['action']))){
            $id = (int)$_POST['id'];
            $url = 'https://www.rbzzz.com/api/kp/jifen?url='.baiduseo_common::baiduseo_url(0);
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                $jifen = wp_remote_retrieve_body($result);
                $jifen =$jifen?$jifen:0;
            }else{
                $jifen = 0;
            }
            if($jifen>0.28){
                $total =2;
            }else{
                if($baiduseo_wzt_log){
                    $log = baiduseo_zz::pay_money();
                    if($log){
                        $total = 1;
                    }else{
                        $total = 0;
                    }
                }else{
                    $total = 0;
                }
            }
            if($total==0){
                $baiduseo_jifen = get_option('baiduseo_jifen');
                if($baiduseo_jifen!==false){
                    $timezone_offet = get_option( 'gmt_offset');
                    if(isset($baiduseo_jifen['addtime']) && $baiduseo_jifen['addtime']>strtotime(gmdate('Y-m-d 00:00:00'))-$timezone_offet*3600){
                        
                        if(isset($baiduseo_jifen['sy']) && $baiduseo_jifen['sy']<1){
                            echo json_encode(['msg'=>0,'data'=>'当日服务器压力大，请明天再试']);exit;
                        }else{
                            update_option('baiduseo_jifen',['sy'=>$baiduseo_jifen['sy']-1,'kc_total'=>1+$baiduseo_jifen['kc_total'],'addtime'=>time()]);
                        }
                    }else{
                        update_option('baiduseo_jifen',['sy'=>2,'kc_total'=>1+$baiduseo_jifen['kc_total'],'addtime'=>time()]);
                    }
                }else{
                    add_option('baiduseo_jifen',['sy'=>2,'kc_total'=>1,'addtime'=>time()]);
                }
            }
            $post_extend = get_post_meta( $id, 'baiduseo', true );
            $current_time = current_time( 'Y/m/d H:i:s');
            if($post_extend){
               update_post_meta( $id,'baiduseo',  ['status'=>2,'tjtime'=>$current_time] ); 
            }else{
                add_post_meta($id,'baiduseo',['status'=>2,'tjtime'=>$current_time] );
            }
            $content = get_post($id)->post_content;
            $url = 'https://ceshig.zhengyouyoule.com/api/wyc/wp_wyc?id='.$id.'&content='.$content.'&url='.get_option('siteurl').'&like=9';
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                 $result = wp_remote_retrieve_body($result);
                 if($result){
                    echo json_encode(['msg'=>'1']);exit;
                 }else{
                     echo json_encode(['msg'=>0,'data'=>'当日服务器压力大，请明天再试']);exit;
                 }
            }else{
                $result = wp_remote_post('https://ceshig.zhengyouyoule.com/api/wyc/wp_wyc',['body'=>['id'=>$id,'content'=>$content,'url'=>get_option('siteurl'),'like'=>9],'headers'=>[
                    'timeout' =>4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE]]);
                if(!is_wp_error($result)){
                     $result = wp_remote_retrieve_body($result);
                     if($result){
                        echo json_encode(['msg'=>'1']);exit;
                     }else{
                         echo json_encode(['msg'=>0,'data'=>'当日服务器压力大，请明天再试']);exit;
                     }
                }
                echo json_encode(['msg'=>'0','data'=>'提交失败请稍后重试！']);exit;
            }
        }
        echo json_encode(['msg'=>'0','data'=>'提交失败！']);exit;
    }
    public function baiduseo_kp_delete(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $id = (int)$_POST['id'];
            
            $kp = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_kp where id=%d',$id),ARRAY_A);
            $url = 'https://www.rbzzz.com/api/kp/keywords_delete?url='.baiduseo_common::baiduseo_url(0).'&keywords='.$kp[0]['keywords'].'&type='.$kp[0]['type'];
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
             $result = wp_remote_get($url,$defaults);
           
            if(!is_wp_error($result)){
                $content = wp_remote_retrieve_body($result);
                if($content){
                    if($kp[0]['status']==2 || $kp[0]['status']==1){
                        $wpdb->update($wpdb->prefix . 'baiduseo_kp',['status'=>3],['id'=>$id]);
                    }elseif($kp[0]['status']==5){
                        $wpdb->update($wpdb->prefix . 'baiduseo_kp',['status'=>7],['id'=>$id]);
                    }
                    echo json_encode(['code'=>'1']);exit;
                }
            }
                
            
        }
        echo json_encode(['code'=>'0']);exit;
    }
    public function baiduseo_tag_pladd(){
        set_time_limit(0);
        ini_set('memory_limit','-1');
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $baiduseo_tag = get_option('baiduseo_tag');
            
            $num = (int)$_POST['num'];
            
            global $wpdb;
            $page = (int)$_POST['page']?(int)$_POST['page']:1;
            if($page==1){
                global $baiduseo_wzt_log;
                if(!$baiduseo_wzt_log){
                     echo json_encode(['code'=>'0','msg'=>'请先授权']);exit;
                }
                $log = baiduseo_zz::pay_money();
                if(!$log){
                    echo json_encode(['code'=>'0','msg'=>'请先授权']);exit;
                }
            }
            $tag_num = (int)$_POST['tag_num'];
            
            $count_posts = wp_count_posts();
            $total = $count_posts->publish;
            $start = ($page-1)*$num;
            $list = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="post" limit %d,%d',$start,$num),ARRAY_A);
            
            if(!empty($list)){
                foreach($list as $key=>$val){
                    $tag_article = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'term_relationships as a left join '.$wpdb->prefix.'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where  a.object_id=%d and b.taxonomy="post_tag"',$val['ID']),ARRAY_A);
                    if(!empty($tag_article)){
                        $count = count($tag_article);
                    }else{
                        $count = 0;
                    }
                    if($count==$tag_num){
                       
                    }elseif($count<$tag_num){
                        if(isset($baiduseo_tag['pp']) && $baiduseo_tag['pp']==1){
                            $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms ORDER BY LENGTH(name) DESC',ARRAY_A);
                        }elseif(isset($baiduseo_tag['pp']) && $baiduseo_tag['pp']==2){
                            $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms ORDER BY LENGTH(name) ASC',ARRAY_A);
                        }else{
                            $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms',ARRAY_A);
                        }
                       
                        $nos =0;
                        foreach($tags as $k=>$v){
                            
                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where term_id=  %d and   taxonomy="post_tag"',$v['term_id']),ARRAY_A);
                          if(!empty($term_taxonomy)){
                           
                                $res = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where object_id=  %d and term_taxonomy_id=%d',$val['ID'],$term_taxonomy[0]['term_taxonomy_id']),ARRAY_A);
                                
                                if(empty($res)){
                                   
                                    if($nos<($tag_num-$count)){
                                        if(isset($baiduseo_tag['hremove']) && $baiduseo_tag['hremove']==1){
                                            if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',get_post($val['ID'])->post_content,$matches))
                                            {
                                                
                                                $re = $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$val['ID'],'term_taxonomy_id'=>$term_taxonomy[0]['term_taxonomy_id']]);
                                                if($re){
                                                    ++$nos;
                                                }
                                                $counts = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where  term_taxonomy_id=%d',$term_taxonomy[0]['term_taxonomy_id']));
                                                $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$counts],['term_taxonomy_id'=>$term_taxonomy[0]['term_taxonomy_id']]);
                                                
                                                
                                            }
                                        }else{
                                            if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',get_post($val['ID'])->post_content,$matches))
                                            {
                                                
                                                $re = $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$val['ID'],'term_taxonomy_id'=>$term_taxonomy[0]['term_taxonomy_id']]);
                                                if($re){
                                                    ++$nos;
                                                }
                                                $counts = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where  term_taxonomy_id=%d',$term_taxonomy[0]['term_taxonomy_id']));
                                                $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$counts],['term_taxonomy_id'=>$term_taxonomy[0]['term_taxonomy_id']]);
                                                
                                                
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }elseif($count>$tag_num){
                       
                        $no = 0;
                        foreach($tag_article as $k=>$v){
                     
                            if($no<($count-$tag_num)){
                                
                                $re = $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "term_relationships where object_id=  %d and term_taxonomy_id=%d",$v['object_id'],$v['term_taxonomy_id']),ARRAY_A);
                                if($re){
                                    ++$no;
                                }
                                $counts = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where  term_taxonomy_id=%d',$v['term_taxonomy_id']));
                                $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$counts],['term_taxonomy_id'=>$v['term_taxonomy_id']]);
                                
                            }
                            
                        }
                        
                    }
                }
            
                echo json_encode(['num'=>$num,'percent'=>round(100*($start+count($list))/$total,2).'%','page'=>$page,'tag_num'=>$tag_num,'code'=>1]);exit;
            }else{
                echo json_encode(['msg'=>"操作完成",'code'=>0]);exit;
            }
        }
        echo json_encode(['msg'=>"操作失败",'code'=>0]);exit;
    }
     public function baiduseo_add_pltag(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $type = (int)$_POST['type'];
            $keywords = array_map('sanitize_text_field',explode(',',$_POST['keywords']));
            global $baiduseo_wzt_log,$wpdb;
            if(!$baiduseo_wzt_log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);
                exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);
                exit;
            }
            if(!empty($keywords)){
                if($type==1){
                    foreach($keywords as $key=>$val){
                        $terms = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag" and a.name=%s',$val),ARRAY_A);
                        if(!$terms){
                            $res = $wpdb->insert($wpdb->prefix."terms",['name'=>$val]);
                            $id = $wpdb->insert_id;
                            $wpdb->update($wpdb->prefix . 'terms',['slug'=>$id],['term_id'=>$id]);
                            $wpdb->insert($wpdb->prefix."term_taxonomy",['term_id'=>$id,'taxonomy'=>'post_tag']);
                            $id_1 = $wpdb->insert_id;
                            $baiduseo_tag_manage = get_option('baiduseo_tag');
                            if($baiduseo_tag_manage){
                                if(isset($baiduseo_tag_manage['auto']) && $baiduseo_tag_manage['auto']){
                                    $article = $wpdb->get_results('select * from '.$wpdb->prefix . 'posts where  post_status="publish" and post_type="post" order by ID desc limit 1000',ARRAY_A);
                                    if(!isset($baiduseo_tag_manage['num']) || !$baiduseo_tag_manage['num'] || $baiduseo_tag_manage['num']==11){
                                        
                                        foreach($article as $k=>$v){
                                           if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                                 if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($val).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                {
                                                    $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                    $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                                    $count = $term_taxonomy[0]['count']+1;
                                                    $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                }
                                           }else{
                                                 if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($val).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                {
                                                    $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                    $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                                    $count = $term_taxonomy[0]['count']+1;
                                                    $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                }
                                           }
                                          
                                        }
                                    }else{
                                        foreach($article as $k=>$v){
                                            $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d' ,$v['ID']));
                                            if($shu>=$baiduseo_tag_manage['num']){
                                                break;
                                            }else{
                                                if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                                    if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($val).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                    {
                                                        $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                        $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                                
                                                        $count = $term_taxonomy[0]['count']+1;
                                                        $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                    }
                                                }else{
                                                    if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($val).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                    {
                                                        $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                        $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                                
                                                        $count = $term_taxonomy[0]['count']+1;
                                                        $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                    }
                                                }
                                                
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }elseif($type==2){
                    foreach($keywords as $key=>$val){
                        $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where keywords =%s ",$val),ARRAY_A);
                        if(empty($post1)){
                         $wpdb->insert($wpdb->prefix."baiduseo_neilian",['keywords'=>$val,'link'=>'/',]);
                        }
                    }
                }
            
            }
             echo json_encode(['msg'=>'导入成功','code'=>1]);
            exit;
        }
         echo json_encode(['msg'=>'导入失败','code'=>0]);
        exit;
       
    }
    public function baiduseo_add_tag(){
        set_time_limit(0);
        ini_set('memory_limit','-1');
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $keyword = sanitize_text_field($_POST['keyword']);
            $type = (int)$_POST['type'];
            global $baiduseo_wzt_log,$wpdb;
            if(!$baiduseo_wzt_log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);
                exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);
                exit;
            }
            if($type==1){
                $terms = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag" and a.name=%s',$keyword),ARRAY_A);
                if(!$terms){
                    $res = $wpdb->insert($wpdb->prefix."terms",['name'=>$keyword]);
                    $id = $wpdb->insert_id;
                    $wpdb->update($wpdb->prefix . 'terms',['slug'=>$id],['term_id'=>$id]);
                    $wpdb->insert($wpdb->prefix."term_taxonomy",['term_id'=>$id,'taxonomy'=>'post_tag']);
                    $id_1 = $wpdb->insert_id;
                    $baiduseo_tag_manage = get_option('baiduseo_tag');
                    if($baiduseo_tag_manage){
                        if(isset($baiduseo_tag_manage['auto']) && $baiduseo_tag_manage['auto']){
                            $article = $wpdb->get_results('select * from '.$wpdb->prefix . 'posts where  post_status="publish" and post_type="post" order by ID desc limit 1000',ARRAY_A);
                            if(!isset($baiduseo_tag_manage['num']) || !$baiduseo_tag_manage['num'] || $baiduseo_tag_manage['num']==11){
                                
                                foreach($article as $k=>$v){
                                    if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                          if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($keyword).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                        {
                                            $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                            $count = $term_taxonomy[0]['count']+1;
                                            $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                        }
                                    }else{
                                        if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($keyword).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                        {
                                            $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                            $count = $term_taxonomy[0]['count']+1;
                                            $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                        }
                                    }
                                }
                            }else{
                                foreach($article as $k=>$v){
                                    $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d' ,$v['ID']));
                                    if($shu>=$baiduseo_tag_manage['num']){
                                        break;
                                    }else{
                                        if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                            if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($keyword).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                            {
                                                $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                        
                                                $count = $term_taxonomy[0]['count']+1;
                                                $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                            }
                                        }else{
                                             if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($keyword).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                            {
                                                $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                        
                                                $count = $term_taxonomy[0]['count']+1;
                                                $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                            }
                                        }
                                       
                                    }
                                }
                            }
                        }
                    }
                }
            }elseif($type==2){
                 $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where keywords =%s ",$keyword),ARRAY_A);
                if(empty($post1)){
                 $wpdb->insert($wpdb->prefix."baiduseo_neilian",['keywords'=>$keyword,'link'=>'/',]);
                }
               
            }
            echo json_encode(['msg'=>'导入成功','code'=>1]);
                exit;
        }
        echo json_encode(['msg'=>'导入失败','code'=>0]);
                exit;
        
    }
    public function baiduseo_tag_add(){
        set_time_limit(0);
        ini_set('memory_limit','-1');
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            if(sanitize_textarea_field($_POST['content'])){
                global $baiduseo_wzt_log;
                if(!$baiduseo_wzt_log){
                      echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
                $log = baiduseo_zz::pay_money();
                if(!$log){
                     echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
                }
                $content = explode("\n",sanitize_textarea_field($_POST['content']));
               
                if(!empty($content)){
                    global $wpdb;
                    
                    foreach($content as $key=>$val){
                        $tag = explode(',',$val);
                        if(isset($tag[1])){
                            $res = $wpdb->insert($wpdb->prefix."baiduseo_neilian",['keywords'=>$tag[0],'link'=>$tag[1],]);
                        }else{
                            $terms = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag" and a.name=%s',$tag[0]),ARRAY_A);
                           
                            if(!$terms){
                                $res = $wpdb->insert($wpdb->prefix."terms",['name'=>$tag[0]]);
                                
                                 $id = $wpdb->insert_id;
                        
                                $wpdb->update($wpdb->prefix . 'terms',['slug'=>$id],['term_id'=>$id]);
                                $wpdb->insert($wpdb->prefix."term_taxonomy",['term_id'=>$id,'taxonomy'=>'post_tag']);
                            
                                $id_1 = $wpdb->insert_id;
                                $baiduseo_tag_manage = get_option('baiduseo_tag');
                                if($baiduseo_tag_manage){
                                    
                                    if(isset($baiduseo_tag_manage['auto']) && $baiduseo_tag_manage['auto']){
                                        $article = $wpdb->get_results('select * from '.$wpdb->prefix . 'posts where  post_status="publish" and post_type="post" order by ID desc limit 1000',ARRAY_A);
                                        if(!isset($baiduseo_tag_manage['num']) || !$baiduseo_tag_manage['num'] || $baiduseo_tag_manage['num']==11){
                                            
                                            foreach($article as $k=>$v){
                                               if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                                    if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($tag[0]).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                    {
                                                        $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                        $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                                        $count = $term_taxonomy[0]['count']+1;
                                                        $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                    }
                                               }else{
                                                   if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($tag[0]).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                    {
                                                        $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                        $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d' ,$id_1),ARRAY_A);
                                                        $count = $term_taxonomy[0]['count']+1;
                                                        $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                    }
                                               }
                                               
                                            }
                                        }else{
                                            foreach($article as $k=>$v){
                                                $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d' ,$v['ID']));
                                                if($shu>=$baiduseo_tag_manage['num']){
                                                    break;
                                                }else{
                                                    if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                                        if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($tag[0]).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                        {
                                                            $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                                    
                                                            $count = $term_taxonomy[0]['count']+1;
                                                            $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
                                                        }
                                                    }else{
                                                        if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($tag[0]).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',$v['post_content'],$matches))
                                                        {
                                                            $wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$v['ID'],'term_taxonomy_id'=>$id_1]);    
                                                            $term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d'  ,$id_1),ARRAY_A);
                                                                    
                                                            $count = $term_taxonomy[0]['count']+1;
                                                            $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$id_1]);
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
            }else{
                echo json_encode(['code'=>0,'msg'=>'请输入关键词']);exit;
            }
            echo json_encode(['code'=>1,'msg'=>'添加成功']);exit;
        }
        echo json_encode(['code'=>0,'msg'=>'添加失败']);exit;
    }
    public function baiduseo_rank(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            
            $baiduseo_rank = get_option('baiduseo_rank');
            $ur=  baiduseo_common::baiduseo_url(0);
            $url = 'https://www.rbzzz.com/api/rank/get_rank?url='.$ur.'&http='.get_option('siteurl');
            $defaults = array(
                'timeout' => 4000,
                'redirection' => 4000,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $result = wp_remote_get($url,$defaults);
            $result = wp_remote_retrieve_body($result);
            if($result){
                $result = json_decode($result,true);
                if($result['code']){
                    if($baiduseo_rank!==false){
                        update_option('baiduseo_rank',$result['data']);
                    }else{
                        add_option('baiduseo_rank',$result['data']);
                    }
                    echo json_encode(['code'=>1,'data'=>$result['data']]);exit;
                }else{
                    echo json_encode(['code'=>0,'msg'=>'24小时只能查询一次']);exit;
                }
            }else{
                echo json_encode(['code'=>0,'msg'=>'查询失败']);exit;
            }
            
            
        }
        echo json_encode(['code'=>0]);exit;
    }
    public function baiduseo_301(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $site_url = baiduseo_common::baiduseo_url(0).'/';
            $site_url1 = baiduseo_common::baiduseo_url(1);
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
            $url = str_replace('www.','',$site_url);
            
            $url1 = $http_type.$url;
            $url2 = $http_type.'www.'.$url;
            $url_301['status'] = 0;
            $result = wp_remote_get($url1,$defaults);
            if(!is_wp_error($result)){
              $http = (array)$result['http_response'];
              
              $url_301['re_url1'] = $http["\0*\0response"]->url;
            }else{
               $url_301['re_url1'] =''; 
            }
            $result1 = wp_remote_get($url2,$defaults);
            if(!is_wp_error($result1)){
              $http1 = (array)$result1['http_response'];
              
              
              $url_301['re_url2'] = $http1["\0*\0response"]->url;
            }else{
                $url_301['re_url2'] =''; 
            }
             if($url_301['re_url2'] && $url_301['re_url1'] && trim($url_301['re_url2'],'/')==trim($url_301['re_url1'],'/') && trim($url_301['re_url1'],'/')==trim($site_url1,'/')){
                echo json_encode(['msg'=>'恭喜您，您的301状态正常，无需设置！','code'=>1]);exit; 
            }else{
                echo json_encode(['code'=>0]);exit; 
            }
        
        }
        echo json_encode(['code'=>0]);exit; 
    }
    public function baiduseo_zhizhu_clear(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                  echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            global $wpdb;
            $res = $wpdb->query( "DELETE FROM " . $wpdb->prefix . "baiduseo_zhizhu  " );
            if($res){
            echo json_encode(['code'=>1]);exit; 
            }
        }
        echo json_encode(['msg'=>'删除失败','code'=>0]);exit;
    }
    public function baiduseo_zhizhu_linkdelete(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $id = (int)$_POST['id'];
           
            $res = $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zhizhu where id=%d",$id));
            echo json_encode(['code'=>1]);exit; 
        }
         echo json_encode(['code'=>0]);exit; 
    }
    public function baiduseo_tag(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                 echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            baiduseo_tag::baiduseo_tag_set($_POST);
            
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_kp(){
        global $wpdb;
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            if($wpdb->get_var("show tables like '{$wpdb->prefix}baiduseo_kp'") !=  $wpdb->prefix."baiduseo_kp"){
                echo json_encode(['code'=>0,'msg'=>'请先授权']);exit;
            }
            $data['keywords'] = sanitize_text_field($_POST['keywords']);
            if(!$data['keywords']){
                echo json_encode(['code'=>0,'msg'=>'请先授权']);exit;
            }
            $length = mb_strlen($data['keywords']);

           
                $url = 'https://www.rbzzz.com/api/kp/jifen?url='.baiduseo_common::baiduseo_url(0);
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $result = wp_remote_get($url,$defaults);
                if(!is_wp_error($result)){
                    $jifen = wp_remote_retrieve_body($result);
                    $jifen =$jifen?$jifen:0;
                }else{
                    $jifen = 0;
                }
                
                if($jifen>=150){
                    
                }else{
                     if($length<5){
                         echo json_encode(['code'=>0,'msg'=>'剩余积分不足150,不允许添加4个字及4个字以下的关键词！']);exit;
                       
                     }
                     if($jifen<10){
                         echo json_encode(['code'=>0,'msg'=>'剩余积分低于10积分,无法正常消费！']);exit;
                     }
                }
            
            $data['type'] = (int)$_POST['type'];
            $resu = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_kp where type=%d and keywords=%s',(int)$data['type'],$data['keywords']),ARRAY_A);
            if(!empty($resu) && $resu[0]['status']<=2){
                echo json_encode(['code'=>0,'msg'=>'关键词已添加,请不要重复添加']);exit;
               
            }
            $url = 'https://www.rbzzz.com/api/kp/keywords_add?url='.sanitize_text_field($_SERVER['SERVER_NAME']).'&keywords='.$data['keywords'].'&type='.$data['type'].'&http='.trim(get_option('siteurl')).'&url1='.baiduseo_common::baiduseo_url(0);
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                $content = wp_remote_retrieve_body($result);
                if($content){
                    if(!empty($resu) && $resu[0]['status']>2){
                        $wpdb->update($wpdb->prefix . 'baiduseo_kp',['status'=>1],['id'=>$resu[0]['id']]);
                    }else{
                        $res = $wpdb->insert($wpdb->prefix."baiduseo_kp",['keywords'=>$data['keywords'],'type'=>(int)$data['type'],'time'=>current_time( 'Y-m-d H:i:s'),'status'=>1]);
                    }
                    echo json_encode(['code'=>1,'msg'=>'关键词验证通过，已进入人工审核期！人工审核会在24小时内完成审核并进行优化']);exit;
                    
                }else{
                    echo json_encode(['code'=>0,'msg'=>'您提交的关键词经检验不适合快速优化原因:1.该关键词在网站不存在2.已收录的内容未匹配到该关键词3.网站质量过低，无法快速优化指定关键词。请您更换其他关键词进行尝试！']);exit;
                    
                }
            }else{
                echo json_encode(['code'=>0,'msg'=>'添加失败！']);exit;
                
            }
        }
        echo json_encode(['code'=>0,'msg'=>'添加失败！']);exit;
    }
    public function baiduseo_keywords(){
        global $wpdb;
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
           global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $keywords = sanitize_text_field($_POST['keywords']);
            
            if($keywords){
                $list = $wpdb->query(' select * from  '.$wpdb->prefix.'baiduseo_keywords where type="'.(int)$_POST['type'].'"');
                $defaults = array(
                    'timeout' => 4000,
                    'redirection' => 4000,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                if($list>9){
                    $url = 'http://wp.seohnzz.com/api/keywords/num';
                    $result = wp_remote_get($url,$defaults);
                    $content = wp_remote_retrieve_body($result);
                    if($list>$content-1){
                        echo json_encode(['msg'=>'超出关键词限制个数','code'=>0]);exit;
                        
                    }
                }
                $re = $wpdb->query($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_keywords where keywords=%s and type=%d',$keywords,(int)$_POST['type']));
                if($re>=1){
                    echo json_encode(['msg'=>'该关键词已添加','code'=>0]);exit;
                    
                }
                $currnetTime= current_time( 'Y/m/d H:i:s');
                $res = $wpdb->insert($wpdb->prefix."baiduseo_keywords",['post_time'=>$currnetTime,'keywords'=>$keywords,'type'=>(int)$_POST['type']]);
                if(!$res){
                    echo json_encode(['msg'=>'添加失败','code'=>0]);exit;
                    
                }
                $ids = $wpdb->get_results(' select * from  '.$wpdb->prefix.'baiduseo_keywords order by ID desc');
                $id = $ids[0]->id;
                $url = 'http://wp.seohnzz.com/api/keywords/log?url='.get_option('siteurl').'&keywords='.$keywords.'&type='.(int)$_POST['type'];
                $result = wp_remote_get($url,$defaults);
                if(is_wp_error($result)){
                    
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_keywords where id=  %d",$id));
                    echo json_encode(['msg'=>'添加失败','code'=>0]);exit;
                }
                $content = wp_remote_retrieve_body($result);
        
                if($content){
                    echo json_encode(['msg'=>'添加成功','code'=>1]);exit;
                }else{
                     
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_keywords where id=  %d",$id));
                    echo json_encode(['msg'=>'添加失败','code'=>0]);exit;
                }
            }else{
                echo json_encode(['msg'=>'请填写关键词','code'=>0]);exit;
                
            }
            
        }
        echo json_encode(['msg'=>'添加失败','code'=>0]);exit;
    }
    public function baiduseo_youhua(){
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $data = [
                'thumb'=>(int)$_POST['thumb'],
                'head_dy'=>(int)$_POST['head_dy'],
                'xml_rpc'=>(int)$_POST['xml_rpc'],
                'feed'=>(int)$_POST['feed'],
                'post_thumb'=>(int)$_POST['post_thumb'],
                'gravatar'=>(int)$_POST['gravatar'],
                'lan'=>(int)$_POST['lan'],
                'category'=>(int)$_POST['category'],
                'listbtn'=>(int)$_POST['listbtn']
            ];
            $baidu = get_option('baiduseo_youhua');
            if($baidu!==false){
                update_option('baiduseo_youhua',$data);
            }else{
                add_option('baiduseo_youhua',$data);
            }
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
        echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
    }
    public function baiduseo_zz(){
        global $wpdb,$baiduseo_wzt_log;
        
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            if(!$baiduseo_wzt_log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $log = baiduseo_zz::pay_money();
            if(!$log){
                echo json_encode(['msg'=>'请先授权','code'=>0]);exit;
            }
            $indexnow_key = sanitize_text_field($_POST['indexnow_key']);
            
            $seo_baidu_xzh =[                               
                'zz_link'=>sanitize_url($_POST['zz_link']),                                   
                'bing_key'=>sanitize_text_field($_POST['bing_key']), 
                'shenma_key' =>sanitize_url($_POST['shenma_key']),
                'toutiao_key'=>sanitize_text_field($_POST['toutiao_key']),
                'indexnow_key'=>$indexnow_key,
                'google_api'=>sanitize_textarea_field(stripslashes($_POST['google_api'])),
                'indexnow_pingtai'=>sanitize_text_field($_POST['indexnow_pingtai']),
                'post_type'=>sanitize_text_field($_POST['post_type']),
                'baiduseo_type'=>sanitize_text_field($_POST['baiduseo_type']),
                'post_type'=>sanitize_text_field($_POST['post_type']),
                'status'=>sanitize_text_field($_POST['status']),
                'pingtai'=>sanitize_text_field($_POST['pingtai']),
                'bdpt_num'=>(int)$_POST['bdpt_num'],
                'bing_num'=>(int)$_POST['bing_num'],
                'sm_num'=>(int)$_POST['sm_num'],
                'log'=>sanitize_text_field($_POST['log']),
                'bd_log'=>(int)$_POST['bd_log'],
                'bdks_log'=>(int)$_POST['bdks_log'],
                'bing_log'=>(int)$_POST['bing_log'],
                'shenma_log'=>(int)$_POST['shenma_log'],
                'indexNow_log'=>(int)$_POST['indexNow_log'],
                'guge_log'=>(int)$_POST['guge_log'],
                
            ];
            if($indexnow_key){
                WP_Filesystem();
                global $wp_filesystem;
                $res = $wp_filesystem->put_contents (ABSPATH.'/'.$indexnow_key.'.txt',$indexnow_key);
                
            }
            
            $baidu = get_option('baiduseo_zz');
            if($baidu!==false){
                update_option('baiduseo_zz',$seo_baidu_xzh);
            }else{
                add_option('baiduseo_zz',$seo_baidu_xzh);
            }
            echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
        }
        
         echo json_encode(['msg'=>'保存失败','code'=>0]);exit;
       
        
            
            
    }
    public function baiduseo_seo(){
        ini_set('memory_limit','-1');
        if(isset($_POST['nonce']) && isset($_POST['action']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
             global $baiduseo_wzt_log;
            if(!$baiduseo_wzt_log){
                 echo json_encode(['code'=>'0','msg'=>'请先授权']);exit;
            }
            $log = baiduseo_zz::pay_money();
            
            if(!$log){
                echo json_encode(['code'=>'0','msg'=>'请先授权']);exit;
            }
            baiduseo_seo::seo_index(sanitize_text_field($_POST['keywords']),sanitize_text_field($_POST['description']));
            baiduseo_seo::cate_seo(sanitize_text_field($_POST['cate_keywords']),sanitize_text_field($_POST['cate_description']),(int)$_POST['cate']);
            baiduseo_seo::page_seo(sanitize_text_field($_POST['page_keywords']),sanitize_text_field($_POST['page_description']),(int)$_POST['page']);
            if((int)$_POST['page_404']){
                baiduseo_seo::page_404();
            }else{
                $seo_301_404_url = get_option('seo_301_404_url');
                if($seo_301_404_url!=false){
                    update_option('seo_301_404_url',['404_url'=>0]);
                }else{
                    add_option('seo_301_404_url',['404_url'=>0]);
                }
            }
            if(isset($_POST['robots'])){
                baiduseo_seo::robots(sanitize_textarea_field($_POST['robots']));
            }
            
            $sitemap = get_option('seo_baidu_sitemap');
            if($sitemap!==false && !is_array($sitemap)){
                // $data = $sitemap;
                $data['level1'] = (int)$_POST['level1'];
                $data['level2'] = (int)$_POST['level2'];
                $data['level3'] = (int)$_POST['level3'];
                $data['level4'] = (int)$_POST['level4'];
                $data['level5'] = (int)$_POST['level5'];
                $data['type1'] = (int)$_POST['type1'];
                $data['type2'] = (int)$_POST['type2'];
                $data['type3'] = (int)$_POST['type3'];
                $data['type4'] = (int)$_POST['type4'];
                $data['type5'] = (int)$_POST['type5'];
                $data['page_time'] = sanitize_text_field($_POST['page_time']);
                $data['post_time'] = sanitize_text_field($_POST['post_time']);
                $data['tag_time'] = sanitize_text_field($_POST['tag_time']);
                $data['other_time'] = sanitize_text_field($_POST['other_time']);
                $data['cate_time'] = sanitize_text_field($_POST['cate_time']);
                $data['sitemap_open'] = (int)$_POST['sitemap_open'];
                $data['silian_open'] = (int)$_POST['silian_open'];
                $data['tag_open'] = (int)$_POST['tag_open'];
                update_option('seo_baidu_sitemap',$data);
            }elseif($sitemap!==false && is_array($sitemap)){
                $data = $sitemap;
                $data['level1'] = (int)$_POST['level1'];
                $data['level2'] = (int)$_POST['level2'];
                $data['level3'] = (int)$_POST['level3'];
                $data['level4'] = (int)$_POST['level4'];
                $data['level5'] = (int)$_POST['level5'];
                $data['type1'] = (int)$_POST['type1'];
                $data['type2'] = (int)$_POST['type2'];
                $data['type3'] = (int)$_POST['type3'];
                $data['type4'] = (int)$_POST['type4'];
                $data['type5'] = (int)$_POST['type5'];
                $data['page_time'] = sanitize_text_field($_POST['page_time']);
                $data['post_time'] = sanitize_text_field($_POST['post_time']);
                $data['tag_time'] = sanitize_text_field($_POST['tag_time']);
                $data['other_time'] = sanitize_text_field($_POST['other_time']);
                $data['cate_time'] = sanitize_text_field($_POST['cate_time']);
                $data['sitemap_open'] = (int)$_POST['sitemap_open'];
                $data['silian_open'] = (int)$_POST['silian_open'];
                $data['tag_open'] = (int)$_POST['tag_open'];
                update_option('seo_baidu_sitemap',$data);
            }else{
                $data['level1'] = (int)$_POST['level1'];
                $data['level2'] = (int)$_POST['level2'];
                $data['level3'] = (int)$_POST['level3'];
                $data['level4'] = (int)$_POST['level4'];
                $data['level5'] = (int)$_POST['level5'];
                $data['type1'] = (int)$_POST['type1'];
                $data['type2'] = (int)$_POST['type2'];
                $data['type3'] = (int)$_POST['type3'];
                $data['type4'] = (int)$_POST['type4'];
                $data['type5'] = (int)$_POST['type5'];
                $data['page_time'] = sanitize_text_field($_POST['page_time']);
                $data['post_time'] = sanitize_text_field($_POST['post_time']);
                $data['tag_time'] = sanitize_text_field($_POST['tag_time']);
                $data['other_time'] = sanitize_text_field($_POST['other_time']);
                $data['cate_time'] = sanitize_text_field($_POST['cate_time']);
                $data['sitemap_open'] = (int)$_POST['sitemap_open'];
                $data['silian_open'] = (int)$_POST['silian_open'];
                $data['tag_open'] = (int)$_POST['tag_open'];
                add_option('seo_baidu_sitemap',$data);  
            }
            baiduseo_seo::alt((int)$_POST['alt'],(int)$_POST['title']);
            if((int)$_POST['sitemap_open']==1){
            baiduseo_seo::sitemap(1,1,1);
            }
            if((int)$_POST['silian_open']==1){
                baiduseo_seo::silian(1,1);
            }
            echo json_encode(['msg'=>'','code'=>1]);exit;
        }else{
             echo json_encode(['msg'=>'','code'=>0]);exit;
        }
    }

    public function baiduseo_wycsc(){
        if(isset($_POST['nonce']) &&  wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            $id = (int)$_POST['id'];
            delete_post_meta($id,'baiduseo');
            echo json_encode(['code'=>'1','msg'=>'删除成功']);exit;
        }
        echo json_encode(['code'=>'0','msg'=>'删除失败']);exit;
    }
}