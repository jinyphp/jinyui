<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarkdownController extends Controller
{

    public function index(...$slug)
    {
        // 경로분석
        $string = implode(DIRECTORY_SEPARATOR,$slug);
        $path = resource_path("docs\\".$string.".md");

        // 파일읽기
        if (file_exists($path)) {
            $text = file_get_contents($path);

            // frontmatter ---
            $frontMatter = new \Webuni\FrontMatter\FrontMatter();
            $document = $frontMatter->parse($text);
                $data = $document->getData();
                $content = $document->getContent();

            // 마크다운 변환
            $data['content'] = (new \Parsedown())->text($content);
            if (isset($data['layout'])) {
                // forntmatter 설정된 resource layout을 이용
                return view($data['layout'], $data);
            } else {
                return view("pages.markdown", $data);
            }            
        }        
    }
}
