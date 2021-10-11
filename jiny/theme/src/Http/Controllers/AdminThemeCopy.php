<?php

namespace Jiny\Theme\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;


use Jiny\Members\Http\Controllers\CrudController;


//use Sunra\PhpSimple\HtmlDomParser;
use KubAT\PhpSimple\HtmlDomParser;


class AdminThemeCopy extends CrudController
{
    public function __construct()
    {
        

    }

    public function index()
    {
        $theme = "samples.varkala";
        $url = "https://demo.bootstrapious.com/varkala/1-2-1/index.html";
        

        $path = resource_path("views".DIRECTORY_SEPARATOR."theme");
        $filename = $path.DIRECTORY_SEPARATOR;
        $filename .= str_replace(".", DIRECTORY_SEPARATOR, $theme);
        $filename .= DIRECTORY_SEPARATOR;

        ## cURL 파일을 다운로드 합니다.
        if(!file_exists($filename."app.blade.php")) {
            $ch = curl_init($url);
            $fp = fopen($filename, "w");
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        }
    
        // 경로분석
        if ($html = file_get_contents($filename."app.blade.php")) {
            
            $res = [];
            $el = [];
            $dom = [];

            $el['dom'] = [];
            $el['next'] = strpos($html,"<",0);
            $el['dom'] []= substr($html,0,$el['next']);
            
            $el = $this->element($html,$el);
            $dom[ $el['tagname'] ] = $el;
            //dump($el);

            $el = $this->element($html,$el);
            $dom[ $el['tagname'] ] = $el;
            //dump($el);


            //$res = $html;
            //echo "<pre>";
            //print_r($dom);
            //exit;

            dd($dom);







            
            //$res = str_replace(array("\r\n", "\r", "\n", "  "), "", $html);
            //$res = str_replace(">", ">\n", $res);
            //$res = str_replace("\n</", "</", $res);

            //$dom = HtmlDomParser::str_get_html( $html );
            //$elems = $dom->find("div");
            //dd($elems);

            /*
            $html = str_replace(array("\r\n", "\r", "\n", "  "), "", $html);

            $res = "";
            $level = 0;
            $tag = false;
            for($i=0;$i<strlen($html);$i++) {
                if($html[$i] == "<") {
                    $res .= "\n";
                    $res .= $html[$i++];
                    $tag = true;

                    for(;$i<strlen($html);$i++){
                        $res .= $html[$i];
                        if($tag && $html[$i] == "/") $tag = false;
                        if($html[$i] == ">") {
                            //if(!$tag) 
                            $res .= "\n";
                            break;
                        }
                    }
                    //
                    continue;
                    
                } 
                $res .= $html[$i];
            }
            */








            //$html = str_replace(">", ">\n", $html);
            //$this->lines = explode("\n",$html);

            //$str = $this->parser();
            /*
            $res = "";
            $tag = false;
            $code = "";
            for($i=0;$i<strlen($html);$i++) {
                if($html[$i] == "<") {
                    $tag = true;
                    $code .= $html[$i];
                    continue;
                    //$res .= "\n";
                } else 
                if ($tag) {
                    $code .= $html[$i];
                    if($html[$i] == ">") {
                        $tag = false;
                        $res .= "\n";
                    }
                    continue;
                }
        
                $res .= $html[$i];
            }
            */
            

            

            /*
            
            $html = str_replace("<", "\n<", $html);
            $html = str_replace("\n\n", "\n", $html);
            
            $lines = explode("\n",$html);
            for($i=0;$i<count($lines);$i++) {
                if (chop($lines[$i]) === '') {
                    unset($lines[$i]);
                    continue;
                }
                if($lines[$i][0] == "<") {
                    if(isset($lines[$i][1]) && $lines[$i][1] == "!") unset($lines[$i]);
                }
                    
            }
            dd($lines);
            */
            //$pos = strpos($html,"<",0);
            //$body = $this->parser($html, $pos);


            
            
            return response($res, 200)
                ->header('Content-Type', 'text/plain');
        }
    }

    private function eleAttr($code)
    {
        $pos = strpos($code," ");
        $code = substr($code,$pos+1);
        $code = explode('" ',$code);
        
        $attr = [];
        foreach($code as $item) {
            $k = explode("=",$item);
            if(isset($k[0])) {
                if(isset($k[1])) {
                    if($k[0] == "class") {
                        $val = trim($k[1], '"');
                        $attr[ $k[0] ] = explode(" ",$val);
                    } else 
                    if($k[0] == "style") {
                        $val = trim($k[1], '"');
                        $attr[ $k[0] ] = explode(";",$val);
                    } else {
                        $attr[ $k[0] ] = $k[1];
                    }
                    
                }
            }
            //$attr []= $a;
            /*
            if(count($a)>2) {
                $attr[ $a[0] ] = $a[1];
            }  
            */          
        }
        
        return $attr;
        /*
        $el['attr'] = [];
        for($i=1;$i<count($code);$i++) {
            $el['attr'] []= $code[$i];
        }
        */
    }


    private function element($html,$el)
    {
        
        $el['dom'] = [];

        // 테그 시작검사
        $el['pos'] = strpos($html,"<",$el['next']);
        $el['len'] = strpos($html,">",$el['pos']) - $el['pos'] +1;
        
        // 테그명 추출
        $code = substr($html,$el['pos']+1,$el['len']-2);
        //$code = explode(" ", $code);
        $el['code'] = $code;
        $el['tagname'] = explode(" ", $code)[0];

        // 이전 문자열 추출
        $el['text'] = substr($html,$el['next'],$el['pos']-$el['next']);
        //$el['dom'] []= $el['text'];
        $lines = explode("\n",$el['text']);
        foreach($lines as $line) {
            if(chop($line) !== '' ) {
                $el['dom'] []= $line;
            }
        }
        
        // 속성
        $el['attr'] = $this->eleAttr($code);


        // 다음 검색요소 위치 결정
        $el['next'] = $el['pos'] + $el['len'];

        //if($el['tagname'][0] == "/") return $el; //dd($el);





        // 테그타입
        switch($el['tagname']){
            case 'img': $el['pare'] = false; break;

            case '!DOCTYPE': $el['pare'] = false; break;
            case 'html': $el['pare'] = true; break;
            case 'head': $el['pare'] = true; break;
            case 'meta': $el['pare'] = false; break;
            
            case 'title': $el['pare'] = true; break;
            //case '/title': $el['pare'] = true; break;

            case 'script': $el['pare'] = true; break;
            case 'body': $el['pare'] = true; break;
            case 'header': $el['pare'] = true; break;
            case 'div': $el['pare'] = true; break;
            case 'ul': $el['pare'] = true; break;
            case 'li': $el['pare'] = true; break;
            case 'a': $el['pare'] = true; break;
            case 'footer': $el['pare'] = true; break;
            case 'svg': $el['pare'] = true; break;
            case 'use': $el['pare'] = true; break;
            case 'p': $el['pare'] = true; break;
            case 'nav': $el['pare'] = true; break;
            case 'button': $el['pare'] = true; break;
            case 'form': $el['pare'] = true; break;
            case 'h1': $el['pare'] = true; break;
            case 'h2': $el['pare'] = true; break;
            case 'h3': $el['pare'] = true; break;
            case 'h4': $el['pare'] = true; break;
            case 'h5': $el['pare'] = true; break;
            case 'h6': $el['pare'] = true; break;
            case 'span': $el['pare'] = true; break;
            case 'section': $el['pare'] = true; break;
            case 'small': $el['pare'] = true; break;
            case 'strong': $el['pare'] = true; break;
            case 'i': $el['pare'] = true; break;
            case 'label': $el['pare'] = true; break;
            case 'del': $el['pare'] = true; break;
            case 'select': $el['pare'] = true; break;
            case 'option': $el['pare'] = true; break;
            default:
                $el['pare'] = false;
        }

        // 테그타입별 재귀호출      
        while($el['pare'] == true) {
            
            $e = $this->element($html,$el);
            $el['next'] = $e['next']; //다음요소

            
            if($e['tagname'][0] == "/") {
                // 종료테그 탈출
                $lines = explode("\n",$e['text']);
                foreach($lines as $line) {
                    if(chop($line) !== '' ) {
                        $el['dom'] []= $line;
                    }
                }

                /*
                if($e['text'] !== "\n" || chop($e['text']) !== '' ) {
                    $el['dom'] []= $e['text'];
                }
                */
                
                //dump($el);
                //exit;
                break;
            } else {
                // 서브 요소 저장
                // 주석 요소는 제외
                if($e['tagname'] != "!--") {
                    $el['dom'] []= $e;
                }
                
            }
         

            
        }

        

        return $el;
    }





    private function tag($html)
    {
        $pos = strpos($html,"<");
        $end = strpos($html,">",$pos);
        $tag = substr($html,$pos, $end-$pos+1);
        return ['tag'=>$tag, 'pos'=>$end+1];
    }




    public $lines;
    private function parser($i=0)
    {
        $str = [];
        for(;$i<count($this->lines);$i++) {
            $this->lines[$i] = trim($this->lines[$i]," ");
            if (chop($this->lines[$i]) === '') {
                continue;
            }

            
            if($this->lines[$i][0] == "<") {
                $str []= $this->parser(++$i);
            } else {
                $str []= $this->lines[$i];
            }
        }
        return $str;
    }

    private function __tag($html)
    {
        $pos = strpos($html,"<");
        if(isset($html[$pos+1]) &&  $html[$pos+1] == "/") {
            return ['pos'=>$pos, 'status'=>"end"];
        } else {
            return ['pos'=>$pos, 'status'=>"start"];
        }
    }




    private function _tag($string)
    {
        $pos = strpos($string, "<");
        $str['pre'] = substr($string, 0, $pos);
        
        $end = strpos($string, ">", $pos)+1;
        $str['tag'] =  substr($string, $pos, $end-$pos);

        $str['text'] = substr($string,$end);
        dd($str);
        
    }

    private function splitHeader($html,$filename)
    {
        $pos = strpos($html,"<header");
        $start = $pos; //strpos($html,">",$pos)+1;

        //echo $start."\n";

        $pos = strpos($html,"</header",$pos);
        $end = strpos($html,">",$pos)+1;

        //echo $end."\n";
        //return substr($html,$start,$end-$start);

        $app = substr($html,0,$start);
        /*
        $app .= "\n"."{{".'';
        $app .= "Header}}"."\n";
        */
        $app .= substr($html,$end);


        return $app;
    }

    private function splitFooter($html,$filename)
    {
        $pos = strpos($html,"<footer");
        $start = $pos; //strpos($html,">",$pos)+1;

        // echo $start."\n";

        $pos = strpos($html,"</footer",$pos);
        $end = strpos($html,">",$pos)+1;

        // echo $end."\n";
        //return substr($html,$start,$end-$start);

        $app = substr($html,0,$start);
        /*
        $app .= "\n"."{{".'';
        $app .= "Footer}}"."\n";
        */
        $app .= substr($html,$end);


        return $app;
    }

    private function splitBody($html,$filename)
    {
        $pos = strpos($html,"<body");
        $start = strpos($html,">",$pos)+1;
        //echo $pos."\n";
        //echo substr($html,$pos,100)."\n";

        $end = strpos($html,"<script",$pos);

        $app = substr($html,0,$start);
        $app .= "\n"."{{".'$';
        $app .= "slot}}"."\n";
        $app .= substr($html,$end);
        //return $app;
        
        return substr($html,$start,$end-$start);
    }


}
