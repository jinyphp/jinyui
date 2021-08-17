---
theme: "adminkit"
layout: "markdown"
title: "타이틀 입니다."
breadcrumb:
    - "Docs"
---
# Theme App
테마는 다양한 웹사이트의 스타일과 요소들을 묽어서 가지고 있습니다.
또한 레이아아웃 배치를 지정할 수 있습니다. 하지만, 테마의 레이아웃 배치를 배제한 순수한 화면을 구현하고 싶을 경우가 있습니다.

예를들어 꾸밈이 없는 로그인 페이지같은 경우 입니다.  


## x-theme-app
테마의 레이아웃을 베제한 순수한 HTML 골격을 읽어 올때에는 `<x-theme-app>` 테그를 사용합니다.

```php
<x-theme-app theme="jiny">
내용
</x-theme-app>  
```

`theme/jiny` 폴더안에 있는 `app.blade.php`를 기반으로 화면을 구현합니다.

