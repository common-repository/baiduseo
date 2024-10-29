<?php
class baiduseo_tag{
    public function init(){
        if(is_admin()){
            global $wpdb;
            $charset_collate = '';
            if (!empty($wpdb->charset)) {
              $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
            }
            if (!empty( $wpdb->collate)) {
              $charset_collate .= " COLLATE {$wpdb->collate}";
            }
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            if($wpdb->get_var("show tables like '{$wpdb->prefix}baiduseo_neilian'") !=  $wpdb->prefix."baiduseo_neilian"){
                $sql15 = "CREATE TABLE " . $wpdb->prefix . "baiduseo_neilian   (
                    id bigint NOT NULL AUTO_INCREMENT,
                    keywords varchar(255) NOT NULL ,
                    link varchar(255) NOT NULL ,
                    target bigint NOT NULL DEFAULT 0,
                    nofollow bigint NOT NULL DEFAULT 0,
                    sort int DEFAULT 0,
                    UNIQUE KEY id (id)
                ) $charset_collate;";
                dbDelta($sql15);
            }
             $sql3 = 'Describe '.$wpdb->prefix.'baiduseo_neilian sort' ;
            $res = $wpdb->query($sql3);
            
            if($res){
                 
            }else{
               $wpdb->query(' ALTER TABLE '.$wpdb->prefix.'baiduseo_neilian ADD COLUMN `sort` int DEFAULT 0');
            }
            
            if($wpdb->get_var("show tables like '{$wpdb->prefix}baiduseo_long'") !=  $wpdb->prefix."baiduseo_long"){
                $sql16 = "CREATE TABLE " . $wpdb->prefix . "baiduseo_long   (
                    id bigint NOT NULL AUTO_INCREMENT,
                    keywords varchar(255) NOT NULL ,
                    total bigint NOT NULL DEFAULT 0 ,
                    longs bigint NOT NULL DEFAULT 0,
                    collect bigint NOT NULL DEFAULT 0,
                    bidword bigint NOT NULL DEFAULT 0,
                    link varchar(255) NUll,
                    time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    guo timestamp NULL,
                    size varchar(255) NOT NULL default '',
                    UNIQUE KEY id (id)
                ) $charset_collate;";
                // var_dump($sql16);exit;
                dbDelta($sql16);
            }
        }
    }
    public static function baiduseo_tag_set($data){
        $data1['link'] = (int)$data['link'];   
        $data1['auto'] = (int)$data['auto'];  
        $data1['bold'] = (int)$data['bold'];  
        $data1['color'] = sanitize_text_field($data['color']);  
        $data1['num'] = (int)$data['num'];
        $data1['pp'] = (int)$data['pp'];
        $data1['nlnum'] = (int)$data['nlnum'];
        $data1['bqgl'] = sanitize_text_field($data['bqgl']);
        if(isset($data['hremove'])){
            $data1['hremove'] = (int)$data['hremove'];
        }else{
            $data1['hremove'] = 0;
        }
        $seo_init = get_option('baiduseo_tag');
        if($seo_init!==false){
        	$res = update_option('baiduseo_tag',$data1);
        }else{
        	$res = add_option('baiduseo_tag',$data1);
    	} 
    	
    	echo json_encode(['msg'=>'保存成功','code'=>1]);exit;
    	
    }
    public static function auto_tag(){
        $baiduseo_tag_manage = get_option('baiduseo_tag');
        if(!isset($baiduseo_tag_manage['num']) || !$baiduseo_tag_manage['num'] || $baiduseo_tag_manage['num']==11){
            // $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms',ARRAY_A);
            $tags = $wpdb->get_results('select a.* from '.$wpdb->prefix .'terms as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_id=b.term_id where b.taxonomy="post_tag" ',ARRAY_A);
            foreach($tags as $k=>$v){
                 if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                        if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',get_post($post_ID)->post_content,$matches))
                		{
                			$res = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id=%d',$v['term_id']),ARRAY_A);
                			if($res){
                				$re = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where object_id='.$post_ID.' and term_taxonomy_id=%d',$res[0]['term_taxonomy_id']),ARRAY_A);
                				if(!$re){
                					$wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$post_ID,'term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                					$term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d',$res[0]['term_taxonomy_id']),ARRAY_A);
                				
                	                $count = $term_taxonomy[0]['count']+1;
                	                $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                				}
                			}
                		}
                 }else{
                        if(preg_match('{(?!((<.*?)|(<a.*?)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',get_post($post_ID)->post_content,$matches))
                		{
                			$res = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id=%d',$v['term_id']),ARRAY_A);
                			if($res){
                				$re = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_relationships where object_id='.$post_ID.' and term_taxonomy_id=%d',$res[0]['term_taxonomy_id']),ARRAY_A);
                				if(!$re){
                					$wpdb->insert($wpdb->prefix."term_relationships",['object_id'=>$post_ID,'term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                					$term_taxonomy = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where  term_taxonomy_id=%d',$res[0]['term_taxonomy_id']),ARRAY_A);
                				
                	                $count = $term_taxonomy[0]['count']+1;
                	                $res = $wpdb->update($wpdb->prefix . 'term_taxonomy',['count'=>$count],['term_taxonomy_id'=>$res[0]['term_taxonomy_id']]);
                				}
                			}
                		}
                 }
        	 
            }
        }else{
            $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d',$post_ID));
                if($shu<$baiduseo_tag_manage['num']){
                    $tags=$wpdb->get_results('select * from '.$wpdb->prefix . 'terms',ARRAY_A);
                    foreach($tags as $k=>$v){
                        
                        $shu = $wpdb->query($wpdb->prepare('select * from '.$wpdb->prefix .'term_relationships as a left join '.$wpdb->prefix .'term_taxonomy as b on a.term_taxonomy_id=b.term_taxonomy_id where b.taxonomy="post_tag" and a.object_id=%d',$post_ID));
                       
                        if($shu<$baiduseo_tag_manage['num']){
                            if(isset($baiduseo_tag_manage['hremove']) && $baiduseo_tag_manage['hremove']==1){
                                if(preg_match('{(?!((<.*?)|(<a.*?)|(<h[1-6].*?>)))('.baiduseo_tag::BaiduSEO_preg($v['name']).')(?!(([^<>]*?)>)|([^>]*?<\/a>))}i',get_post($post_ID)->post_content,$matches))
                        		{
                        			$res = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id=%d',$v['term_id']),ARRAY_A);
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
                        			$res = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'term_taxonomy where taxonomy="post_tag" and term_id=%d',$v['term_id']),ARRAY_A);
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
    public static function pay_money(){
        $baiduseo_wzt_log = get_option('baiduseo_wzt_log');
        if(!$baiduseo_wzt_log){
            return 0;
        }
        $data =  baiduseo_common::baiduseo_url(0);
    	$url = "https://www.rbzzz.com/api/money/pay_money?url={$data}&type=1";
    	$defaults = array(
            'timeout' =>4000,
            'connecttimeout'=>4000,
            'redirection' => 3,
            'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
            'sslverify' => FALSE,
        );
    	$result = wp_remote_get($url,$defaults);
    	if(!is_wp_error($result)){
            $content = wp_remote_retrieve_body($result);
        	$content = json_decode($content,true);
        	if(isset($content['status']) && $content['status']==1){
        	    return 1;
        	}
    	}else{
    	    return 0;
    	}
    }
    public static function BaiduSEO_preg($str)
    {
        $str=strtolower(trim($str));
    	$replace=array('\\','*','?','[','^',']','$','(',')','{','}','=','!','<','>','|',':','-',';','\'','\"','/','&','_','`');
        $str = str_replace($replace,'',$str);
        $str = str_replace('+','\+',$str);
         $str = str_replace('%','\%',$str);
        return $str;
    }
}
?>