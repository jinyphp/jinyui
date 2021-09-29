<?php

namespace Jiny\Pages\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;

class MarkdownController extends Controller
{
    public $rootpath = "docs"; // 마크다운이 존재하는 페이지

    public function __construct($path=null)
    {
        if ($path) {
            $this->rootpath = $path;
        }        
    }


    public function index(...$slug)
    {
        // 경로분석
        $path = $this->path($slug);

        // 파일읽기
        if (file_exists($path)) {
            $text = file_get_contents($path);

            // frontmatter ---
            list($data, $content) = $this->frontMatter($text);
            $data['content'] = $content;

            $resource = $this->resource($data);
            return view($resource, $data);
        }
    }

    private function resource($data)
    {
        if (isset($data['layout'])) {
            // forntmatter 설정된 resource layout을 이용
            if (isset($data['theme'])) {
                $resource = "theme.".$data['theme'].".".$data['layout'];                
            } else {
                $resource = $data['layout'];                
            }                
        } else {
            $resource = "jinypage::markdown";            
        }

        return $resource;
    }

    

    private function path($slug)
    {
        if (empty($slug)) {
            // 루트접속
            $string = "index";
            $path = resource_path($this->rootpath.DIRECTORY_SEPARATOR.$string);
        } else {
            $string = implode(DIRECTORY_SEPARATOR,$slug);
            $path = resource_path($this->rootpath.DIRECTORY_SEPARATOR.$string);
            if(is_dir($path)) {
                // 디렉터리인 경우, 디렉터리 안에 있는 index.md를 이용
                $path .= DIRECTORY_SEPARATOR."index";
            }
        }

        return $path.".md";
    }

    private function frontMatter($text)
    {
        $frontMatter = new FrontMatter();
        $document = $frontMatter->parse($text);
        $data = $document->getData();
        $content = $document->getContent();

        return [$data, $content];
    }

}
