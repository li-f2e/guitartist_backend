//禁用
let banBtns = document.querySelectorAll('.ban');
// console.log(banBtns);

banBtns.forEach( function(banBtn) {

    banBtn.onclick = function(){    
        let isBaned = this.dataset.baned;
        // console.log(isBaned);
        let sid = this.dataset.sid;
        // console.log(sid);


        if ( isBaned == 0 ){
            Swal.fire({
                title: `會員禁用`,
                text: `確定要禁用編號為 ${sid} 的資料嗎?`,
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: '取消',
                confirmButtonColor: 'var(--red)',
                cancelButtonColor: 'var(--dark)',
                confirmButtonText: '禁用'
            })
            .then( (result) => {
                if (result.value) {
                    $('.swal2-success-fix').css('color', 'black');
                    Swal.fire(
                        '已禁用!',
                        `編號為 ${sid} 的資料已禁用`,
                        'success'
                    )

                    setTimeout(() => {
                        location.href = 'data_ban.php?sid=' + sid;
                    }, 1500);
                    
                }
            })
        }
        else {
            Swal.fire({
                title: `解除禁用`,
                text: `確定要解除編號為 ${sid} 的資料的禁用嗎?`,
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: '取消',
                confirmButtonColor: 'var(--success)',
                cancelButtonColor: 'var(--dark)',
                confirmButtonText: '解除'
            })
            .then((result) => {
                if (result.value) {
                    $('.swal2-success-fix').css('color', 'black');
                    Swal.fire(
                        '已解除!',
                        `編號為 ${sid} 的資料的禁用已解除`,
                        'success'
                    )

                    setTimeout(() => {
                        location.href = 'remove_data_ban.php?sid=' + sid;
                    }, 1500); 
                }
            })
            
        }
        
    }
});