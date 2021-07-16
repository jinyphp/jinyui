document.addEventListener("DOMContentLoaded", function(){
    const sidebar = document.querySelectorAll(".sidebar");
    //var zindex = 100;
    sidebar.forEach(el => {
        /*
        let width = "264px"; // 초기값

        //el.style.zIndex = zindex--;

        if(el.dataset.width) {
            // 데이터 값으로 width 변경
            if(el.dataset.width.includes('px')) {
                width = el.dataset.width; 
            } else {
                width = el.dataset.width + "px"; 
            }                
        }

        el.style.width = width;

        // 요소숨김 => margin을 이용하여 밀어넣기로 변경
        if(el.classList.contains("hidden")) {
            el.style.marginLeft = "-" + width;// + "px";
            el.classList.remove("hidden");
        }
        */

    });
});

window.addEventListener("load", function(){
    const btnToggle = document.querySelectorAll(".sidebar-toggle");
    btnToggle.forEach(el => {

        el.addEventListener("click", function(e){
            let btn = e.target;
            while(btn.tagName !== "BUTTON") { // 테그명 대문자 비교
                btn = btn.parentElement;
            }

            let target = btn.dataset.target;
            let sidebar;
            if (target) {
                sidebar = document.querySelector(".sidebar"+"[data-sidebar='"+target+"']");
                console.log(target);
                console.log(sidebar);
            } else {
                sidebar = document.querySelector(".sidebar");
            }

            //sidebar collapsed
            sidebar.classList.toggle("collapsed");
            /*
            if(sidebar.style.marginLeft) {
                sidebar.style.marginLeft = null;
            } else {
                sidebar.style.marginLeft = "-" + sidebar.clientWidth + "px";
            }
            */           
        
        });
    });
});