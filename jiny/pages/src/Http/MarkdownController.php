<?php

namespace Jiny\Pages\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;
use Illuminate\Support\Facades\View;

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
        //dd("aaa");
        // 경로분석, 파일읽기
        $path = $this->path($slug);
        if (file_exists($path)) {
            $text = file_get_contents($path);

            // frontmatter ---
            list($data, $content) = $this->frontMatter($text);
            $data['slot'] = $content;

            $resource = $this->resource($data);
            //dd($resource);
            return view($resource, $data);
        }

        return "can not find markdown file";
    }


    private function resource($data)
    {
        // 테마 페키지가 설치되어 있는 경우
        if(function_exists('theme')) {
            // forntmatter 설정된 
            // resource layout을 이용
            if (isset($data['theme'])) {

                theme()->setTheme($data['theme']);

                // 사용자 레이아웃 지정확인
                if (isset($data['layout'])) {
                    $layout = $data['layout'];
                } else {
                    $layout = "markdown";
                }
    
                $resource = "theme.".$data['theme'].".".$layout;
                if (View::exists($resource)) {
                    return $resource;
                }
            }
        }

        return "jinypage::markdown";
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
