<?PHP

namespace ie23s\shop\system;
/***
 * Interface of system components
 *
 * @author ie23s
 ***/
abstract class Component
{
    private $system;

    public abstract function init(System $system);

    public abstract function load();

    public abstract function unload();

    public final function setSystem(System $system)
    {
        $this->system = $system;
    }

    public final function getSystem()
    {
        return $this->system;
    }
}
