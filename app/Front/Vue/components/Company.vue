<template>
 <div id="mypage"> 　

   <div class="row">
      <div class="mainfont titleline col-100">
               <div class="col-20">
                  <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                       <img src="images/back.png" width="24%;" style="margin-top:1px;">
                    </div>
                </div>
           <div class="col-60  text-center margin-top-2">
               <span>{{user.user_name}}</span>
           </div>
     <div class="col-20"></div>
      </div>
  </div>

      <div class="row">
	      <div class="col-100 profile">
		      <div class="btn-circle-3d">
                  <img v-if="user.image" v-image="user.image" dir="companies" size="Thum" :target="user.id" />
		      </div>
			  <span>{{user.user_name}}</span>
			  <p>{{user.user_name_english}}</p>
              <p class="pink-btn-big flexiblebox text-center margin-right-8" style="margin-top: 5px; display:inline-block; font-size:10px;" v-language="'Official shop'">　
                  公認ショップ
               </p>
              <div class="text-right">
                  <img src="images/trophy.png" width="11%;" style="margin-top:-25px!important;">
              </div>
	</div>
  </div>

     <div class="container">
         <div class="circle-gray margin-top-13">
              <UserLikes v-if="user" :user="user"></UserLikes>
         </div>
      </div>
   <div class="torofiee_containerbig margin-top-13">
     <div class="mainfont padding-top-5 margin-left-10 text-pre">{{user.pr}}</div>
   </div>
  <div class="introduce">
     <div class="row margin-left-12 margin-right-12">
         <div class="col-33" v-for="i of 8" :key="i">
             <div style="margin:5px;">
                 <ImageScale class="cover" :image="user['image_add' + i]" v-if="user['image_add' + i]" dir="companies" size="Thum" style="width:100%;"></ImageScale>
             </div>
         </div>
     </div>
   </div>

     <!--
   <div v-if="user.movie">
       <video :src="'/api/image/?image=' + user.movie + '&dir=' + user.movie"></video>
   </div>
   -->




      <div class="row">
           <div class="userfont titleline col-100">
                <div class="col-45 margin-left-15 margin-top-15">
                    <span v-language="'Service'">サービス</span>
                </div>
           </div>
      </div>
        <div class="row">
              <div class="clearfix">
                  <div class="col-60 margin-left-15 margin-top-3 float:left;">
                      <img v-for="option in user.options" :src="'images/option' + option + '.png'" style="width:15%;">
                 </div>
              </div>
           </div>
      <div class="row">
           <div class="userfont titleline col-100">
                <div class="col-45 margin-left-15 margin-top-15">
                    <span v-language="'Address'">住所</span>
                </div>
           </div>
          <div class="col-60 margin-left-19 margin-top-5 mainfont">
              {{user.address}}
          </div>
      </div>
      <div class="row">
           <div class="userfont titleline col-100">
                <div class="col-45 margin-left-15 margin-top-17">
                    <span v-language="'business hours'">営業時間</span>
                </div>
           </div>
          <div class="col-60 margin-left-19 margin-top-5 mainfont">
              {{user.time_open}}-{{user.time_close}}
          </div>
     </div>
    <div class="row">
           <div class="userfont titleline col-100">
                <div class="col-45 margin-left-15 margin-top-17">
                    <span v-language="'Regular holiday'">定休日</span>
                </div>
           </div>
          <div class="col-60 margin-left-19 margin-top-5 mainfont">
              <span v-for="holiday in user.holidays">{{weeks[holiday]}}&nbsp;&nbsp;</span>
          </div>
     </div>
　  <div class="row" v-if="user">
           <div class="userfont titleline col-100">
                <div class="col-45 margin-left-15 margin-top-17">
                    <span v-language="'Form'">形態</span>
                </div>
           </div>
          <div class="col-60 margin-left-19 margin-top-5 mainfont">
              {{categories[user.category]}}
          </div>
    </div>
    <div class="row" v-if="user">
           <div class="userfont titleline col-100">
                <div class="col-45 margin-left-15 margin-top-17">
                    <span v-language="'Genre'">ジャンル</span>
                </div>
           </div>
          <div class="col-60 margin-left-19 margin-top-5 mainfont">
              {{genres[user.genre]}}
          </div>
    </div>

     <!--
　　<div class="row">
           <div class="userfont titleline col-100">
                <div class="col-45 margin-left-15 margin-top-17">
                    みんなの投稿
                </div>
           </div>
            <div class="margin-left-12">
            <div class="clearfix">
            <div class="col-100 margin-top-4 wetoukou">
               <img src="images/nowsample.png">
               <img src="images/nowsample.png">
               <img src="images/sample2.png">
               <img src="images/nowsample.png">
            </div>
         </div>
       </div>
    </div>
    -->
</div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import StorageClass from "../liblary/StorageClass";
    import UserLikes from "./layouts/UserLikes.vue";
    import UserClass from "../http/UserClass";
    import ImageScale from "./layouts/ImageScale.vue";

    @Component({
        components: {
            UserLikes,
            ImageScale
        }
    })

    export default class extends Mixins<Base>(Base){
        public user:any = {}
        public weeks:any = {}
        public categories:any = {}
        public genres:any = {}

        public async created()
        {


            var userId:number = parseInt(String(this.$route.query.target))
            //userId = 5

            this.weeks = window.configs.week
            this.categories = window.configs.company_category
            this.genres = window.configs.company_genre


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
    }


</script>
