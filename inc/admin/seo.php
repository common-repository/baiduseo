<?php
class baiduseo_seo{
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
            if($wpdb->get_var("show tables like '{$wpdb->prefix}baiduseo_ai_lishi'") !=  $wpdb->prefix."baiduseo_ai_lishi"){
                $sql15 = "CREATE TABLE " . $wpdb->prefix . "baiduseo_ai_lishi   (
                    id bigint NOT NULL AUTO_INCREMENT,
                    hexin varchar(255) NOT NULL ,
                    guangjianci varchar(255) NOT NULL,
                    riqi timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    neirong text,
                    jifen varchar(255) DEFAULT -0.35,
                    UNIQUE KEY id (id)
                ) $charset_collate;";
                dbDelta($sql15);
            }
            $sql3 = 'Describe '.$wpdb->prefix.'baiduseo_ai_lishi jifen';
            $res = $wpdb->query($sql3);
            
            if($res){
                 
            }else{
               $wpdb->query(' ALTER TABLE '.$wpdb->prefix.'baiduseo_ai_lishi ADD COLUMN `jifen` varchar(255) DEFAULT "-0.35"');
            }
         }
    }
    public static function seo_index($key,$des){
        $seo_init = get_option('seo_init');
        if($seo_init!==false){
        	update_option('seo_init',['keywords'=>$key,'description'=>$des]);
        }else{
        	add_option('seo_init',['keywords'=>$key,'description'=>$des]);
    	}  
    }
    public static function sanitizing_json($data){
        $arr = [];
        $data = json_decode($data,true);
       
        if(is_array($data)){
            $BaiduSEO = (int)$data['BaiduSEO'];
           
            switch ($BaiduSEO) {
                case 17:
                    $arr['BaiduSEO'] = 17;
                    $data['keywords'] = json_decode(sanitize_text_field($data['keywords']),true);
                    $arr['keywords'] = json_encode([0=>['type'=>(int)$data['keywords'][0]['type'],'keywords'=> sanitize_text_field($data['keywords'][0]['keywords']),'time'=>sanitize_text_field($data['keywords'][0]['time']),'title'=>sanitize_text_field($data['keywords'][0]['title']),'num'=>(int)$data['keywords'][0]['num'],'prev'=>$data['keywords'][0]['prev']]]);
                    break;
                case 37:
                    $arr['BaiduSEO'] = 37;
                   
                    $arr['wyc'] = [
                        'wp_id'=>(int)$data['wyc']['wp_id'],
                        'content_edit'=>wp_kses_post($data['wyc']['content_edit']),
                        'yc'=>(int)$data['wyc']['yc'],
                        'num'=>(int)$data['wyc']['num'],
                        'endtime'=>sanitize_text_field($data['wyc']['endtime']),
                        'hyc'=>(int)$data['wyc']['hyc'],
                        'gx_status'=>(int)$data['wyc']['gx_status'],
                        'kouchu'=>sanitize_text_field($data['wyc']['kouchu']),
                    ];
                    break;
                case 41:
                    $arr['BaiduSEO'] = 41;
                    $arr['wp_id'] = $data['wp_id'];
                    $arr['content'] = wp_kses_post($data['content']);
                    break;
                case 44:
                    $arr['BaiduSEO'] = 44;
                    $arr['keywords']=[
                        'keywords'=>sanitize_text_field($data['keywords']['keywords']),  
                        'type'=>(int)$data['keywords']['type'],
                        'time'=>sanitize_text_field($data['keywords']['time']),
                        'check_time'=>sanitize_text_field($data['keywords']['check_time']),
                        'delete_time'=>sanitize_text_field($data['keywords']['delete_time']),
                        'chu'=>(int)$data['keywords']['chu'],
                        'news'=>(int)$data['keywords']['news'],
                        'status'=>(int)$data['keywords']['status'],
                        'high'=>(int)$data['keywords']['high'],
                        'high_time'=>sanitize_text_field($data['keywords']['high_time'])
                    ];
                    break;
                case 45:
                    $arr['BaiduSEO'] = 45;
                    $arr['keywords']=[
                        'orderno'=>(int)$data['keywords']['orderno'],   
                        'num'=>sanitize_text_field($data['keywords']['num']),
                        'time'=>sanitize_text_field($data['keywords']['time']),
                        'remark'=>sanitize_text_field($data['keywords']['remark']),
                    ];
                    break;
                case 46:
                    $arr['BaiduSEO'] = 46;
                    $arr['daochu'] = [
                        'link'=>sanitize_url($data['daochu']['link']),
                        'guo'=>sanitize_text_field($data['daochu']['guo']),
                        'keywords'=>sanitize_text_field($data['daochu']['keywords']),
                        'size'=>sanitize_text_field($data['daochu']['size']),
                    ];
                    break;
                case 47:
                    $arr['BaiduSEO'] = 47;
                    $arr['key'] = sanitize_text_field($data['key']);
                    break;
                case 48:
                    $arr['BaiduSEO'] = 48;
                    break;
                case 49:
                    $arr['BaiduSEO'] = 49;
                    $arr['title'] = sanitize_text_field($data['title']);
                    $arr['con'] = sanitize_textarea_field($data['content']);
                    $arr['cate'] = (int)$data['cate'];
                    $arr['is_chachong'] =(int)$data['is_chachong'];
                    $arr['is_tese'] =isset($data['is_tese'])?(int)$data['is_tese']:0;
                    $arr['is_tuku_header'] =isset($data['is_tuku_header'])?(int)$data['is_tuku_header']:0;
                    $arr['is_tuku_footer'] =isset($data['is_tuku_footer'])?(int)$data['is_tuku_footer']:0;
                    $arr['img'] = isset($data['img'])?sanitize_url($data['img']):'';
                    $arr['img1'] = isset($data['img1'])?sanitize_url($data['img1']):'';
                    $arr['author'] =  (int)$data['author'];
                    break;
                case 50:
                    $arr['BaiduSEO'] = 50;
                    break;
                default:
                    return 0;
                    break;
            }
            
            return $arr;
        }else{
            return 0;
        }
    }
    public static function cate_seo($key,$des,$cate){
        $seo_init = get_option('baiduseo_cate_'.$cate);
		$seo = ['keywords'=>$key,'description'=>$des];   
        if($seo_init!==false){
        	update_option('baiduseo_cate_'.$cate,$seo);
        }else{
        	add_option('baiduseo_cate_'.$cate,$seo);
    	} 
    }
    public static function page_seo($key,$des,$page){
        $baiduseo_page = get_post_meta( $page, 'baiduseo_page', true );
        $seo = ['keywords'=>$key,'description'=>$des]; 
        update_post_meta($page,'baiduseo_page',$seo);
        
    }
    public static function page_404(){
        WP_Filesystem();
        global $wp_filesystem;
       
        $wp_filesystem->put_contents( ABSPATH .'/404.html','<!DOCTYPE html>
            <html>
            <head>
            <meta charset="UTF-8">
            <title>System Error404</title>
            <meta name="robots" content="noindex,nofollow" />
            <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
            <style>
                    /* Base */
                    body {
                        color: #333;
                        font: 14px Verdana, "Helvetica Neue", helvetica, Arial, "Microsoft YaHei", sans-serif;
                        margin: 0;
                        padding: 0 20px 20px;
                        word-break: break-word;
                    }
                    h1{
                        margin: 10px 0 0;
                        font-size: 28px;
                        font-weight: 500;
                        line-height: 32px;
                    }
                    h2{
                        color: #4288ce;
                        font-weight: 400;
                        padding: 6px 0;
                        margin: 6px 0 0;
                        font-size: 18px;
                        border-bottom: 1px solid #eee;
                    }
                    h3.subheading {
                        color: #4288ce;
                        margin: 6px 0 0;
                        font-weight: 400;
                    }
                    h3{
                        margin: 12px;
                        font-size: 16px;
                        font-weight: bold;
                    }
                    abbr{
                        cursor: help;
                        text-decoration: underline;
                        text-decoration-style: dotted;
                    }
                    a{
                        color: #868686;
                        cursor: pointer;
                    }
                    a:hover{
                        text-decoration: underline;
                    }
                    .line-error{
                        background: #f8cbcb;
                    }
            
                    .echo table {
                        width: 100%;
                    }
            
                    .echo pre {
                        padding: 16px;
                        overflow: auto;
                        font-size: 85%;
                        line-height: 1.45;
                        background-color: #f7f7f7;
                        border: 0;
                        border-radius: 3px;
                        font-family: Consolas, "Liberation Mono", Menlo, Courier, monospace;
                    }
            
                    .echo pre > pre {
                        padding: 0;
                        margin: 0;
                    }
                    /* Layout */
                    .col-md-3 {
                        width: 25%;
                    }
                    .col-md-9 {
                        width: 75%;
                    }
                    [class^="col-md-"] {
                        float: left;
                    }
                    .clearfix {
                        clear:both;
                    }
                    @media only screen 
                    and (min-device-width : 375px) 
                    and (max-device-width : 667px) { 
                        .col-md-3,
                        .col-md-9 {
                            width: 100%;
                        }
                    }
                    /* Exception Info */
                    .exception {
                        margin-top: 20px;
                    }
                    .exception .message{
                        padding: 12px;
                        border: 1px solid #ddd;
                        border-bottom: 0 none;
                        line-height: 18px;
                        font-size:16px;
                        border-top-left-radius: 4px;
                        border-top-right-radius: 4px;
                        font-family: Consolas,"Liberation Mono",Courier,Verdana,"微软雅黑";
                    }
            
                    .exception .code{
                        float: left;
                        text-align: center;
                        color: #fff;
                        margin-right: 12px;
                        padding: 16px;
                        border-radius: 4px;
                        background: #999;
                    }
                    .exception .source-code{
                        padding: 6px;
                        border: 1px solid #ddd;
            
                        background: #f9f9f9;
                        overflow-x: auto;
            
                    }
                    .exception .source-code pre{
                        margin: 0;
                    }
                    .exception .source-code pre ol{
                        margin: 0;
                        color: #4288ce;
                        display: inline-block;
                        min-width: 100%;
                        box-sizing: border-box;
                    font-size:14px;
                        font-family: "Century Gothic",Consolas,"Liberation Mono",Courier,Verdana;
                        padding-left: 40px;
                    }
                    .exception .source-code pre li{
                        border-left: 1px solid #ddd;
                        height: 18px;
                        line-height: 18px;
                    }
                    .exception .source-code pre code{
                        color: #333;
                        height: 100%;
                        display: inline-block;
                        border-left: 1px solid #fff;
                    font-size:14px;
                        font-family: Consolas,"Liberation Mono",Courier,Verdana,"微软雅黑";
                    }
                    .exception .trace{
                        padding: 6px;
                        border: 1px solid #ddd;
                        border-top: 0 none;
                        line-height: 16px;
                    font-size:14px;
                        font-family: Consolas,"Liberation Mono",Courier,Verdana,"微软雅黑";
                    }
                    .exception .trace ol{
                        margin: 12px;
                    }
                    .exception .trace ol li{
                        padding: 2px 4px;
                    }
                    .exception div:last-child{
                        border-bottom-left-radius: 4px;
                        border-bottom-right-radius: 4px;
                    }
            
                    /* Exception Variables */
                    .exception-var table{
                        width: 100%;
                        margin: 12px 0;
                        box-sizing: border-box;
                        table-layout:fixed;
                        word-wrap:break-word;            
                    }
                    .exception-var table caption{
                        text-align: left;
                        font-size: 16px;
                        font-weight: bold;
                        padding: 6px 0;
                    }
                    .exception-var table caption small{
                        font-weight: 300;
                        display: inline-block;
                        margin-left: 10px;
                        color: #ccc;
                    }
                    .exception-var table tbody{
                        font-size: 13px;
                        font-family: Consolas,"Liberation Mono",Courier,"微软雅黑";
                    }
                    .exception-var table td{
                        padding: 0 6px;
                        vertical-align: top;
                        word-break: break-all;
                    }
                    .exception-var table td:first-child{
                        width: 28%;
                        font-weight: bold;
                        white-space: nowrap;
                    }
                    .exception-var table td pre{
                        margin: 0;
                    }
            
                    /* Copyright Info */
                    .copyright{
                        margin-top: 24px;
                        padding: 12px 0;
                        border-top: 1px solid #eee;
                    }
            
                    /* SPAN elements with the classes below are added by prettyprint. */
                    pre.prettyprint .pln { color: #000 }  /* plain text */
                    pre.prettyprint .str { color: #080 }  /* string content */
                    pre.prettyprint .kwd { color: #008 }  /* a keyword */
                    pre.prettyprint .com { color: #800 }  /* a comment */
                    pre.prettyprint .typ { color: #606 }  /* a type name */
                    pre.prettyprint .lit { color: #066 }  /* a literal value */
                    /* punctuation, lisp open bracket, lisp close bracket */
                    pre.prettyprint .pun, pre.prettyprint .opn, pre.prettyprint .clo { color: #660 }
                    pre.prettyprint .tag { color: #008 }  /* a markup tag name */
                    pre.prettyprint .atn { color: #606 }  /* a markup attribute name */
                    pre.prettyprint .atv { color: #080 }  /* a markup attribute value */
                    pre.prettyprint .dec, pre.prettyprint .var { color: #606 }  /* a declaration; a variable name */
                    pre.prettyprint .fun { color: red }  /* a function name */
                </style>
            </head>
            <body>
            <div class="echo">
            <script>setTimeout(function (){location.href="/";},2000);</script> </div>
            <div class="exception">
            <div class="info"><h1>404页面提醒您，该页面不存在！</h1></div>
            </div>
            <div class="copyright">
            </div>
            </body>
            </html>' );
        
        $seo_301_404_url = get_option('seo_301_404_url');
		if($seo_301_404_url!=false){
			update_option('seo_301_404_url',['404_url'=>1]);
		}else{
			add_option('seo_301_404_url',['404_url'=>1]);
		}
    }
    public static function robots($roobots){
        $url =trim(get_option('siteurl'),'/').'/robots.txt';   
        $currnetTime= current_time( 'Y/m/d H:i:s');
        $robot = [        				     		 	  	
            'robot'=>$roobots,     			   	     							
            'time'=>$currnetTime,    	 	 			       			 	 
            'url'=>$url,     	   	     			 		 	
        ];    
         WP_Filesystem();
        global $wp_filesystem;
       
        $wp_filesystem->put_contents( ABSPATH .'/robots.txt',$roobots);
        $rootbot = get_option('seo_robots_sc');
	    if($rootbot){
           update_option('seo_robots_sc',$robot); 
        }else{
            add_option('seo_robots_sc',$robot);
        }
    }
    public static function sitemap($page,$two,$tag_sl=0){
        
        ini_set('memory_limit','-1');
        global $wpdb;
        //$two==2后端$two==1前端
        $sitemap = get_option('seo_baidu_sitemap');
        if(!is_array($sitemap)){
            $sitemap = [];
        }
        $currnetTime= current_time( 'Y/m/d H:i:s');
    	$currnetTime1= current_time( 'Y-m-d H:i:s');
    	
    	$art_num = wp_count_posts()->publish;
    	
    	if($art_num>10000){
    	    $sitemap['sitemap_htmlurl'] = [];
    	    $baiduseo_sitemap_num = get_option('baiduseo_sitemap_num');
    	    if($baiduseo_sitemap_num!==false){
    	        $baiduseo_sitemap_num  = $baiduseo_sitemap_num+1;
    	        update_option('baiduseo_sitemap_num',$baiduseo_sitemap_num);
    	    }else{
    	        $baiduseo_sitemap_num =1;
    	        update_option('baiduseo_sitemap_num',$baiduseo_sitemap_num);
    	    }
    	}else{
    	    $sitemap['sitemap_url'] = [];
        	$sitemap['sitemap_htmlurl'] = [];
    	    $baiduseo_sitemap_num=1;
    	}
    	if(is_array($sitemap)){
            $data = $sitemap;
    	}
        $data['time'] = $currnetTime;
       
        if($baiduseo_sitemap_num == 1){
        // 	$data['sitemap_url'] = [];
        // 	$data['sitemap_htmlurl'] = [];
            if(isset($sitemap['tag_open']) && $sitemap['tag_open']==1){
            	$data['sitemap_tag'] = get_option('siteurl'). '/tag.html';
            	if($tag_sl){
            	    $tags = $wpdb->get_results('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit 500',ARRAY_A);
            	}else{
            	    $tags = $wpdb->get_results('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit 9995',ARRAY_A);
            	}
            
            	$html_tag = "<!DOCTYPE html>\n<html>\n<head>\n<meta charset='UTF-8'>\n<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n<style>\nbody {\nbackground-color: #f3f3f3;\n}\nul li {\ndisplay: inline-block;\npadding: 5px 10px;\nmargin: 5px 0px;\nbackground-color: #fff;\nborder-radius: 25px;\n}\n* {\nmargin: 0;\npadding: 0;\n}\na {\ntext-decoration: none;\ncolor: #111;\nfont-weight: 300;\n}\na:hover{\ncolor: skyblue;\n}\n</style>\n</head>\n<body>\n<!-- 官网：www.rbzzz.com(可接定制开发、网站、小程序、公众号、seo/sem优化)交流QQ群：1077537009 客服QQ：1500351892 -->\n<ul>";
            	foreach($tags as $k=>$val){
            	    $html_tag .="<li><a href='".get_tag_link($val["term_id"])."' title='{$val['name']}'>{$val['name']}</a></li>\n";
            	}
            	$html_tag .="</ul>\n</body>\n</html>";
            }
        }
       
        if($baiduseo_sitemap_num>1){
        	$page1 = $baiduseo_sitemap_num-1;
        	$add_address = 0;
        	foreach($data['sitemap_url'] as $key=>$val){
        	    if($val==get_option('siteurl'). '/sitemap'.$page1.'.xml'){
        	        $add_address =1;
        	    }
        	}
        	if($add_address==0){
    	        $data['sitemap_url'][] = get_option('siteurl'). '/sitemap'.$page1.'.xml';
    	        
        	}
        	$data['sitemap_htmlurl'][] = get_option('siteurl').'/sitemap.html';
        }else{
            $add_address1 =0;
            foreach($data['sitemap_url'] as $key=>$val){
        	    if($val==get_option('siteurl'). '/sitemap.xml'){
        	        $add_address1 =1;
        	    }
        	}
        	if($add_address1==0){
        	    $data['sitemap_url'][] = get_option('siteurl'). '/sitemap.xml';
        	}
        	$data['sitemap_htmlurl'][] = get_option('siteurl').'/sitemap.html';
        }
        $data['sitemap_url'] = array_unique($data['sitemap_url']);
        $data['sitemap_htmlurl'] = array_unique($data['sitemap_htmlurl']);
        $start = 9995*($baiduseo_sitemap_num-1);
        if(($sitemap['type1']==1)&&($sitemap['type2']==1)&&($sitemap['type3']==1)&&($sitemap['type4']==1)&&($sitemap['type5']==1)){
            $type = 31;
        }elseif(($sitemap['type1']==1)&&($sitemap['type2']==1)&&($sitemap['type3']==1)&&($sitemap['type4']==1)){
            $type = 30;
        }elseif(($sitemap['type1']==1)&&($sitemap['type2']==1)&&($sitemap['type3']==1)&&($sitemap['type5']==1)){
            $type = 29;
        }elseif(($sitemap['type1']==1)&&($sitemap['type2']==1)&&($sitemap['type5']==1)&&($sitemap['type4']==1)){
            $type = 28;
        }elseif(($sitemap['type1']==1)&&($sitemap['type5']==1)&&($sitemap['type3']==1)&&($sitemap['type4']==1)){
            $type = 27;
        }elseif(($sitemap['type5']==1)&&($sitemap['type2']==1)&&($sitemap['type3']==1)&&($sitemap['type4']==1)){
            $type = 26;
        }elseif(($sitemap['type1']==1)&&($sitemap['type2']==1)&&($sitemap['type3']==1)){
            $type = 25;
        }elseif(($sitemap['type1']==1)&&($sitemap['type2']==1)&&($sitemap['type4']==1)){
            $type = 24;
        }elseif(($sitemap['type1']==1)&&($sitemap['type2']==1)&&($sitemap['type5']==1)){
            $type = 23;
        }elseif(($sitemap['type1']==1)&&($sitemap['type3']==1)&&($sitemap['type4']==1)){
            $type = 22;
        }elseif(($sitemap['type1']==1)&&($sitemap['type3']==1)&&($sitemap['type5']==1)){
            $type = 21;
        }elseif(($sitemap['type1']==1)&&($sitemap['type4']==1)&&($sitemap['type5']==1)){
            $type = 20;
        }elseif(($sitemap['type2']==1)&&($sitemap['type3']==1)&&($sitemap['type4']==1)){
            $type = 19;
        }elseif(($sitemap['type2']==1)&&($sitemap['type3']==1)&&($sitemap['type5']==1)){
            $type = 18;
        }elseif(($sitemap['type2']==1)&&($sitemap['type4']==1)&&($sitemap['type5']==1)){
            $type = 17;
        }elseif(($sitemap['type3']==1)&&($sitemap['type4']==1)&&($sitemap['type5']==1)){
            $type = 16;
        }elseif(($sitemap['type1']==1)&&($sitemap['type2']==1)){
            $type = 15;
        }elseif(($sitemap['type1']==1)&&($sitemap['type3']==1)){
            $type = 14;
        }elseif(($sitemap['type1']==1)&&($sitemap['type4']==1)){
            $type = 13;
        }elseif(($sitemap['type1']==1)&&($sitemap['type5']==1)){
            $type = 12;
        }elseif(($sitemap['type2']==1)&&($sitemap['type3']==1)){
            $type = 11;
        }elseif(($sitemap['type2']==1)&&($sitemap['type4']==1)){
            $type = 10;
        }elseif(($sitemap['type2']==1)&&($sitemap['type5']==1)){
            $type = 9;
        }elseif(($sitemap['type3']==1)&&($sitemap['type4']==1)){
            $type = 8;
        }elseif(($sitemap['type3']==1)&&($sitemap['type5']==1)){
            $type = 7;
        }elseif(($sitemap['type4']==1)&&($sitemap['type5']==1)){
            $type = 6;
        }elseif($sitemap['type5']==1){
            $type = 5;
        }elseif($sitemap['type4']==1){
            $type = 4;
        }elseif($sitemap['type3']==1){
            $type = 3;
        }elseif($sitemap['type2']==1){
            $type = 2;
        }elseif($sitemap['type1']==1){
            $type = 1;
        }
       
        switch($type){
            case 1:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="post" order by post_date desc limit %d, 9995',$start),ARRAY_A);
                break;
            case 2:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="page" order by post_date desc limit %d, 9995',$start),ARRAY_A);
                break;
            case 3:
                $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start),ARRAY_A);
                break;
            case 4:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish"  AND post_type NOT IN("nav_menu_item","attachment","post","page") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                break;
            case 5:
                $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start),ARRAY_A);
                break;
            case 6:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish"  AND post_type NOT IN("nav_menu_item","attachment","post","page") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment","post","page")',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 7:
                $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start),ARRAY_A);
                if(count($tag)<9995){
                    if(count($tag)==0){
                        $page_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($tag);
                        $start1 = 0;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 8:
                 $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment","post","page") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment","post","page")',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 9:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="page" order by post_date desc limit %d, 9995',$start),ARRAY_A);
                
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="page"',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 10:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish"  AND post_type NOT IN("nav_menu_item","attachment","post") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                break;
            case 11:
                
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="page" order by post_date desc limit %d, 9995',$start),ARRAY_A);
                
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="page" ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                
                break;
            case 12:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="post" order by post_date desc limit %d, 9995',$start),ARRAY_A);
                
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="post"',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            
            case 13:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment","page") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                break;
             case 14:
               $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="post" order by post_date desc limit %d, 9995',$start),ARRAY_A);
                
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="post"',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 15:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and (post_type="post" or post_type="page") AND post_type NOT IN("nav_menu_item","attachment") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                break;
            case 16:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish"  AND post_type NOT IN("nav_menu_item","attachment","post","page") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment","post","page") ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                 $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }
                }
                break;
            case 17:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment","post") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment","post")',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 18:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="page"  order by post_date desc limit %d, 9995',$start),ARRAY_A);
                
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish"  and post_type="page"',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                       
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                 $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                       
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                               
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                                
                            }
                           
                        }
                    }
                }
                break;
            case 19:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish"  AND post_type NOT IN("nav_menu_item","attachment","post") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment","post")',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 20:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish"  AND post_type NOT IN("nav_menu_item","attachment","page") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment","page") ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 21:
                 $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and post_type="post"  order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish"  and post_type="post" ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                 $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }
                }
                break;
            case 22:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish"  AND post_type NOT IN("nav_menu_item","attachment","page") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment","page") ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 23:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and (post_type="post" or post_type="page") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" and (post_type="post" or post_type="page")',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 24:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment")  order by post_date desc limit %d, 9995',$start),ARRAY_A);
                break;
            case 25:
                 $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and (post_type="post" or post_type="page") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" and (post_type="post" or post_type="page") ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 26:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish"  AND post_type NOT IN("nav_menu_item","attachment","post") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment","post")  order by post_date desc ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                 $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }
                }
                break;
            case 27:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish"   AND post_type NOT IN("nav_menu_item","attachment","page") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish"  AND post_type NOT IN("nav_menu_item","attachment","page")  order by post_date desc ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                 $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }
                }
                break;
            case 28:
                 $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish"  AND post_type NOT IN("nav_menu_item","attachment") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish"  AND post_type NOT IN("nav_menu_item","attachment") ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 29:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" and (post_type="post" or post_type="page") order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" and and (post_type="post" or post_type="page") ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                 $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }
                }
                break;
            case 30:
                 $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment")  order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment") ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                    }
                }
                break;
            case 31:
                $article = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'posts where post_status="publish" AND post_type NOT IN("nav_menu_item","attachment")  order by post_date desc limit %d, 9995',$start),ARRAY_A);
                if(count($article)<9995){
                    if(count($article)==0){
                        $page_total = $wpdb->query('select ID from '.$wpdb->prefix . 'posts where post_status="publish" and  post_type NOT IN("nav_menu_item","attachment") ',ARRAY_A);
                        $start1 = 9995-$page_total%9995+($baiduseo_sitemap_num-ceil($page_total/9995)-1)*9995;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, 9995',$start1),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                 $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $satrt2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }else{
                        $total = 9995-count($article);
                        $start1 = 0;
                        $tag = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"  limit %d, %d',$start1,$total),ARRAY_A);
                        if(count($article)+count($tag)<9995){
                            if(count($tag)==0){
                                $tag_total = $wpdb->query('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="post_tag"',ARRAY_A);
                                $start2 = 9995-($page_total+$tag_total)%9995+($baiduseo_sitemap_num-ceil(($page_total+$tag_total)/9995)-1)*9995;
                                $cate = $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, 9995',$start2),ARRAY_A);
                            }else{
                                $total1 = 9995-count($tag)-count($article);
                                $start2 = 0;
                                $cate =  $wpdb->get_results($wpdb->prepare('select a.* from '.$wpdb->prefix . 'terms as a left join '.$wpdb->prefix . 'term_taxonomy as b on a.term_id=b.term_id   where b.taxonomy="category"  limit %d, %d',$start2,$total1),ARRAY_A);
                            }
                           
                        }
                    }
                }
                break;
            }
           
        
                
                $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
                 $xml .= "<urlset>\n";
                 
                   if($baiduseo_sitemap_num==1){
                		$xml .= "<url>\n";
                        $xml .= "<loc>".get_option('siteurl')."</loc>\n";
                        $xml .= "<lastmod>{$currnetTime1}</lastmod>\n";
                        $xml .= "<changefreq>daily</changefreq>\n";
                        $xml .= "<priority>1.0</priority>\n";
                        $xml .= "</url>\n";
                       
                   }
                $article = isset($article)?$article:[];
                $tag = isset($tag)?$tag:[];
                $cate = isset($cate)?$cate:[];
               
                $tongguo =0;

                if(!$article && !$tag && !$cate){
                    $tongguo =1;
                }
                
                if($tongguo){
                    
                    $page1 = $baiduseo_sitemap_num-1;
                    foreach($data['sitemap_url'] as $key=>$val){
                        $s = str_replace(get_option('siteurl'). '/sitemap','',$val);
                        $s = str_replace('.xml','',$s);   
                        if($s>=$page1){
                            unset($data['sitemap_url'][$key]);
                        }
                	}
                	foreach($sitemap['sitemap_htmlurl'] as $key=>$val){
                	    $s = str_replace(get_option('siteurl'). '/sitemap','',$val);
                        $s = str_replace('.html','',$s);   
                        if($s>=$page1){
                            unset($data['sitemap_htmlurl'][$key]);
                        }
                	}
                	update_option('seo_baidu_sitemap',$data);
                    update_option('baiduseo_sitemap_num',0);
                }else{
                    if($article){
            	        foreach($article as $key=>$val){
            	                if($val['post_type']=='post'){
            	                    $level1 = $sitemap['level1']/10;
            	                    if($level1==1){
            	                        $level1 = '1.0';
            	                    }
            	                    $pinlv = $sitemap['post_time'];
            	                }elseif($val['post_type']=='page'){
            	                    $level1 = $sitemap['level2']/10;
            	                     if($level1==1){
            	                        $level1 = '1.0';
            	                    }
            	                    $pinlv = $sitemap['page_time'];
            	                }else{
            	                   $level1 = $sitemap['level4']/10; 
            	                   if($level1==1){
            	                        $level1 = '1.0';
            	                    }
            	                   $pinlv = $sitemap['other_time'];
            	                }
            	                $xml .= "<url>\n";
            	                $xml .= "<loc>".htmlspecialchars(get_permalink($val["ID"]))."</loc>\n";
            	                $xml .= "<lastmod>{$val['post_date']}</lastmod>\n";
            	                $xml .= "<changefreq>{$pinlv}</changefreq>\n";
            	                $xml .= "<priority>{$level1}</priority>\n";
            	                $xml .= "</url>\n";
            	           
            	           
            	        }
                    }
                    if($tag){
                        foreach($tag as $key=>$val){
        	                $level3 = $sitemap['level3']/10;
        	                 if($level3==1){
    	                        $level3 = '1.0';
    	                    }
        	                $xml .= "<url>\n";
        	                $xml .= "<loc>".htmlspecialchars(get_tag_link($val["term_id"]))."</loc>\n";
        	                $xml .= "<changefreq>{$sitemap['tag_time']}</changefreq>\n";
        	                $xml .= "<priority>{$level3}</priority>\n";
        	                $xml .= "</url>\n";
        	                
            	           
            	        }
                    }
                    
                    if($cate){
                        foreach($cate as $key=>$val){
                            $level5 = $sitemap['level5']/10;
                             if($level5==1){
    	                        $level5 = '1.0';
    	                    }
        	                $xml .= "<url>\n";
        	                $xml .= "<loc>".htmlspecialchars(get_category_link($val["term_id"]))."</loc>\n";
        	                $xml .= "<changefreq>{$sitemap['cate_time']}</changefreq>\n";
        	                $xml .= "<priority>{$level5}</priority>\n";
        	                $xml .= "</url>\n";
                        }
                    }
        	        $xml .='</urlset>';
        	       
        	        if(file_exists('WP_Filesystem')){
        	         WP_Filesystem();
        	        }else{
        	             require_once(ABSPATH . 'wp-admin/includes/file.php');
        	             WP_Filesystem();
        	        }
        	        $html = "<!DOCTYPE html>\n<html>\n<head>\n<meta charset='UTF-8'>\n<meta name='viewport' content='width=device-width, initial-scale=1.0'><style>\nbody {\nbackground-color: #f3f3f3;\n}\nul {\nbackground-color: #fff;\nmax-width: 1200px;\nmargin: 0 auto;\nbox-sizing: border-box;\npadding: 15px 125px;\n}\nul li {\npadding: 15px 0;\n}\nul li a {\ncolor: #333;\npadding-left: 25px;\ntext-decoration: none;\n}\nbody>ul>li>a{\nfont-weight:bold\n}\n</style>\n</head>\n<body>\n<!-- 官网：www.rbzzz.com(可接定制开发、网站、小程序、公众号、seo/sem优化)交流QQ群：1077537009 客服QQ：1500351892 -->\n<ul >";
        	        $category = $wpdb->get_results('select a.* from '.$wpdb->prefix .'terms as a  join '.$wpdb->prefix .'term_taxonomy as b on a.term_id=b.term_id where b.taxonomy="category" and b.parent=0 order by a.term_id desc limit 1000',ARRAY_A);
        	        $html .="<li><a href='/' target='_blank'>首 页</a></li>\n";
        	        foreach($category as $key=>$val){
        	            $category1 = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix .'terms as a  join '.$wpdb->prefix .'term_taxonomy as b on a.term_id=b.term_id where b.taxonomy="category"  and b.parent=%d order by a.term_id desc limit 1000',$val['term_id']),ARRAY_A);
        	            
        	            if(!empty($category1)){
        	                $html.="<li><a href='".get_category_link($val['term_id'])."' target='_blank'>".$val['name']."</a>\n<ul>";
        	                foreach($category1 as $k=>$v){
        	                    $category2 = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix .'terms as a  join '.$wpdb->prefix .'term_taxonomy as b on a.term_id=b.term_id where b.taxonomy="category" and b.parent=%d order by a.term_id desc limit 1000',$v['term_id']),ARRAY_A);
        	                    if(!empty($category2)){
        	                        $html.="<li><a href='".get_category_link($v['term_id'])."' target='_blank'>".$v['name']."</a>\n<ul>";
        	                        foreach($category2 as $ke=>$va){
        	                            $html.="<li><a href='".get_category_link($va['term_id'])."' target='_blank'>".$va['name']."</a></li>\n";
        	                        }
        	                        $html.="</ul>\n</li>";
        	                    }else{
        	                        $html.="<li><a href='".get_category_link($v['term_id'])."' target='_blank'>".$v['name']."</a></li>\n";
        	                    }
        	                }
        	                $html.="</ul>\n</li>\n";
        	            }else{
        	                $html.="<li><a href='".get_category_link($val['term_id'])."' target='_blank'>".$val['name']."</a></li>\n";
        	            }
        	        }
        	        $html.="</ul>\n</body>\n</html>";
                    global $wp_filesystem;
        	        if($two==2){
        	            if($baiduseo_sitemap_num>1){
                    		$page1 = $baiduseo_sitemap_num-1;
                		    $wp_filesystem->put_contents (ABSPATH.'/sitemap'.$page1.'.xml',$xml);
        	        	    
            	        }else{
            	            if(isset($sitemap['tag_open']) && $sitemap['tag_open']==1){
            	                $wp_filesystem->put_contents (ABSPATH.'/tag.html',$html_tag);
            	            }
        	                 $wp_filesystem->put_contents (ABSPATH.'/sitemap.xml',$xml);
        	        	    
            	        }
        	        }else{
            	        if($baiduseo_sitemap_num>1){
                    		$page1 = $baiduseo_sitemap_num-1;
                		     $wp_filesystem->put_contents (ABSPATH.'/sitemap'.$page1.'.xml',$xml);
        	        	     
            	        }else{
            	            if(isset($sitemap['tag_open']) && $sitemap['tag_open']==1){
            	                $wp_filesystem->put_contents (ABSPATH.'/tag.html',$html_tag);
            	            }
        	                 $wp_filesystem->put_contents (ABSPATH.'/sitemap.xml',$xml);
        	        	     
            	        }
            	        
        	        }
        	        $wp_filesystem->put_contents(ABSPATH.'/sitemap.html',$html);
        	        update_option('seo_baidu_sitemap',$data);
        	       // baiduseo_seo::sitemap(++$page,$two);
        }
	       
    }
    public static function silian($two,$sl=0){
         global $wpdb;
        //$two==2后端$two==1前端 
        $silian = get_option('seo_baidu_silian');
        $currnetTime= current_time( 'Y/m/d H:i:s');
        	
            $data = [      	 	 		    		 	 			
                'silian_url'=>[],      	 		      							 
                'silian_htmlurl'=>[],     	 			 	     		 	   
                'time'=>$currnetTime    	 	 		     	 	   	 
            ];
            if($sl){
                $count = $wpdb->query('select * from '.$wpdb->prefix . 'baiduseo_zhizhu where  type="404" group by address limit 500',ARRAY_A);
            }else{
                $count = $wpdb->query('select * from '.$wpdb->prefix . 'baiduseo_zhizhu where  type="404" group by address',ARRAY_A);
            }
            
            for($i=0;$i<ceil($count/50000);$i++){
                $start = $i*50000;
                if($sl){
                    $zhizhu = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu where  type="404"  group by address limit %d , 500',$start),ARRAY_A);
                }else{
                    $zhizhu = $wpdb->get_results($wpdb->prepare('select * from '.$wpdb->prefix . 'baiduseo_zhizhu where  type="404"  group by address limit %d , 50000',$start),ARRAY_A);
                }
                
            	$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
                $xml .= "<urlset>\n";
                $txt = '';
            	foreach($zhizhu as $key=>$val){
                    $xml .= "<url>\n";
                    $xml .= "<loc>".htmlspecialchars($val['address'])."</loc>\n";
                    $xml .= "</url>\n";
                    $txt .=$val['address']."\n";
                }
                 WP_Filesystem();
                global $wp_filesystem;
                $xml .= "</urlset>\n";
                if($two==2){
                    if($i==0){
                        $data['silian_url'][] = get_option('siteurl'). '/silian.xml';
                        $data['silian_htmlurl'][] = get_option('siteurl'). '/silian.txt';
                        $wp_filesystem->put_contents ('../silian.xml',$xml);
                        $wp_filesystem->put_contents ('../silian.txt',$txt);
                    }else{
                        $data['silian_url'][] = get_option('siteurl'). '/silian'.$i.'.xml';
                        $data['silian_htmlurl'][] = get_option('siteurl'). '/silian'.$i.'.txt';
                        $wp_filesystem->put_contents ('../silian'.$i.'.xml',$xml);
                        $wp_filesystem->put_contents ('../silian'.$i.'.txt',$txt);
                    }
                }elseif($two==1){
                    if($i==0){
                        $data['silian_url'][] = get_option('siteurl'). '/silian.xml';
                         $data['silian_htmlurl'][] = get_option('siteurl'). '/silian.txt';
                        $wp_filesystem->put_contents (ABSPATH.'/silian.xml',$xml);
                        $wp_filesystem->put_contents (ABSPATH.'/silian.txt',$txt);
                    }else{
                        $data['silian_url'][] = get_option('siteurl'). '/silian'.$i.'.xml';
                        $data['silian_htmlurl'][] = get_option('siteurl'). '/silian'.$i.'.txt';
                        $wp_filesystem->put_contents (ABSPATH.'/silian'.$i.'.xml',$xml);
                        $wp_filesystem->put_contents (ABSPATH.'/silian'.$i.'.txt',$txt);
                    }
                }
            }
            if($silian!==false){
                update_option('seo_baidu_silian',$data);
            }else{
                add_option('seo_baidu_silian',$data);
            }
    }
    public static function alt($alt,$title){
        $seo_alt_auto = get_option('seo_alt_auto');
        $alt_seo = ['alt'=>$alt,'title'=>$title];
        if($seo_alt_auto!==false){
            update_option('seo_alt_auto',$alt_seo);
        }else{
            add_option('seo_alt_auto',$alt_seo);
        }
    }
     public static function pay_money(){
        $baiduseo_wzt_log = get_option('baiduseo_wzt_log');
        if(!$baiduseo_wzt_log){
            return 0;
        }
        $data =  baiduseo_common::baiduseo_url(0);
        
    	$url = "https://ceshig.zhengyouyoule.com/index/index/pay_money?url={$data}&type=1";
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
            
        	if(isset($content['status']) && $content['status']==1){
        	    return 1;
        	}elseif(isset($content['status']) && $content['status']==0){
        	    return 0;
        	}else{
        	    $url = "http://wp.seohnzz.com/api/index/pay_money?url={$data}&type=1";
        	
            	$result = wp_remote_get($url,$defaults);
            	
            	if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    
                	$content = json_decode($content,true);
                	if(isset($content['status']) && $content['status']==1){
                	    return 1;
                	}elseif(isset($content['status']) && $content['status']==0){
        	            return 0;
                	}else{
                	    return baiduseo_zhizhu::pay_money();
                	}
            	}else{
            	    return baiduseo_zhizhu::pay_money();
            	}
        	}
    	}else{
    	    
        
        	$url = "http://wp.seohnzz.com/api/index/pay_money?url={$data}&type=1";
        	
            	$result = wp_remote_get($url,$defaults);
            	
            	if(!is_wp_error($result)){
                    $content = wp_remote_retrieve_body($result);
                    
                	$content = json_decode($content,true);
                	if(isset($content['status']) && $content['status']==1){
                	    return 1;
                	}elseif(isset($content['status']) && $content['status']==0){
        	            return 0;
                	}else{
                	    return baiduseo_zhizhu::pay_money();
                	}
            	}else{
            	    return baiduseo_zhizhu::pay_money();
            	}
    	}
    	    
    }
    public static function baiduseo_friends_hh($key){
        if(md5(baiduseo_common::baiduseo_url(0))==$key){
            global $wpdb;
            $wztkj_linkhh = get_option('baiduseo_linkhh');
            if($wztkj_linkhh['kqtype']==2){
                $friends = $wpdb->get_results('select * from '.$wpdb->prefix . 'wztkj_friends where (status1=0 and status2=0 and status3=2) or status1=5',ARRAY_A);
            }else{
                $friends = $wpdb->get_results('select * from '.$wpdb->prefix . 'wztkj_friends where (status1=0 and status2=0) or status1=5',ARRAY_A);
            }
            echo '<span style="display:none">'.md5(baiduseo_common::baiduseo_url(0)).'</span>';
            $wztkj_linkhh = get_option('baiduseo_linkhh');
            
            if (isset($wztkj_linkhh['ystype']) && $wztkj_linkhh['ystype'] == 1) {
                if(isset($wztkj_linkhh['link']) && $wztkj_linkhh['link']){
                    echo '
                        <style>
                            .baiduseo_linkhh_box {
                                width: var(--container-width, 100%);
                                margin: 0 auto;
                                display: flex;
                                align-items: center;
                                flex-wrap: wrap;
                                list-style: none;
                            }
                            .baiduseo_linkhh_box li {
                                list-style: none;
                                width: 14.2857%;
                                padding: 2px;
                                margin-bottom: 5px;
                                box-sizing: border-box;
                            }
                            .baiduseo_linkhh_box a {
                                width: 100%;
                                border: 1px solid #eee;
                                white-space: nowrap;
                                text-overflow: ellipsis;
                                overflow: hidden;
                                color: #062743;
                                font-size: 14px;
                                display: block;
                                box-sizing: border-box;
                                text-align: center;
                                line-height: 38px;
                                background-color: #fff;
                                border-radius: 3px;
                                transition: .5s;
                                position: relative;
                            }
                            .baiduseo_linkhh_box a:hover {
                                text-decoration: underline;
                            }
                            .baiduseo_linkhh_box span {
                                position: absolute;
                                z-index: 10;
                                background: linear-gradient(90deg, #0162c8, #55e7fc);
                                transform: translate(-50%, -50%);
                                pointer-events: none;
                                border-radius: 50%;
                                animation: scaleAnimate 1s linear infinite;
                            }
                            @keyframes scaleAnimate {
                                from {
                                    width: 0px;
                                    height: 0px;
                                    opacity: .5;
                                }
                                to {
                                    width: 500px;
                                    height: 500px;
                                    opacity: 0;
                                }
                            }
                        </style>
                        <ul class="baiduseo_linkhh_box" style="--container-width: '.$wztkj_linkhh['yswidth'].'">
                    ';
                    if(!empty($friends)){
                        foreach($friends as $key=>$val){
                            echo '<li><a href="'.$val['link'].'" target="_blank">'.$val['keywords'].'</a></li>';
                        }
                    }else{
                        $keywords = explode(',',$wztkj_linkhh['keywords']);
                        echo '<li><a href="/" target="_blank">'.$keywords[0].'</a></li>';
                    }
                    echo '
                        </ul>
                        <script>
                            function isMobile(){
                    			return navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i);
                    		}
                            if (isMobile()) {
                                document.querySelector(".baiduseo_linkhh_box").style = "width:'.$wztkj_linkhh['mobilewidth'].'";
                                document.querySelectorAll(".baiduseo_linkhh_box li").forEach(li => {
                                    li.style.width = "50%";
                                });
                            }
    
                            const links = document.querySelectorAll(".baiduseo_linkhh_box li a");
                            links.forEach(link => {
                                link.addEventListener("mouseenter", function(e) {
                                    let x = e.offsetX;
                                    let y = e.offsetY;
                    
                                    let ripples = document.createElement("span");
                                    ripples.style.left = x + "px";
                                    ripples.style.top = y + "px";
                                    this.appendChild(ripples);
                    
                                    setTimeout(() => {
                                        ripples.remove();
                                    }, 1000);
                                });
                            });
                        </script>
                    ';
                }else{
                    
                }
            } else if (isset($wztkj_linkhh['ystype']) && $wztkj_linkhh['ystype'] == 2) {
                if(isset($wztkj_linkhh['link']) && $wztkj_linkhh['link']){
                    echo '
                        <style>
                            .baiduseo_linkhh_box_container {
                                background-color: #fff;
                            }
                            .baiduseo_linkhh_box {
                                width: var(--container-width, 100%);
                                margin: 0 auto;
                                font-size: 14px;
                                padding: 15px 0;
                                box-sizing: border-box;
                            }
                            .baiduseo_linkhh_box a {
                                font-size: 14px;
                                margin-right: 10px;
                            }
                            .baiduseo_linkhh_box a:hover {
                                text-decoration: underline;
                            }
                        </style>
                        <div class="baiduseo_linkhh_box_container">
                            <div class="baiduseo_linkhh_box" style="--container-width: '.$wztkj_linkhh['yswidth'].'">
                                <span>友情链接：</span>
                    ';
                   
                    if(!empty($friends)){
                        foreach($friends as $key=>$val){
                            echo '<a href="'.$val['link'].'" target="_blank">'.$val['keywords'].'</a>';
                        }
                    }else{
                        $keywords = explode(',',$wztkj_linkhh['keywords']);
                        echo '<a href="/" target="_blank">'.$keywords[0].'</a>';
                    }
                    echo '
                            </div>
                        </div>
                        <script>
                            function isMobile(){
                    			return navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i);
                    		}
                            if (isMobile()) {
                                document.querySelector(".baiduseo_linkhh_box").style = "width:'.$wztkj_linkhh['mobilewidth'].'";
                            }
                        </script>    
                    ';
                }else{
                    
                }
            }
        }
    }
}
?>