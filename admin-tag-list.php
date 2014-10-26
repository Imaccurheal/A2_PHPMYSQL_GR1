<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header-admin.php';

$tags = getTags($link);

isConnected() ? $username = $_SESSION['username'] : $username = null;

echo $twig->render('admin-tag-list.html.twig', [
    // direction links in the header
    'home'                  => ROOT,
    'categories'            => ROOT.'categories.php',
    'tags'                  => ROOT.'tags.php',
    'contact'               => ROOT.'contact.php',
    'admin-article-list'    => ROOT.'admin-article-list.php',
    'admin-article-add'     => ROOT.'admin-article-add.php',
    'admin-category-list'   => ROOT.'admin-category-list.php',
    'admin-category-add'    => ROOT.'admin-category-add.php',
    'admin-tag-list'        => ROOT.'admin-tag-list.php',
    'admin-tag-add'         => ROOT.'admin-tag-add.php',
    'admin-user-list'       => ROOT.'admin-user-list.php',
    'admin-user-add'        => ROOT.'admin-user-add.php',
    'login'                 => ROOT.'login.php',
    'logout'                => ROOT.'logout.php',
    //
    'var_tags'              => $tags,
    // checking status connection
    'connected'             => isConnected(),
    'role'                  => isAdmin(),
    'username'              => $username,
]);

require __DIR__.'/_footer.php';
