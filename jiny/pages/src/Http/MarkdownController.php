<?php

namespace Jiny\Pages\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;

class MarkdownController extends Controller
{
    public $rootpath = "docs";
    public function __construct($path=null)
    {
        if ($path) {
            $this->rootpath = $path;
        }        
    }

    public function index(...$slug)
    {
        // 경로분석
        if (empty($slug)) {
            $string = "index";
        } else {
            $string = implode(DIRECTORY_SEPARATOR,$slug);
            if(is_dir($string)) {
                // 디렉터리인 경우, 디렉터리 안에 있는 index.md를 이용
                $string .= DIRECTORY_SEPARATOR."index";
            }
        }
        $path = resource_path($this->rootpath.DIRECTORY_SEPARATOR.$string.".md");
        //dd($path);

        // 파일읽기
        if (file_exists($path)) {
            $text = file_get_contents($path);

            // frontmatter ---
            $frontMatter = new FrontMatter();
            $document = $frontMatter->parse($text);
                $data = $document->getData();
                $content = $document->getContent();

            // 마크다운 변환
            $markdown = (new Parsedown())->dom($content);
            $data['content'] = $markdown['markup'];
            $data['hash'] = $markdown['hash'];
        
            if (isset($data['layout'])) {
                // forntmatter 설정된 resource layout을 이용
                if (isset($data['theme'])) {
                    return view("theme.".$data['theme'].".".$data['layout'], $data);
                } else {
                    return view($data['layout'], $data);
                }                
            } else {
                return view("jinypage::markdown", $data);
            }            
        }        
    }
}
