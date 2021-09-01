<?php 
namespace Jiny\UI;

class Json 
{
    public $filename;
    public $data;

    public function setFilename($file)
    {
        $this->filename = $file;
        return $this;
    }

    public function load($file=null)
    {
        if ($file) $this->filename = $file;

        $path = resource_path($this->filename);
        $json = file_get_contents($path);
        $this->data = json_decode($json, true);

        return $this;
    }

    public function save()
    {
        $data = json_encode($this->data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        $path = resource_path($this->filename);
        file_put_contents($path, $data);  
    }

    public function get()
    {
        return $this->data;
    }

    public function set($data)
    {
        $this->data = $data;
        return $this;
    }

    public function sort()
    {
        $this->_sortId(1, $this->data);
        return $this;       
    }

    private function _sortId($i, &$data, $level=0, $ref=0)
    {
        $level++;
        foreach($data as $key => &$value) {
            $data[$key]['_id'] = $i++;
            $data[$key]['_level'] = $level;
            $data[$key]['_ref'] = $ref;
            if(isset($value['submenu'])) {
                $i = $this->_sortId($i, $value['submenu'], $level, $i-1);
            }
        }
        return $i;
    }
}