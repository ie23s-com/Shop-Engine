<?PHP

namespace ie23s\shop\system;
/***
Interface of system components

@author ie23s
***/
interface Component {
    public function init();
    public function load();
    public function unload();
}
