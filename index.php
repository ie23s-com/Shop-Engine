<?PHP
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$time_start = microtime(true);

const __SHOP_DIR__ = __DIR__ . "/";

require_once(__SHOP_DIR__ . 'vendor/autoload.php');
require_once(__SHOP_DIR__ . 'system/System.class.php');

$system = new ie23s\shop\system\System();
$system->init();

$system->load();

$system->unload();

$time_end = microtime(true);
$time = round($time_end - $time_start, 6) * 1000;

echo "<div style=\"position: fixed; bottom:5px; right:5px\">{$time} ms";
