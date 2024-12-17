<div class="content" id="id-chatroomlist">
    <header class="content-header">
        <h3><?= __('部屋') ?></h3>
        <div class="content-more" id="view-count"></div>
    </header>
    <div class="table-responsive" id="id-chatroomlist-table">
    </div>
    <div id="id-chatroomlist-reload">（自動更新）</div>
</div>
<script>
jQuery(function(){
    var getChatRoomList = function() {
        var getChatRoomListObj;
        jQuery.ajax({
            url: '<?php echo $this->Url->build(['controller' => 'ChatRooms', 'action' => 'topListTable',]); ?>',
            type: 'GET',
            dataType: 'html',
        }).done(function (data, status, jqXHR) {
            jQuery('#id-chatroomlist-table').html(data);
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
            // 自動更新を有効にする場合はコメントアウトを外してください
            // ここから
            jQuery('#id-chatroomlist-reload').show();
            clearInterval(this.getChatRoomListObj);
            this.getChatRoomListObj = setInterval(function() {
                getChatRoomList();
            }, 20 * 1000);
            // ここまで
        });
    }
    getChatRoomList();

    var getViewCount = function() {
        var getViewCountObj;
        jQuery.ajax({
            url: '<?php echo $this->Url->build(['controller' => 'Chat', 'action' => 'viewCount',]); ?>',
            type: 'GET',
            dataType: 'json',
        }).done(function (data, status, jqXHR) {
            var cnt = '閲覧 ' + data['views'] + ' 人';
            jQuery('#view-count').html(cnt);
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
            // 自動更新を有効にする場合はコメントアウトを外してください
            // ここから
            clearInterval(this.getViewCountObj);
            this.getViewCountObj = setInterval(function() {
                getViewCount();
            }, 20 * 1000);
            // ここまで
        });
    }
    getViewCount();
});
</script>
