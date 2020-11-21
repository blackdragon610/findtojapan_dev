function Suggest(url, suggestFrom, suggestTo, div){
    var self = this
    this.suggestFrom = suggestFrom
    this.suggestTo = suggestTo
    this.datas = []
    this.div = div

    this.done = null

    this.suggest = function(){
        self.suggestTo.css("display", "none")

        var text = this

        if ($(this).val().length >= 2){
            $.ajax({
                url:url,
                type:"GET",
                data:{keyword:$(this).val()},
                dataType:"json",
            }).done(function(data,textStatus,jqXHR) {
                self.datas = data
                //サジェストの表示処理
                var html = ""

                suggestTo.css("display", "block")

                for (var key in self.datas){
                    html+='<span class="btn suggest-click" target="' + key + '">' + self.datas[key].value + '</span><br />'
                }

                self.suggestTo.html(html)

                $(".suggest-click").click(self.onClick)
            })
        }
    }

    this.onClick = function(){
        var key = $(this).attr("target")

        self.suggestFrom.val(self.datas[key].value)
        self.suggestTo.css("display", "none")

        if (self.done){
            self.done(self.datas[key])
        }

    }

    this.suggestFrom.keyup(this.suggest)
}