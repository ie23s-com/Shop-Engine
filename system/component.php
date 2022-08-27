<?PHP

namespace ie23s\shop\system;

interface Component {
    public function init();
    public function load();
    public function unload();
}
