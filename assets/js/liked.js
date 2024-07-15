function liked(i, id_user){
    const data = i.value
    const btn = document.getElementById(`forum_${data}`)
    if(btn.classList.contains('clicked')){
        btn.classList.remove('clicked')
        btn.classList.add('desaclicked')
        action_dislike(data, id_user)
    }else{
        btn.classList.remove('desaclicked')
        btn.classList.add('clicked')
        action_like(data, id_user)
    }
}

function action_like(id_reddit, id_user) {
    $.ajax({
        url: './controller/liked_reddit_controller.php',
        type: 'post',
        data: { action: 'like', id_reddit: id_reddit, id_user: id_user },
        dataType: 'json',
        success: function(response) {
            $('#count_'+id_reddit).text(`${response.likes} Gostei`);
        }
    });
}

function action_dislike(id_reddit,id_user) {
    $.ajax({
        url: './controller/liked_reddit_controller.php',
        type: 'post',
        data: { action: 'dislike', id_reddit: id_reddit, id_user: id_user },
        dataType: 'json',
        success: function(response) {
            $('#count_'+id_reddit).text(`${response.likes} Gostei`);
        }
    });
}