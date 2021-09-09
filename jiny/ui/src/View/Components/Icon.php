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
        
		return view('jinyui::components.icon.'.$this->name);
    }

    public function toString()
    {
        return $this->render()->render();
    }

	public function __toString()
    {
        return $this->toString();
	}

}

