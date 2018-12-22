var postId = 0;
var likeCount = 0;
var likeCountClass = '';

$('.like').on('click', function(event) {

    event.preventDefault();
    //どの投稿が押されたのかを判別する
    postId = event.target.parentNode.parentNode.parentNode.parentNode.dataset['postid'];
    likeCount = event.target.parentNode.parentNode.parentNode.dataset['like'];
    likeCount = Number(likeCount);
    likeCountClass = event.target.parentNode.parentNode.parentNode.getAttribute("class");

    var likeId = '#' + postId;
    likeCountClass = '.' + likeCountClass; 

    $.ajax({
        method: 'POST',
            url: urlLike, //route('like')
            data:{
                postId: postId,
                _token: token
            }
        })

    //成功時の処理
    .done(function() {
        //「いいね」ボタンを押下済に切り替える
        //まだ押してないとき
        if (!$(likeId).hasClass('up')) {
            likeCount ++;
            event.target.parentNode.innerHTML 
            = `<i style="color:#ff69b4;" class="fas fa-heart"></i><p style="color:#ff69b4;display:inline-block;">&nbsp;&nbsp;(${likeCount})</p>`;
            $(likeId).addClass('up');
            $(likeCountClass)[0].dataset.like = likeCount;
        }else{
        //いいね済み
            if (likeCount <= 1 || likeCount == 'NULL') {
                event.target.parentNode.innerHTML 
                = `<i style="color:#ff69b4;" class="far fa-heart"></i><p style="color:#ff69b4;display:inline-block;"></p>`; 
                $(likeId).removeClass('up'); 
                $(likeCountClass)[0].dataset.like = likeCount -1;
            }else{
                likeCount --;
                event.target.parentNode.innerHTML 
                = `<i style="color:#ff69b4;" class="far fa-heart"></i><p style="color:#ff69b4;display:inline-block;">&nbsp;&nbsp;(${likeCount})</p>`; 
                $(likeId).removeClass('up');
                $(likeCountClass)[0].dataset.like = likeCount;
            }
        }
    });

});