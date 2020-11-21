<template>
    <div id="mypage"> 　

        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-20">
                    <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                       <img src="images/back.png"width="24%;" style="margin-top:1px;">
                    </div>
                </div>
                <div class="col-60  text-center margin-top-2">
                    {{user.user_name}}
                </div>
           <div class="col-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-100 userprofile">
                <HeaderUser v-if="user" :user="user"></HeaderUser>

                <div class="clearfix">
                    <div class="col-55">
                        <img src="images/bottom.png" width="16%;" style="float:right;" v-show="isButtonBottom" @click="onDetail">
                    </div>
                </div>

           <div v-show="isDetail">
             <div class=" margin-left-15 margin-right-15 userline"></div>
                 <div class="col-20 margin-top-7 margin-left-15 userfont">
                        自己紹介
                 </div>
             <div class="col-96 margin-top-3 margin-left-15 userfontcover text-pre">{{user.pr}}</div>
              <div class="col-25 margin-top-7 margin-left-15 userfont">
                  好きなカテゴリー
              </div>
           <div class="col-90">
              <div class="margin-top-3 margin-left-15">
                  <div class="clearfix">
                     <div class="userbox flexiblebox" v-for="category in user.categories">
                         {{category.category.category_name}}
                     </div>
                  </div>
               </div>
            </div>

               <div class="clearfix">
                   <div class="col-56">
                       <img src="images/up.png" width="19%;" style="float:right;" @click="onNotDetail">
                   </div>
               </div>
           </div>
          </div>
      </div>

        <div class="container">
            <div class="circle-gray margin-top-13">
                <UserLikes v-if="user" :user="user"></UserLikes>
            </div>
        </div>
 <div class="titleline col-100 margin-top-7"></div>
  <div class="titleline col-100" v-for="post in posts" @click="onPost" :target="post.id">
	  <div class="row" style="pointer-events: none;">
	     <div class="col-25">
		     <div class="margin-left-15">
                  <img v-image="post.image" dir="posts" size="Thum"  class="profilecover" width="72%" />
		     </div>
         </div>
        <div class="col-55 margin-top-8">
	           <div class="mainfontsub">
                   {{post.body}}
	          </div>
             <dl>
	           <dt class="littlesub">
                   {{post.user.user_name}}
               </dt>
                <dd class="pink-btn-big text-center margin-right-8" style="display:inline-block;" v-if="post.user.is_official">公認アンバサダー</dd>
             </dl>
          </div>
          <div class="col-20 margin-top-40">
             <div class="margin-left-36">
                 <img src="images/redtrophy.png" width="79%"/>
             </div>
            </div>
           </div>
       </div>
   </div>



</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import UserClass from "../http/UserClass";
    import LikeClass from "../http/LikeClass";
    import FollowerClass from "../http/FollowerClass";
    import PostClass from "../http/PostClass";
    import HeaderUser from "./layouts/HeaderUser.vue";
    import UserLikes from "./layouts/UserLikes.vue";


    @Component({
        components: {
            HeaderUser,
            UserLikes
        },
    })

    export default class extends Mixins<Base>(Base){
        public user:any = {}
        public posts:any = {}
        public isDetail:boolean = false
        public isButtonBottom:boolean = true

        public async created()
        {
            let userId:number = parseInt(String(this.$route.query.target))

            //投稿の一覧取得
            let $PostClass = new PostClass()
            let self = this
            $PostClass.getUser(userId, function(result:any){
                self.posts = result
            })

            //ユーザー情報取得
            let $UserClass = new UserClass()
            this.user = await $UserClass.get(userId)
        }
        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()

        }



        public onDetail()
        {
            this.isDetail = true
            this.isButtonBottom = false
        }

        public onNotDetail()
        {
            this.isDetail = false
            this.isButtonBottom = true
        }

        /**
         * 記事を選択
         */
        public onPost(eventHandle:any)
        {
            this.$router.push({name:"post_detail", query:{target:eventHandle.target.getAttribute("target")}})
        }
    }


</script>
