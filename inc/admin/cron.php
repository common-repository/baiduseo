<?php
class baiduseo_cron{
    public function init(){
        add_action( 'baiduseo_cronhook', [$this,'baiduseo_cronexec'] );
        // if(isset($_GET['plan'])){
        // $this->baiduseo_cronexec();
        // }
        if(!wp_next_scheduled( 'baiduseo_cronhook' )){
            wp_schedule_event( strtotime(current_time('Y-m-d H:i:00',1)), 'hourly', 'baiduseo_cronhook' );
        }
    }
    public function baiduseo_cronexec(){
        ini_set('memory_limit','-1');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $baiduseo_zhizhu = get_option('baiduseo_zhizhu');
        if(isset($baiduseo_zhizhu['open']) && $baiduseo_zhizhu['open']==1){
            $this->baiduseo_zhizhu();
        }
	    $this->baiduseo_kp();
        $baiduseo_wyc = get_option('baiduseo_wyc');
        if(isset($baiduseo_wyc['wyc']) && $baiduseo_wyc['wyc']){
            $this->baiduseo_wyc();
        }
        
        $this->wztkj_linkhh();
        
        
        $baiduseo_auto = get_option('baiduseo_zz');
        
	    if(isset($baiduseo_auto['baiduseo_type']) && strpos($baiduseo_auto['baiduseo_type'],'1')!==false && isset($baiduseo_auto['status']) && strpos($baiduseo_auto['status'],'1')!==false && isset($baiduseo_auto['pingtai']) && strpos($baiduseo_auto['pingtai'],'1')!==false){
	        $this->baiduseo_zz();
	    }
	     if(isset($baiduseo_auto['status']) && strpos($baiduseo_auto['status'],'1')!==false && isset($baiduseo_auto['pingtai']) && strpos($baiduseo_auto['pingtai'],'2')!==false){
	         $this->baiduseo_bing();
	    }
	    //下架
	   // if(isset($baiduseo_auto['status']) && strpos($baiduseo_auto['status'],'1')!==false && isset($baiduseo_auto['pingtai']) && strpos($baiduseo_auto['pingtai'],'3')!==false){
	   //      $this->baiduseo_shenma();
	   // }
	    if(isset($baiduseo_auto['baiduseo_type']) && strpos($baiduseo_auto['baiduseo_type'],'2')!==false && isset($baiduseo_auto['status']) && strpos($baiduseo_auto['status'],'1')!==false && isset($baiduseo_auto['pingtai']) && strpos($baiduseo_auto['pingtai'],'1')!==false){
	         $this->baiduseo_day();
	    }
	   
	    $sitemap = get_option('seo_baidu_sitemap');
	    if(isset($sitemap['sitemap_open']) && $sitemap['sitemap_open']){
            $this->baiduseo_sitemap();
	    }
	    if(isset($sitemap['silian_open']) && $sitemap['silian_open']){
            $this->baiduseo_silian();
        }
      
        // $this->baiduseo_rank();
        $this->baiduseo_tongji();
        $this->baiduseo_clear_log();
        $this->baiduseo_liuliang();
    }
    public function baiduseo_liuliang(){
        global $wpdb,$baiduseo_wzt_log;
        if($baiduseo_wzt_log){
            $log = baiduseo_zz::pay_money();
            if(!$log){
                return;
            }
            //删除超过限制的数据
            $timezone_offet = get_option( 'gmt_offset');
            $baiduseo_liuliang = get_option('baiduseo_liuliang');
            if(isset($baiduseo_liuliang['log'])){
                if($baiduseo_liuliang['log']==1){
                    $end = strtotime('-30 days')-$timezone_offet*3600;
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_liuliang  where unix_timestamp(time)<%d",$end));
                }elseif($baiduseo_liuliang['log']==2){
                     $end = strtotime('-90 days')-$timezone_offet*3600;
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_liuliang  where unix_timestamp(time)<%d",$end));
                }elseif($baiduseo_liuliang['log']==3){
                     $end = strtotime('-180 days')-$timezone_offet*3600;
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_liuliang  where unix_timestamp(time)<%d",$end));
                }elseif($baiduseo_liuliang['log']==4){
                      $end = strtotime('-3 days')-$timezone_offet*3600;
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_liuliang  where unix_timestamp(time)<%d",$end));
                }elseif($baiduseo_liuliang['log']==5){
                      $end = strtotime('-7 days')-$timezone_offet*3600;
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_liuliang  where unix_timestamp(time)<%d",$end));
                }elseif($baiduseo_liuliang['log']==6){
                      $end = strtotime('-15 days')-$timezone_offet*3600;
                    $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_liuliang  where unix_timestamp(time)<%d",$end));
                    
                }
            }
            if(isset($baiduseo_liuliang['open']) && $baiduseo_liuliang['open']){
                //深度和时长计算
                $res = $wpdb->get_results('select * from '.$wpdb->prefix . 'baiduseo_liuliang where shichang=0',ARRAY_A);
                foreach($res as $key=>$val){
                    if($val['status']==1){
                        $count = $wpdb->query($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_liuliang where session="%s" and status=1',$val['session']),ARRAY_A);
                        if($count){
                            $wpdb->update($wpdb->prefix . 'baiduseo_liuliang',['pinci'=>$count,'is_new'=>1],['session'=>$val['session']]);
                        }
                        $total_page = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_liuliang where pid=%d',$val['id']),ARRAY_A);
                        
                        $shendu = $total_page+1;
                        $re = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_liuliang where pid=%d',$val['id']),ARRAY_A);
                        if($val['updatetime']){
                            $totaltime = strtotime($val['updatetime'])-strtotime($val['time']);
                        }else{
                            $totaltime = 1;
                        }
                        if(!empty($re)){
                            foreach($re as $k=>$v){
                                if($v['shichang']){
                                    $totaltime+=$v['shichang'];
                                }else{
                                    if($v['updatetime']){
                                        $totaltime += strtotime($v['updatetime'])-strtotime($v['time']);
                                       
                                        
                                    }else{
                                        $totaltime += 1;
                                        
                                    }
                                }
                               
                            }
                            
                        }
                        $wpdb->update($wpdb->prefix . 'baiduseo_liuliang',['shichang'=>$totaltime,'shendu'=>$shendu,'pinci'=>$count],['id'=>$val['id']]);
                    }else{
                        if($val['updatetime']){
                            $time = strtotime($val['updatetime'])-strtotime($val['time']);
                        }else{
                            $time = 1;
                        }
                        $wpdb->update($wpdb->prefix . 'baiduseo_liuliang',['shichang'=>$time],['id'=>$val['id']]);
                    }
                }
            }
            
            $sheng = $wpdb->get_results('select ip from '.$wpdb->prefix . 'baiduseo_liuliang where sheng is null and ip !="" and ip !="unknown" group by ip limit 100',ARRAY_A);
            if(!empty($sheng)){
                    $ur=  baiduseo_common::baiduseo_url(0);
            	    $url = 'https://www.rbzzz.com/api/tag/getaddress?url='.$ur;
                    $defaults = array(
                        'timeout' => 4000,
                        'redirection' => 4000,
                        'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                        'sslverify' => FALSE,
                    );
            	    $result = wp_remote_post($url,['body'=>['data'=>json_encode($sheng)]]);
            	    if(!is_wp_error($result)){
            	        $result = wp_remote_retrieve_body($result);
            	        
            	        
            	        $result = json_decode($result,true);
            	        
            	        if(isset($result['data'])){
            	            $result = $result['data'];
                	        foreach($result as $key=>$val){
                	           
                	             $wpdb->update($wpdb->prefix . 'baiduseo_liuliang',['sheng'=>$val],['ip'=>$key]);
                	           
                	        }
            	        }
            	    }
            	    
            }
        }
        
    }
    public function wztkj_linkhh(){
        global $wpdb;
        
        $wztkj_linkhh = get_option('baiduseo_linkhh');
        if(isset($wztkj_linkhh['link']) && $wztkj_linkhh['link']==1){
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
                }else{
                    $baiduseo_friends_kg_num = get_option('baiduseo_friends_kg_num');
                    if($baiduseo_friends_kg_num!==false){
                        if($baiduseo_friends_kg_num>48){
                            update_option('baiduseo_friends_kg_num',1);
                            $wztkj_linkhh['link'] = 0;
                            update_option('baiduseo_linkhh',$wztkj_linkhh);
                            $wztkj_linkhh = get_option('baiduseo_linkhh');
                        }else{
                            update_option('baiduseo_friends_kg_num',$baiduseo_friends_kg_num+1);
                        }
                    }else{
                        add_option('baiduseo_friends_kg_num',1);
                    }
                    
                }
            }
        }
        //提交到远端
       $url = 'http://wp.seohnzz.com/api/wztkj/friend_post';
       $wztkj_linkhh['linkurl'] = baiduseo_common::baiduseo_url(1);
	   $result = wp_remote_post($url,['body'=>['data'=>$wztkj_linkhh]]);
	   if(!is_wp_error($result)){
	        $result = wp_remote_retrieve_body($result);
	        $result = json_decode($result,true);
	        if(!empty($result)){
	            $baiduseo_hh_count = get_option('baiduseo_hh_count');
	            if(!is_array($baiduseo_hh_count)){
	                $baiduseo_hh_count = [];
	            }
	            foreach($result as $key=>$val){
	                //需要处理
                    $res = $wpdb->get_results('select * from '.$wpdb->prefix . 'wztkj_friends where link="'.$val['link2'].'"',ARRAY_A);
                    $currnetTime = current_time( 'Y-m-d H:i:s');
                    $status3 = $val['status3'];
                    $baiduseo_hh_count['count'] = $val['count'];
                    $baiduseo_hh_count['hhcount'] = $val['hhcount'];
                    if($wztkj_linkhh['kqtype']==2 && $wztkj_linkhh['link']==1){
                        if($val['status3']==1 && $val['is_check2']==1 && $val['status4']==1){
                            $status3=2;
                        }
                        if($val['status3']==1 && $val['is_check2']==0){
                            $status3=2;
                        }
                    }else{
                        if( $val['is_check2']==1 && $val['status4']==1){
                            $status3=2;
                        }
                         if( $val['is_check2']==0){
                            $status3=2;
                        }
                    }
                    
                    if(!empty($res)){
                        
                        $wpdb->update($wpdb->prefix . 'wztkj_friends',['keywords'=>$val['keywords'],'status1'=>$val['status1'],'status2'=>$val['status2'],'status3'=>$status3],['id'=>$res[0]['id']]);
                    }else{  
                        $wpdb->insert($wpdb->prefix."wztkj_friends",['link'=>$val['link2'],'keywords'=>$val['keywords'],'time'=>$currnetTime,'status1'=>$val['status1'],'status2'=>$val['status2'],'status3'=>$status3]);
                    }
                }
                update_option('baiduseo_hh_count',$baiduseo_hh_count);
                
	        }
	        
	   }
    }
    public function baiduseo_shenma(){
        global $wpdb,$baiduseo_wzt_log;
         global $wp_rewrite;
        if($baiduseo_wzt_log){
         $log = baiduseo_zz::pay_money();
        if(!$log){
            return;
        }
	    if(!$wp_rewrite){
	       $wp_rewrite = new wp_rewrite();
	    }
        $currnetTime= current_time( 'Y-m-d H:i:s');
        
        $baidu = get_option('baiduseo_zz');
        $baiduseo_auto = get_option('baiduseo_zz');
        if(isset($baiduseo_auto['sm_num']) && $baiduseo_auto['sm_num']){
            $num = $baiduseo_auto['sm_num'];
            $num1 = $num;
        }else{
            return;
        }
        
        if(isset($baidu['shenma_key'])){
            $baiduseo_sm_record = get_option('baiduseo_sm_record');
            $urls = [];
           if(isset($baiduseo_sm_record['id']) && $baiduseo_sm_record['id']){
                $id =$baiduseo_sm_record['id'];
            }else{
                $id = 0;
            }
            $article = $wpdb->get_results($wpdb->prepare('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND FIND_IN_SET(`post_type`,%s) and ID>%d order by ID asc limit %d',$baiduseo_auto['post_type'],$id,$num),ARRAY_A);
        	if(!empty($article)){
        	    $ids = end($article)['ID'];
                foreach($article as $key=>$val){
                    $urls[] = get_permalink($val["ID"]);
                }
                $result = wp_remote_post(str_replace('&#038;','&',$baidu['shenma_key']),['body'=>implode("\n", $urls)]);
                $content = wp_remote_retrieve_body($result);
                $res = json_decode($content,true);
                if(isset($res['returnCode']) && $res['returnCode']=='200'){
                    if(isset($baiduseo_auto['shenma_log']) && $baiduseo_auto['shenma_log']){
                        foreach($urls as $key=>$val){
        	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>1,'type'=>4,'message'=>'']);
        	            }
                    }
                    if($baiduseo_sm_record!==false){
    	                $data = $baiduseo_sm_record;
    	                $data['num'] = $baiduseo_sm_record['num']+count($article);
    	                $data['id'] = $ids;
    	                $data['time'] = $currnetTime;
    	                update_option('baiduseo_sm_record',$data);
    	            }else{
    	                $data['num'] = count($article);
    	                
    	                    $data['id'] = $ids;
    	                
    	                $data['time'] =  $currnetTime;
    	                
    	                add_option('baiduseo_sm_record',$data);
    	            }
                }else{
                    if(isset($baiduseo_auto['shenma_log']) && $baiduseo_auto['shenma_log']){
                        if(isset($res['returnCode']) && $res['returnCode']==201){
                            foreach($urls as $key=>$val){
            	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'token不合法']);
            	                break;
            	            }
                        }elseif(isset($res['returnCode']) && $res['returnCode']==202){
                            foreach($urls as $key=>$val){
            	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'当日流量已用完']);
            	                break;
            	            }
                        }elseif(isset($res['returnCode']) && $res['returnCode']==400){
                            foreach($urls as $key=>$val){
            	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'请求参数错误']);
            	                break;
            	            }
                        }else{
                            foreach($urls as $key=>$val){
            	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'服务器错误']);
            	                break;
            	            }
                        }
            	            
                    
                    }   
                }
            }else{
                $baiduseo_sm_record['id'] =0;
                update_option('baiduseo_sm_record',$baiduseo_sm_record);
            }
        $baiduseo_sm_record = get_option('baiduseo_sm_record');
        if(isset($baiduseo_auto['post_type']) && $baiduseo_auto['post_type']){
             
            if(isset($baiduseo_sm_record['tag_id']) && $baiduseo_sm_record['tag_id']){
                $tag_id =$baiduseo_sm_record['tag_id'];
            }else{
                $tag_id = 0;
            }
            $tag = $wpdb->get_results($wpdb->prepare('select a.term_id,b.taxonomy from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id  where FIND_IN_SET(`taxonomy`,%s)  and a.term_id>%d limit  %d',$baiduseo_auto['post_type'],$tag_id,$num1),ARRAY_A);
        
            if(!empty($tag)){
                $urls = [];
                $ids = end($tag)['term_id'];
                foreach($tag as $k=>$v){
                    if($v['taxonomy']=='category'){
                        $urls[] = get_category_link($v['term_id']);
                    }elseif($v['taxonomy']=='post_tag'){
                        $urls[] = get_tag_link($v['term_id']);
                    }else{
                        $term = get_term_by('ID',$v['term_id'],$v['term_id']);
                        if($term){
                            $urls[] = get_term_link($v['term_id'],$v['taxonomy']);
                        }
                    }
                }
                 $result = wp_remote_post(str_replace('&#038;','&',$baidu['shenma_key']),['body'=>implode("\n", $urls)]);
                $content = wp_remote_retrieve_body($result);
                $res = json_decode($content,true);
                if(isset($res['returnCode']) && $res['returnCode']=='200'){
                    if(isset($baiduseo_auto['shenma_log']) && $baiduseo_auto['shenma_log']){
                        foreach($urls as $key=>$val){
        	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>1,'type'=>4,'message'=>'']);
        	            }
                    }
                    if($baiduseo_sm_record!==false){
    	                $data = $baiduseo_sm_record;
    	                $data['num'] = $baiduseo_sm_record['num']+count($tag);
    	                $data['tag_id'] = $ids;
    	                $data['time'] = $currnetTime;
    	                update_option('baiduseo_sm_record',$data);
    	            }else{
    	                $data['num'] = count($tag);
    	                
    	                    $data['tag_id'] = $ids;
    	                
    	                $data['time'] =  $currnetTime;
    	                
    	                add_option('baiduseo_sm_record',$data);
    	            }
                }else{
                    if(isset($baiduseo_auto['shenma_log']) && $baiduseo_auto['shenma_log']){
                        if(isset($res['returnCode']) && $res['returnCode']==201){
                            foreach($urls as $key=>$val){
            	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'token不合法']);
            	                break;
            	            }
                        }elseif(isset($res['returnCode']) && $res['returnCode']==202){
                            foreach($urls as $key=>$val){
            	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'当日流量已用完']);
            	                break;
            	            }
                        }elseif(isset($res['returnCode']) && $res['returnCode']==400){
                            foreach($urls as $key=>$val){
            	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'请求参数错误']);
            	                break;
            	            }
                        }else{
                            foreach($urls as $key=>$val){
            	                $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>2,'type'=>4,'message'=>'服务器错误']);
            	                break;
            	            }
                        }
            	            
                    
                    }   
                }
               
            }else{
                $baiduseo_sm_record = get_option('baiduseo_sm_record');
                $baiduseo_sm_record['tag_id'] = 0;
                update_option('baiduseo_sm_record',$baiduseo_sm_record);
            }
            
        }
           
        }
        }
    }
    public function baiduseo_rank(){
    //     global $baiduseo_wzt_log;
    //     if($baiduseo_wzt_log){
    //     $log = baiduseo_zz::pay_money();
    //     if(!$log){
    //         return;
    //     }
    //     $baiduseo_rank = get_option('baiduseo_rank');
	   // $ur=  baiduseo_common::baiduseo_url(0);
	   // $url = 'http://wp.seohnzz.com/api/rank/rank1?url='.$ur.'&http='.get_option('siteurl');
    //     $defaults = array(
    //         'timeout' => 4000,
    //         'redirection' => 4000,
    //         'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
    //         'sslverify' => FALSE,
    //     );
	   // $result = wp_remote_get($url,$defaults);
	   // $result = wp_remote_retrieve_body($result);
    //     if($baiduseo_rank!==false){
    //         update_option('baiduseo_rank',json_decode($result,true));
    //     }else{
    //         add_option('baiduseo_rank',json_decode($result,true));
    //     }
    //     }
		
    }
    public function baiduseo_kp(){
        global $wpdb;
        $tuisong = 0;
        $title = get_option('blogname');
        $baiduseo_auto = get_option('baiduseo_auto');
        if(isset($baiduseo_auto['rank']) && $baiduseo_auto['rank']){
            $tuisong = 1;
        }
        $baiduseo_kp_tongbu_error = get_option('baiduseo_kp_tongbu_error');
        if($baiduseo_kp_tongbu_error===false){
            update_option('baiduseo_kp_tongbu_error',1);
            $wpdb->query( "DELETE FROM " . $wpdb->prefix . "baiduseo_kp_log  where num<0" );
            $url = 'https://www.rbzzz.com/api/kp/tongbu3';
            $url1 = get_option('siteurl');
            $url1 = str_replace('https://','',$url1);
            $url1 = str_replace('http://','',$url1);
            $url1 = trim($url1,'/');
            $result = wp_remote_post($url,['body'=>['url'=>$url1,'tuisong'=>$tuisong,'title'=>$title]]);
            $content = wp_remote_retrieve_body($result);
            $content = json_decode($content,true);
            foreach($content['log'] as $key=>$val){
                unset($val['id']);
                unset($val['url']);
                $res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_kp_log where orderno=%d ',$val['orderno']),ARRAY_A);
                if(!empty($res)){
            	}else{
            	    $wpdb->insert($wpdb->prefix."baiduseo_kp_log",$val);
            	}
            }
        }
        $baiduseo_kp_tongbu = get_option('baiduseo_kp_tongbu');
        
        if(isset($baiduseo_kp_tongbu['time']) && $baiduseo_kp_tongbu['time']<time()){
            
            update_option('baiduseo_kp_tongbu',['time'=>time()+24*3600]);
            
            $url = 'https://www.rbzzz.com/api/kp/tongbu3';
            $url1 = get_option('siteurl');
            $url1 = str_replace('https://','',$url1);
            $url1 = str_replace('http://','',$url1);
            $url1 = trim($url1,'/');
            $result = wp_remote_post($url,['body'=>['url'=>$url1,'tuisong'=>$tuisong,'title'=>$title]]);
            $content = wp_remote_retrieve_body($result);
            $content = json_decode($content,true);
            foreach($content['kp'] as $key=>$val){
                unset($val['http']);
                unset($val['id']);
                unset($val['url']);
                $res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_kp where keywords=%s and type=%d',$val['keywords'],$val['type']),ARRAY_A);
                if($res){
                    $wpdb->update($wpdb->prefix . 'baiduseo_kp',$val,['id'=>$res[0]['id']]);
                }else{
                    $wpdb->insert($wpdb->prefix . 'baiduseo_kp',$val);
                }
            }
            
            foreach($content['log'] as $key=>$val){
                unset($val['id']);
                unset($val['url']);
                $res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_kp_log where orderno=%d ',$val['orderno']),ARRAY_A);
                if(!empty($res)){
            	}else{
            	    $wpdb->insert($wpdb->prefix."baiduseo_kp_log",$val);
            	}
            }
        }else{
            if($baiduseo_kp_tongbu===false){
                add_option('baiduseo_kp_tongbu',['time'=>time()+24*3600]);
            }else{
                update_option('baiduseo_kp_tongbu',['time'=>time()+24*3600]);
            }
        }
    }
    public function baiduseo_wyc(){
        global $wpdb,$baiduseo_wzt_log;
        $seo_init = get_option('baiduseo_wyc');
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
    	if($jifen>0){
    	    $total = 2;
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
        if(isset($seo_init['gx']) && $seo_init['gx']==1){
        	if($jifen>=0.28){
                $post = $wpdb->get_results("SELECT a.*,c.meta_value FROM ".$wpdb->prefix ."posts  as a  left join ".$wpdb->prefix."postmeta as c on a.ID=c.post_id where c.meta_key='baiduseo' and a.post_status='publish' and a.post_type='post' ",ARRAY_A);
               
                foreach($post as $ke=>$va){
                    $post_extend = get_post_meta( $va['ID'], 'baiduseo', true );
                    $meta = unserialize($va['meta_value']);
                   
                    if(isset($meta['hyc']) && $meta['hyc']==0 && isset($meta['yc']) && $meta['yc']<=$seo_init['wyc_min'] && $meta['yc']>0){
                        if($post_extend['status']==1){
                            $jifen -= 0.28;
                            if($jifen>=0){
                                $url = 'https://ceshig.zhengyouyoule.com/api/wyc/wyc_50';
                                $va['url'] = get_option('siteurl');
                		        $result = wp_remote_post($url,['body'=>$va]);
                		         
                                if($post_extend){
                                    $post_extend['status'] =3;
                                    update_post_meta( $va['ID'],'baiduseo', $post_extend ); 
                                }else{
                                    add_post_meta($va['ID'],'baiduseo',['status'=>3] );
                                }
                            }
                        }
                        
                    }
                    
                }
                if(isset($seo_init['wyc']) && $seo_init['wyc']==1){
            	    if($total==0){
                        return '';
                    }
                    $num = ceil($jifen/0.28);
                    $result = wp_remote_get('https://ceshig.zhengyouyoule.com/api/wyc/wyc_nums',$defaults);
                    $result = wp_remote_retrieve_body($result);
                    if($result<100){
                        $post1 =  $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."posts  where ID not in (select post_id from ".$wpdb->prefix ."postmeta where meta_key='baiduseo') and post_status='publish' and post_type='post' order by ID desc limit %d",$num),ARRAY_A);
                    }elseif($result>=100 && $result<500){
                        if($num>50){
                           
                            $post1 =  $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."posts  where ID not in (select post_id from ".$wpdb->prefix ."postmeta where meta_key='baiduseo') and post_status='publish' and post_type='post' order by ID desc limit 50",ARRAY_A);
                        }else{
                            
                            $post1 =  $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."posts  where ID not in (select post_id from ".$wpdb->prefix ."postmeta where meta_key='baiduseo') and post_status='publish' and post_type='post' order by ID desc limit %d",$num),ARRAY_A);
                        }
                    }elseif($result>=500 && $result<1000){
                         if($num>10){
                            
                            $post1 =  $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."posts  where ID not in (select post_id from ".$wpdb->prefix ."postmeta where meta_key='baiduseo') and post_status='publish' and post_type='post' order by ID desc limit 10",ARRAY_A);
                        }else{
                           
                            $post1 =  $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."posts  where ID not in (select post_id from ".$wpdb->prefix ."postmeta where meta_key='baiduseo') and post_status='publish' and post_type='post' order by ID desc limit %d",$num),ARRAY_A);
                        }
                    }
                    if(!empty($post1)){
                        foreach($post1 as $key=>$val){
                            $id = (int)$val['ID'];
                            $num = mb_strlen(preg_replace('/\s/','',html_entity_decode(wp_strip_all_tags($val['post_content']))),'UTF-8');
                            $post_extend = get_post_meta( $id, 'baiduseo', true );
                            $current_time = current_time( 'Y/m/d H:i:s');
                            if($post_extend){
                               update_post_meta( $id,'baiduseo',  ['status'=>2,'tjtime'=>$current_time] ); 
                            }else{
                                add_post_meta($id,'baiduseo',['status'=>2,'tjtime'=>$current_time] );
                            }
                            $content = $val['post_content'];
                            $url = 'https://ceshig.zhengyouyoule.com/api/wyc/wp_wyc';
                		    $result = wp_remote_post($url,['body'=>['id'=>$id,'content'=>$content,'num'=>$num,'url'=>get_option('siteurl'),'auto'=>1,'wyc_nums'=>$seo_init['wyc_min']]]);
                		    
                        }
                    }
            	}
        	}else{
        	    if(isset($seo_init['wyc']) && $seo_init['wyc']==1){
                    if($total==0){
                        return '';
                    }
                    $result = wp_remote_get('https://ceshig.zhengyouyoule.com/api/wyc/wyc_nums',$defaults);
                    $result = wp_remote_retrieve_body($result);
                    if($result<100){
                        $post1 =  $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."posts  where ID not in (select post_id from ".$wpdb->prefix ."postmeta where meta_key='baiduseo') and post_status='publish' and post_type='post' order by ID desc limit 10",ARRAY_A);
                    }elseif($result>=100 && $result<500){
                        $post1 =  $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."posts  where ID not in (select post_id from ".$wpdb->prefix ."postmeta where meta_key='baiduseo') and post_status='publish' and post_type='post' order by ID desc limit 5",ARRAY_A);
                    }elseif($result>=500 && $result<1000){
                        $post1 =  $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."posts  where ID not in (select post_id from ".$wpdb->prefix ."postmeta where meta_key='baiduseo') and post_status='publish' and post_type='post' order by ID desc limit 1",ARRAY_A);
                    }
                  
                    if(!empty($post1)){
                    foreach($post1 as $key=>$val){
                        $id = (int)$val['ID'];
                        $num = mb_strlen(preg_replace('/\s/','',html_entity_decode(wp_strip_all_tags($val['post_content']))),'UTF-8');
                        $post_extend = get_post_meta( $id, 'baiduseo', true );
                        $current_time = current_time( 'Y/m/d H:i:s');
                        if($post_extend){
                           update_post_meta( $id,'baiduseo',  ['status'=>2,'tjtime'=>$current_time] ); 
                        }else{
                            add_post_meta($id,'baiduseo',['status'=>2,'tjtime'=>$current_time] );
                        }
                        $content = $val['post_content'];
                        $url = 'https://ceshig.zhengyouyoule.com/api/wyc/wp_wyc';
            		    $result = wp_remote_post($url,['body'=>['id'=>$id,'content'=>$content,'num'=>$num,'url'=>get_option('siteurl'),'auto'=>1,'wyc_nums'=>$seo_init['wyc_min']]]);
                    }
                    }
                }
        	}
        	
        }else{
            
            if(isset($seo_init['wyc']) && $seo_init['wyc']==1){
                if($total==0){
                    return '';
                }
                $result = wp_remote_get('https://ceshig.zhengyouyoule.com/api/wyc/wyc_nums',$defaults);
                $result = wp_remote_retrieve_body($result);
               
                if($result<100){
                    
                    $post1 =  $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."posts  where ID not in (select post_id from ".$wpdb->prefix ."postmeta where meta_key='baiduseo') and post_status='publish' and post_type='post' order by ID desc limit 10",ARRAY_A);
                }elseif($result>=100 && $result<500){
                    
                    $post1 =  $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."posts  where ID not in (select post_id from ".$wpdb->prefix ."postmeta where meta_key='baiduseo') and post_status='publish' and post_type='post' order by ID desc limit 3",ARRAY_A);
                }elseif($result>=500 && $result<1000){
                   
                    $post1 =  $wpdb->get_results("SELECT * FROM ".$wpdb->prefix ."posts  where ID not in (select post_id from ".$wpdb->prefix ."postmeta where meta_key='baiduseo') and post_status='publish' and post_type='post' order by ID desc limit 1",ARRAY_A);
                }
                
                if(!empty($post1)){
                foreach($post1 as $key=>$val){
                    $id = (int)$val['ID'];
                    $num = mb_strlen(preg_replace('/\s/','',html_entity_decode(wp_strip_all_tags($val['post_content']))),'UTF-8');
                    $post_extend = get_post_meta( $id, 'baiduseo', true );
                    $current_time = current_time( 'Y/m/d H:i:s');
                    if($post_extend){
                       update_post_meta( $id,'baiduseo',  ['status'=>2,'tjtime'=>$current_time] ); 
                    }else{
                        add_post_meta($id,'baiduseo',['status'=>2,'tjtime'=>$current_time] );
                    }
                    $content = $val['post_content'];
                    $url = 'https://ceshig.zhengyouyoule.com/api/wyc/wp_wyc';
        		    $result = wp_remote_post($url,['body'=>['id'=>$id,'content'=>$content,'num'=>$num,'url'=>get_option('siteurl'),'auto'=>0,'wyc_nums'=>$seo_init['wyc_min']]]);
                }
                }
            }
        }
    }
    public function baiduseo_zhizhu(){
        global $wpdb;
        $timezone_offet = get_option( 'gmt_offset');
       
        $sta =strtotime(gmdate('Y-m-d 00:00:00'))-$timezone_offet*3600-24*3600;
    	$end = strtotime(gmdate('Y-m-d 00:00:00'))-$timezone_offet*3600;
       
    	$suoyin1 = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu_suoyin where unix_timestamp(time) >=%d and unix_timestamp(time)<%d and name="百度"  ',$sta,$end),ARRAY_A);
        $currnetTime= gmdate('Y-m-d H:i:s',strtotime(gmdate('Y-m-d 00:00:00'))-24*3600);
    	$baidu = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_zhizhu  where name="百度" and unix_timestamp(time) >=%d and unix_timestamp(time)<%d',$sta,$end));
    	if(empty($suoyin1)){
    	    $wpdb->insert($wpdb->prefix."baiduseo_zhizhu_suoyin",['name'=>'百度','num'=>0,'time'=>$currnetTime,'zhizhu_num'=>$baidu]);
    	}else{
    	    $res = $wpdb->update($wpdb->prefix . 'baiduseo_zhizhu_suoyin',['zhizhu_num'=>$baidu],['id'=>$suoyin1[0]["id"]]);
    	    
    	}
    	$suoyin2 = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu_suoyin where unix_timestamp(time) >=%d and unix_timestamp(time)<%d and name="必应"  ',$sta,$end),ARRAY_A);
    
    	$bingying = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_zhizhu  where name="必应" and unix_timestamp(time) >=%d and unix_timestamp(time)<%d',$sta,$end));
    		
    	if(empty($suoyin2)){
    	    $wpdb->insert($wpdb->prefix."baiduseo_zhizhu_suoyin",['name'=>'必应','num'=>0,'time'=>$currnetTime,'zhizhu_num'=>$bingying]);
    	}else{
    	    $wpdb->update($wpdb->prefix . 'baiduseo_zhizhu_suoyin',['zhizhu_num'=>$bingying],['id'=>$suoyin2[0]["id"]]);
    	}
    	$suoyin3 = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu_suoyin where unix_timestamp(time) >=%d and unix_timestamp(time)<%d and name="360"  ',$sta,$end),ARRAY_A);
    	
    	$a360 = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_zhizhu  where name="360" and unix_timestamp(time) >=%d and unix_timestamp(time)<%d',$sta,$end));
    
    	if(empty($suoyin3)){
    	    $wpdb->insert($wpdb->prefix."baiduseo_zhizhu_suoyin",['name'=>'360','num'=>0,'time'=>$currnetTime,'zhizhu_num'=>$a360]);
    	}else{
    	    $wpdb->update($wpdb->prefix . 'baiduseo_zhizhu_suoyin',['zhizhu_num'=>$a360],['id'=>$suoyin3[0]["id"]]);
    	}
    	$suoyin4 = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu_suoyin where unix_timestamp(time) >=%d and unix_timestamp(time)<%d and name="搜狗"  ',$sta,$end),ARRAY_A);
    	
    	$sougou = $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_zhizhu  where name="搜狗" and unix_timestamp(time) >=%d and unix_timestamp(time)<%d',$sta,$end));
    
    	if(empty($suoyin4)){
    	    $wpdb->insert($wpdb->prefix."baiduseo_zhizhu_suoyin",['name'=>'搜狗','num'=>0,'time'=>$currnetTime,'zhizhu_num'=>$sougou]);
    	}else{
    	    $wpdb->update($wpdb->prefix . 'baiduseo_zhizhu_suoyin',['zhizhu_num'=>$sougou],['id'=>$suoyin4[0]["id"]]);
    	}
    	$suoyin5 = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu_suoyin where unix_timestamp(time) >=%d and unix_timestamp(time)<%d and name="谷歌"  ',$sta,$end),ARRAY_A);
    
    	$guge= $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_zhizhu  where name="谷歌" and unix_timestamp(time) >=%d and unix_timestamp(time)<%d',$sta,$end));
    	
    	if(empty($suoyin5)){
    	    $wpdb->insert($wpdb->prefix."baiduseo_zhizhu_suoyin",['name'=>'谷歌','num'=>0,'time'=>$currnetTime,'zhizhu_num'=>$guge]);
    	}else{
    	    $wpdb->update($wpdb->prefix . 'baiduseo_zhizhu_suoyin',['zhizhu_num'=>$guge],['id'=>$suoyin5[0]["id"]]);
    	}
    	$suoyin6 = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu_suoyin where unix_timestamp(time) >=%d and unix_timestamp(time)<%d and name="神马"  ',$sta,$end),ARRAY_A);
    	
    	$shenma= $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_zhizhu  where name="神马" and unix_timestamp(time) >=%d and unix_timestamp(time)<%d',$sta,$end));
    	
    	if(empty($suoyin6)){
    	    $wpdb->insert($wpdb->prefix."baiduseo_zhizhu_suoyin",['name'=>'神马','num'=>0,'time'=>$currnetTime,'zhizhu_num'=>$shenma]);
    	}else{
    	    $wpdb->update($wpdb->prefix . 'baiduseo_zhizhu_suoyin',['zhizhu_num'=>$shenma],['id'=>$suoyin6[0]["id"]]);
    	}
    	$suoyin7 = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu_suoyin where unix_timestamp(time) >=%d and unix_timestamp(time)<%d and name="头条"  ',$sta,$end),ARRAY_A);
    	
    	$toutiao= $wpdb->query($wpdb->prepare('select id from '.$wpdb->prefix . 'baiduseo_zhizhu  where name="头条" and unix_timestamp(time) >=%d and unix_timestamp(time)<%d',$sta,$end));
    	
    	if(empty($suoyin7)){
    	    $wpdb->insert($wpdb->prefix."baiduseo_zhizhu_suoyin",['name'=>'头条','num'=>0,'time'=>$currnetTime,'zhizhu_num'=>$toutiao]);
    	}else{
    	    $wpdb->update($wpdb->prefix . 'baiduseo_zhizhu_suoyin',['zhizhu_num'=>$toutiao],['id'=>$suoyin7[0]["id"]]);
    	}
        $baiduseo_zhizhu = get_option('baiduseo_zhizhu');
    	if(isset($baiduseo_zhizhu['log'])){
            $timezone_offet = get_option( 'gmt_offset');
            if($baiduseo_zhizhu['log']==1){
                $end = strtotime('-7 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zhizhu  where unix_timestamp(time)<%d",$end));
            }elseif($baiduseo_zhizhu['log']==2){
                 $end = strtotime('-15 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zhizhu  where unix_timestamp(time)<%d",$end));
            }elseif($baiduseo_zhizhu['log']==3){
                 $end = strtotime('-30 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zhizhu  where unix_timestamp(time)<%d",$end));
            }elseif($baiduseo_zhizhu['log']==4){
                 $end = strtotime('-90 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zhizhu  where unix_timestamp(time)<%d",$end));
            }elseif($baiduseo_zhizhu['log']==5){
                 $end = strtotime('-180 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zhizhu  where unix_timestamp(time)<%d",$end));
            }elseif($baiduseo_zhizhu['log']==6){
                 $end = strtotime('-3 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zhizhu  where unix_timestamp(time)<%d",$end));
                
            }
    	}
    }
    public function baiduseo_bing(){
        global $wpdb,$baiduseo_wzt_log;
        
        if($baiduseo_wzt_log){
        $log = baiduseo_zz::pay_money();
        global $wp_rewrite;
        if(!$log){
            return;
        }
	    if(!$wp_rewrite){
	       $wp_rewrite = new wp_rewrite();
	    }
        $baidu = get_option('baiduseo_zz');
        $baiduseo_auto = get_option('baiduseo_zz');
        if(!isset($baidu['bing_key']) || !$baidu['bing_key']  ){
            return;
        }else{
            $num = $this->baiduseo_quota($baidu['bing_key']);
        }
        if(!isset($baidu['bing_num']) || !$baidu['bing_num']){
            return;
        }
        if($num>$baidu['bing_num']){
            $num = $baidu['bing_num'];
        }
        if($baidu['bing_num']>=500 && $num>=500){
            $num = 500;
        }
        
         $baiduseo_bing_record = get_option('baiduseo_bing_record');
        if(isset($baiduseo_bing_record['id']) && $baiduseo_bing_record['id']){
            $id = $baiduseo_bing_record['id'];
        }else{
            $id = 1;
        }
        if($num>0){
             if(isset($baiduseo_auto['post_type']) && $baiduseo_auto['post_type']){
            	$article = $wpdb->get_results($wpdb->prepare('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND FIND_IN_SET(`post_type`,%s) and ID>%d order by ID asc limit %d',$baiduseo_auto['post_type'],$id,$num),ARRAY_A);
                $urls = [];
                if(!empty($article)){
                    $ids = end($article)['ID'];
                    foreach($article as $key=>$val){
                        $urls[] = get_permalink($val["ID"]);
                    }
                    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                    $api = 'https://www.bing.com/webmaster/api.svc/json/SubmitUrlbatch?apikey='.$baidu['bing_key'];
                    $http = wp_remote_post($api,array('headers'=>array('Content-Type'=>'text/json; charset=utf-8'),'body'=>json_encode(array('siteUrl'=>sanitize_url($http_type.$_SERVER['HTTP_HOST']),'urlList'=>$urls))));
                    if(is_wp_error($http)){
                        return;
                    }
                    $body = wp_remote_retrieve_body($http);
                    $data = json_decode($body,'true');
                    if(isset($data['ErrorCode'])){
                        return;
                    } 
                     $currnetTime= current_time( 'Y/m/d H:i:s');
                     $baiduseo_auto = get_option('baiduseo_zz');
                     if(isset($baiduseo_auto['bing_log']) && $baiduseo_auto['bing_log']){ 
                        foreach($urls as $key=>$val){
                            $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>1,'type'=>3,'message'=>'']);
                        }
                    }
                    $baiduseo_bing_record = get_option('baiduseo_bing_record');
                    if($num>500){
                        $num = 500;
                    }
                    if($baiduseo_bing_record!==false){
                        $data = $baiduseo_bing_record;
                        $data['num'] = $baiduseo_bing_record['num']+$num;
                        $data['id'] = $ids;
                        $data['remind'] =  $this->baiduseo_quota($baidu['bing_key']);
                        $data['time'] = $currnetTime;
                        update_option('baiduseo_bing_record',$data);
                    }else{
                        $data['num'] = $num;
                        $data['id'] = $ids;
                        $data['time'] =  $currnetTime;
                        $data['remind'] =  $this->baiduseo_quota($baidu['bing_key']);
                        add_option('baiduseo_bing_record',$data);
                    }
                }else{
                    $baiduseo_bing_record['id']=0;
                    $baiduseo_bing_record['remind'] =  $this->baiduseo_quota($baidu['bing_key']);
                    update_option('baiduseo_bing_record',$baiduseo_bing_record);
                }
            }
        }
        $baiduseo_bing_record = get_option('baiduseo_bing_record');
        $num = $this->baiduseo_quota($baidu['bing_key']);
        $baiduseo_auto = get_option('baiduseo_zz');
        if(isset($baiduseo_auto['bing_tag_num']) && $num>$baiduseo_auto['bing_tag_num']){
            $num = $baiduseo_auto['bing_tag_num'];
        }
        if(isset($baiduseo_auto['bing_tag_num']) &&  $baiduseo_auto['bing_tag_num']>=500 && $num>=500){
            $num = 500;
        }
        
        if(isset($baiduseo_auto['post_type']) && $baiduseo_auto['post_type']){
           
            if(isset($baiduseo_bing_record['tag_id']) && $baiduseo_bing_record['tag_id']){
                $tag_id =$baiduseo_bing_record['tag_id'];
            }else{
                $tag_id = 0;
            }
            $tag = $wpdb->get_results($wpdb->prepare('select a.term_id,b.taxonomy from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id  where FIND_IN_SET(`taxonomy`,%s)  and a.term_id>%d limit  %d',$baiduseo_auto['post_type'],$tag_id,$num),ARRAY_A);
          
        
            if(!empty($tag)){
                $urls = [];
                $ids = end($tag)['term_id'];
                foreach($tag as $k=>$v){
                    if($v['taxonomy']=='category'){
                        $urls[] = get_category_link($v['term_id']);
                    }elseif($v['taxonomy']=='post_tag'){
                        $urls[] = get_tag_link($v['term_id']);
                    }else{
                        $term = get_term_by('ID',$v['term_id'],$v['term_id']);
                        if($term){
                            $urls[] = get_term_link($v['term_id'],$v['taxonomy']);
                        }
                    }
                }
                $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                $api = 'https://www.bing.com/webmaster/api.svc/json/SubmitUrlbatch?apikey='.$baidu['bing_key'];
                $http = wp_remote_post($api,array('headers'=>array('Content-Type'=>'text/json; charset=utf-8'),'body'=>json_encode(array('siteUrl'=>sanitize_url($http_type.$_SERVER['HTTP_HOST']),'urlList'=>$urls))));
                if(is_wp_error($http)){
                    return;
                }
                $body = wp_remote_retrieve_body($http);
                $data = json_decode($body,'true');
                if(isset($data['ErrorCode'])){
                    return;
                } 
                 $currnetTime= current_time( 'Y/m/d H:i:s');
                $baiduseo_auto = get_option('baiduseo_zz');
                if(isset($baiduseo_auto['bing_log']) && $baiduseo_auto['bing_log']){ 
                    foreach($urls as $key=>$val){
                        $wpdb->insert($wpdb->prefix . 'baiduseo_zz',['time'=>$currnetTime,'link'=>$val,'ts'=>1,'type'=>3,'message'=>'']);
                    }
                }
                $baiduseo_bing_record = get_option('baiduseo_bing_record');
                if($num>500){
                    $num = 500;
                }
                $ids = end($tag)['term_id'];
                if($baiduseo_bing_record!==false){
                    $data = $baiduseo_bing_record;
                    $data['num'] = $baiduseo_bing_record['num']+count($tag);
                    $data['tag_id'] = $ids;
                    $data['remind'] =  $this->baiduseo_quota($baidu['bing_key']);
                    $data['time'] = $currnetTime;
                    update_option('baiduseo_bing_record',$data);
                }else{
                    $data['num'] = count($tag);
                    $data['tag_id'] = $ids;
                    $data['time'] =  $currnetTime;
                    $data['remind'] =  $this->baiduseo_quota($baidu['bing_key']);
                    add_option('baiduseo_bing_record',$data);
                }
            }else{
                $baiduseo_bing_record = get_option('baiduseo_bing_record');
                $baiduseo_bing_record['tag_id'] = 0;
                update_option('baiduseo_bing_record',$baiduseo_bing_record);
            }
            
        }
        }
    }
     public static function baiduseo_quota($key)
    {
         global $wpdb,$baiduseo_wzt_log;
        if($baiduseo_wzt_log){
         $log = baiduseo_zz::pay_money();
        if(!$log){
            return;
        }
        $api = 'https://www.bing.com/webmaster/api.svc/json/GetUrlSubmissionQuota?siteUrl=%s&apikey=%s';
        $api = sprintf($api,home_url(),$key);
        $http = wp_remote_get($api);
        if(is_wp_error($http)){
            return 0;
        }
        $body = wp_remote_retrieve_body($http);
        if(!$body){
            return 0;
        }
        $data =json_decode($body,true);
        if(!$data){
            return 0;
        }
        if(isset($data['ErrorCode'])){
            return 0;
        }else if(isset($data['d'])){
            return $data['d']['DailyQuota'];
        }
        return 0;
        }
    }
    public function baiduseo_sitemap(){
        global $wp_rewrite;
	    if(!$wp_rewrite){
	       $wp_rewrite = new wp_rewrite();
	    }
       baiduseo_seo::sitemap(1,1);
    }
    public function baiduseo_silian(){
        baiduseo_seo::silian(1);
    }
    public function baiduseo_day(){
         global $wpdb,$baiduseo_wzt_log;
        if($baiduseo_wzt_log){
         $log = baiduseo_zz::pay_money();
        if(!$log){
            return;
        }
	    global $wp_rewrite;
	    if(!$wp_rewrite){
	       $wp_rewrite = new wp_rewrite();
	    }
	    $baiduseo_day_record = get_option('baiduseo_day_record');
	    if($baiduseo_day_record!==false){
	        
	        if(isset($baiduseo_day_record['id']) && $baiduseo_day_record['id']){
	            $id = $baiduseo_day_record['id'];
	        }else{
	            $id = 1;
	        }
	        if($baiduseo_day_record['remind']>0 && $baiduseo_day_record['remind']<10){
                $article = $wpdb->get_results($wpdb->prepare('select ID from '.$wpdb->prefix . 'posts  where  post_status="publish" and post_type="post" AND post_type NOT IN("nav_menu_item","attachment") and ID>%d order by ID asc limit %d',$id,$baiduseo_day_record['remind']),ARRAY_A);
	        }else{
	            $article = $wpdb->get_results($wpdb->prepare('select ID from '.$wpdb->prefix . 'posts  where  post_status="publish" and post_type="post" AND post_type NOT IN("nav_menu_item","attachment") and ID>%d order by ID asc limit 10',$id),ARRAY_A);
	        }
	    }else{
	        $id = 1;
	        $article = $wpdb->get_results($wpdb->prepare('select ID from '.$wpdb->prefix . 'posts  where  post_status="publish" and post_type="post" AND post_type NOT IN("nav_menu_item","attachment") and ID>%d order by ID asc limit 10',$id),ARRAY_A);
	    }
        $urls = [];
        if(!empty($article)){
            $ids = end($article)['ID'];
            foreach($article as $key=>$val){
                $urls[] =  get_permalink($val["ID"]);
        	}
        	baiduseo_zz::bddayts($urls,$ids);
        }else{
            $baiduseo_day_record['id'] = 0;
            update_option('baiduseo_day_record',$baiduseo_day_record);
        }
        }
    }
    public function baiduseo_zz(){
        global $wpdb,$baiduseo_wzt_log;
        if($baiduseo_wzt_log){
         $log = baiduseo_zz::pay_money();
        if(!$log){
            return;
        }
        global $wp_rewrite;
	    if(!$wp_rewrite){
	       $wp_rewrite = new wp_rewrite();
	    }
	    
	    $baiduseo_auto = get_option('baiduseo_zz');
	    if(isset($baiduseo_auto['bdpt_num']) && $baiduseo_auto['bdpt_num']){
	        $bdpt_num = $baiduseo_auto['bdpt_num'];
	    }else{
	        return;
	    }
	    
        $baiduseo_zz_record = get_option('baiduseo_zz_record');
        
        if(isset($baiduseo_auto['post_type']) && $baiduseo_auto['post_type']){
            
            
            if(isset($baiduseo_zz_record['id']) && $baiduseo_zz_record['id']){
                $id =$baiduseo_zz_record['id'];
            }else{
                $id = 0;
            }
            if(isset($baiduseo_zz_record['remind']) && $baiduseo_zz_record['remind']>0 && $baiduseo_zz_record['remind']<$bdpt_num){
        	    $article = $wpdb->get_results($wpdb->prepare('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND FIND_IN_SET(`post_type`,%s) and ID>%d order by ID asc limit %d',$baiduseo_auto['post_type'],$id,$baiduseo_zz_record['remind']),ARRAY_A);
            }else{
                $article = $wpdb->get_results($wpdb->prepare('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND FIND_IN_SET(`post_type`,%s) and ID>%d order by ID asc limit %d',$baiduseo_auto['post_type'],$id,$bdpt_num),ARRAY_A);
            }
            
        	$urls = [];
        	if(!empty($article)){
        	    $ids = end($article)['ID'];
                foreach($article as $key=>$val){
                    $urls[] = get_permalink($val["ID"]);
                }
                if(!empty($urls)){
                    baiduseo_zz::bdts($urls,$ids);
                }
            }else{
                $baiduseo_zz_record['id'] =0;
                update_option('baiduseo_zz_record',$baiduseo_zz_record);
            }
        }
        $baiduseo_zz_record = get_option('baiduseo_zz_record');
        if(isset($baiduseo_auto['post_type']) && $baiduseo_auto['post_type']){
           
            if(isset($baiduseo_zz_record['tag_id']) && $baiduseo_zz_record['tag_id']){
                $tag_id =$baiduseo_zz_record['tag_id'];
            }else{
                $tag_id = 0;
            }
          
            if(isset($baiduseo_zz_record['remind']) &&  $baiduseo_zz_record['remind']>0 && $baiduseo_zz_record['remind']<$bdpt_num){
        	    $tag = $wpdb->get_results($wpdb->prepare('select a.term_id,b.taxonomy from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id  where FIND_IN_SET(`taxonomy`,%s)  and a.term_id>%d limit  %d',$baiduseo_auto['post_type'],$tag_id,$baiduseo_zz_record['remind']),ARRAY_A);
            }else{
                $tag = $wpdb->get_results($wpdb->prepare('select a.term_id,b.taxonomy from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id  where FIND_IN_SET(`taxonomy`,%s)  and a.term_id>%d limit  %d',$baiduseo_auto['post_type'],$tag_id,$bdpt_num),ARRAY_A);
            }
            if(!empty($tag)){
                $urls = [];
                $ids = end($tag)['term_id'];
                foreach($tag as $k=>$v){
                    
                    if($v['taxonomy']=='category'){
                        $urls[] = get_category_link($v['term_id']);
                    }elseif($v['taxonomy']=='post_tag'){
                        $urls[] = get_tag_link($v['term_id']);
                    }else{
                        $term = get_term_by('ID',$v['term_id'],$v['term_id']);
                        if($term){
                            $urls[] = get_term_link($v['term_id'],$v['taxonomy']);
                        }
                    }
                }
                if(!empty($urls)){
                    baiduseo_zz::bdts($urls,0,$ids);
                }
            }else{
                $baiduseo_zz_record = get_option('baiduseo_zz_record');
                $baiduseo_zz_record['tag_id'] = 0;
                $ids = 0;
                update_option('baiduseo_zz_record',$baiduseo_zz_record);
            }
            
        }
        }
	    
    }
    public function baiduseo_tongji(){
        $BaiduSEO_tongji = get_option('BaiduSEO_tongji');
        if(!$BaiduSEO_tongji || (isset($BaiduSEO_tongji) && $BaiduSEO_tongji['time']<time()) ){
            $wp_version =  get_bloginfo('version');
            $data =  baiduseo_common::baiduseo_url(0);
        	$url = "http://wp.seohnzz.com/api/baiduseo/index?url={$data}&type=1&url1=".md5($data.'seohnzz.com')."&theme_version=".BAIDUSEO_VERSION."&php_version=".PHP_VERSION."&wp_version={$wp_version}";
        	$defaults = array(
                'timeout' => 4000,
                'connecttimeout'=>4000,
                'redirection' => 3,
                'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
                'sslverify' => FALSE,
            );
            $result = wp_remote_get($url,$defaults);
            if($BaiduSEO_tongji!==false){
                update_option('BaiduSEO_tongji',['time'=>time()+7*3600*24]);
            }else{
                add_option('BaiduSEO_tongji',['time'=>time()+7*3600*24]);
            }
        }
    }
    public function baiduseo_clear_log(){
        
        global $wpdb;
        $timezone_offet = get_option( 'gmt_offset');
        $baiduseo_auto = get_option('baiduseo_zz');
        
        if(isset($baiduseo_auto['bd_log'])){
            if($baiduseo_auto['bd_log']==1){
                $end = strtotime('-1 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=1",$end));
            }elseif($baiduseo_auto['bd_log']==2){
                 $end = strtotime('-3 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=1",$end));
            }elseif($baiduseo_auto['bd_log']==3){
                 $end = strtotime('-7 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=1",$end));
            }
    	}
    	if(isset($baiduseo_auto['bdks_log'])){
            if($baiduseo_auto['bdks_log']==1){
                $end = strtotime('-1 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=2",$end));
            }elseif($baiduseo_auto['bdks_log']==2){
                 $end = strtotime('-3 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=2",$end));
            }elseif($baiduseo_auto['bdks_log']==3){
                 $end = strtotime('-7 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=2",$end));
            }
    	}
    	if(isset($baiduseo_auto['bing_log'])){
            if($baiduseo_auto['bing_log']==1){
                $end = strtotime('-1 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=3",$end));
            }elseif($baiduseo_auto['bing_log']==2){
                 $end = strtotime('-3 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=3",$end));
            }elseif($baiduseo_auto['bing_log']==3){
                 $end = strtotime('-7 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=3",$end));
            }
    	}
        if(isset($baiduseo_auto['shenma_log'])){
            if($baiduseo_auto['shenma_log']==1){
                $end = strtotime('-1 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=4",$end));
            }elseif($baiduseo_auto['shenma_log']==2){
                 $end = strtotime('-3 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=4",$end));
            }elseif($baiduseo_auto['shenma_log']==3){
                 $end = strtotime('-7 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=4",$end));
            }
    	}
    	if(isset($baiduseo_auto['indexNow_log'])){
            if($baiduseo_auto['indexNow_log']==1){
                $end = strtotime('-1 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=5",$end));
            }elseif($baiduseo_auto['indexNow_log']==2){
                 $end = strtotime('-3 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=5",$end));
            }elseif($baiduseo_auto['indexNow_log']==3){
                 $end = strtotime('-7 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=5",$end));
            }
    	}
    	if(isset($baiduseo_auto['guge_log'])){
            if($baiduseo_auto['guge_log']==1){
                $end = strtotime('-1 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=6",$end));
            }elseif($baiduseo_auto['guge_log']==2){
                 $end = strtotime('-3 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=6",$end));
            }elseif($baiduseo_auto['guge_log']==3){
                 $end = strtotime('-7 days')-$timezone_offet*3600;
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "baiduseo_zz  where unix_timestamp(time)<%d and type=6",$end));
            }
    	}
    }
    
}
?>