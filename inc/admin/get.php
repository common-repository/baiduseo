<?php
    class baiduseo_get{
        public function init(){
            add_action('wp_ajax_baiduseo_get_zhizhu', [$this,'zhizhu']);
            add_action('wp_ajax_baiduseo_zhizhu_tubiao', [$this,'baiduseo_zhizhu_tubiao']);
            add_action('wp_ajax_baiduseo_zhizhu_dangqian', [$this,'baiduseo_zhizhu_dangqian']);
            add_action('wp_ajax_baiduseo_get_zhizhu_con', [$this,'baiduseo_get_zhizhu_con']);
            add_action('wp_ajax_baiduseo_get_cate', [$this,'baiduseo_get_cate']);
            add_action('wp_ajax_baiduseo_get_page', [$this,'baiduseo_get_page']);
            add_action('wp_ajax_baiduseo_get_seo', [$this,'baiduseo_get_seo']);
            add_action('wp_ajax_baiduseo_get_cate_seo', [$this,'baiduseo_get_cate_seo']);
            add_action('wp_ajax_baiduseo_get_page_seo', [$this,'baiduseo_get_page_seo']);
            add_action('wp_ajax_baiduseo_get_wyc', [$this,'baiduseo_get_wyc']);
            add_action('wp_ajax_baiduseo_get_yuanchuang', [$this,'yuanchuang']);
            add_action('wp_ajax_baiduseo_get_zhigai_log', [$this,'zhigai_log']);
            add_action('wp_ajax_baiduseo_get_cate_type', [$this,'baiduseo_get_cate_type']);
            add_action('wp_ajax_baiduseo_get_zz', [$this,'baiduseo_get_zz']);
            add_action('wp_ajax_baiduseo_get_bbpt', [$this,'bbpt']);
            add_action('wp_ajax_baiduseo_get_bbks', [$this,'bbks']);
            add_action('wp_ajax_baiduseo_get_bing', [$this,'bing']);
            add_action('wp_ajax_baiduseo_get_indexnow', [$this,'indexnow']);
            add_action('wp_ajax_baiduseo_get_google', [$this,'baiduseo_get_google']);
            add_action('wp_ajax_baiduseo_get_shenma', [$this,'shenma']);
            add_action('wp_ajax_baiduseo_get_bdpe', [$this,'baiduseo_get_bdpe']);
            add_action('wp_ajax_baiduseo_get_bingpe', [$this,'baiduseo_get_bingpe']);
            add_action('wp_ajax_baiduseo_get_youhua', [$this,'baiduseo_get_youhua']);
            add_action('wp_ajax_baiduseo_get_quanzhong', [$this,'baiduseo_get_quanzhong']);
            add_action('wp_ajax_baiduseo_get_rank', [$this,'baiduseo_get_rank']);
            add_action('wp_ajax_baiduseo_get_keywords', [$this,'baiduseo_get_keywords']);
            add_action('wp_ajax_baiduseo_get_kp', [$this,'kp']);
            add_action('wp_ajax_baiduseo_get_kp_delete', [$this,'kp_delete']);
            add_action('wp_ajax_baiduseo_get_kp_log', [$this,'kp_log']);
            add_action('wp_ajax_baiduseo_get_kp_jifen', [$this,'baiduseo_get_kp_jifen']);
            add_action('wp_ajax_baiduseo_get_neilian', [$this,'neilian']);
            add_action('wp_ajax_baiduseo_get_tag', [$this,'baiduseo_get_tag']);
            add_action('wp_ajax_baiduseo_get_long', [$this,'baiduseo_get_long']);
            add_action('wp_ajax_baiduseo_get_friends_sz', [$this,'baiduseo_get_friends_sz']);
            add_action('wp_ajax_baiduseo_get_friends_open', [$this,'baiduseo_get_friends_open']);
            add_action('wp_ajax_baiduseo_get_friends_tongji', [$this,'baiduseo_get_friends_tongji']);
            add_action('wp_ajax_baiduseo_get_friends1', [$this,'friends1']);
            add_action('wp_ajax_baiduseo_get_friends2', [$this,'friends2']);
            add_action('wp_ajax_baiduseo_get_friends3', [$this,'friends3']);
            add_action('wp_ajax_baiduseo_get_titles', [$this,'baiduseo_get_titles']);
            add_action('wp_ajax_baiduseo_get_tongxun', [$this,'baiduseo_get_tongxun']);
            add_action('wp_ajax_baiduseo_get_liuliang', [$this,'baiduseo_get_liuliang']);
            add_action('wp_ajax_baiduseo_get_liuliang_pv', [$this,'baiduseo_get_liuliang_pv']);
            add_action('wp_ajax_baiduseo_get_liuliang_uv', [$this,'baiduseo_get_liuliang_uv']);
            add_action('wp_ajax_baiduseo_get_liuliang_ip', [$this,'baiduseo_get_liuliang_ip']);
            add_action('wp_ajax_baiduseo_get_liuliang_source', [$this,'baiduseo_get_liuliang_source']);
            add_action('wp_ajax_baiduseo_get_liuliang_sf', [$this,'baiduseo_get_liuliang_sf']);
            add_action('wp_ajax_baiduseo_get_liuliang_sl', [$this,'baiduseo_get_liuliang_sl']);
            add_action('wp_ajax_baiduseo_get_liuliang_list', [$this,'baiduseo_get_liuliang_list']);
            add_action('wp_ajax_baiduseo_get_vip', [$this,'baiduseo_get_vip']);
            add_action('wp_ajax_baiduseo_get_301', [$this,'baiduseo_get_301']);
            add_action('wp_ajax_baiduseo_get_key', [$this,'baiduseo_get_key']);
            add_action('wp_ajax_baiduseo_liuliang_ditu', [$this,'baiduseo_liuliang_ditu']);
            add_action('wp_ajax_baiduseo_get_zhizhu_tongji', [$this,'baiduseo_get_zhizhu_tongji']);
            add_action('wp_ajax_baiduseo_get_zhizhu_tongji_2', [$this,'baiduseo_get_zhizhu_tongji_2']);
            add_action('wp_ajax_baiduseo_get_pingfen', [$this,'baiduseo_get_pingfen']);
            add_action('wp_ajax_baiduseo_get_gonggao', [$this,'baiduseo_get_gonggao']);
            add_action('wp_ajax_baiduseo_gonggao_read', [$this,'baiduseo_gonggao_read']);
            add_action('wp_ajax_baiduseo_get_beian', [$this,'baiduseo_get_beian']);
        }
        public function baiduseo_get_beian(){
             if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                 $beian = get_option('baiduseo_beian');
                 echo wp_json_encode(['code'=>1,'data'=>$beian]);exit; 
             }
        }
        public function baiduseo_gonggao_read(){
             if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $res = $wpdb->insert($wpdb->prefix."baiduseo_gonggao",['gid'=>(int)$_POST['id']]);
             }
        }
        public function baiduseo_get_gonggao(){
             if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
             global $wpdb;
            $defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $page = (int)$_POST['page'];
            $url = 'https://www.rbzzz.com/api/rank/gonggao?type=1&page='.$page;
            $result = wp_remote_get($url,$defaults);
            if(!is_wp_error($result)){
                $result = wp_remote_retrieve_body($result);
                $result = json_decode($result,true);
                foreach($result['data'] as $k=>$v){
                    $re = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_gonggao where gid=%d ',$v['id']),ARRAY_A);
                    if($re){
                        $result['data'][$k]['is_read'] =1;
                    }else{
                        $result['data'][$k]['is_read'] =0;
                    }
                }
                echo wp_json_encode(['code'=>1,'data'=>$result['data'],'total'=>(int)$result['total']]);exit; 
            }else{
                echo wp_json_encode(['code'=>0]);exit;
            }
             }
        }
        public function baiduseo_get_pingfen(){
             if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $baiduseo_pingfen = get_option('baiduseo_pingfen');
                echo wp_json_encode(['code'=>1,'data'=>$baiduseo_pingfen?$baiduseo_pingfen:0]);exit;
            }
        }
        public  function baiduseo_get_zhizhu_tongji_2(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $sql = 'select * from '.$wpdb->prefix . 'baiduseo_zhizhu where type=200 order by num desc limit 20';
                $list = $wpdb->get_results($sql,ARRAY_A);
                foreach($list as $k=>$v){
                    $list[$k]['id'] = $k+1;
                }
                $sql1 = 'select  * from '.$wpdb->prefix . 'baiduseo_zhizhu where type=404 order by num desc limit 20';
                $list1 = $wpdb->get_results($sql1,ARRAY_A);
                foreach($list1 as $k=>$v){
                    $list1[$k]['id'] = $k+1;
                }
                echo wp_json_encode(['code'=>1,'data'=>$list,'data1'=>$list1]);exit;
            }
        }
        public function baiduseo_get_zhizhu_tongji(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $sql = 'select sum(num) as nums from '.$wpdb->prefix . 'baiduseo_zhizhu where type=200';
                $list = $wpdb->get_results($sql,ARRAY_A);
                $sql1 = 'select sum(num) as nums from '.$wpdb->prefix . 'baiduseo_zhizhu where type=404';
                $list1 = $wpdb->get_results($sql1,ARRAY_A);
                echo wp_json_encode(['code'=>1,'data'=>[['value'=>isset($list[0]['nums'])&& $list[0]['nums']?$list[0]['nums']:0,'name'=>200,'itemStyle'=>['color'=>'#009688']],['value'=>isset($list1[0]['nums'])&& $list1[0]['nums']?$list1[0]['nums']:0,'name'=>404,'itemStyle'=>['color'=>'#005796']]]]);exit;
            }
        }
        public function baiduseo_liuliang_ditu(){
             if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $arr = [];
                $count = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang',ARRAY_A);
               
                if(!$count){
                    $count =1;
                }
                $n = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="河南省"',ARRAY_A);
                $n1 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="香港"',ARRAY_A);
                $n2 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="黑龙江省"',ARRAY_A);
                $n3 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="吉林省"',ARRAY_A);
                $n4 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="辽宁省"',ARRAY_A);
                $n5 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="内蒙古"',ARRAY_A);
                $n6 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="新疆"',ARRAY_A);
                $n7 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="青海省"',ARRAY_A);
                $n8 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="甘肃省"',ARRAY_A);
                $n9 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="宁夏"',ARRAY_A);
                $n10 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="山西省"',ARRAY_A);
                $n11 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="河北省"',ARRAY_A);
                $n12 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="北京"',ARRAY_A);
                $n13 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="天津"',ARRAY_A);
                $n14 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="山东省"',ARRAY_A);
                $n15 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="陕西省"',ARRAY_A);
                $n16 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="江苏省"',ARRAY_A);
                $n17 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="西藏"',ARRAY_A);
                $n18 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="四川省"',ARRAY_A);
                $n19 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="湖北省"',ARRAY_A);
                $n20 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="安徽省"',ARRAY_A);
                $n21 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="上海"',ARRAY_A);
                $n22 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="浙江省"',ARRAY_A);
                $n23 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="福建省"',ARRAY_A);
                $n24 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="台湾省"',ARRAY_A);
                $n25 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="江西省"',ARRAY_A);
                $n26 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="湖南省"',ARRAY_A);
                $n27 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="广东省"',ARRAY_A);
                $n28 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="广西"',ARRAY_A);
                $n29 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="贵州省"',ARRAY_A);
                $n30 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="海南省"',ARRAY_A);
                $n31 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="重庆"',ARRAY_A);
                $n32 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="云南省"',ARRAY_A);
                $n33 = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_liuliang where sheng="澳门"',ARRAY_A);
               
                $arr =[
                    [
                        'sheng'=>'河南',
                        'num'=>$n,
                        'zhanbi'=>round($n*100/$count,2),
                    ],
                    [
                        'sheng'=>'香港',
                        'num'=>$n1,
                        'zhanbi'=>round($n1*100/$count,2),
                    ],
                    [
                        'sheng'=>'黑龙江',
                        'num'=>$n2,
                        'zhanbi'=>round($n2*100/$count,2),
                    ],
                    [
                        'sheng'=>'吉林',
                        'num'=>$n3,
                        'zhanbi'=>round($n3*100/$count,2),
                    ],
                    [
                        'sheng'=>'辽宁',
                        'num'=>$n4,
                        'zhanbi'=>round($n4*100/$count,2),
                    ],
                    [
                        'sheng'=>'内蒙古',
                        'num'=>$n5,
                        'zhanbi'=>round($n5*100/$count,2),
                    ],
                    [
                        'sheng'=>'新疆',
                        'num'=>$n6,
                        'zhanbi'=>round($n6*100/$count,2),
                    ],
                    [
                        'sheng'=>'青海',
                        'num'=>$n7,
                        'zhanbi'=>round($n7*100/$count,2),
                    ],
                    [
                        'sheng'=>'甘肃',
                        'num'=>$n8,
                        'zhanbi'=>round($n8*100/$count,2),
                    ],
                    [
                        'sheng'=>'宁夏',
                        'num'=>$n9,
                        'zhanbi'=>round($n9*100/$count,2),
                    ],
                    [
                        'sheng'=>'山西',
                        'num'=>$n10,
                        'zhanbi'=>round($n10*100/$count,2),
                    ],
                    [
                        'sheng'=>'河北',
                        'num'=>$n11,
                        'zhanbi'=>round($n11*100/$count,2),
                    ],
                    [
                        'sheng'=>'北京',
                        'num'=>$n12,
                        'zhanbi'=>round($n12*100/$count,2),
                    ],
                    [
                        'sheng'=>'天津',
                        'num'=>$n13,
                        'zhanbi'=>round($n13*100/$count,2),
                    ],
                    [
                        'sheng'=>'山东',
                        'num'=>$n14,
                        'zhanbi'=>round($n14*100/$count,2),
                    ],
                    [
                        'sheng'=>'陕西',
                        'num'=>$n15,
                        'zhanbi'=>round($n15*100/$count,2),
                    ],
                    [
                        'sheng'=>'江苏',
                        'num'=>$n16,
                        'zhanbi'=>round($n16*100/$count,2),
                    ],
                    [
                        'sheng'=>'西藏',
                        'num'=>$n17,
                        'zhanbi'=>round($n17*100/$count,2),
                    ],
                    [
                        'sheng'=>'四川',
                        'num'=>$n18,
                        'zhanbi'=>round($n18*100/$count,2),
                    ],
                    [
                        'sheng'=>'湖北',
                        'num'=>$n19,
                        'zhanbi'=>round($n19*100/$count,2),
                    ],
                    [
                        'sheng'=>'安徽',
                        'num'=>$n20,
                        'zhanbi'=>round($n20*100/$count,2),
                    ],
                    [
                        'sheng'=>'上海',
                        'num'=>$n21,
                        'zhanbi'=>round($n21*100/$count,2),
                    ],
                    [
                        'sheng'=>'浙江',
                        'num'=>$n22,
                        'zhanbi'=>round($n22*100/$count,2),
                    ],
                    [
                        'sheng'=>'福建',
                        'num'=>$n23,
                        'zhanbi'=>round($n23*100/$count,2),
                    ],
                     [
                        'sheng'=>'台湾',
                        'num'=>$n24,
                        'zhanbi'=>round($n24*100/$count,2),
                    ],
                     [
                        'sheng'=>'江西',
                        'num'=>$n25,
                        'zhanbi'=>round($n25*100/$count,2),
                    ],
                     [
                        'sheng'=>'湖南',
                        'num'=>$n26,
                        'zhanbi'=>round($n26*100/$count,2),
                    ],
                     [
                        'sheng'=>'广东',
                        'num'=>$n27,
                        'zhanbi'=>round($n27*100/$count,2),
                    ],
                     [
                        'sheng'=>'广西',
                        'num'=>$n28,
                        'zhanbi'=>round($n28*100/$count,2),
                    ],
                     [
                        'sheng'=>'贵州',
                        'num'=>$n29,
                        'zhanbi'=>round($n29*100/$count,2),
                    ],
                     [
                        'sheng'=>'海南',
                        'num'=>$n30,
                        'zhanbi'=>round($n30*100/$count,2),
                    ],
                     [
                        'sheng'=>'重庆',
                        'num'=>$n31,
                        'zhanbi'=>round($n31*100/$count,2),
                    ],
                     [
                        'sheng'=>'云南',
                        'num'=>$n32,
                        'zhanbi'=>round($n32*100/$count,2),
                    ],
                    [
                        'sheng'=>'澳门',
                        'num'=>$n33,
                        'zhanbi'=>round($n33*100/$count,2),
                    ],
                    [
                        'sheng'=>'其它（含国外）',
                        'num'=>$count-$n-$n1-$n2-$n3-$n4-$n5-$n6-$n7-$n8-$n9-$n10-$n11-$n12-$n13-$n14-$n15-$n16-$n17-$n18-$n19-$n20-$n21-$n22-$n23-$n24-$n25-$n26-$n27-$n28-$n29-$n30-$n31-$n32-$n33,
                        'zhanbi'=>round(($count-$n-$n1-$n2-$n3-$n4-$n5-$n6-$n7-$n8-$n9-$n10-$n11-$n12-$n13-$n14-$n15-$n16-$n17-$n18-$n19-$n20-$n21-$n22-$n23-$n24-$n25-$n26-$n27-$n28-$n29-$n30-$n31-$n32-$n33)*100/$count,2),
                    ],
                    
                ];
                if($count==1){
                    echo wp_json_encode(['code'=>1,'data'=>$arr]);exit;
                }else{
                    $paytime = array();
                    foreach ($arr as $v) {
                        $paytime[] = $v['num'];
                    }
                    array_multisort($paytime, SORT_DESC, $arr);
                    echo wp_json_encode(['code'=>1,'data'=>$arr]);exit;
                }
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_key(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $baiduseo_wzt_log = get_option('baiduseo_wzt_log');
                echo wp_json_encode(['code'=>1,'data'=>$baiduseo_wzt_log]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_301(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $url_301['url'] = baiduseo_common::baiduseo_url(0).'/';
                $site_url1 = baiduseo_common::baiduseo_url(1);
                $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                $url = str_replace('www.','', $url_301['url']);
                
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
                echo wp_json_encode(['code'=>1,'data'=>$url_301]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_vip(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                 $defaults = array(
                    'timeout' => 4000,
                    'connecttimeout'=>4000,
                    'redirection' => 3,
                    'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                    'sslverify' => FALSE,
                );
                $baiduseo_level = get_option('baiduseo_level');
                if(!isset($baiduseo_level[2]) || $baiduseo_level[2]<time()-24*3600){
                    $url = 'https://www.rbzzz.com/api/money/level1?url='.baiduseo_common::baiduseo_url(0);
                    $result = wp_remote_get($url,$defaults);
                    if(!is_wp_error($result)){
                        $level = wp_remote_retrieve_body($result);
                        $level = json_decode($level,true);
                        
                        $level1 = explode(',',$level['level']);
                        $level2 = $level1;
                        if(isset($level1[0]) && ($level1[0]==1 || $level1[0]==2)){
                            $level2[2] = time();
                            $level2[3] = $level['version'];
                            update_option('baiduseo_level',$level2);
                            $baiduseo_wzt_log = get_option('baiduseo_wzt_log');
                        }
                    }
                }else{
                    $level1 = $baiduseo_level;
                    $level = [];
                    $level['version'] = $baiduseo_level[3];
                    if(isset($level1[0]) && ($level1[0]==1 || $level1[0]==2)){
                        $baiduseo_wzt_log = get_option('baiduseo_wzt_log');
                    }
                }
                $level1[2] = $level['version'];
                $data['level'] = $level1;
                echo wp_json_encode(['code'=>1,'data'=>$data]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_liuliang_list(){
             ini_set('memory_limit','500M');
             if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $where = [];
                $con = [];
                $sql ='select * from '.$wpdb->prefix . 'baiduseo_liuliang where status=1';
                if((int)$_POST['fangke']==1){
                    $sql .= '  and is_new=1';
                    
                }elseif((int)$_POST['fangke']==2){
                    $sql .= '  and is_new=0';
                }
                if((int)$_POST['pinci']==1){
                    $sql .= '  and pinci=1';
                }elseif((int)$_POST['pinci']==2){
                     $sql .= '  and pinci=2';
                }elseif((int)$_POST['pinci']==3){
                    $sql .= '  and pinci=3';
                }elseif((int)$_POST['pinci']==4){
                    $sql .= '  and pinci=4';
                }elseif((int)$_POST['pinci']==5){
                     $sql .= '  and pinci>=5 and pinci<=10';
                }elseif((int)$_POST['pinci']==6){
                    $sql .= '  and pinci>=11 and pinci<=20';
                }elseif((int)$_POST['pinci']==7){
                    $sql .= '  and pinci>20';
                }
                if((int)$_POST['shendu']==1){
                    $sql .= ' and shendu=1';
                }elseif((int)$_POST['shendu']==2){
                    $sql .= ' and shendu=2';
                }elseif((int)$_POST['shendu']==3){
                    $sql .= ' and shendu=3';
                }elseif((int)$_POST['shendu']==4){
                    $sql .= ' and shendu=4';
                }elseif((int)$_POST['shendu']==5){
                    $sql .= ' and shendu>=5 and shendu<=10';
                }elseif((int)$_POST['shendu']==6){
                    $sql .= ' and shendu>=11 and shendu<=20';
                }elseif((int)$_POST['shendu']==7){
                    $sql .= ' and shendu>20';
                }
                if((int)$_POST['shichang']==1){
                    $sql .= ' and shichang<=30';
                }elseif((int)$_POST['shichang']==2){
                    $sql .= ' and shichang>30 and shichang<=60';
                }elseif((int)$_POST['shichang']==3){
                    $sql .= ' and shichang>60 and shichang<=90';
                }elseif((int)$_POST['shichang']==4){
                    $sql .= ' and shichang>90 and shichang<=180';
                }elseif((int)$_POST['shichang']==5){
                    $sql .= ' and shichang>180 and shichang<=300';
                }elseif((int)$_POST['shichang']==6){
                    $sql .= ' and shichang>300 and shichang<=600';
                }elseif((int)$_POST['shichang']==7){
                    $sql .= ' and shichang>600';
                }
                if(sanitize_text_field($_POST['time'])){
                    $timezone_offet = get_option( 'gmt_offset');
                    $sta1 = strtotime($_POST['time']);
                    $end1 = strtotime($_POST['time'])+24*3600;
                    $sql .=' and unix_timestamp(time)>%d and  unix_timestamp(time)<%d';
                    $con = [$sta1,$end1];
                }
                if(sanitize_text_field($_POST['rukou'])){
                    $sql .= ' and url=%s';
                    $con[] = sanitize_text_field($_POST['rukou']);
                }
                if(sanitize_text_field($_POST['ip'])){
                    $sql .= ' and ip=%s';
                    $con[] = sanitize_text_field($_POST['ip']);
                }
                if(sanitize_text_field($_POST['session'])){
                    $sql .= ' and session=%s';
                    $con[] = sanitize_text_field($_POST['session']);
                }
                
                if((int)$_POST['source']==1){
                    $sql .= '  and source="直接访问"';
                }elseif((int)$_POST['source']==2){
                    $sql .= '  and source<>"直接访问"';
                }
                if((int)$_POST['type']==1){
                    $sql .= ' and type=1';
                }elseif((int)$_POST['type']==2){
                    $sql .= ' and type=2';
                }
                if(isset($group) && $group){
                    $sql .=$group;
                }
                $page = isset($_POST['page'])?$_POST['page']:1;
                $start = ($page-1)*50;
                $con1 = $con;
                $con[] = $start;
                $sql1 = $sql;
                $sql .= ' order by id desc limit %d,50 ';
                if(empty($con1)){
                    $count = $wpdb->query($sql1,ARRAY_A);
                }else{
                    $count = $wpdb->query($wpdb->prepare($sql1,array_values($con1)),ARRAY_A);
                }
                // var_dump($wpdb->prepare($sql,array_values($con)));exit;
                $list = $wpdb->get_results($wpdb->prepare($sql,array_values($con)),ARRAY_A);
                
                if(!empty($list)){
                    foreach($list as $key=>$val){
                        $newlao = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_liuliang where session=%s and status=1 and  id<%d  order by  id desc limit 1',$val['session'],$val['id']),ARRAY_A);
                        if(!empty($newlao)){
                            $list[$key]['news'] =1;
                            $list[$key]['shang'] = $newlao[0]['time'];
                        }else{
                            $list[$key]['news'] =0;
                        }
                        
                        $list[$key]['lujing']= $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_liuliang where pid=%d',$val['id']),ARRAY_A);
                        $total_page = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_liuliang where pid=%d',$val['id']),ARRAY_A);
                        $list[$key]['totalpage'] = $total_page+1;
                        
                        if($val['updatetime']){
                            $totaltime = strtotime($val['updatetime'])-strtotime($val['time']);
                        }else{
                            $totaltime = 1;
                        }
                        
                        if(!empty($list[$key]['lujing'])){
                            foreach($list[$key]['lujing'] as $k=>$v){
                                if($v['shichang']){
                                    $totaltime+=$v['shichang'];
                                }else{
                                    if($v['updatetime']){
                                        $totaltime += strtotime($v['updatetime'])-strtotime($v['time']);
                                        $list[$key]['lujing'][$k]['shichang'] =  strtotime($v['updatetime'])-strtotime($v['time']);
                                        
                                    }else{
                                        $totaltime += 1;
                                        $list[$key]['lujing'][$k]['shichang'] =  1;
                                    }
                                }
                                $list[$key]['lujing'][$k]['opentime'] = substr($v['time'],11,8);
                            }
                            $list[$key]['end'] = $v['url'];
                        }else{
                            $list[$key]['end'] = $val['url'];
                        }
                        if($val['shichang']){
                            
                        }else{
                            $list[$key]['shichang'] = $totaltime;
                        }
                        
                    }
                }
                 echo wp_json_encode(['code'=>1,'data'=>$list,'count'=>$count,'pagesize'=>50,'total'=>ceil($count/50)]);exit;
                
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_liuliang_sl(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $res = $wpdb->get_results('select *,count(id) as a from '.$wpdb->prefix . 'baiduseo_liuliang where status=1  group by session having a>1',ARRAY_A);
                 $res2 = $wpdb->query('select *,count(id) as a from '.$wpdb->prefix . 'baiduseo_liuliang where status=1  group by session having a>1',ARRAY_A);
                $count1 = 0;
                $count2 = 0;
                foreach($res as $key=>$val){
                    $count1 +=$val['a'];
                }
                $res1 = $wpdb->get_results('select *,count(id) as a from '.$wpdb->prefix . 'baiduseo_liuliang where status=1  group by session having a=1',ARRAY_A);
                $res3 = $wpdb->query('select *,count(id) as a from '.$wpdb->prefix . 'baiduseo_liuliang where status=1  group by session having a=1',ARRAY_A);
                foreach($res1 as $key=>$val){
                    $count2 +=$val['a'];
                }
                echo wp_json_encode(['code'=>1,'data'=>$res2?$res2:0,'data1'=>$res3?$res3:0,'data2'=>$count1,'data3'=>$count2]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_liuliang_sf(){
             if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                 $res = $wpdb->get_results('select *,count(id) as a from '.$wpdb->prefix . 'baiduseo_liuliang  group by url order by a desc limit 10',ARRAY_A);
                 $count = 0;
                 foreach($res as $key=>$val){
                    $count +=$val['a'];
                 }
                 
                  foreach($res as $key=>$val){
                    $res[$key]['zhanbi'] =round($val['a']*100/$count,2).'%';
                    $res[$key]['rank'] = $key+1;
                 }
                  echo wp_json_encode(['code'=>1,'data'=>$res]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_liuliang_source(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                 $res = $wpdb->get_results('select *,count(id) as a from '.$wpdb->prefix . 'baiduseo_liuliang group by source order by a desc limit 10',ARRAY_A);
                
                 $count = 0;
                 foreach($res as $key=>$val){
                    $count +=$val['a'];
                 }
                 
                  foreach($res as $key=>$val){
                    $res[$key]['zhanbi'] =round($val['a']*100/$count,2).'%';
                    $res[$key]['rank'] = $key+1;
                 }
                  echo wp_json_encode(['code'=>1,'data'=>$res]);exit;
            }
             echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_liuliang_ip(){
            global $wpdb;
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $type = (int)$_POST['type'];
                if($type==1){
                    $timezone_offet = get_option( 'gmt_offset');
                    $arr1 = [];
                    $arr2 = [];
                    $arr3 = [];
                    for($i=0;$i<=23;$i++){
                        if($i>=10){
                            $j=$i+1;
                            $sta1 = strtotime(current_time('Y-m-d '.$i.':00'));
                            $end1 = strtotime(current_time('Y-m-d '.$j.':00'));
                            $sta2 = $sta1-24*3600;
                            $end2 = $end1-24*3600;
                            $sta3 = $sta1-24*3600*2;
                            $end3 = $end1-24*3600*2;
                        }else{
                            $j=$i+1;
                            
                            $sta1 = strtotime(current_time('Y-m-d 0'.$i.':00'));
                            $sta2 = $sta1-24*3600;
                            $sta3 = $sta1-24*3600*2;
                            if($j==10){
                                $end1 = strtotime(current_time('Y-m-d 10:00'));
                                $end2 = $end1-24*3600;
                                $end3 = $end1-24*3600*2;
                            }else{
                                $end1 = strtotime(current_time('Y-m-d 0'.$j.':00'));
                                $end2 = $end1-24*3600;
                                $end3 = $end1-24*3600*2;
                            }
                        }
                        $arr1[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip ',$sta1,$end1));
                        $arr2[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta2,$end2));
                        $arr3[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta3,$end3));
                    }
                    $sta4 = strtotime(current_time('Y-m-d'));
                    $sta5 = $sta4-24*3600;
                    $sta6 = $sta4-24*3600*2;
                    $end4 = strtotime(current_time('Y-m-d 23:59:59'));
                    $end5 = $end4-24*3600;
                    $end6 = $end4-24*3600*2;
                    $arr4 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta4,$end4));
                    $arr5 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta5,$end5));
                    $arr6 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta6,$end6));
                    $data5['series'] = [
                        [
                            'name'=>'今天',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr1
                        ],
                        [
                            'name'=>'昨天',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr2    
                        ],
                        [
                            'name'=>'前天',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr3    
                        ],
                    ];
                    $data5['xdata'] = ['0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23'];
                   echo wp_json_encode(['code'=>1,'data1'=>$data5,'data2'=>$arr4,'data3'=>$arr5,'data4'=>$arr6]);exit;
                }elseif($type==2){
                    //获取周
                    $timezone_offet = get_option( 'gmt_offset');
                    $arr1 = [];
                    $arr2 = [];
                    $arr3 = [];
                    $n = current_time('N');
                    for($i=1;$i<=7;$i++){
                       
                         $sta1 = strtotime(current_time('Y-m-d'))-($n-$i)*24*3600;
                        $sta2 = $sta1-24*3600*7;
                        $sta3 = $sta1-24*3600*14;
                        $end1 = $sta1+24*3600;
                        $end2 = $sta2+24*3600;
                        $end3 = $sta3+24*3600;
                        $arr1[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta1,$end1));
                        $arr2[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta2,$end2));
                        $arr3[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta3,$end3));
                    }
                    $sta4 = strtotime(current_time('Y-m-d'))-($n-1)*24*3600;
                    $sta5 = $sta4-24*3600*7;
                    $sta6 = $sta4-24*3600*14;
                    $end4 = $sta4+24*3600*7;
                    $end5 = $sta5+24*3600*7;
                    $end6 = $sta6+24*3600*7;
                    $arr4 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta4,$end4));
                    $arr5 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta5,$end5));
                    $arr6 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta6,$end6));
                    $data5['series'] = [
                        [
                            'name'=>'本周',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr1
                        ],
                        [
                            'name'=>'上周',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr2    
                        ],
                        [
                            'name'=>'上上周',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr3    
                        ],
                    ];
                    $data5['xdata'] = ['1','2','3','4','5','6','7'];
                    echo wp_json_encode(['code'=>1,'data1'=>$data5,'data2'=>$arr4,'data3'=>$arr5,'data4'=>$arr6]);exit;
                }elseif($type==3){
                    //获取月份
                    $m = current_time('m');
                    $n = current_time('n');
                    $year = current_time('Y');
                    $month_31 = ['01','03','05','07','08','10','12'];
                    $month_30 = ['04','06','09','11'];
                    if($n==1){
                        $num1 = 31;
                        $num2 =30;
                    }else{
                        $n= $n-1;
                        if($n<10){
                            $n = '0'.$n;
                            
                        }
                        if($n=='02'){
                            if($year%4==0){
                                $num1 = 29;
                            }else{
                                $num1  = 28;
                            }
                            $num2 =31;
                             
                        }elseif(in_array($n,$month_31)){
                            $num1  = 31;
                            if($n==8){
                                $num2 =31;
                            }else{
                                $num2 =30;
                            }
                        }elseif(in_array($n,$month_30)){
                           $num1  = 30;
                           $num2 =31;
                        }
                    }
                    $d = current_time('j');
                   
                    if($m=='02'){
                        if($year%4==0){
                            $num = 29;
                        }else{
                            $num  = 28;
                        }
                         
                    }elseif(in_array($m,$month_31)){
                        $num  = 31;
                    }elseif(in_array($m,$month_30)){
                       $num  = 30;
                    }
                    $timezone_offet = get_option( 'gmt_offset');
                    $arr1 = [];
                    $arr2 = [];
                    $arr3 = [];
                    for($i=1;$i<=31;$i++){
                        $sta1 = strtotime(current_time('Y-m-'.$i));
                        $end1 = $sta1+24*3600;
                        $sta2 = $sta1-24*3600*($num1+$d);
                        $end2 = $sta2+24*3600;
                        $sta3 = $sta1-24*3600*($num1+$d+$num2);
                        $end3 = $sta3+24*3600;
                        $arr1[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta1,$end1));
                        $arr2[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta2,$end2));
                        $arr3[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta3,$end3));
                    }
                    $sta4 = strtotime(current_time('Y-m-01'));
                    $sta5 = $sta4-24*3600*$num1;
                    $sta6 = $sta4-24*3600*($num1+$num2);
                    $end4 = $sta4+24*3600*$num;
                    $end5 = $sta4;
                    $end6 = $sta5;
                    $arr4 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta4,$end4));
                    $arr5 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta5,$end5));
                    $arr6 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by ip',$sta6,$end6));
                    $data5['series'] = [
                        [
                            'name'=>'本月',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr1
                        ],
                        [
                            'name'=>'上月',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr2    
                        ],
                        [
                            'name'=>'上上月',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr3    
                        ],
                    ];
                    $data5['xdata'] = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
                    echo wp_json_encode(['code'=>1,'data1'=>$data5,'data2'=>$arr4,'data3'=>$arr5,'data4'=>$arr6]);exit;
                }
                
                
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_liuliang_uv(){
            global $wpdb;
             if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $type = (int)$_POST['type'];
                if($type==1){
                    $timezone_offet = get_option( 'gmt_offset');
                    $arr1 = [];
                    $arr2 = [];
                    $arr3 = [];
                    for($i=0;$i<=23;$i++){
                         if($i>=10){
                            $j=$i+1;
                            $sta1 = strtotime(current_time('Y-m-d '.$i.':00'));
                            $end1 = strtotime(current_time('Y-m-d '.$j.':00'));
                            $sta2 = $sta1-24*3600;
                            $end2 = $end1-24*3600;
                            $sta3 = $sta1-24*3600*2;
                            $end3 = $end1-24*3600*2;
                        }else{
                            $j=$i+1;
                            
                            $sta1 = strtotime(current_time('Y-m-d 0'.$i.':00'));
                            $sta2 = $sta1-24*3600;
                            $sta3 = $sta1-24*3600*2;
                            if($j==10){
                                $end1 = strtotime(current_time('Y-m-d 10:00'));
                                $end2 = $end1-24*3600;
                                $end3 = $end1-24*3600*2;
                            }else{
                                $end1 = strtotime(current_time('Y-m-d 0'.$j.':00'));
                                $end2 = $end1-24*3600;
                                $end3 = $end1-24*3600*2;
                            }
                        }
                        $arr1[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session ',$sta1,$end1));
                        $arr2[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta2,$end2));
                        $arr3[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta3,$end3));
                    }
                    $sta4 = strtotime(current_time('Y-m-d'));
                    $sta5 = $sta4-24*3600;
                    $sta6 = $sta4-24*3600*2;
                    $end4 = strtotime(current_time('Y-m-d 23:59:59'));
                    $end5 = $end4-24*3600;
                    $end6 = $end4-24*3600*2;
                    $arr4 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta4,$end4));
                    $arr5 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta5,$end5));
                    $arr6 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta6,$end6));
                    $data5['series'] = [
                        [
                            'name'=>'今天',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr1
                        ],
                        [
                            'name'=>'昨天',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr2    
                        ],
                        [
                            'name'=>'前天',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr3    
                        ],
                    ];
                    $data5['xdata'] = ['0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23'];
                   echo wp_json_encode(['code'=>1,'data1'=>$data5,'data2'=>$arr4,'data3'=>$arr5,'data4'=>$arr6]);exit;
                }elseif($type==2){
                    //获取周
                    $timezone_offet = get_option( 'gmt_offset');
                    $arr1 = [];
                    $arr2 = [];
                    $arr3 = [];
                    $n = current_time('N');
                    for($i=1;$i<=7;$i++){
                        $j=$i+1;
                       $sta1 = strtotime(current_time('Y-m-d'))-($n-$i)*24*3600;
                        $sta2 = $sta1-24*3600*7;
                        $sta3 = $sta1-24*3600*14;
                        $end1 = $sta1+24*3600;
                        $end2 = $sta2+24*3600;
                        $end3 = $sta3+24*3600;
                        $arr1[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta1,$end1));
                        $arr2[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta2,$end2));
                        $arr3[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta3,$end3));
                    }
                     $sta4 = strtotime(current_time('Y-m-d'))-($n-1)*24*3600;
                    $sta5 = $sta4-24*3600*7;
                    $sta6 = $sta4-24*3600*14;
                    $end4 = $sta4+24*3600*7;
                    $end5 = $sta5+24*3600*7;
                    $end6 = $sta6+24*3600*7;
                    $arr4 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta4,$end4));
                    $arr5 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta5,$end5));
                    $arr6 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta6,$end6));
                    $data5['series'] = [
                        [
                            'name'=>'本周',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr1
                        ],
                        [
                            'name'=>'上周',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr2    
                        ],
                        [
                            'name'=>'上上周',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr3    
                        ],
                    ];
                    $data5['xdata'] = ['1','2','3','4','5','6','7'];
                    echo wp_json_encode(['code'=>1,'data1'=>$data5,'data2'=>$arr4,'data3'=>$arr5,'data4'=>$arr6]);exit;
                }elseif($type==3){
                    //获取月份
                    $m = current_time('m');
                    $n = current_time('n');
                    $year = current_time('Y');
                    $month_31 = ['01','03','05','07','08','10','12'];
                    $month_30 = ['04','06','09','11'];
                    if($n==1){
                        $num1 = 31;
                        $num2 =30;
                    }else{
                        $n= $n-1;
                        if($n<10){
                            $n = '0'.$n;
                            
                        }
                        if($n=='02'){
                            if($year%4==0){
                                $num1 = 29;
                            }else{
                                $num1  = 28;
                            }
                            $num2 =31;
                             
                        }elseif(in_array($n,$month_31)){
                            $num1  = 31;
                            if($n==8){
                                $num2 =31;
                            }else{
                                $num2 =30;
                            }
                        }elseif(in_array($n,$month_30)){
                           $num1  = 30;
                           $num2 =31;
                        }
                    }
                    $d = current_time('j');
                   
                    if($m=='02'){
                        if($year%4==0){
                            $num = 29;
                        }else{
                            $num  = 28;
                        }
                         
                    }elseif(in_array($m,$month_31)){
                        $num  = 31;
                    }elseif(in_array($m,$month_30)){
                       $num  = 30;
                    }
                    $timezone_offet = get_option( 'gmt_offset');
                    $arr1 = [];
                    $arr2 = [];
                    $arr3 = [];
                    for($i=1;$i<=31;$i++){
                        $sta1 = strtotime(current_time('Y-m-'.$i));
                        $end1 = $sta1+24*3600;
                        $sta2 = $sta1-24*3600*($num1+$d);
                        $end2 = $sta2+24*3600;
                        $sta3 = $sta1-24*3600*($num1+$d+$num2);
                        $end3 = $sta3+24*3600;
                        $arr1[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta1,$end1));
                        $arr2[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta2,$end2));
                        $arr3[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta3,$end3));
                    }
                    $sta4 = strtotime(current_time('Y-m-01'));
                    $sta5 = $sta4-24*3600*$num1;
                    $sta6 = $sta4-24*3600*($num1+$num2);
                    $end4 = $sta4+24*3600*$num;
                    $end5 = $sta4;
                    $end6 = $sta5;
                    $arr4 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta4,$end4));
                    $arr5 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta5,$end5));
                    $arr6 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d group by session',$sta6,$end6));
                    $data5['series'] = [
                        [
                            'name'=>'本月',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr1
                        ],
                        [
                            'name'=>'上月',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr2    
                        ],
                        [
                            'name'=>'上上月',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr3    
                        ],
                    ];
                    $data5['xdata'] = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
                    echo wp_json_encode(['code'=>1,'data1'=>$data5,'data2'=>$arr4,'data3'=>$arr5,'data4'=>$arr6]);exit;
                    
                }
                
                
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_liuliang_pv(){
            global $wpdb;
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $type = (int)$_POST['type'];
                if($type==1){
                    $timezone_offet = get_option( 'gmt_offset');
                    $arr1 = [];
                    $arr2 = [];
                    $arr3 = [];
                    for($i=0;$i<=23;$i++){
                        if($i>=10){
                            $j=$i+1;
                            $sta1 = strtotime(current_time('Y-m-d '.$i.':00'));
                            $end1 = strtotime(current_time('Y-m-d '.$j.':00'));
                            $sta2 = $sta1-24*3600;
                            $end2 = $end1-24*3600;
                            $sta3 = $sta1-24*3600*2;
                            $end3 = $end1-24*3600*2;
                        }else{
                            $j=$i+1;
                            
                            $sta1 = strtotime(current_time('Y-m-d 0'.$i.':00'));
                            $sta2 = $sta1-24*3600;
                            $sta3 = $sta1-24*3600*2;
                            if($j==10){
                                $end1 = strtotime(current_time('Y-m-d 10:00'));
                                $end2 = $end1-24*3600;
                                $end3 = $end1-24*3600*2;
                            }else{
                                $end1 = strtotime(current_time('Y-m-d 0'.$j.':00'));
                                $end2 = $end1-24*3600;
                                $end3 = $end1-24*3600*2;
                            }
                        }
                    
                        
                        $arr1[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta1,$end1));
                        $arr2[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta2,$end2));
                        $arr3[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta3,$end3));
                    }
                    $sta4 = strtotime(current_time('Y-m-d'));
                    $sta5 = $sta4-24*3600;
                    $sta6 = $sta4-24*3600*2;
                    $end4 = strtotime(current_time('Y-m-d 23:59:59'));
                    $end5 = $end4-24*3600;
                    $end6 = $end4-24*3600*2;
                    $arr4 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta4,$end4));
                    $arr5 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta5,$end5));
                    $arr6 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta6,$end6));
                    
                    $data5['series'] = [
                        [
                            'name'=>'今天',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr1
                        ],
                        [
                            'name'=>'昨天',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr2    
                        ],
                        [
                            'name'=>'前天',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr3    
                        ],
                    ];
                    $data5['xdata'] = ['0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23'];
                   echo wp_json_encode(['code'=>1,'data1'=>$data5,'data2'=>$arr4,'data3'=>$arr5,'data4'=>$arr6]);exit;
                }elseif($type==2){
                    //获取周
                    $timezone_offet = get_option( 'gmt_offset');
                    $arr1 = [];
                    $arr2 = [];
                    $arr3 = [];
                    $n = current_time('N');
                    for($i=1;$i<=7;$i++){
                        $j=$i+1;
                        $sta1 = strtotime(current_time('Y-m-d'))-($n-$i)*24*3600;
                        $sta2 = $sta1-24*3600*7;
                        $sta3 = $sta1-24*3600*14;
                        $end1 = $sta1+24*3600;
                        $end2 = $sta2+24*3600;
                        $end3 = $sta3+24*3600;
                        $arr1[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta1,$end1));
                        $arr2[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta2,$end2));
                        $arr3[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta3,$end3));
                    }
                    $sta4 = strtotime(current_time('Y-m-d'))-($n-1)*24*3600;
                    $sta5 = $sta4-24*3600*7;
                    $sta6 = $sta4-24*3600*14;
                    $end4 = $sta4+24*3600*7;
                    $end5 = $sta5+24*3600*7;
                    $end6 = $sta6+24*3600*7;
                    $arr4 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta4,$end4));
                    $arr5 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta5,$end5));
                    $arr6 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta6,$end6));
                    $data5['series'] = [
                        [
                            'name'=>'本周',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr1
                        ],
                        [
                            'name'=>'上周',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr2    
                        ],
                        [
                            'name'=>'上上周',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr3    
                        ],
                    ];
                    $data5['xdata'] = ['1','2','3','4','5','6','7'];
                    echo wp_json_encode(['code'=>1,'data1'=>$data5,'data2'=>$arr4,'data3'=>$arr5,'data4'=>$arr6]);exit;
                }elseif($type==3){
                    //获取月份
                    $m = current_time('m');
                    $n = current_time('n');
                    $year = current_time('Y');
                    $month_31 = ['01','03','05','07','08','10','12'];
                    $month_30 = ['04','06','09','11'];
                    if($n==1){
                        //上月天数
                        $num1 = 31;
                        //上上月天数
                        $num2 =30;
                    }else{
                        $n= $n-1;
                        if($n<10){
                            $n = '0'.$n;
                            
                        }
                        if($n=='02'){
                            if($year%4==0){
                                $num1 = 29;
                            }else{
                                $num1  = 28;
                            }
                            $num2 =31;
                             
                        }elseif(in_array($n,$month_31)){
                            $num1  = 31;
                            if($n==8){
                                $num2 =31;
                            }else{
                                $num2 =30;
                            }
                        }elseif(in_array($n,$month_30)){
                           $num1  = 30;
                           $num2 =31;
                        }
                    }
                    $d = current_time('j');
                    
                    if($m=='02'){
                        if($year%4==0){
                            //当前月天数
                            $num = 29;
                        }else{
                            $num  = 28;
                        }
                         
                    }elseif(in_array($m,$month_31)){
                        $num  = 31;
                    }elseif(in_array($m,$month_30)){
                       $num  = 30;
                    }
                    $timezone_offet = get_option( 'gmt_offset');
                    $arr1 = [];
                    $arr2 = [];
                    $arr3 = [];
                    for($i=1;$i<=31;$i++){
                        $sta1 = strtotime(current_time('Y-m-'.$i));
                        $end1 = $sta1+24*3600;
                        $sta2 = $sta1-24*3600*($num1+$d);
                        $end2 = $sta2+24*3600;
                        $sta3 = $sta1-24*3600*($num1+$d+$num2);
                        $end3 = $sta3+24*3600;
                        $arr1[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta1,$end1));
                        $arr2[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta2,$end2));
                        $arr3[] = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta3,$end3));
                    }
                    $sta4 = strtotime(current_time('Y-m-01'));
                    $sta5 = $sta4-24*3600*$num1;
                    $sta6 = $sta4-24*3600*($num1+$num2);
                    $end4 = $sta4+24*3600*$num;
                    $end5 = $sta4;
                    $end6 = $sta5;
                    $arr4 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta4,$end4));
                    $arr5 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta5,$end5));
                    $arr6 =$wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_liuliang  where unix_timestamp(time)>%d and  unix_timestamp(time)<%d ',$sta6,$end6));
                    $data5['series'] = [
                        [
                            'name'=>'本月',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr1
                        ],
                        [
                            'name'=>'上月',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr2    
                        ],
                        [
                            'name'=>'上上月',
                            'type'=>'line',
                            'smooth'=> true,
                            // 'stack'=> 'Total',
                            'data'=>$arr3    
                        ],
                    ];
                    $data5['xdata'] = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
                    echo wp_json_encode(['code'=>1,'data1'=>$data5,'data2'=>$arr4,'data3'=>$arr5,'data4'=>$arr6]);exit;
                    
                }
                
                
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_liuliang(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $baiduseo_wyc = get_option('baiduseo_liuliang');
                echo wp_json_encode(['code'=>1,'data'=>$baiduseo_wyc]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_tongxun(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $tongxun = baiduseo_common::baiduseo_tongxun();
                $siteurl = trim(get_option('siteurl'),'/');;
                echo wp_json_encode(['code'=>1,'data'=>['key'=>$tongxun,'url'=>$siteurl]]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_titles(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $blogname = get_option('blogname');
                $blogdescription = get_option('blogdescription');
                echo wp_json_encode(['code'=>1,'data'=>['title'=>$blogname,'futitle'=>$blogdescription]]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_friends_tongji(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                 global $wpdb;
                $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."wztkj_friends where status1=0 and status2=0 and status3=0 ",ARRAY_A);
                
                if((isset($data['kqtype']) && $data['kqtype']==2) && isset($data['link']) && $data['link']==1 ){
                      $count1 = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."wztkj_friends  where status1=5 or (status1=0 and status2=0 and status3=0)",ARRAY_A);
                  
                 }else{
                      $count1 = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."wztkj_friends  where status1=5 or (status1=0 and status2=0)",ARRAY_A);
                      
                 }
                $count2 = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."wztkj_friends where status1=5",ARRAY_A);
                
                $baiduseo_hh_count = get_option('baiduseo_hh_count');   
                echo wp_json_encode(['code'=>1,'data'=>['shenhe'=>$count,'succ'=>$count1,'xianyou'=>isset($baiduseo_hh_count['hhcount'])?$baiduseo_hh_count['hhcount']:'--','shoudong'=>$count2,'qingqiu'=>isset($baiduseo_hh_count['count'])?$baiduseo_hh_count['count']:'--']]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
           
        }
        public function baiduseo_get_friends_open(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $str = '<?php if(class_exists("baiduseo_seo")){echo '.'baiduseo_seo::baiduseo_friends_hh("'.md5(baiduseo_common::baiduseo_url(0)).'");}?>';
                $str2 = '';
                echo wp_json_encode(['code'=>1,'data'=>['php'=>$str,'jianma'=>'[baiduseofriends]']]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_friends_sz(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
               $wztkj_linkhh = get_option('baiduseo_linkhh');
                echo wp_json_encode(['code'=>1,'data'=>$wztkj_linkhh]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        } 
        public function baiduseo_get_long(){
             global $wpdb;
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $long = $wpdb->get_results('select * from  '.$wpdb->prefix.'baiduseo_long order by id desc',ARRAY_A);
                $jifen = baiduseo_kp::get_jifen();
                echo wp_json_encode(['code'=>1,'data'=>$long,'jifen'=>$jifen]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_tag(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $baiduseo_tag_manage = get_option('baiduseo_tag');
                if($baiduseo_tag_manage===false){
                    $baiduseo_tag_manage = [
                        'num'=>0,
                        'nlnum'=>0
                    ];
                }else{
                    if(isset($baiduseo_tag_manage['bqgl']) && is_string($baiduseo_tag_manage['bqgl'])){
                        $baiduseo_tag_manage['bqgl'] = explode(',',$baiduseo_tag_manage['bqgl']);
                    }
                }
                echo wp_json_encode(['code'=>1,'data'=>$baiduseo_tag_manage]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_kp_jifen(){
            global $wpdb;
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $jifen = baiduseo_kp::get_jifen();
                $kp_count =$wpdb->get_var("SELECT SUM(num) FROM {$wpdb->prefix}baiduseo_kp_log where num<0");
                $kp_count = $kp_count?-$kp_count:0;
                echo wp_json_encode(['code'=>1,'jifen'=>$jifen,'xiaohao'=>$kp_count]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_keywords(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                 $keywords = $wpdb->get_results('select * from '.$wpdb->prefix . 'baiduseo_keywords',ARRAY_A);
                    foreach($keywords as $key=>$val){
                        if($val['prev']==50){
                            $keywords[$key]['prev'] = $val['prev'].'+';
                        }
                        if($val['prev']==0){
                            $keywords[$key]['prev'] = '--'; 
                        }
                        
                        if(!$val['title']){
                            $keywords[$key]['title']='未知';
                        }
                        if(!$val['time']){
                            $keywords[$key]['time']='--';
                        }
                    }
                echo wp_json_encode(['code'=>1,'data'=>$keywords]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public  function baiduseo_get_rank(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $baiduseo_rank = get_option('baiduseo_rank');
                echo wp_json_encode(['code'=>1,'data'=>$baiduseo_rank]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_quanzhong(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $baiduseo_quanzhong = get_option('baiduseo_quanzhong');
                if(!isset($baiduseo_quanzhong['time']) || $baiduseo_quanzhong['time']<time()-24*3600){
                    $url = 'http://wp.seohnzz.com/api/rank/quanzhong?url='.baiduseo_common::baiduseo_url(0);
                    $defaults = array(
                        'timeout' => 4000,
                        'redirection' => 4000,
                        'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                        'sslverify' => FALSE,
                    );
                    $result = wp_remote_get($url,$defaults);
                    if(!is_wp_error($result)){
                        $result = wp_remote_retrieve_body($result);
                        $content = json_decode($result,true);
                        if($content){
                            $content = $content[0];
                            $content['url'] = esc_url(baiduseo_common::baiduseo_url(1));
                            echo wp_json_encode(['code'=>1,'data'=>$content]);exit;
                        }else{
                            echo wp_json_encode(['code'=>0]);exit;
                        }
                    }else{
                        echo wp_json_encode(['code'=>0]);exit;
                    }
                }else{
                    echo wp_json_encode(['code'=>1,'data'=>$baiduseo_quanzhong]);exit;
                }
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public  function baiduseo_get_youhua(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $baidu = get_option('baiduseo_youhua');;
               
                echo wp_json_encode(['code'=>1,'data'=>$baidu]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_bingpe(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $baiduseo_cron = new baiduseo_cron();
                $baidu = get_option('baiduseo_zz');
                $num =  $baiduseo_cron->baiduseo_quota($baidu['bing_key']);
                echo wp_json_encode(['code'=>1,'data'=>$num]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_bdpe(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $urls[] = get_option('siteurl');
                baiduseo_zz::bdts($urls,0,0);
                
                $baiduseo_zz_record = get_option('baiduseo_zz_record');
                 echo wp_json_encode(['code'=>1,'data'=>$baiduseo_zz_record]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_zz(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $baidu = get_option('baiduseo_zz');
                 echo wp_json_encode(['code'=>1,'data'=>$baidu]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_cate_type(){
            // if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $args       = array(
                    'public' => true,
                );
                $post_types = get_post_types( $args, 'objects' );
                unset( $post_types['attachment'] );
                unset( $post_types['elementor_library'] );
                $data = [];
                
                foreach($post_types as $key=>$val){
                    $data[] = get_object_taxonomies($val->name,'objects');
                    
                }
               
                 echo wp_json_encode(['code'=>1,'data'=>$data,'post'=>$post_types]);exit;
            // }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_wyc(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $baiduseo_wyc = get_option('baiduseo_wyc');
                $baiduseo_wyc['jifen'] = baiduseo_kp::get_jifen();
                $baiduseo_wyc_xh = $wpdb->query('select id from '.$wpdb->prefix . 'baiduseo_kp_log where num>0  order by id desc ',ARRAY_A);
                $baiduseo_wyc['xiaohao'] = $baiduseo_wyc_xh*0.28;
                 echo wp_json_encode(['code'=>1,'data'=>$baiduseo_wyc]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_page_seo(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $page=(int)$_POST['page'];
                $baiduseo_page = get_post_meta( $page, 'baiduseo_page', true );
                 echo wp_json_encode(['code'=>1,'data'=>$baiduseo_page]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function baiduseo_get_cate_seo(){
             if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $cate = (int)$_POST['cate'];
                $seo_init = get_option('baiduseo_cate_'.$cate);
                echo wp_json_encode(['code'=>1,'data'=>$seo_init]);exit;
            }else{
                echo wp_json_encode(['code'=>0]);exit;
            }
        }
        public function baiduseo_get_zhizhu_con(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $baiduseo_zhizhu = get_option('baiduseo_zhizhu');
                echo wp_json_encode(['code'=>1,'data'=>$baiduseo_zhizhu]);exit;
            }else{
                echo wp_json_encode(['code'=>0]);exit;
            }
        }
        public function baiduseo_get_seo(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                
                $seo_init = get_option('seo_init');
                if(!is_array($seo_init)){
                    $seo_init = [];
                }
                $seo_301_404_url['url_404'] = get_option('seo_301_404_url');
                $seo_301_404_url['url_404']['url_404'] = $seo_301_404_url['url_404']['404_url'];
                $sitemap['sitemap'] = get_option('seo_baidu_sitemap');
                $seo_alt_auto['alt'] = get_option('seo_alt_auto');
                $rootbot['robots'] = get_option('seo_robots_sc');
                $silian['silian'] = get_option('seo_baidu_silian');
                $blogname['biaoti'] = get_option('blogname');
                $blogdescription['fubiaoti'] = get_option('blogdescription');
                $data = array_merge($seo_init,$seo_301_404_url,$sitemap,$seo_alt_auto,$rootbot,$silian,$blogname,$blogdescription);
                echo wp_json_encode(['code'=>1,'data'=>$data]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public  function baiduseo_get_page(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $page = $wpdb->get_results('select ID,post_title from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="page" order by ID desc ',ARRAY_A);
                echo wp_json_encode(['code'=>1,'data'=>$page]);exit;
            }else{
                echo wp_json_encode(['code'=>0]);exit;
            }
        }
        public function baiduseo_get_cate(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $page = $wpdb->get_results('select a.term_id,a.name from '.$wpdb->prefix . 'terms as a join '.$wpdb->prefix . 'term_taxonomy as b on a .term_id=b.term_id where b.taxonomy NOT IN("post_tag","nav_menu","wp_theme","language","term_language","term_translations","protag","videotag","goodstag","apptag","booktag","sitetag") ',ARRAY_A);
                echo wp_json_encode(['code'=>1,'data'=>$page]);exit;
            }else{
                echo wp_json_encode(['code'=>0]);exit;
            }
        }
        public function baiduseo_zhizhu_tubiao(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                if(isset($_POST['time']) && $_POST['time']){
                    $year = substr(sanitize_text_field($_POST['time']),0,4);
                    $month = substr(sanitize_text_field($_POST['time']),5,2);
                }else{
                    $year = '';
                    $month = '';
                }
                 baiduseo_zhizhu::baiduseo_zhizhu_tubiao($year,$month);
            }
        }
        public function baiduseo_zhizhu_dangqian(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                baiduseo_zhizhu::baiduseo_zhizhu_dangqian();
            }
        }
        public function zhigai_log(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                $start1 = ($p1-1)*20;
                $count = $wpdb->query('select * from '.$wpdb->prefix . 'baiduseo_kp_log where num>0  order by id desc ',ARRAY_A);
                $kp_log = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_kp_log where num>0 order by id desc limit %d ,20',$start1),ARRAY_A);
                foreach($kp_log as $key=>$val){
                    $kp_log[$key]['title'] = get_post($val['num'])->post_title;
                }
                echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$kp_log,'pagesize'=>20,'total'=>ceil($count/20)]);exit;
            }
            echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit;
        }
        public function kp_log(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                $start1 = ($p1-1)*20;
                $count = $wpdb->query('select * from '.$wpdb->prefix . 'baiduseo_kp_log where num<-0.2   order by id desc ',ARRAY_A);
                $kp_log = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_kp_log where num<-0.3 order by id desc limit %d ,20',$start1),ARRAY_A);
                echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$kp_log,'pagesize'=>20,'total'=>ceil($count/20)]);exit;
            }
            echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit;
        }
        public function kp_delete(){
           if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                $start1 = ($p1-1)*20;
                $count = $wpdb->query('select * from '.$wpdb->prefix . 'baiduseo_kp where status>2 order by id desc ',ARRAY_A);
                $kp_delete = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_kp where status>2 order by id desc limit %d ,20',$start1),ARRAY_A);
                foreach($kp_delete as $k=>$v){
                    if($v['type']==1){
                        $kp_delete[$k]['type'] ='百度pc';
                    }else{
                        $kp_delete[$k]['type'] ='百度手机';
                    }
                    $kp_delete[$k]['change'] = $v['chu']-$v['news'];
                    if($v['status']==4){
                        $kp_delete[$k]['status'] ='已删除';
                    }elseif($v['status']==5){
                        $kp_delete[$k]['status'] ='审核不通过';
                    }
                    if($v['chu']==50){
                        $kp_delete[$k]['chu'] = '50+';
                    }
                    if($v['news']==50){
                        $kp_delete[$k]['news'] = '50+';
                    }
                   
                }
                echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$kp_delete,'pagesize'=>20,'total'=>ceil($count/20)]);exit;
            }
             echo wp_json_encode(['code'=>0]);exit;
        }
        public function kp(){
           if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
            $start1 = ($p1-1)*20;
            $count = $wpdb->query('select * from '.$wpdb->prefix . 'baiduseo_kp where status=2 or status=1 order by id desc',ARRAY_A);
            $kps = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_kp where status=2 or status=1 order by id desc limit %d ,20',$start1),ARRAY_A);
            foreach($kps as $k=>$v){
                if($v['type']==1){
                    $kps[$k]['type'] ='百度pc';
                    $kps[$k]['keywords'] = '<a href="https://www.baidu.com/s?wd='.$v['keywords'].'" target="_blank" style="color:#01AAED">'.$v['keywords'].'</a>';
                }else{
                    $kps[$k]['type'] ='百度手机';
                    $kps[$k]['keywords'] = '<a href="https://m.baidu.com/s?word='.$v['keywords'].'" target="_blank" style="color:#01AAED">'.$v['keywords'].'</a>';
                }
                $kps[$k]['change'] = $v['chu']-$v['news'];
                if($v['status']==1){
                    $kps[$k]['status'] ='审核中';
                }else if($v['status']==2){
                    $kps[$k]['status'] ='优化中';
                }
                if($v['chu']==50){
                    $kps[$k]['chu'] = '50+';
                }
                if($v['news']==50){
                    $kps[$k]['news'] = '50+';
                }
                if(!$v['high_time']){
                    $kps[$k]['high_time'] = '-';
                }
                if(!$v['check_time']){
                    $kps[$k]['check_time'] = '-';
                }
            }
            echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$kps,'pagesize'=>20,'total'=>ceil($count/20)]);exit;
            }
            echo wp_json_encode(['code'=>0]);exit;
        }
        public function yuanchuang(){
             set_time_limit(0);
            ini_set('memory_limit','-1');
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                $start1 = ($p1-1)*20;
                $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."posts  as a  left join ".$wpdb->prefix."postmeta as c on a.ID=c.post_id where c.meta_key='baiduseo' order by a.ID desc",ARRAY_A);
                $post = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."posts  as a  left join ".$wpdb->prefix."postmeta as c on a.ID=c.post_id where c.meta_key='baiduseo' order by a.ID desc limit %d,20",$start1),ARRAY_A);
                $arr = [];
                foreach($post as $key=>$val){
                    $arr[$key]['ID'] = $val['ID'];
                     $arr[$key]['link'] = get_permalink($val['ID']);
                    $arr[$key]['post_title'] = $val['post_title'];
                    if(isset(unserialize($val['meta_value'])['num'])){
                        $arr[$key]['num'] = unserialize($val['meta_value'])['num'];
                    }else{
                        $arr[$key]['num'] = '检测中';
                    }
                  //  if(isset(unserialize($val['meta_value'])['num'])){
                  //      $arr[$key]['jifen'] = ceil(unserialize($val['meta_value'])['num']/1000);
                  //  }else{
                  //      $arr[$key]['jifen'] =  '检测中';
                  //  }
                    if(isset(unserialize($val['meta_value'])['tjtime'])){
                        $arr[$key]['tjtime'] = unserialize($val['meta_value'])['tjtime'];
                    }else{
                        $arr[$key]['tjtime'] = '';
                    }
                    if(isset(unserialize($val['meta_value'])['kouchu'])){
                        $arr[$key]['jifen'] = unserialize($val['meta_value'])['kouchu'];
                    }else{
                        $arr[$key]['jifen'] =  '0';
                    }
                    if(isset(unserialize($val['meta_value'])['yc'])){
                        if(isset(unserialize($val['meta_value'])['hyc']) && unserialize($val['meta_value'])['hyc']){
                            if(unserialize($val['meta_value'])['yc']=='101'){
                                $arr[$key]['yc'] = '内容超出';
                                $arr[$key]['hyc'] = '--';
                            }elseif(unserialize($val['meta_value'])['yc']=='102'){
                                $arr[$key]['yc'] = '无效内容';
                                $arr[$key]['hyc'] = '--';
                            }else{
                                $arr[$key]['yc'] = unserialize($val['meta_value'])['hyc'].'%';
                                if(unserialize($val['meta_value'])['gx_status']==2){
                                    $arr[$key]['hyc'] = '智改失败';
                                }else{
                                    $arr[$key]['hyc'] = unserialize($val['meta_value'])['yc'].'%';
                                }
                            }
                        }else{
                            if(unserialize($val['meta_value'])['yc']=='101'){
                                $arr[$key]['yc'] = '内容超出';
                            }elseif(unserialize($val['meta_value'])['yc']=='102'){
                                $arr[$key]['yc'] = '无效内容';
                            }else{
                                $arr[$key]['yc'] = unserialize($val['meta_value'])['yc'].'%';
                            }
                            $arr[$key]['hyc'] = '--';
                        }
                    }else{
                        $arr[$key]['yc'] = '检测中';
                        $arr[$key]['hyc'] = '--';
                    }
                    if(isset(unserialize($val['meta_value'])['addtime'])){
                        $arr[$key]['time'] = unserialize($val['meta_value'])['addtime'];
                    }else{
                        $arr[$key]['time'] = '检测中';
                    }
                    if(isset(unserialize($val['meta_value'])['content_edit'])){
                       $arr[$key]['content_edit'] = unserialize($val['meta_value'])['content_edit'];
                    }else{
                        $arr[$key]['content_edit'] =  '<div style="padding:50px 0;text-align:center;">检测中</div>';
                    }
                }
                echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$arr,'pagesize'=>20]);exit;
            }
            echo wp_json_encode(['code'=>0,'msg'=>'参数错误']);exit;
        }
        public function zhizhu(){
           
           if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                $pages = isset($_POST['pages'])?(int)$_POST['pages']:1;
                $sta = isset($_POST['start'])?sanitize_text_field($_POST['start']):'';
                $end = isset($_POST['end'])?sanitize_text_field($_POST['end']):"";
                $search = isset($_POST['search'])?sanitize_text_field($_POST['search']):'';
                $type = isset($_POST['type'])?sanitize_text_field($_POST['type']):0;
                $type2 = isset($_POST['type2'])?sanitize_text_field($_POST['type2']):0;
                $orders = isset($_POST['orders'])?sanitize_text_field($_POST['orders']):1;
                $data = baiduseo_zhizhu::baiduseo_zhizhu_data($pages,$sta,$end,$search,$type,$type2,$orders);
            
            }else{
                echo wp_json_encode(['code'=>0]);exit;
            }
            
        }
        public function bbpt(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                $start1 = ($p1-1)*20;
                $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=1 ",ARRAY_A);
                $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=1 order by id desc limit %d,20",$start1),ARRAY_A);
                $baiduseo_zz_record = get_option('baiduseo_zz_record');
                 if($baiduseo_zz_record===false){
                    $baiduseo_zz_record = [
                     'num'=>0,
                     'remind'=>0
                     ];
                 }else{
                     if(!isset($baiduseo_zz_record['num']) && is_array($baiduseo_zz_record)){
                         $baiduseo_zz_record['num'] =0;
                     }
                     if(!isset($baiduseo_zz_record['remind']) && is_array($baiduseo_zz_record)){
                         $baiduseo_zz_record['remind'] =0;
                     }
                 }
                echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$post1,'pagesize'=>20,'leiji'=>$baiduseo_zz_record]);exit;
            }
             echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit;
            
        }
        public function  baiduseo_get_google(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                $start1 = ($p1-1)*20;
                $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=6 ",ARRAY_A);
                $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=6 order by id desc limit %d,20",$start1),ARRAY_A);
                 $baiduseo_google_record = get_option('baiduseo_google_record');
                 if($baiduseo_google_record===false){
                     $baiduseo_google_record = [
                         'num'=>0,
                         'remind'=>0
                         ];
                 }else{
                     if(!isset($baiduseo_google_record['num']) && is_array($baiduseo_google_record)){
                         $baiduseo_google_record['num'] =0;
                     }
                     if(!isset($baiduseo_google_record['remind']) && is_array($baiduseo_google_record)){
                         $baiduseo_google_record['remind'] =0;
                     }
                 }
                echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$post1,'pagesize'=>20,'leiji'=>$baiduseo_google_record]);exit;
            }
            echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit;
        }
        public function bbks(){
           if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                $start1 = ($p1-1)*20;
                $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=2 ",ARRAY_A);
                $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=2 order by id desc limit %d,20",$start1),ARRAY_A);
                $baiduseo_day_record = get_option('baiduseo_day_record');
                if($baiduseo_day_record===false){
                    $baiduseo_day_record = [
                             'num'=>0,
                             'remind'=>0
                             ];
                }else{
                     if(!isset($baiduseo_day_record['num']) && is_array($baiduseo_day_record)){
                         $baiduseo_day_record['num'] =0;
                     }
                     if(!isset($baiduseo_day_record['remind']) && is_array($baiduseo_day_record)){
                         $baiduseo_day_record['remind'] =0;
                     }
                 }
                echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$post1,'pagesize'=>20,'leiji'=>$baiduseo_day_record]);exit;
            }
            echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit;
        }
        public function bing(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                $start1 = ($p1-1)*20;
                $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=3 ",ARRAY_A);
                $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=3 order by id desc limit %d,20",$start1),ARRAY_A);
                $baiduseo_bing_record = get_option('baiduseo_bing_record');
                if($baiduseo_bing_record===false){
                    $baiduseo_bing_record = [
                         'num'=>0,
                         'remind'=>0
                    ];
                }else{
                     if(!isset($baiduseo_bing_record['num']) && is_array($baiduseo_bing_record)){
                         $baiduseo_bing_record['num'] =0;
                     }
                     if(!isset($baiduseo_bing_record['remind']) && is_array($baiduseo_bing_record)){
                         $baiduseo_bing_record['remind'] =0;
                     }
                 }
                echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$post1,'pagesize'=>20,'leiji'=>$baiduseo_bing_record]);exit;
            }
            echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit;
        }
        public function indexnow(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
            global $wpdb;
            $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
            $start1 = ($p1-1)*20;
            $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=5 ",ARRAY_A);
            $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=5 order by id desc limit %d,20",$start1),ARRAY_A);
             $baiduseo_indexnow_record = get_option('baiduseo_indexnow_record');
             if($baiduseo_indexnow_record===false){
                $baiduseo_indexnow_record = [
                         'num'=>0,
                         'remind'=>0
                         ];
             }else{
                     if(!isset($baiduseo_indexnow_record['num']) && is_array($baiduseo_indexnow_record)){
                         $baiduseo_indexnow_record['num'] =0;
                     }
                     if(!isset($baiduseo_indexnow_record['remind']) && is_array($baiduseo_indexnow_record)){
                         $baiduseo_indexnow_record['remind'] =0;
                     }
                 }
            echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$post1,'pagesize'=>20,'leiji'=>$baiduseo_indexnow_record]);exit;
            }
            echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit;
        }
        public function shenma(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                 global $wpdb;
                $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                $start1 = ($p1-1)*20;
                $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=4 ",ARRAY_A);
                $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_zz  where type=4 order by id desc limit %d,20",$start1),ARRAY_A);
                $baiduseo_sm_record = get_option('baiduseo_sm_record');
                 if($baiduseo_sm_record===false){
                $baiduseo_sm_record = [
                         'num'=>0,
                         'remind'=>0
                         ];
                 }else{
                     if(!isset($baiduseo_sm_record['num']) && is_array($baiduseo_sm_record)){
                         $baiduseo_sm_record['num'] =0;
                     }
                     if(!isset($baiduseo_sm_record['remind']) && is_array($baiduseo_sm_record)){
                         $baiduseo_sm_record['remind'] =0;
                     }
                 }
                echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$post1,'pagesize'=>20,'leiji'=>$baiduseo_sm_record]);exit;
            }
            echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit;
        }
        public function neilian(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
               
                if(isset($_POST['keywords'])){
                    $search = sanitize_text_field($_POST['keywords']);
                    $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian where keywords like %s order by id desc ",'%'.$search.'%'),ARRAY_A);
                    echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$post1,'pagesize'=>20,]);exit; 
                }else{
                    $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                    $start1 = ($p1-1)*20;
                    $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian  ",ARRAY_A);
                    $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."baiduseo_neilian order by id desc limit %d,20",$start1),ARRAY_A);
                    echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$post1,'pagesize'=>20,'total'=>ceil($count/20)]);exit;
                }
            }
            echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit; 
        }
        public function friends1(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                $start1 = ($p1-1)*30;
                $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."wztkj_friends where status1=0 and status2=0 and status3=0 ",ARRAY_A);
                $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."wztkj_friends where status1=0 and status2=0 and status3=0 order by id desc limit %d,30",$start1),ARRAY_A);
                if(!empty($post1)){
                         $timezone_offet = get_option( 'gmt_offset');
                       
                        $end = time();
                        
                        foreach($post1 as $key=>$val){
                            
                            $sta =strtotime($val['time'])-$timezone_offet*3600;
                             $time = $end-$sta;
                              if( $time<3600){
                                 $post1[$key]['times'] =  '刚刚';
                            }else if($time<24*3600 && $time>=3600){
                                $post1[$key]['times'] =  floor($time/3600).'小时前';
                            }elseif($time>=24*3600 && $time<30*24*3600){
                                 $post1[$key]['times'] =   floor($time/3600/24).'天前';
                            }elseif($time>=30*24*3600 && $time<30*24*3600*12){
                                 $post1[$key]['times'] =  floor($time/3600/24/30).'月前';
                            }elseif($time>=30*24*3600*12 ){
                                 $post1[$key]['times'] =  floor($time/3600/24/30/12).'年前';
                            }
                           
                        }
                    }
                echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$post1,'pagesize'=>30,'total'=>ceil($count/30)]);exit;
                
            }
            echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit;
        }
        public function friends2(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
               
               
                    $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                    $start1 = ($p1-1)*30;
                   
                     $data = get_option('baiduseo_linkhh');
                    
                     if(isset($data['kqtype']) && $data['kqtype']==2 ){
                          $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."wztkj_friends  where status1=5 or (status1=0 and status2=0 and status3=2)",ARRAY_A);
                        $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."wztkj_friends where status1=5 or (status1=0 and status2=0 and status3=2) order by id desc limit %d,30",$start1),ARRAY_A);
                     }else{
                          $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."wztkj_friends  where status1=5 or (status1=0 and status2=0)",ARRAY_A);
                          $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."wztkj_friends where status1=5 or (status1=0 and status2=0) order by id desc limit %d,30",$start1),ARRAY_A);
                     }
                    if(!empty($post1)){
                         $timezone_offet = get_option( 'gmt_offset');
                       
                        $end = time();
                        
                        foreach($post1 as $key=>$val){
                            
                            $sta =strtotime($val['time'])-$timezone_offet*3600;
                             $time = $end-$sta;
                              if( $time<3600){
                                 $post1[$key]['times'] =  '刚刚';
                            }else if($time<24*3600 && $time>=3600){
                                $post1[$key]['times'] =  floor($time/3600).'小时前';
                            }elseif($time>=24*3600 && $time<30*24*3600){
                                 $post1[$key]['times'] =   floor($time/3600/24).'天前';
                            }elseif($time>=30*24*3600 && $time<30*24*3600*12){
                                 $post1[$key]['times'] =  floor($time/3600/24/30).'月前';
                            }elseif($time>=30*24*3600*12 ){
                                 $post1[$key]['times'] =  floor($time/3600/24/30/12).'年前';
                            }
                                    
                        }
                    }
                    echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$post1,'pagesize'=>30,'total'=>ceil($count/30)]);exit;
                
            }
            echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit;
        }
        public function friends3(){
            if(isset($_POST['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['nonce']),'baiduseo')){
                global $wpdb;
                    $p1 = isset($_POST['pages'])?(int)$_POST['pages']:1;
                    $start1 = ($p1-1)*30;
                    
                    $data = get_option('baiduseo_linkhh');
                     if(isset($data['kqtype']) && $data['kqtype']==2 ){
                         $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."wztkj_friends  where (status1!=5 and status1!=0) or status2!=0 or (status3!=2 and status1=0 and status2=0) ",ARRAY_A);
                         $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."wztkj_friends where (status1!=5 and status1!=0) or status2!=0 or (status3!=2 and status1=0 and status2=0)   order by id desc limit %d,30",$start1),ARRAY_A);
                     }else{
                        
                         $count = $wpdb->query("SELECT * FROM ".$wpdb->prefix ."wztkj_friends where (status1!=5 and status1!=0) or status2!=0  ",ARRAY_A);
                         $post1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."wztkj_friends where (status1!=5 and status1!=0) or status2!=0   order by id desc limit %d,30",$start1),ARRAY_A);
                     }
                     $data = get_option('baiduseo_linkhh');
                    if(!empty($post1)){
                         $timezone_offet = get_option( 'gmt_offset');
                       
                        $end = time();
                        
                        foreach($post1 as $key=>$val){
                            
                            $sta =strtotime($val['time'])-$timezone_offet*3600;
                             $time = $end-$sta;
                              if( $time<3600){
                                 $post1[$key]['times'] =  '刚刚';
                            }else if($time<24*3600 && $time>=3600){
                                $post1[$key]['times'] =  floor($time/3600).'小时前';
                            }elseif($time>=24*3600 && $time<30*24*3600){
                                 $post1[$key]['times'] =   floor($time/3600/24).'天前';
                            }elseif($time>=30*24*3600 && $time<30*24*3600*12){
                                 $post1[$key]['times'] =  floor($time/3600/24/30).'月前';
                            }elseif($time>=30*24*3600*12 ){
                                 $post1[$key]['times'] =  floor($time/3600/24/30/12).'年前';
                            }
                            
                       
                           
                        }
                    }
                    echo wp_json_encode(['code'=>1,'msg'=>'','count'=>$count,'data'=>$post1,'pagesize'=>30,'total'=>ceil($count/30)]);exit;
                
            }
            echo wp_json_encode(['code'=>0,'msg'=>'获取失败']);exit;
        }
    }
?>