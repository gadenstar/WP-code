<?php

/**WordPress让主题激活后跳转到设置页**/

//方法一
add_action( 'load-themes.php', 'Init_theme' );
function Init_theme(){
  global $pagenow;

  if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
    // options-general.php 改成你的主题设置页面网址
    wp_redirect( admin_url( 'options-general.php' ) );
    exit;
  }
}
//方法二
add_action('after_switch_theme', 'Init_theme');
function Init_theme($oldthemename){
  global $pagenow;

  if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
    // options-general.php 改成你的主题设置页面网址
    wp_redirect( admin_url( 'options-general.php' ) );
    exit;
  }
}

?>