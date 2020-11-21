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
                    <span v-language="'Write'">記事</span>
                </div>
           <div class="col-20"></div>
            </div>
        </div>

     <div class="row userprofile">
         <HeaderUser v-if="post" :user="post.user"></HeaderUser>
     </div>

      <div class="container">
    	<div class="circle-gray margin-top-13">

            <div class="margin-left-35 socialdetail" v-if="post.id">
                <PostLikes :post="post"></PostLikes>
            </div>
         </div>

          <div class="postfont titleline  margin-top-20">
              {{ post.typeName}}
          </div>

          <div class="margin-left-10 text-pre postfont">
{{ post.body }}
          </div>

          <div class="postfont titleline  margin-top-20">
              <span v-language="'Picture'">画像</span>
          </div>
          <div class="margin-left-10">
              <div class="row">
                  <div class="col-31 col-offset-2 margin-top-10" v-for="image in post.images">
                      <ImageScale :image="image.image" v-if="image.image" dir="posts" size="Big" style="width:100%;"></ImageScale>
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
    import HeaderUser from "./layouts/HeaderUser.vue";
    import PostClass from "../http/PostClass";
    import PostLikes from "./layouts/PostLikes.vue";
    import ImageScale from "./layouts/ImageScale.vue";

    @Component({
        components: {
            HeaderUser,
            PostLikes,
            ImageScale
        },
    })

    export default class extends Mixins<Base>(Base){
        public postId:number = 0
        public post:any = {}

        public async created()
        {
            this.postId = parseInt(String(this.$route.query.target))

            //this.postId = 7

            let $PostClass = new PostClass()
            this.post = await $PostClass.get(this.postId)

        }
        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
        }

        public onLike() : void
        {

        }

        public onFollower() : void
        {

        }

    }


</script>
