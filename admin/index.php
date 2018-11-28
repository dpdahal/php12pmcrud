<?php
// required config file
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../help/help.php');
$url = htmlspecialchars($_GET['url'] ?? 'dashboard');
$title = $url;
$page = $url;
$url = $url . '.php';

if (!isset($_SESSION['user_name']) || $_SESSION['is_log_in'] != true) {
    $_SESSION['error'] = 'Login First';
    redirect_to('admin/login');
    exit();
}


?>
<?php
require_once root_path('admin/layouts/header.php')
?>
<?php
$pagePath = root_path('admin/pages/' . $url);
if (file_exists($pagePath) && is_file($pagePath)) {
    require_once root_path('admin/layouts/top-header.php');
    require_once root_path('admin/layouts/aside.php');
    require_once $pagePath;
    require_once root_path('admin/layouts/main-footer.php');
} else {
    echo "<h1>Page not found</h1>";
}
?>
<?php
require_once root_path('admin/layouts/footer.php')
?>

