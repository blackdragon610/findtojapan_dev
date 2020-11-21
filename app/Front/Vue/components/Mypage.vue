<template>
  <div id="mypage"> 　

   <div class="row">
        <div class="mainfont titleline col-100">
	       <div class="col-30">
	        <div class="margin-left-15 margin-top-5">
                <span v-language="'MYPAGE'">マイページ</span>
            </div>
           </div>
       </div>
  </div>
      <div class="row">
	      <div class="col-100 profile">
		      <div class="btn-circle-3d">
			     <img v-image="user.image" dir="users" size="Thum">
		      </div>
			  <span>{{ user.user_name }}</span>
			  <p>{{ user.message }}</p>
		      <img src="images/pen.png" class="pen" @click="onProfile">
		 </div>
	   </div>

 <div class="container">
    	<div class="torofiee_container margin-top-20">
    	<h1 v-language="'Status'">今のランク</h1>
    	<img src="images/redtrophyee.svg">
    	<span v-if="count.rankFuture" v-language-net>{{count.rankFuture.rank_name}}</span>
    	</div>
        <div class="torofiee_container margin-top-9" v-if="count.rankFuture">
    	    <h1 v-language="'Achievement rate'">次のランクまで</h1>
    	    <img src="images/yellowtrophyee.svg">
            <span v-language-net>あと{{pointFuture}}pt</span>
        </div>

       <div class="margin-top-5">
	       <img src="images/repeat.png"width="8%" style="margin-left: 140px;">
          <span class="description" v-language="'About trophy color and rank'">トロフィーの色とランクについて</span>
      </div>
      <div class="row margin-top-15">

            <div class="mainfont mypageline col-100">
	          <div class="col-8 margin-left-2 margin-top-5">
                 <img src="images/penshiru.svg"width="63%">
              </div>
               <div class="col-45">
                <span v-language="'I went to the number of articles'">行ったよ記事数</span>
              </div>
             <div class="col-40 margin-top-2  article"style="text-align: right;">
               {{count.postGo}}<span style=" display : inline-block;color:#879aaa;margin-left: 3%; font-size: 12px;" v-language="'Case'">件</span>
         </div>
      </div>
   </div>
      <div class="row margin-top-15">
          <div class="mainfont mypageline col-100">
	          <div class="col-8 margin-left-2 margin-top-5">
                 <img src="images/penshiru.svg"width="63%">
              </div>
               <div class="col-35">
                   <span v-language="'I\'ll go the number of articles'">行くよ記事数</span>
              </div>
             <div class="col-50 article"style="text-align: right;">
                 {{count.postGoing}}<span style=" display : inline-block;color:#879aaa;margin-left: 3%; font-size: 12px;" v-language="'Case'">件</span>
             </div>
          </div>
      </div>
     <div class="row margin-top-15">
          <div class="mainfont mypageline col-100">
	          <div class="col-8 margin-left-2 margin-top-5">
                 <img src="images/penshiru.svg"width="63%">
              </div>
               <div class="col-35">
                   <span v-language="'Number of reviews'">レビュー数</span>
              </div>
             <div class="col-50 article"style="text-align: right;">
                 {{count.postReview}}<span style=" display : inline-block;color:#879aaa;margin-left: 3%; font-size: 12px;" v-language="'Case'">件</span>
             </div>
          </div>
      </div>

      <div class="row margin-top-15">
          <div class="mainfont mypageline col-100">
	          <div class="col-8 margin-left-2 margin-top-5">
                 <img src="images/heart.svg"width="63%">
              </div>
               <div class="col-35">
                   <span v-language="'Number of likes'">いいねの数</span>
              </div>
             <div class="col-50 article"style="text-align: right;">
                 {{count.like}}<span style=" display : inline-block;color:#879aaa;margin-left: 3%; font-size: 12px;" v-language="'Case'">件</span>
             </div>
          </div>
      </div>
      <div class="row margin-top-15">
          <div class="mainfont mypageline col-100">
	          <div class="col-8 margin-left-4 margin-top-5">
                 <img src="images/follow.svg"width="63%">
              </div>
               <div class="col-35">
                   <span v-language="'Number of followers'">フォロワー数</span>
              </div>
             <div class="col-50 article"style="text-align: right;">
                 {{count.follower}}<span style=" display : inline-block;color:#879aaa;margin-left: 3%; font-size: 12px;" v-language="'Case'">件</span>
             </div>
          </div>
      </div>
      <div class="row margin-top-15">
          <div class="mainfont mypageline col-100">
	          <div class="col-8 margin-left-4 margin-top-5">
                 <img src="images/yajirushi.svg"width="63%">
              </div>
               <div class="col-39">
                   <span v-language="'Number of shares'">シェアをされた数</span>
              </div>
             <div class="col-50 article"style="text-align: right;">
                 {{count.reply}}<span style=" display : inline-block;color:#879aaa;margin-left: 3%; font-size: 12px;" v-language="'Case'">件</span>
             </div>
          </div>
      </div>
     <div class="row margin-top-15">
          <div class="mainfont mypageline col-100">
	          <div class="col-8 margin-left-4 margin-top-4">
                 <img src="images/hushtug.svg"width="60%">
              </div>
               <div class="col-58"style="color: #4f5d6b; font-size: 13.5px!important;">
                   <span v-language="'Hashtag to favorite'">お気に入りにのハッシュタグ</span>
              </div>
             <div class="col-30 article"style="text-align: right;">
               1234<span style=" display : inline-block; color:#879aaa; margin-left: 5%; font-size: 12px!important;" v-language="'Case'">件</span>
             </div>
          </div>
      </div>
      <div class="row margin-top-15">
          <div class="mainfont mypageline col-100">
	          <div class="col-8 margin-left-4 margin-top-4">
                 <img src="images/hushtug.svg"width="60%">
              </div>
               <div class="col-50">
                   <span v-language="'Favorite category'">お気に入りのカテゴリ</span>
              </div>
             <div class="col-35 article"style="text-align: right;margin-right:0.5px;">
               1234<span style=" display : inline-block;color:#879aaa;margin-left: 3%; font-size: 12px;" v-language="'Case'">件</span>
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
    import StorageClass from "../liblary/StorageClass";
    import UserClass from "../http/UserClass";

    @Component({

    })

    export default class extends Mixins<Base>(Base){
        public user:any
        public count:any = {}
        public pointFuture:number = 0

        public async created()
        {
            let $UserClass = new UserClass()
            this.user = $UserClass.user



            $UserClass.isLoading = false
            let result = await $UserClass.count()
            this.count = result.data

            this.pointFuture = this.count.rankFuture.point - this.count.point
        }
        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
            this.parent().setFooter(5)
        }

        public onProfile() : void
        {
            this.$router.push({name:"profile"})
        }
    }


</script>
