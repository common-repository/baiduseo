<?php  
/*
Plugin Name: 百度站长SEO合集(支持百度/神马/Bing/头条推送/谷歌站长)
Description: 含百度站长、360站长、Bing站长、今日头条站长、神马站长、IndexNow、tag标签内链、友情链接、百度地图sitemap、Google地图、 谷歌地图、关键词排名查询监控、360站长JS自动推送、 文章原创率检测、文章伪原创、 网站蜘蛛、robots、图片alt标签、天级推送、category隐藏、死链查询、百度自动推送、批量提交URL到站长、百度收录查询、批量推送未收录、301/404等功能、AI文章助手、流量监控。
Version: 2.0.5
Author: 沃之涛科技
Author URI: https://www.rbzzz.com
License: GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/
if(!defined('ABSPATH'))exit;
global $baiduseo_wzt_log;
$baiduseo_wzt_log = get_option('baiduseo_wzt_log');
define('BAIDUSEO_VERSION','2.0.5');
define('BAIDUSEO_FILE',__FILE__);
define('BAIDUSEO_NAME',plugin_basename(__FILE__));
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/common/index.php';
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/admin/cron.php';
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/admin/cron_tongbu.php';
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/admin/post.php';
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/admin/get.php';
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/admin/kp.php';
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/admin/rank.php';
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/admin/seo.php';
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/admin/tag.php';
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/admin/zhizhu.php';
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/admin/zz.php';
require plugin_dir_path( BAIDUSEO_FILE ) . 'inc/index/youhua.php';
$baiduseo_common = new baiduseo_common();
$baiduseo_common->init();
$baiduseo_cron = new baiduseo_cron();
$baiduseo_cron->init();
$baiduseo_get = new baiduseo_get();
$baiduseo_get->init();
$baiduseo_post = new baiduseo_post();
$baiduseo_post->init();
$baiduseo_zhizhu = new baiduseo_zhizhu();
$baiduseo_zhizhu->init();
$baiduseo_kp = new baiduseo_kp();
$baiduseo_kp->init();
$baiduseo_rank = new baiduseo_rank();
$baiduseo_rank->init();
$baiduseo_seo = new baiduseo_seo();
$baiduseo_seo->init();
$baiduseo_tag = new baiduseo_tag();
$baiduseo_tag->init();
$baiduseo_zz = new baiduseo_zz();
$baiduseo_zz->init();
$baiduseoyouhua = new baiduseo_youhua();
$baiduseoyouhua->init();
$baiduseo_crons  = new baiduseo_crons();
$baiduseo_crons->init();


	




