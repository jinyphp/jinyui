<?php
namespace Jiny\UI\View\Components;
use Illuminate\View\Component;

class Icon extends Component
{
    
    private $name;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name=null)
    {
        $this->name = $name;
    }

    public function render()
    {
        $attrs = "h-4 w-4";
		return view('jinyui::components.icon.'.$this->name, ['attrs'=>$attrs]);
    }

    public function toString()
    {
        return $this->render();
    }

	public function __toString()
    {
        return $this->render();
	}

}

