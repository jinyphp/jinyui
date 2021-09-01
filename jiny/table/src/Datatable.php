<?php 
namespace Jiny\Table;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Livewire\WithPagination;
use Jiny\Table\Http\Livewire\Pagination;

/**
 * 리스트 테이블 표 생성을 위한 
 * Helper 클래스
 */

class Datatable
{
    public $routename;
    public $td;
    public $th;

    public function __construct($routename)
    {
        $this->routename = $routename;
        $this->th = new \Jiny\Html\CTag("th",true);
        $this->td = new \Jiny\Html\CTag("td",true);
    }

    private function isValue($key, $row)
    {
        $k = explode(".", $key);
        
        switch (count($k)) {
            case 1: 
                if(isset($row[$key])) {
                    return $row[$key];
                }
                break;
            case 2: 
                if (isset( $row[$k[0]] )) {
                    if(is_array($row[$k[0]])) {
                        $values = "";
                        foreach($row[$k[0]] as $v) {
                            $values .= $v->{$k[1]};
                        }
                        return $values;
                    }
                    else if(is_object($row[$k[0]])) {
                        return $row[$k[0]]->{$k[1]};
                    } else {
                        return $row[$k[0]][$k[1]];
                    }                    
                }

                if(isset($row[$k[0]][$k[1]])) {
                    return $row[$k[0]][$k[1]];
                }
                break;
        }        
        return null;
    }

    private function cellHtml($html)
    {
        return (clone $this->td)->addItem($html);
    }

    private function cellEdit($fieldname, $row)
    {
        $link = new \Jiny\Html\CTag("a",true, $this->isValue($fieldname, $row) );
        $link->setAttribute("href", route( $this->routename.".edit", $row['id']) );
        return (clone $this->td)->addItem($link);
        //$cell = "<a href=\"".route( $this->routename.".edit", $row->id)."\">". $row->$fieldname ."</a>";
        //{{-- <a href="#" wire:click="edit({{$row->id}})" data-bs-toggle="modal" data-bs-target="#new-add-popup">{{ $row->$fieldname }} </a>--}}
    }

    private function cellView($fieldname, $row)
    {
        $link = new \Jiny\Html\CTag("a",true, $this->isValue($fieldname, $row) );
                    $link->setAttribute("href", route( $this->routename.".view", $row['id']) );
        return (clone $this->td)->addItem($link);
    }

    private function cellItem($fieldname, $row)
    {
        return (clone $this->td)->addItem($this->isValue($fieldname, $row) );
    }

    public function tbodyCell($item, $row)
    {
        if(isset($item['list']) && $item['list']) {
            // plan Text
            if (isset($item['input']) && $item['input'] == "html") {
                return $this->cellHtml($item['value']);
            } else 
            // 필드 출력
            if (isset($item['name']) && $this->isValue($item['name'], $row)) {
                if (isset($item['list_edit'])) {
                    return $this->cellEdit($item['name'], $row);// 수정링크

                } else if (isset($item['view'])) {
                    return $this->cellView($item['name'], $row);

                } else {
                    return $this->cellItem($item['name'], $row);
                    
                }
            }
        }            
    }

    public function header($item)
    {
        if(isset($item['list']) && $item['list']) {
            $head = (clone $this->th);

            if(isset($item['list_sort'])) {
                $link = new \Jiny\Html\CTag("a",true, $item['title']);
                $link->setAttribute("wire:click","sort");
                $head->addItem($link); 

                if($item['list_sort'] == "desc") {
                    $head->addItem("&#129043;"); // arrow-down
                } else if($item['list_sort'] == "asc") {
                    $head->addItem("&#129041;"); // arrow-up
                } else {
                    $head->addItem("&#8693;"); // arrow-up-down
                }                

            } else {
                $head->addItem($item['title']);
            }

            return $head;
        }
    }

}