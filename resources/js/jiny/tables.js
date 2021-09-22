function selectTableRow()
{
    // 선택, 해제
    var selected = 0;
    var rowCheck = document.querySelectorAll('table tbody .rowCheckbox');
    var allCheck = document.querySelector("table thead #all_checks");

    var btnDelete = document.querySelector("#selected-delete");
    
    allCheck.addEventListener("click",function(e){
        checkAll(e.target.checked);
        if(e.target.checked) {
            selected = rowCheck.length;
            if(btnDelete) btnDelete.removeAttribute("disabled");
        } else {
            selected = 0;
            if(btnDelete) btnDelete.setAttribute("disabled",true);
        }
    });
    
    rowCheck.forEach(el=> {
        el.addEventListener("click",function(e){
            let Tr = el.parentElement.parentElement.parentElement;
            if(e.target.checked) {
                Tr.classList.add('row-selected');
                selected++;
            } else {
                Tr.classList.remove('row-selected');
                selected--;
            }

            if (selected == rowCheck.length) {
                allCheck.checked = true;
            } else {
                allCheck.checked = false;
            }

            if(selected && btnDelete) {
                btnDelete.removeAttribute("disabled");
            } else {
                btnDelete.setAttribute("disabled",true);
            }
        });
    });

    function checkAll(status) {
        rowCheck.forEach(el=> {
            el.checked = status;

            let Tr = el.parentElement.parentElement.parentElement;
            if (status) {
                Tr.classList.add('row-selected');
            } else {
                Tr.classList.remove('row-selected');
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", selectTableRow);