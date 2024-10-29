<?php
class baiduseo_crons{
    public function init(){
        add_action( 'baiduseo_cronhook1', [$this,'baiduseo_tongbu'] );
        // if(isset($_GET['planss'])){
        // $this->baiduseo_tongbu();exit;
        // }
        if(!wp_next_scheduled( 'baiduseo_cronhook1' )){
            wp_schedule_event( strtotime(current_time('Y-m-d H:i:00',1)), 'daily', 'baiduseo_cronhook1' );
        }
    }
    public function baiduseo_tongbu(){
        global $wpdb;
         $log = baiduseo_zz::pay_money();
        if(!$log){
            return;
        }
        $currnetTime= current_time( 'Y/m/d H:i:s');
        // $data =  baiduseo_common::baiduseo_url(0);
        // $url = "http://wp.seohnzz.com/api/tongbu/keywords?url={$data}";
        // $defaults = array(
        //     'timeout' => 4000,
        //     'connecttimeout'=>4000,
        //     'redirection' => 3,
        //     'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
        //     'sslverify' => FALSE,
        // );
        // $result = wp_remote_get($url,$defaults);
        
        // if(!is_wp_error($result)){
        //     $content = wp_remote_retrieve_body($result);
        //     $content = json_decode($content,true);
        //     if(isset($content['data'])){
        //         $content = $content['data'];
        //         foreach($content as $key=>$val){
        //             $res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_keywords where keywords=%s and type=%d',sanitize_text_field($val['keywords']),(int)$val['type']),ARRAY_A);
        //             if(!empty($res)){
        //                  $wpdb->update($wpdb->prefix . 'baiduseo_keywords',['time'=>sanitize_text_field($val['updatetime']),'num'=>(int)$val['rank'],'prev'=>(int)$val['high']],['id'=>$res[0]['id']]);
        //             }else{
        //                  $wpdb->insert($wpdb->prefix."baiduseo_keywords",['time'=>sanitize_text_field($val['updatetime']),'num'=>(int)$val['rank'],'prev'=>(int)$val['high'],'type'=>(int)$val['type'],'keywords'=>sanitize_text_field($val['keywords'])]);
        //             }
        //         }
        //     }
            
        // }
       
        // $this->baiduseo_tongbu1();
        $this->baiduseo_tongbu2();
        $this->baiduseo_tongbu3();
        $this->baiduseo_tongbu4();
        $this->baiduseo_tongbu5();
        $timezone_offet = get_option( 'gmt_offset');
        $sta =strtotime(gmdate('Y-m-d 00:00:00'))-$timezone_offet*3600;
        $end = strtotime(gmdate('Y-m-d 00:00:00'))+24*3600-$timezone_offet*3600;
        
      $suoyin = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu_suoyin where unix_timestamp(time) >%d and unix_timestamp(time)<%d and name="百度" ',$sta,$end),ARRAY_A);
        if(empty($suoyin)){
            $num = $this->baiduseo_sitebaidu();
          
            if($num){
                
                $res = $wpdb->insert($wpdb->prefix."baiduseo_zhizhu_suoyin",['name'=>'百度','num'=>$num,'time'=>$currnetTime]);
                
            }
           
        }
    }
    public function baiduseo_tongbu5(){
        global $wpdb;
        $baiduseo_wyc = get_option('baiduseo_wyc');
        $post = $wpdb->get_results("SELECT a.ID FROM ".$wpdb->prefix ."posts  as a  left join ".$wpdb->prefix."postmeta as c on a.ID=c.post_id where c.meta_key='baiduseo'",ARRAY_A);
        if(!empty($post)){
            if($baiduseo_wyc!==false && $baiduseo_wyc['wyc']){
                $wyc_result = wp_remote_post('https://ceshig.zhengyouyoule.com/api/wyc/wyc_tongbu1',['body'=>['url'=>get_option('siteurl')]]);
                $wyc_content = wp_remote_retrieve_body($wyc_result);
                $wyc_content = json_decode($wyc_content,true);
                
                
                if($wyc_content && !empty($wyc_content)){
                    foreach($wyc_content as $k=>$v){
                        $meta = get_post_meta($v['wp_id'],'baiduseo',true);
                        update_post_meta( (int)$v['wp_id'],'baiduseo',  ['content_edit'=>wp_kses_post($v['content_edit']),'status'=>1,'yc'=>(int)$v['yc'],'num'=>(int)$v['num'],'addtime'=>sanitize_text_field($v['endtime']),'hyc'=>(int)$v['hyc'],'gx_status'=>(int)$v['gx_status'],'kouchu'=>sanitize_text_field($v['kouchu']),'tjtime'=>$meta['tjtime']] ); 
                    }
                }
            }
        }
    }
    public function baiduseo_tongbu1(){
        global $wpdb;
        $data =  baiduseo_common::baiduseo_url(0);
        $url = "http://wp.seohnzz.com/api/tongbu/kp?url={$data}";
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
            $content = json_decode($content,true);
            if(isset($content['data'])){
                $content = $content['data'];
                
                foreach($content as $key=>$val){
                    $res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_kp where keywords=%s and type=%d',sanitize_text_field($val['keywords']),(int)$val['type']),ARRAY_A);
                    if(!empty($res)){
                         $wpdb->update($wpdb->prefix . 'baiduseo_kp',['time'=>sanitize_text_field($val['time']),'check_time'=>sanitize_text_field($val['check_time']),'delete_time'=>sanitize_text_field($val['delete_time']),'chu'=>(int)$val['chu'],'news'=>(int)$val['news'],'status'=>(int)$val['status'],'high'=>(int)$val['high'],'high_time'=>sanitize_text_field($val['high_time'])],['id'=>$val['id']]);
                    }else{
                         $wpdb->insert($wpdb->prefix."baiduseo_kp",['time'=>sanitize_text_field($val['time']),'check_time'=>sanitize_text_field($val['check_time']),'delete_time'=>sanitize_text_field($val['delete_time']),'chu'=>(int)$val['chu'],'news'=>(int)$val['news'],'status'=>(int)$val['status'],'high'=>(int)$val['high'],'high_time'=>sanitize_text_field($val['high_time']),'type'=>(int)$val['type'],'keywords'=>sanitize_text_field($val['keywords'])]);
                    }
                }
            }
            
        }
    }
     public function baiduseo_tongbu2(){
        global $wpdb;
        $data =  baiduseo_common::baiduseo_url(0);
        $url = "http://wp.seohnzz.com/api/tongbu/kp_log?url={$data}";
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
            $content = json_decode($content,true);
            if(isset($content['data'])){
                $content = $content['data'];
                
                foreach($content as $key=>$val){
                    $res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_kp_log where orderno=%s ',sanitize_text_field($val['orderno'])),ARRAY_A);
                    if(!empty($res)){
                         $wpdb->update($wpdb->prefix . 'baiduseo_kp_log',['num'=>sanitize_text_field($val['num']),'time'=>sanitize_text_field($val['time']),'remark'=>sanitize_text_field($val['remark'])],['id'=>$val['id']]);
                    }else{
                         $wpdb->insert($wpdb->prefix."baiduseo_kp_log",['num'=>sanitize_text_field($val['num']),'time'=>sanitize_text_field($val['time']),'remark'=>sanitize_text_field($val['remark'])]);
                    }
                }
            }
            
        }
    }
    public function baiduseo_tongbu3(){
         global $wpdb;
        $data =  baiduseo_common::baiduseo_url(0);
        $url = "http://wp.seohnzz.com/api/tongbu/long?url={$data}";
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
            $content = json_decode($content,true);
            if(isset($content['data'])){
                $content = $content['data'];
                
                foreach($content as $key=>$val){
                    $res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_long where keywords=%s ',sanitize_text_field($val['keywords'])),ARRAY_A);
                    if(!empty($res)){
                         $wpdb->update($wpdb->prefix . 'baiduseo_long',['link'=>sanitize_text_field($val['link'])],['id'=>$res[0]['id']]);
                    }
                }
            }
            
        }
    }
    public function baiduseo_tongbu4(){
         global $wpdb;
        $data =  baiduseo_common::baiduseo_url(0);
        $url = "http://wp.seohnzz.com/api/tongbu/bing?url={$data}";
        $defaults = array(
            'timeout' => 4000,
            'connecttimeout'=>4000,
            'redirection' => 3,
            'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
            'sslverify' => FALSE,
        );
        $timezone_offet = get_option( 'gmt_offset');
        $sta =strtotime(gmdate('Y-m-d 00:00:00'))-$timezone_offet*3600;
        $end = strtotime(gmdate('Y-m-d 00:00:00'))+24*3600-$timezone_offet*3600;
        
        $result = wp_remote_get($url,$defaults);
        if(!is_wp_error($result)){
            $content = wp_remote_retrieve_body($result);
            $content = json_decode($content,true);
            $content = $content['data'];
           
            $suoyin = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu_suoyin where unix_timestamp(time) >%d and unix_timestamp(time)<%d and name="必应" ',$sta,$end),ARRAY_A);
                $currnetTime= current_time( 'Y/m/d H:i:s');
                if(empty($suoyin)){
                    if($content['num']){
                        $wpdb->insert($wpdb->prefix."baiduseo_zhizhu_suoyin",['name'=>'必应','num'=>(int)$content['num'],'time'=>$currnetTime]);
                    }
                }else{
                     if($content['num']){
                           $wpdb->update($wpdb->prefix . 'baiduseo_zhizhu_suoyin',['num'=>(int)$content['num'],'time'=>$currnetTime],['id'=>$suoyin[0]['id']]);
                        
                    }
                }
                $suoyin = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu_suoyin where unix_timestamp(time) >%d and unix_timestamp(time)<%d and name="360" ',$sta,$end),ARRAY_A);
                if(empty($suoyin)){
                    if($content['num3']){
                        $wpdb->insert($wpdb->prefix."baiduseo_zhizhu_suoyin",['name'=>'360','num'=>(int)$content['num3'],'time'=>$currnetTime]);
                    }
                }else{
                     if($content['num3']){
                           $wpdb->update($wpdb->prefix . 'baiduseo_zhizhu_suoyin',['num'=>(int)$content['num3'],'time'=>$currnetTime],['id'=>$suoyin[0]['id']]);
                        
                    }
                }
                
                    $suoyin = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu_suoyin where unix_timestamp(time) >%d and unix_timestamp(time)<%d and name="搜狗" ',$sta,$end),ARRAY_A);
                if(empty($suoyin)){
                    if($content['numg']){
                        $wpdb->insert($wpdb->prefix."baiduseo_zhizhu_suoyin",['name'=>'搜狗','num'=>(int)$content['numg'],'time'=>$currnetTime]);
                    }
                }else{
                     if($content['numg']){
                           $wpdb->update($wpdb->prefix . 'baiduseo_zhizhu_suoyin',['num'=>(int)$content['numg'],'time'=>$currnetTime],['id'=>$suoyin[0]['id']]);
                        
                    }
                }
                
    
            
        }
    }
     public function baiduseo_sitebaidu(){
        $yuming = baiduseo_common::baiduseo_url(0);
        $ua = $this->getua();
        $uaRandNum = rand(0,(count($ua['pc'])-1));
        $defaults = array(
            'timeout' => 4000,
            'connecttimeout'=>4000,
            'redirection' => 3,
            'user-agent' => $ua['pc'][$uaRandNum],
            'sslverify' => FALSE,
            'headers'=>[
                'Cookie'=>'BIDUPSID=372944C98AD4EBC50EBE698423A8FAD2; PSTM=1658193332; BAIDUID=74B16FF1AD4CE15C37E1C1D858E08A1D:SL=0:NR=10:FG=1; H_WISE_SIDS=110085_114550_189755_194530_196427_197471_204909_205161_209568_210321_211435_212295_213041_213346_214796_215730_216850_216942_218548_219566_219744_219942_219946_220017_220071_220600_220663_221006_221120_221410_221439_221479_221502_221678_222207_222299_222397_222425_222522_222606_222625_222888_223042_223064_223211_223238_223374_223474_223683_224048_224080_224099_224196_224429_224436_224458_224801_224981_225015_225245_225285_225332_225382_225738_225847_225852_226016_226076_226088_226222_226294_226377_226535_226598_226723_226757_226865_226881_226956_227040_227061_227064_227066_227084_227156_227228_227265_227411_227428_227454_227489_227514_227529_227579_227614_227747_227865_227933_227982_228107_228168_228247; MSA_WH=390_844; H_WISE_SIDS_BFESS=110085_114550_189755_194530_196427_197471_204909_205161_209568_210321_211435_212295_213041_213346_214796_215730_216850_216942_218548_219566_219744_219942_219946_220017_220071_220600_220663_221006_221120_221410_221439_221479_221502_221678_222207_222299_222397_222425_222522_222606_222625_222888_223042_223064_223211_223238_223374_223474_223683_224048_224080_224099_224196_224429_224436_224458_224801_224981_225015_225245_225285_225332_225382_225738_225847_225852_226016_226076_226088_226222_226294_226377_226535_226598_226723_226757_226865_226881_226956_227040_227061_227064_227066_227084_227156_227228_227265_227411_227428_227454_227489_227514_227529_227579_227614_227747_227865_227933_227982_228107_228168_228247; MCITY=-%3A; BD_UPN=12314753; BDORZ=B490B5EBF6F3CD402E515D22BCDA1598; kleck=b44a44f020ecbb9e4323346b6c1533a1; channel=baidusearch; baikeVisitId=66a9828c-8bcf-47fd-beb8-c9a92a9c146a; BAIDUID_BFESS=74B16FF1AD4CE15C37E1C1D858E08A1D:SL=0:NR=10:FG=1; ZD_ENTRY=baidu; __bid_n=186df81fc954004a0d4207; FPTOKEN=XKyb3HPhjIXljuc+g8TbfdedvXvzD3I6AKWgIfXUUj0GRJsWs58Kw3qZdJY5YC6JxytopSKmaUvKRarMaDsnx5evtvHF5zsEFHGIMhT27Hs77hMvH9iDKVdFOhdZrcb7ON7JU5kgNSN5Rh5Ij9VMolo8kkpfPxQ4DO0LU+DMRYI2i/ib9EM+76zpiFgFRbStneCusthetdKiIFRPA06VXdJA/7SxhG78t0RoPTHBbAoiSOdakyh3H+BxAdqXq7a16bmJ/fnFjqZQhlW9KxnFaWQsaBIeY8oEDLPIWlgw5gIdTV5Z1p1uPvp0aAJOpo1b89sgpSM9oCpJhUxn/JBY3TuYkhCLmmZf2tC0RwoudpOYzFRxCsL/Zmxvp4zAKKPDi0xvrx/EWybuio7Ej/FPxA==|cpSRIpRI/5RcZyL49l4pLrw5VBQh/CAeDOgsRYUtmuk=|10|0640d5f68addefacc37891ec5a31108b; ab_sr=1.0.1_YTA5Y2FmOGEwMjVlOTRkYzU0NjdhY2NmMDFhZTE0MGNiZGNiMjAzZTVmY2ZmZDQ5MTgyZjVjODA0NjEyZTgwZDhiNGEwYzY3YTBjM2VjZGVlNzJiNTA5NWRmYTEzY2Y2NzYxYzM1MGJhM2JkMWU5Y2IwNGZhODI5M2IzYWZhMDRjNGE4ZjcyZThmNzBhYTg4NWIzZWI3ZmJlZjk0MTMxMWE2NTRmOThkNjZjOWI3M2Y3YTYwYTY3YjgyMWY1MGNm; BD_HOME=1; delPer=0; BD_CK_SAM=1; PSINO=1; sugstore=1; BA_HECTOR=a585ak840k850gaga58ha4fc1i15n6c1m; ZFY=AGUhFedGvAzWv0evTA8fkmgaRGxv3UPaGqnZUR5L4Co:C; H_PS_645EC=1507Al2n8QUJtYb4iuDoQG%2Bd8N%2BWKwXvcf2xtvdbrOU4oyhd1MaVJJt9hDc; BDUSS=FZMZmI5ZHZYdzBHNE5OfjY0UERpdWRwSVJSNHlsWE04aEZPaTFDOXZsMVphenBrRUFBQUFBJCQAAAAAAAAAAAEAAABx4D6-tPo5ODc2NTQzMjEwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFneEmRZ3hJkR; BDUSS_BFESS=FZMZmI5ZHZYdzBHNE5OfjY0UERpdWRwSVJSNHlsWE04aEZPaTFDOXZsMVphenBrRUFBQUFBJCQAAAAAAAAAAAEAAABx4D6-tPo5ODc2NTQzMjEwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFneEmRZ3hJkR; BDRCVFR[feWj1Vr5u3D]=I67x6TjHwwYf0; H_PS_PSSID=36549_38126_38364_38402_37861_38170_38289_38380_36807_37925_38312_38359_38284_26350_37958_37881; BDSVRTM=5; WWW_ST='.time()    
            ],
        );
        $url = 'https://www.baidu.com/s?wd=site%3A'.$yuming.'&rsv_spt=1&rsv_iqid=0x93e13ad50012f7a6&issp=1&f=8&rsv_bp=1&rsv_idx=2&ie=utf-8&tn=baiduhome_pg&rsv_enter=1&rsv_dl=ib&rsv_sug2=0&rsv_btype=i&inputT=5168&rsv_sug4=5169';
        $res = wp_remote_get($url,$defaults);
        
        $num =0;
        if(is_wp_error($res)){
            $num=0;
        }else{
            $content = wp_remote_retrieve_body($res);
            if(preg_match("/<title>百度安全验证<\/title>/is",$content,$match)){
                $num = 0;
            }elseif(preg_match('/找到相关结果数约([\d,]+)/is',$content,$match)){
                $num = intval(preg_replace('/[^\d]*/','',$match[1]));
            }elseif(preg_match('/找到相关结果约([\d,]+)/is',$content,$match)){
                $num = intval(preg_replace('/[^\d]*/','',$match[1]));
            }elseif(preg_match('/该网站共有.+?([\d,]+).+?个网页/is',$content,$match)){
                $num = intval(preg_replace('/[^\d]*/','',$match[1]));
            }elseif(preg_match('/很抱歉，没有找到与/is',$content,$match)){
                $num = 0;   
            }
        }
        return $num;
    }

    public function getUa(){
        return [
            'pc' => [
                "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11",
                "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50",
                "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0",
                "Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; .NET4.0C; .NET4.0E; .NET CLR 2.0.50727; .NET CLR 3.0.30729; .NET CLR 3.5.30729; InfoPath.3; rv:11.0) like Gecko",
                "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0",
                "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)",
                "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)",
                "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)",
                "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",
                "Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",
                "Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; en) Presto/2.8.131 Version/11.11",
                "Opera/9.80 (Windows NT 6.1; U; en) Presto/2.8.131 Version/11.11",
                "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_0) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11",
                "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Maxthon 2.0)",
                "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; TencentTraveler 4.0)",
                "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)",
                "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; The World)",
                "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)",
                "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; SE 2.X MetaSr 1.0; SE 2.X MetaSr 1.0; .NET CLR 2.0.50727; SE 2.X MetaSr 1.0)",
                "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Avant Browser)",
                "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)",
                "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36"
            ],
           
        ];
    }
}