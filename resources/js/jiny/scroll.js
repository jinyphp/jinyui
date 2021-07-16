window.addEventListener("load", function(e){
    const scroll = document.querySelectorAll(".scroll");
    var timer = null;
    scroll.forEach(el => {
        el.addEventListener("scroll", function(e){
            // 타이머를 이용하여 스크롤 종료시간 측정
            if(timer !== null) {
                clearTimeout(timer); 
                //console.log("scrolling...");
                e.target.classList.add("active");
            }
            timer = setTimeout(function() {
                //console.log("scrol stop >>");
                e.target.classList.remove("active");
            }, 700);
    
        });
    });
    
});