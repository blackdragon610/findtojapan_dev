<template>
    <div class="text-center padding-top-5">
        <div class="inline-block" @click="onLike">
            <img v-if="user.isLike" src="images/nowheart_on.png" style="width: 20px;">
            <img v-else src="images/nowheart.png" style="width: 20px;">
        </div>
        <div class="littlesub inline-block margin-left-2" @click="onLike">
            {{ user.count_like}}
        </div>
        <div class="inline-block margin-left-15" @click="onFollower">
            <img v-if="user.isFollower" src="images/nowjoin_on.png" style="width: 20px;">
            <img v-else src="images/nowjoin.png" style="width: 20px;">
        </div>
        <div class="littlesub inline-block margin-left-2" @click="onFollower">
            {{ user.count_follower}}
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
        @Prop() public user!: any

        public userMy: any

        public created()
        {

            let $UserClass = new UserClass()
            this.userMy = $UserClass.user
        }

        public onLike() : void
        {
            let self = this
            let $LikeClass = new LikeClass()
            $LikeClass.isLoading = false

            if (this.user.isLike){
                //削除
                self.user.isLike = false
                self.user.count_like--
                $LikeClass.saveDestroyUser(this.user.id, function(result:any){
                    //self.user.count_like = result.count
                })
            }else{
                //追加
                self.user.isLike = true
                self.user.count_like++
                $LikeClass.saveUser(this.user.id, function(result:any){
                    //self.user.count_like = result.count
                })

            }
        }

        public onFollower() : void
        {
            let self = this
            let $FollowerClass = new FollowerClass()
            $FollowerClass.isLoading = false


            if (this.user.isFollower){
                //削除
                self.user.count_follower--
                self.user.isFollower = false
                $FollowerClass.saveDestroyUser(this.user.id, function(result:any){
                    //self.user.count_follower = result.count
                })
            }else{
                //追加
                self.user.count_follower++
                self.user.isFollower = true

                $FollowerClass.saveUser(this.user.id, function(result:any){
                    //self.user.count_follower = result.count
                })

            }
        }
    }

</script>
