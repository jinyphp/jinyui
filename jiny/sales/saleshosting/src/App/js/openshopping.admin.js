$(document).ready(function(){
	
    // Quick Edit: Layout 선택
    $('body').on('mouseover',function(event){
        $(this).css("border","1px solid #ff0000");
        event.stopPropagation();  // 이벤트버블링 방지

        $.contextMenu({
            selector: 'body',
            callback: function(key, options) {
                if(key == "layout"){
                    var url = "/easy/easy_layout.php";
                    popup_ajax(url);
                } else {
                    var url = "/easy/easy_layout_html.php";
                    popup_ajax(url);   
                }
                
            },
            items: {
                "layout": {name: "Layout", icon: "edit"},
                "html": {name: "html", icon: "edit"},
                "sep1": "---------",
                "domain": {name: "Domain", icon: "cut"},
                "language": {name: "Language", icon: "copy"},
                "country": {name: "Country", icon: "paste"},
                "currency": {name: "Currency", icon: "delete"},
                "sep1": "---------",
                "theme": {name: "Theme", icon: "quit"},
                "pages": {name: "pages", icon: "quit"},
                "board": {name: "board", icon: "quit"}
            }
        });

    }).on('mouseout',function(event){
        $(this).css("border","");
        event.stopPropagation();  // 이벤트버블링 방지
    });



    // Quick Edit: Header_body 선택
    $('#header_body').on('mouseover',function(event){
        $(this).css("border","1px solid #ff0000");
        event.stopPropagation();  // 이벤트버블링 방지

        $.contextMenu({
            selector: '#header_body',
            callback: function(key, options) {
                if(key == "header"){
                    var url = "/easy/easy_header.php";
                    popup_ajax(url);
                } else {
                    var url = "/easy/easy_header_html.php";
                    popup_ajax(url);   
                }
                                
            },
            items: {
                "header": {name: "Header Edit", icon: "edit"},
                "sep1": "---------",
                "html": {name: "Header HTML", icon: "edit"}
                
            }
        });

    }).on('mouseout',function(event){
        $(this).css("border","");
        event.stopPropagation();  // 이벤트버블링 방지
    });


    // Quick Edit: Header_body 선택
    $('#footer_body').on('mouseover',function(event){
        $(this).css("border","1px solid #ff0000");
        event.stopPropagation();  // 이벤트버블링 방지

        $.contextMenu({
            selector: '#footer_body',
            callback: function(key, options) {
                if(key == "footer"){
                    var url = "/easy/easy_footer.php";
                    popup_ajax(url);
                } else {
                    var url = "/easy/easy_footer_html.php";
                    popup_ajax(url);   
                }
                                
            },
            items: {
                "footer": {name: "Footer Edit", icon: "edit"},
                "sep1": "---------",
                "html": {name: "Footer HTML", icon: "edit"}
                
            }
        });

    }).on('mouseout',function(event){
        $(this).css("border","");
        event.stopPropagation();  // 이벤트버블링 방지
    });


    // Quick Edit: Header_body 선택
    $('#mainbody').on('mouseover',function(event){
        $(this).css("border","1px solid #ff0000");
        event.stopPropagation();  // 이벤트버블링 방지

        $.contextMenu({
            selector: '#mainbody',
            callback: function(key, options) {
                var class_name = $(this).attr('class');
                alert(class_name);
                if(key == "html"){
                    var url = "/easy/easy_theme_edit.php?class=" + class_name;
                    popup_ajax(url);
                } 
                                
            },
            items: {
                "html": {name: "Theme HTML", icon: "edit"}
                
            }
        });

    }).on('mouseout',function(event){
        $(this).css("border","");
        event.stopPropagation();  // 이벤트버블링 방지
    });




    // Quick Edit: cssMenu 선택
    $('#cssmenu').on('mouseover',function(event){
        $(this).css("border","1px solid #ff0000");
        event.stopPropagation();  // 이벤트버블링 방지

        $.contextMenu({
            selector: '#cssmenu',
            callback: function(key, options) {
                if(key == "tree"){
                    var url = "ajax_menu_tree.php";
                    popup_ajax(url);
                }

                
            },
            items: {
                "tree": {name: "Menu Tree", icon: "edit"},
                "sep1": "---------",
                "code": {name: "Menu code", icon: "edit"},
                "sep1": "---------",
                "setting": {name: "Menu Setting", icon: "edit"}
            }
        });


    }).on('mouseout',function(event){
        $(this).css("border","");
        event.stopPropagation();  // 이벤트버블링 방지

    });


    $('#title_images').on('mouseover',function(event){     
        event.stopPropagation();  // 이벤트버블링 방지
        $(this).css("border","1px solid #ff0000");

        $.contextMenu({
            selector: '#title_images',
            callback: function(key, options) {
                 $(this).css("border","1px solid #ff0000");
                var class_name = $(this).attr('class');
                if(key == "title"){
                    var url = "/easy/easy_title_edit.php?class=" + class_name;
                    popup_ajax(url);
                } else if(key == "inner"){
                    var url = "/easy/easy_title_inner.php?class=" + class_name;
                    popup_ajax(url);
                } 
            },
            items: {
                "title": {name: "Title", icon: "edit"},
                "inner": {name: "Inner HTML", icon: "edit"},
                "sep1": "---------",
                "title_code": {name: "Title code", icon: "edit"}
            }
        });

    }).on('mouseout',function(event){
        event.stopPropagation();  // 이벤트버블링 방지
        $(this).css("border","");
    });


    $('#block_html').on('mouseover',function(event){     
        event.stopPropagation();  // 이벤트버블링 방지
        $(this).css("border","1px solid #ff0000");

        $.contextMenu({
            selector: '#block_html',
            callback: function(key, options) {
                //$(this).css("border","1px solid #ff0000");
                var class_name = $(this).attr('class');
                // alert(class_name);
                if(key == "block"){
                    var url = "/easy/easy_block_edit.php?class=" + class_name;
                    popup_ajax(url);
                } 
            },
            items: {
                "block": {name: "Block", icon: "edit"},
                "sep1": "---------",
                "block_code": {name: "Block code", icon: "edit"}
            }
        });

    }).on('mouseout',function(event){
        event.stopPropagation();  // 이벤트버블링 방지
        $(this).css("border","");
    });




})	
	
