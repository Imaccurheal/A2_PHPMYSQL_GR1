<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header-admin.php';

$errors = [];

if (!empty($_POST) && isset($_POST['submitArticle'])) {
    $mandatory = ['title', 'content', 'category'];
    foreach($mandatory as $name) {
        if (empty($_POST[$name])) {
            $errors[] = $name.' cannot be empty!';
        }
    }

    if (0 === sizeof($errors)) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $enabled = isset($_POST['enabled']) ? true : false;
        $image = isset($_FILES['image']) ? $_FILES['image'] : null;
        $categoryId = (int) $_POST['category'];
        $tagsId = isset($_POST['tags']) ? $_POST['tags'] : null;

        var_dump($_FILES['image']);

        $boolean = addArticle($link, $title, $content, $enabled, $image, $categoryId, 1, $tagsId);
        var_dump($boolean);
    }
}

$categories = getCategories($link);
$tags = getTags($link);

isConnected() ? $username = $_SESSION['username'] : $username = null;

echo $twig->render('admin-article-add.html.twig', [
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
    //'mandatory' => $mandatory,
    'errors'                => $errors,
    'var_categories'        => $categories,
    'var_tags'              => $tags,
    // checking status connection
    'connected'             => isConnected(),
    'role'                  => isAdmin(),
    'username'              => $username,
    ]);

require __DIR__.'/_footer.php';
