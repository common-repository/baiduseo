<?php
class baiduseo_youhua{
    public function init(){
        $baiduseo_youhua = get_option('baiduseo_youhua');
        if(isset($baiduseo_youhua['thumb']) && $baiduseo_youhua['thumb']){
            $this->baiduseo_thumb();
        }
        if(isset($baiduseo_youhua['head_dy']) && $baiduseo_youhua['head_dy']){
            $this->baiduseo_head_dy();
        }
        if(isset($baiduseo_youhua['xml_rpc']) && $baiduseo_youhua['xml_rpc']){
            $this->baiduseo_xml_rpc();
        }
        if(isset($baiduseo_youhua['feed']) && $baiduseo_youhua['feed']){
            $this->baiduseo_feed();
        }
        if(isset($baiduseo_youhua['post_thumb']) && $baiduseo_youhua['post_thumb']){
            $this->baiduseo_post_thumb();
        }
        if(isset($baiduseo_youhua['gravatar']) && $baiduseo_youhua['gravatar']){
            $this->baiduseo_gravatar();
        }
        if(isset($baiduseo_youhua['lan']) && $baiduseo_youhua['lan']){
            $this->baiduseo_lan();
        }
        if(isset($baiduseo_youhua['category']) && $baiduseo_youhua['category']){
            $this->baiduseo_category();
        }
    }
     public function baiduseo_thumb(){
        add_filter('pre_option_thumbnail_size_w',	'__return_zero');
    	add_filter('pre_option_thumbnail_size_h',	'__return_zero');
    	add_filter('pre_option_medium_size_w',		'__return_zero');
    	add_filter('pre_option_medium_size_h',		'__return_zero');
    	add_filter('pre_option_large_size_w',		'__return_zero');
    	add_filter('pre_option_large_size_h',		'__return_zero');
    }
    public function baiduseo_head_dy(){
        remove_action( 'wp_head', 'feed_links', 2 ); //移除feed
    	remove_action( 'wp_head', 'feed_links_extra', 3 ); //移除feed
    	remove_action( 'wp_head', 'rsd_link' ); //移除离线编辑器开放接口
    	remove_action( 'wp_head', 'wlwmanifest_link' );  //移除离线编辑器开放接口
    	remove_action( 'wp_head', 'index_rel_link' );//去除本页唯一链接信息
    	remove_action('wp_head', 'parent_post_rel_link', 10, 0 );//清除前后文信息
    	remove_action('wp_head', 'start_post_rel_link', 10, 0 );//清除前后文信息
    	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    	remove_action( 'wp_head', 'locale_stylesheet' );
    	// remove_action('publish_future_post','check_and_publish_future_post',10, 1 );
    	remove_action( 'wp_head', 'noindex', 1 );
    	remove_action( 'wp_head', 'wp_generator' ); //移除WordPress版本
    	remove_action( 'wp_head', 'rel_canonical' );
    	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
    	remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
    }
    public function baiduseo_xml_rpc(){
        add_filter( 'xmlrpc_methods', [$this,'baiduseo_remove_xmlrpc_pingback_ping'] );
        
    }
    public function baiduseo_remove_xmlrpc_pingback_ping( $methods ) {
    	unset( $methods['pingback.ping'] );
    	return $methods;
    }
    public function baiduseo_feed(){
    	add_action('do_feed', [$this,'baiduseo_digwp_disable_feed'], 1);
    	add_action('do_feed_rdf', [$this,'baiduseo_digwp_disable_feed'], 1);
    	add_action('do_feed_rss', [$this,'baiduseo_digwp_disable_feed'], 1);
    	add_action('do_feed_rss2', [$this,'baiduseo_digwp_disable_feed'], 1);
    	add_action('do_feed_atom', [$this,'baiduseo_digwp_disable_feed'], 1);
    }
    public function baiduseo_digwp_disable_feed(){
        wp_die('<h1>Feed已经关闭, 请访问网站<a href="'.get_bloginfo('url').'">首页</a>!</h1>');
    }
    public function baiduseo_post_thumb(){
        add_action('before_delete_post', [$this,'baiduseo_delete_post_and_attachments']);
    }
    public function baiduseo_delete_post_and_attachments($post_ID){
        global $wpdb;
            //删除特色图片
            $thumbnails = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE meta_key = '_thumbnail_id' AND post_id = %d",$post_ID));
            foreach ( $thumbnails as $thumbnail ) {
            wp_delete_attachment( $thumbnail->meta_value, true );
            }
            //删除图片附件
            $attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'attachment'",$post_ID));
            foreach ( $attachments as $attachment ) {
            wp_delete_attachment( $attachment->ID, true );
            }
            $wpdb->query($wpdb->prepare("DELETE FROM $wpdb->postmeta WHERE meta_key = '_thumbnail_id' AND post_id = %d",$post_ID));
    }
    public function baiduseo_gravatar(){
        add_filter( 'get_avatar', function ($avatar) {
    		return '';
    	}, 10, 3 );
    }
    public function baiduseo_lan(){
        add_filter( 'locale', [$this,'baiduseo_language'] );
    }
    public function baiduseo_language($locale) {
		$locale = ( is_admin() ) ? $locale : 'en_US';
		return $locale;
	}
	public function baiduseo_category(){
	    register_activation_hook(__FILE__,    [$this,'baiduseo_refresh_rules']);
        register_deactivation_hook(__FILE__,  [$this,'baiduseo_deactivate']);
        
        /* actions */
        add_action('created_category',  [$this,'baiduseo_refresh_rules']);
        add_action('delete_category',   [$this,'baiduseo_refresh_rules']);
        add_action('edited_category',   [$this,'baiduseo_refresh_rules']);
        add_action('init',              [$this,'baiduseo_permastruct']);
        
        /* filters */
        add_filter('category_rewrite_rules', [$this,'baiduseo_rewrite_rules']);
        add_filter('query_vars',             [$this,'baiduseo_query_vars']);    // Adds 'category_redirect' query variable
        add_filter('request',                [$this,'baiduseo_request']);
	}
	function baiduseo_refresh_rules() {
    	global $wp_rewrite;
    	$wp_rewrite->flush_rules();
    }
    public function baiduseo_deactivate(){
        remove_filter( 'category_rewrite_rules', [$this,'baiduseo_rewrite_rules']); 
	    $this->baiduseo_refresh_rules();
    }
    public function baiduseo_permastruct()
    {
    	global $wp_rewrite;
    	global $wp_version;
    
    	if ( $wp_version >= 3.4 ) {
    		$wp_rewrite->extra_permastructs['category']['struct'] = '%category%';
    	} else {
    		$wp_rewrite->extra_permastructs['category'][0] = '%category%';
    	}
    }
    public function baiduseo_query_vars($public_query_vars) {
    	$public_query_vars[] = 'category_redirect';
    	return $public_query_vars;
    }
    function baiduseo_rewrite_rules($category_rewrite) {
    	global $wp_rewrite;
    	$category_rewrite=array();
    
    	/* WPML is present: temporary disable terms_clauses filter to get all categories for rewrite */
    	if ( class_exists( 'Sitepress' ) ) {
    		global $sitepress;
    
    		remove_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ) );
    		$categories = get_categories( array( 'hide_empty' => false ) );
    		//Fix provided by Albin here https://wordpress.org/support/topic/bug-with-wpml-2/#post-8362218
    		//add_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ) );
    		add_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ), 10, 4 );
    	} else {
    		$categories = get_categories( array( 'hide_empty' => false ) );
    	}
    
    	foreach( $categories as $category ) {
    		$category_nicename = $category->slug;
    
    		if ( $category->parent == $category->cat_ID ) {
    			$category->parent = 0;
    		} elseif ( $category->parent != 0 ) {
    			$category_nicename = get_category_parents( $category->parent, false, '/', true ) . $category_nicename;
    		}
    
    		$category_rewrite['('.$category_nicename.')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
    		$category_rewrite["({$category_nicename})/{$wp_rewrite->pagination_base}/?([0-9]{1,})/?$"] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
    		$category_rewrite['('.$category_nicename.')/?$'] = 'index.php?category_name=$matches[1]';
    	}
    
    	// Redirect support from Old Category Base
    	$old_category_base = get_option( 'category_base' ) ? get_option( 'category_base' ) : 'category';
    	$old_category_base = trim( $old_category_base, '/' );
    	$category_rewrite[$old_category_base.'/(.*)$'] = 'index.php?category_redirect=$matches[1]';
    	return $category_rewrite;
    }
    public function baiduseo_request($query_vars) {
    	if( isset( $query_vars['category_redirect'] ) ) {
    		$catlink = trailingslashit( get_option( 'home' ) ) . user_trailingslashit( $query_vars['category_redirect'], 'category' );
    		status_header( 301 );
    		header( "Location: $catlink" );
    		exit();
    	}
    	return $query_vars;
    }
    public static  function BaiduSEO_keywords($keywords){
        global $wpdb;
    	$keywords = json_decode($keywords,true);
    	$type = isset($keywords[0]['type'])?$keywords[0]['type']:0;
    	$res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_keywords where keywords=%s and type=%d',$keywords[0]['keywords'],$type),ARRAY_A);
    	$wpdb->update($wpdb->prefix . 'baiduseo_keywords',['time'=>$keywords[0]['time'],'title'=>$keywords[0]['title'],'num'=>$keywords[0]['num'],'prev'=>$res[0]['num']],['id'=>$res[0]['id']]);
    }
    public static function post($data){
        if($data['BaiduSEO']==17){
            baiduseo_youhua::BaiduSEO_keywords(sanitize_text_field($data['keywords']));
        }elseif($data['BaiduSEO']==37){
            $wyc =$data['wyc'];
            $post_extend = get_post_meta( (int)$wyc['wp_id'], 'baiduseo', true );
            if($post_extend){
                
                update_post_meta( (int)$wyc['wp_id'],'baiduseo',  ['content_edit'=>wp_kses_post($wyc['content_edit']),'status'=>1,'yc'=>(int)$wyc['yc'],'num'=>(int)$wyc['num'],'addtime'=>sanitize_text_field($wyc['endtime']),'hyc'=>(int)$wyc['hyc'],'gx_status'=>(int)$wyc['gx_status'],'kouchu'=>sanitize_text_field($wyc['kouchu']),'tjtime'=>$post_extend['tjtime']] ); 
                
            }else{
                
                add_post_meta((int)$wyc['wp_id'],'baiduseo',['content_edit'=>wp_kses_post($wyc['content_edit']),'status'=>1,'yc'=>(int)$wyc['yc'],'num'=>(int)$wyc['num'],'addtime'=>sanitize_text_field($wyc['endtime']),'hyc'=>(int)$wyc['hyc'],'gx_status'=>(int)$wyc['gx_status'],'kouchu'=>sanitize_text_field($wyc['kouchu'])] );
                
            }
        }elseif($data['BaiduSEO']==41){
            $content = $data['content'];
            $id = (int)$data['wp_id'];
            global $wpdb;
            $wpdb->update($wpdb->prefix . 'posts',['post_content'=>wp_kses_post($content)],['id'=>$id]);
        }elseif($data['BaiduSEO']==44){
            global $wpdb;
        	$keywords = $data['keywords'];
        	
        	$res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_kp where keywords=%s and type=%d',sanitize_text_field($keywords['keywords']),(int)$keywords['type']),ARRAY_A);
        	if(!empty($res)){
        	    $wpdb->update($wpdb->prefix . 'baiduseo_kp',$keywords,['id'=>$res[0]['id']]);
        	}else{
        	    $wpdb->insert($wpdb->prefix . 'baiduseo_kp',$keywords);
        	}
        }elseif($data['BaiduSEO']==45){
            global $wpdb;
        	$keywords = $data['keywords'];
        	$res = $wpdb->get_results($wpdb->prepare(' select * from  '.$wpdb->prefix.'baiduseo_kp_log where orderno=%d ',(int)$keywords['orderno']),ARRAY_A);
        	if(!empty($res)){
        	}else{
        	    $wpdb->insert($wpdb->prefix."baiduseo_kp_log",$keywords);
        	}
        }elseif($data['BaiduSEO']==46){
            global $wpdb;
            $daochu = $data['daochu'];
            $wpdb->update($wpdb->prefix . 'baiduseo_long',['link'=>$daochu['link'],'guo'=>$daochu['guo'],'size'=>$daochu['size']],['keywords'=>$daochu['keywords']]);
        }elseif($data['BaiduSEO']==47){
            $key = baiduseo_common::baiduseo_tongxun();
            if($key==$data['key']){
                echo json_encode(['code'=>1,'version'=>BAIDUSEO_VERSION]);exit;
            }else{
                echo json_encode(['code'=>0,'version'=>BAIDUSEO_VERSION]);exit;
            }
        }elseif($data['BaiduSEO']==48){
            $args=array(
            'orderby' => 'name',
            'hide_empty' => false, //显示所有分类
            'order' => 'ASC'
            );
            $categories=get_categories($args);
            echo json_encode(['code'=>1,'cate'=>$categories]);exit;
        }elseif($data['BaiduSEO']==49){
            global $wp_rewrite,$wp_filesystem;
            if (null === $wp_rewrite) {
                $wp_rewrite = new WP_Rewrite();
            }
            require_once(ABSPATH . 'wp-includes/pluggable.php');
            
            global $wpdb;
            //查重
            if($data['is_chachong']==1){
              $article = $wpdb->get_results($wpdb->prepare('select ID from '.$wpdb->prefix . 'posts where post_title="%s" and post_status="publish" and post_type="post"',$data['title']),ARRAY_A);
                if(!empty($article)){
                    exit;  
                }
            }
            
           
            if($data['img']){
                
                $attach_id = self::download_remote_image_to_media_library($data['img']);
               
                if($data['is_tuku_header']){
                    $image_html = wp_get_attachment_image($attach_id, 'full',false,array( 'class' => 'aligncenter' ));
                   
                    $data['con'] = '<div>'.$image_html.'</div>'.$data['con'];
                }
                if($data['is_tuku_footer']){
                    $attach_id1 = self::download_remote_image_to_media_library($data['img1']);
                    $image_html = wp_get_attachment_image($attach_id1, 'full',false,array( 'class' => 'aligncenter' ));
                    $data['con'] = $data['con'].'<div>'.$image_html.'</div>';
                }
                
                 $my_post = array(
                    'post_title' => $data['title'],
                    'post_content' => $data['con'],
                    'post_status' => 'publish',
                    'post_category' => array($data['cate']),
                    'post_author'=>$data['author']
                   
                );
                $id = wp_insert_post($my_post,0);
                if($data['is_tese']){
                    
                    set_post_thumbnail($id, $attach_id);
                }
                if($id){
                    
                   
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }else{
                $my_post = array(
                    'post_title' => $data['title'],
                    'post_content' => $data['con'],
                    'post_status' => 'publish',
                    'post_category' => array($data['cate']),
                    'post_author'=>$data['author']
                   
                );
                $id = wp_insert_post($my_post,0);
                if($id){
                    echo json_encode(['code'=>1]);exit;
                }else{
                    echo json_encode(['code'=>0]);exit;
                }
            }
        }elseif($data['BaiduSEO']==50){
            $args = array(
                'role'    => 'Administrator'
            );
            $administrators = get_users($args);
            $arr = [];
            //只返回id和昵称，不返回敏感信息
            foreach($administrators as $key=>$val){
                $arr[$key]['id'] = $val->ID;
                $arr[$key]['nick'] = $val->user_login;
            }
            echo json_encode(['code'=>1,'data'=>$arr]);exit;
        }
        
    }
    public static function download_remote_image_to_media_library( $image_url ) {
         global $wp_rewrite,$wp_filesystem;
        if (null === $wp_rewrite) {
            $wp_rewrite = new WP_Rewrite();
        }
         // 初始化 WP_Filesystem
        if ( empty( $wp_filesystem ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            WP_Filesystem();
        }
    
        // 下载远程图片
        $response = wp_remote_get( $image_url );
     
    
        // 获取图片内容
        $image_data = wp_remote_retrieve_body( $response );
        
    
        // 计算 MD5 哈希值作为文件名
        $md5_filename = md5( $image_data );
        $file_extension = pathinfo( $image_url, PATHINFO_EXTENSION ); // 获取文件扩展名
        $file_name = $md5_filename . '.' . $file_extension;
    
        // 确定上传目录
        $upload_dir = wp_upload_dir();
        $file_path = trailingslashit( $upload_dir['path'] ) . $file_name;
    
        // 使用 WP_Filesystem 保存图片
         $wp_filesystem->put_contents( $file_path, $image_data, FS_CHMOD_FILE ); 
    
        // 准备附件数据
        $file_type = wp_check_filetype( $file_name, null );
        $attachment = array(
            'post_mime_type' => $file_type['type'],
            'post_title'     => sanitize_file_name( $file_name ),
            'post_content'   => '',
            'post_status'    => 'inherit',
        );
    
        // 插入附件到媒体库
        $attach_id = wp_insert_attachment( $attachment, $file_path );
       
    
        // 生成附件的元数据并更新媒体库
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );
        wp_update_attachment_metadata( $attach_id, $attach_data );
    
        return $attach_id;
    }
    
}