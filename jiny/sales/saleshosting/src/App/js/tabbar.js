/*
     * step #03-01
     *      - 방법1 : 탭메뉴에서 탭패널을 직접 접근하는 방법
     * step #02
     *      - 탭패널 구현하기 
     * 
     * step #01
     *      - 탭메뉴 구현하기
     * 
     */
    var tabPanel1 = null;
    $(document).ready(function(){       
        // 탭메뉴 코드가 동작할 수 있도록 tabMenu() 함수 호출 
        tabMenu("#tabMenu1");        
        
        // 탭패널 기능 호출
        tabPanel1 = tabPanel(".tab-contents");

        //1번째 탭 패널 활성화
        tabPanel1.setSelectPanel(0);

    });
    
    // 탭메뉴 기능 구현하기
   
    function tabMenu(selector){
    
        var $tabMenu = null;    
        var $menuItems = null;
        // 선택 한 탭메뉴를 저장할 변수
        var $selectMenuItem =null;
            
        // 요소 초기화, tabMenu() 함수 내부에서 사용할 공통 데이터는 모두 이곳에 작성해주세요.
        function init(){
            $tabMenu = $(selector);        
            $menuItems =$tabMenu.find("li");                
        }
        
        // 이벤트 등록은 모두 이곳에 작성해주세요.
        function initEvent(){
            $menuItems.click(function(){
                setSelectItem($(this));
            });
        }
    
        // 선택 메뉴 아이템 만들기     
        function setSelectItem($item){
            if($selectMenuItem){
                $selectMenuItem.removeClass("select");
            }    
            $selectMenuItem = $item;
            $selectMenuItem.addClass("select");            
            
            // index에 맞는 탭패널 내용 활성화하기
            tabPanel1.setSelectPanel($item.index());
        }
        
        init();
        initEvent();    
    }
    
    
    // 탭패널 기능 구현하기
    function tabPanel(selector){
        var $tabPanels = null;
        var $selectPanel = null;
        function init(selector){
            $tabPanels = $(selector).find(".content");        
        }
        
        function setSelectPanel(index){
            if($selectPanel){
                $selectPanel.removeClass("select");
            }   
            $selectPanel = $tabPanels.eq(index);
            $selectPanel.addClass("select");
        }
        
        init(selector);
        
        // 선택기능 리턴
        return {
            setSelectPanel:setSelectPanel
        }
    }