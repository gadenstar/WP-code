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

/**
 * 名称：WordPress后台添加顶级菜单
 * 作者：露兜
 * 博客：http://www.ludou.org/
 * http://www.ludou.org/add-admin-menu-in-wordpress.html
 * 最后修改：2011年01月26日
 *
 *add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
 *$parent_slug
 *      这个参数为WordPress内置菜单的文件名称或缩略名，这里我们通常采用菜单文件名的方式。传递这个参数，就说明要往这个顶级菜单添加子菜单，以上示例代码中传递的值为 tools.php ，对应工具顶级菜单，下面提供这个参数的所有值及其对应的顶级菜单：
*
* index.php：控制板
* edit.php：文章
* upload.php：媒体
* link-manager.php：链接
* edit.php?post_type=page：页面
* edit-comments.php：评论
* themes.php：主题
* plugins.php：插件
* users.php：用户
* tools.php：工具
* options-general.php：设置
*$page_title
 *    这个参数是子菜单的标题，将会显示在浏览器的标题栏。
*$menu_title
 *    这个是子菜单的名称，将会显示在侧边栏
*$capability
 *    用户权限，这个定义了具有哪些权限的用户会看到这个子菜单，具体的参数值，可以参考上面第一部分的顶级菜单的说明。
*$menu_slug
 *    子菜单的缩略名，请使用一个唯一的名称，英文形式。
*$function
 *    所有调用的函数名称，通过调用这个函数来显示这个子菜单页面的内容
 *
 *
 *
 *
 *
 */

// my_add_pages() 为 'admin_menu' 钩子的回调函数
function my_add_pages() {
    // 第一个参数'Help page'为菜单名称，第二个参数'使用帮助'为菜单标题
    // 'manage_options' 参数为用户权限
    // 'my_toplevel_page' 参数用于调用my_toplevel_page()函数，来显示菜单内容
    add_menu_page('Help page', '使用帮助', 'manage_options', __FILE__, 'my_toplevel_page');
}

// my_toplevel_page() 用于显示菜单的内容，填写菜单页面的HTML代码即可
function my_toplevel_page() {
    echo '
    这里填菜单页面的HTML代码
    ';

    // 如以下示例代码。 wrap 类是WordPress构建好的css类，可以在你的HTML代码中使用
    /*
    echo '
    <div class="wrap">
    <h2>使用帮助</h2>
    <p>这里是使用帮助，通过阅读本文你将了解本程序的使用！有事请<a href="#">与我联系</a></p>
    </div>
    ';
    */
}

// 通过add_action来自动调用my_add_pages函数
add_action('admin_menu', 'my_add_pages');

/**
 * 名称：WordPress后台添加侧边栏子菜单
 * 作者：露兜
 * 博客：http://www.ludou.org/
 * 最后修改：2011年01月26日
 */

function my_add_submenu() {
    add_submenu_page( 'tools.php', 'my_backup', '备份', 'manage_options', 'backup-page', 'my_magic_function');
}

// 用于显示菜单的内容，填写菜单页面的HTML代码即可
function my_magic_function() {
    echo '
    这里填菜单页面的HTML代码
    ';

    // echo '
    // <div class="wrap">
    // <h2>备份</h2>
    // <p>这里可以备份你的博客数据库。</a></p>
    // </div>
    // ';
}

// 通过add_action来自动调用my_add_submenu函数
add_action('admin_menu', 'my_add_submenu');




?>