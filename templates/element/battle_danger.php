<div class="battledanger" id="id-battledanger">
    <!-- 他画面から呼ぶためにリロードボタンを定義 -->
    <button id="id-battledanger-reload" class="button-hidden" type="button"></button>
    <div id="id-battledanger-data">
    </div>
</div>
<script>
jQuery(function(){
    var getBattleDanger = function() {
        var getBattleDangerTimerObj;
        jQuery.ajax({
            url: '<?php echo $this->Url->build([
                            'controller' => 'Battle',
                            'action' => 'danger',
                            $chatRoomId,
                            "?" => ['battle_id' => $battleTurn->id ],
                        ]); ?>',
            type: 'GET',
            dataType: 'html',
        }).done(function (data, status, jqXHR) {
            jQuery('#id-battledanger-data').html(data);
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
            clearInterval(this.getBattleDangerTimerObj);
            this.getBattleDangerTimerObj = setInterval(function() {
                getBattleDanger();
            }, 20 * 1000);
        });
    }
    getBattleDanger();
    jQuery('#id-battledanger-reload').on('click', function(){
        getBattleDanger();
        return false;
    });
});
</script>
