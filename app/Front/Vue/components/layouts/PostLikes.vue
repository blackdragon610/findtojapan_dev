<template>
    <div>
        <Dialog message="" title="シェア" ref="dialog" />

        <div class="row">
            <div class="col-17"></div>
            <div class="col-9 margin-top-1"　@click="onLike">
                <img v-if="post.isLike" src="images/nowheart_on.png" style="width: 68%; margin-top:6px;">
                <img v-else src="images/nowheart.png" class="socialsmall">
            </div>
            <div class="col-11 littlesub margin-top-6">
                {{ post.count_like}}
            </div>
            <div class="col-9 margin-top-1" v-if="post.user.id != user.id" @click="onFollower">
                <img v-if="post.user.isFollower" src="images/nowjoin_on.png" style="width: 68%; margin-top:7px;">
                <img v-else src="images/nowjoin.png" class="socialsmall"style="margin-top:6px;">
            </div>
            <div class=" col-11 littlesub margin-top-6" v-if="post.user.id != user.id">
                {{ post.user.count_follower}}
            </div>
            <div class="col-9 margin-top-1" @click="onReply">
                <img v-if="post.isReply" src="images/nowyajirushi_on.png" style="width: 68%; margin-top:6px;">
                <img v-else src="images/nowyajirushi.png" class="socialsmall">
            </div>
            <div class="col-11 littlesub margin-top-6">
                {{ post.count_reply}}
            </div>
        </div>
    </div>
</template>


<script lang="ts">
    import {Component, Vue} from 'vue-property-decorator'
    import {Prop} from "vue-property-decorator";
    import {Mixins} from "vue-mixin-decorator";
    import LikeClass from "../../http/LikeClass";
    import UserClass from "../../http/UserClass";
    import FollowerClass from "../../http/FollowerClass";
    import Dialog from "./Dialog.vue";

    @Component({
        components: {Dialog}
    })
    export default class extends Vue{
        @Prop() public post!: any

        public user: any

        public created()
        {
            let $UserClass = new UserClass()
            this.user = $UserClass.user

            //alert(this.post.user.id)
        }

        /**
         *  記事のいいね
         */
        public onLike(eventHandle:any) : void
        {
            eventHandle.stopPropagation()

            let self = this
            let $LikeClass = new LikeClass()
            $LikeClass.isLoading = false

            if (this.post.isLike){
                //削除
                self.post.isLike = false
                self.post.count_like--
                $LikeClass.saveDestroyPost(this.post.id, function(result:any){
                    //self.user.count_like = result.count
                })
            }else{
                //追加
                self.post.isLike = true
                self.post.count_like++
                $LikeClass.savePost(this.post.id, function(result:any){
                    //self.user.count_like = result.count
                })

            }
        }

        /**
         * ユーザーへのフォロー
         */
        public onFollower(eventHandle:any) : void
        {
            eventHandle.stopPropagation()

            let self = this
            let $FollowerClass = new FollowerClass()
            $FollowerClass.isLoading = false


            if (this.post.user.isFollower){
                //削除
                self.post.user.count_follower--
                self.post.user.isFollower = false
                $FollowerClass.saveDestroyUser(this.post.user.id, function(result:any){
                    //self.user.count_follower = result.count
                })
            }else{
                //追加
                self.post.user.count_follower++
                self.post.user.isFollower = true

                $FollowerClass.saveUser(this.post.user.id, function(result:any){
                    //self.user.count_follower = result.count
                })

            }
        }

        /**
         * 記事のリプライ
         */
        public onReply(eventHandle:any)
        {
            eventHandle.stopPropagation()

            let self = this

            //リプライ処理
            let $LikeClass = new LikeClass()
            $LikeClass.isLoading = false

            if (self.post.isReply) {
                //削除
                self.post.isReply = false
                self.post.count_reply--
                $LikeClass.saveDestroyReply(self.post.id, function (result: any) {
                    //self.user.count_like = result.count
                })
            }else{
                let refs = this.$refs as any

                var message:string = "<textarea id='comment' class='form-control' placeholder='コメントを入力'></textarea>"
                message+= "<div class='text-pre'>" + this.post.body + "</div>"



                refs.dialog.setMessage(message)
                refs.dialog.okName = "リプライする"
                refs.dialog.cancelName = "キャンセルする"
                refs.dialog.fncOk = function(){

                    let element:any = document

                    // @ts-ignore
                    let comment:string = document.getElementById("comment").value

                    //追加
                    self.post.isReply = true
                    self.post.count_reply++
                    $LikeClass.saveReply(self.post.id, comment,function(result:any){
                        //self.user.count_like = result.count
                    })

                }
                refs.dialog.show()
            }
        }
    }

</script>
