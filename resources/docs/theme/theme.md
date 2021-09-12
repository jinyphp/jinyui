
# @theme()

`@theme()` 디렉티브는 테마 폴더 안에 있는 리소스를 읽어 삽입이 가능합니다.

인자값을 지정하면 `resource/theme`안의 절대경로로 파일을 찾아 삽입합니다.
```php
@theme("footer")
```

상대경로 경로를 지정하는 경우에는 `.`을 사용합니다.
```php
@theme(".footer")
```