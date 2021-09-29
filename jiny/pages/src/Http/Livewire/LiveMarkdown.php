<?php

namespace Jiny\Pages\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;

class LiveMarkdown extends Component
{
    public $content;
    public $popupTransEnable = false;
    public $transText;

    public function mount()
    {

    }

    public function render()
    {
        $markdown = (new Parsedown())->dom($this->content);
        $this->content = $markdown['markup'];
        
        return view("jinypage::livewire.markdown");
    }

    public function popupTransOpen($text)
    {
        $this->transText = $text;
        $this->popupTransEnable = true;
    }

    public function trans()
    {
        $this->popupTransEnable = false;
    }

}