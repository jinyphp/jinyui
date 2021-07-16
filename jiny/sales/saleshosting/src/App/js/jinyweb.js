function menu_url(url,mode,value){
    var form = document.menu;
    form.action = url;
    form.menu_mode.value = mode;
    form.menu_value.value = value;
    form.submit();
    alert(url);
}