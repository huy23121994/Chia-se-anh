$(document).ready(function(){
   $("button.follow-btn").click(function(){
       var obj = $(this);
       $.ajax({
          url: obj.attr('itemid'),
          type: 'POST',
          dataType: 'html',
          data: {
              user_id: $("#user_id").val(),
              current_user: $("#current_user").val()
          },
          success: function(result){
              if(result == 'true'){
                  obj.hide();
                  $("button.unfollow-btn").show();
              }
          }
       });
   }); 
   $("button.unfollow-btn").click(function(){
       var obj = $(this);
       $.ajax({
          url: obj.attr('itemid'),
          type: 'POST',
          dataType: 'html',
          data: {
              user_id: $("#user_id").val(),
              current_user: $("#current_user").val()
          },
          success: function(result){
              if(result == 'true'){
                  obj.hide();
                  $("button.follow-btn").show();
              }
          }
       });
   }); 
   
   //comment 
    var kt = 0;
    $('.titleBox').click(function () {
        $('.actionBox').toggle(300);
        if (kt == 0) {
            $('.titleBox span').attr('class','glyphicon glyphicon-chevron-down');
            kt = 1;
        } else {
            $('.titleBox span').attr('class','glyphicon glyphicon-chevron-up');
            kt = 0;
        }
        ;
    });
    
    $('#comment-form').submit(function (e) {
        e.preventDefault();
        if ($('textarea.comment-conent').val() != '') {
            var formData = new FormData($('#comment-form')[0]);
            e.preventDefault();
            var obj = $(this);
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                dataType: 'JSON',
                type: 'POST',
                contentType: false,
                processData: false,
                cache: false,
            }).done(function (data) {
                // alert('comment thanh cong');
                var cmt_content = $('textarea.comment-conent').val();
                var str = "<li><p>" + data.user_name + "</p><div class=\"commentText\"><span class='form-control'>" + data.content + "</span><span class=\"date sub-text\">on" + data.updated_at + "</span></div></li>";
                $('ul.commentList').prepend(str);
                $('.comment-conent').attr('placeholder', 'Viết bình luận của bạn...');
                $('.comment-conent').val('');
            }).fail(function () {
                alert('* Bạn không có quyền bình luận !');
            });
        } else {
            $('.comment-conent').attr('placeholder', 'Bạn cần nhập nội dung trước khi bình luận !!!');
            return false;
        }
        ;
    });
});