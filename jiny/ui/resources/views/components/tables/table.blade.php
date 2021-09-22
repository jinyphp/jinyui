<style>
    .row-selected {
        background-color: #fcf7c2;
    }
</style>
{!! xTable($slot)->setAttrs($attributes) !!}









{{--


{!! $tableBuild($slot, $attributes) !!}
--}}











{{--
라이브와이어 쪽으로 이동함

<script>
    document.addEventListener("DOMContentLoaded", function() {
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



    });

</script>
--}}


{{-- 선택삭제 --}}
{{-- <x-button danger id="btn-delete" wire:click="deleteSelected">삭제(F4)</x-button> --}}
{{--
<script>
    /*
	document.addEventListener("DOMContentLoaded", function() {
		let delBtn = document.querySelector('#btn-delete');
		delBtn.addEventListener("click",function(e){
			//alert("delete");

			// 체크된 항목만 선택
			let item = [];
			let check = document.querySelectorAll('input[name=ids]:checked');
            check.forEach(el=>{
				// 항목의 value값만을 추출하여 배열에 저장
                item.push(parseInt(el.attributes.value.value))
            });
            console.log(item);

			if (item.length>0 && confirm("are you delete")) {
				let form = document.querySelector('form#filter');
                let url = form.action;
				//let url = "/admin/members";
                let token = form.querySelector('input[name=_token]').value;

				console.log("route"+url);
                console.log("csrf" + token);

				// AJAX 선택삭제                
				fetch(url, {
					method: 'DELETE',
					headers: {'Content-Type': 'application/json'},
					body: JSON.stringify({ 
						_token: token,
						ids:item
					})
				}).then(function(response) {
					response.json().then(function(json) {
						// process your JSON further
						console.log(json);
						Livewire.emit('refeshTable');
					});
				}).catch(function(error) {
					// Error
					//console.log(error);
				});
				
            }

		})
	});
    */
</script>
--}}