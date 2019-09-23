function ban_one(sid) {
    let ban_btn = document.querySelector('.ban[href="javascript:ban_one(' + sid + ')"]');

    if (ban_btn.style.color == 'rgb(0, 123, 255)') {
        Swal.fire({
            title: `會員禁用`,
            text: `確定要禁用編號為 ${sid} 的資料嗎?`,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: '取消',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '禁用'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '已禁用!',
                    `編號為 ${sid} 的資料已禁用`,
                    'success'
                )
                location.href = 'data_ban.php?sid=' + sid;
            }
        })

        // if(confirm(`確定要禁用編號為 ${sid} 的資料嗎?`)){
        //     location.href = 'data_ban.php?sid=' + sid;
        // }
    } else {
        Swal.fire({
            title: `解除禁用`,
            text: `確定要解除編號為 ${sid} 的資料的禁用嗎?`,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: '取消',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '解除'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '已解除!',
                    `編號為 ${sid} 的資料的禁用已解除`,
                    'success'
                )
                location.href = 'remove_data_ban.php?sid=' + sid;
            }
        })
        // if(confirm(`確定要解除編號為 ${sid} 的禁用嗎?`)){
        //     location.href = 'remove_data_ban.php?sid=' + sid;
        // }
    }
}