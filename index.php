<?PHP
error_reporting(E_ALL);
ini_set('display_errors', 'On');
//DEV
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$time_start = microtime(true);

//\DEV
const __SHOP_DIR__ = __DIR__ . "/";

require_once(__SHOP_DIR__ . 'vendor/autoload.php');
require_once(__SHOP_DIR__ . 'system/System.class.php');

$system = new ie23s\shop\system\System();
try {
    $system->init();
} catch (Exception $e) {
    $system->getPages()->error(500, "Internal server error: " . $e->getTraceAsString());
}

$system->load();

$system->unload();

//DEV
$time_end = microtime(true);
$time = round($time_end - $time_start, 6) * 1000;

echo "<div style=\"position: fixed; bottom:5px; right:5px\">{$time} ms";

//\DEV