<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header.php';

$perPage = 6; // nbArticleParPage
$nbArticles = countArticles($link); //nbArticleTotal
$currentPage = !empty($_GET['p']) ? (int)$_GET['p'] : 1;// numéro de la page
$nbPages = ceil($nbArticles/$perPage); // nombre de pagination


if (0 >= $currentPage) {
    header('Location: index.php?p=1');
}
if ($currentPage > $nbPages) {
    header('Location: index.php?p='.$nbPages);
}

$articles = getArticles($link, null, ($currentPage-1)*$perPage, $perPage);

isConnected() ? $username = $_SESSION['username'] : $username = null;

echo $twig->render('articles.html.twig', [
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
    // variables to display articles
    'var_articles'          => $articles,
    'var_currentPage'       => $currentPage,
    'var_nbPages'           => $nbPages,
    // checking status connection
    'connected'             => isConnected(),
    'role'                  => isAdmin(),
    'username'              => $username,
]);

require __DIR__.'/_footer.php';
