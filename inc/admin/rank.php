<?php
class baiduseo_rank{
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
            if($wpdb->get_var("show tables like '{$wpdb->prefix}baiduseo_keywords'") !=  $wpdb->prefix."baiduseo_keywords"){
                 $sql2 = "CREATE TABLE " . $wpdb->prefix . "baiduseo_keywords   (
                    id bigint NOT NULL AUTO_INCREMENT,
                    keywords varchar(255),
                    title varchar(255) ,
                    post_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                	time timestamp,
                    num bigint  NOT NULL DEFAULT 0,
                    prev bigint  NOT NULL DEFAULT 0,
                    type bigint NOT NULL DEFAULT 0,
                    UNIQUE KEY id (id)
                ) $charset_collate;";
                dbDelta($sql2);
            }
           
        }
    }
}
?>