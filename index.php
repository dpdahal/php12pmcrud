<?php
// required config file
require_once(__DIR__ . '/config/config.php');
require_once(__DIR__ . '/help/help.php');
require_once(__DIR__ . '/config/database.php');
$url = htmlspecialchars($_GET['url'] ?? 'home');
$title = $url;
$page = $url;
$url = $url . '.php';
?>
<?php
require_once root_path('layouts/header.php')
?>
<?php
$pagePath = root_path('pages/' . $url);
if (file_exists($pagePath) && is_file($pagePath)) {
    require_once root_path('layouts/top_header.php');
    require_once root_path('layouts/nav.php');
    require_once $pagePath;
    require_once root_path('layouts/main_footer.php');
} else {
    require_once root_path('messages/errors/404.php');
}
?>
<?php
require_once root_path('layouts/footer.php')
?>

