<?php
class baiduseo_kp{
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
            if($wpdb->get_var("show tables like '{$wpdb->prefix}baiduseo_kp'") !=  $wpdb->prefix."baiduseo_kp"){
                $sql15 = "CREATE TABLE " . $wpdb->prefix . "baiduseo_kp   (
                    id bigint NOT NULL AUTO_INCREMENT,
                    keywords varchar(255) NOT NULL ,
                    type bigint NOT NULL DEFAULT 1,
                    time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    check_time timestamp   NULL ,
                    delete_time timestamp  NULL,
                    chu bigint NOT NULL DEFAULT 0,
                    news  bigint NOT NULL DEFAULT 0,
                    status bigint NOT NULL DEFAULT 1,
                    high tinyint DEFAULT 0,
                    high_time timestamp NULL,
                    UNIQUE KEY id (id)
                ) $charset_collate;";
                dbDelta($sql15);
            }
            
            if($wpdb->get_var("show tables like '{$wpdb->prefix}baiduseo_kp_log'") !=  $wpdb->prefix."baiduseo_kp_log"){
                 $sql16 = "CREATE TABLE " . $wpdb->prefix . "baiduseo_kp_log(
                    id bigint NOT NULL AUTO_INCREMENT,
                    orderno varchar(64) NOT NULL ,
                    num varchar(255) NOT NULL DEFAULT 0,
                    time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    remark varchar(64) NOT NULL,
                    UNIQUE KEY id (id)
                ) $charset_collate;";
                dbDelta($sql16);
            }
           
            
        }
    }
    public static function  get_jifen(){
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
        return $jifen;
    }
    
}
?>