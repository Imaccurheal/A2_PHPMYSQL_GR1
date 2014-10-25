<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header.php';

if (isset($_POST['contactSubmit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Test si les champs sont remplis

    if (empty($name) || empty($email) || empty($message)) {
        $missing_credential = true;
    } else {
        if (@mail('irvyne.contact@gmail.com', 'Blog A2 - Send by '.$email, $message)) {
            $send_successfully = true;
        } else {
            $send_error = true;
        }
    }
}

isConnected() ? $username = $_SESSION['username'] : $username = null;

echo $twig->render('contact.html.twig', [
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
    // variables to display the contact form
    //'var_missing_credential' => $missing_credential,
    //'var_send_successfully'  => $send_successfully,
    //'var_send_error'         => $send_error,
    // checking status connection
    'connected'             => isConnected(),
    'role'                  => isAdmin(),
    'username'              => $username,
]);

require __DIR__.'/_footer.php';