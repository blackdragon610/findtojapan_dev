<template>
   <div>
        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-25">
                    <div class="margin-left-15 margin-top-7">
                        <span>NOW</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="margin-top-12">
                <div class="container">
                    <form method="get" class="search_container" v-on:submit.prevent="onSubmit">
                        <img src="images/search.png">
                        <input type="search" placeholder="Search" v-model="keyword" style="font-size: 14px;margin-top: 1.7px; color: #a7bdd1">
                    </form>
                </div>
            </div>
        </div>


        <div v-for="post in posts" @click="onPost" :target="post.id" :type="post.user.type" :targetCompany="post.user.id" :class="{'share': (post.type=='replay')}">
           <div class="margin-left-15 margin-top-10 text-pre littlesub" v-if="post.type=='replay'">
               <p v-language="'Share'">シェア</p>
            <div class="row">
            <div class="col-15">
            <div class="shear-circle">
               <span v-if="post.user">
                   <img v-if="post.user.type == 2" v-image="post.user.image" dir="companies" size="Thum" style="height: 100%;" />
                   <img v-else v-image="post.user.image" dir="users" size="Thum" style="height: 100%;">
               </span>
			  </div>
			  </div>
			  <div class="col-30">
			  <p> {{post.comment}}</p>
			    </div>
			    </div>


           </div>
               <div class="share-place">
                 <div class="share-box">
                   <div class="row">
                     <div class="col-25 margin-top-14 margin-left-15 nowcircle">
                           <span v-if="post.user">
                               <img v-if="post.user.type == 2" v-image="post.user.image" dir="companies" size="Thum" style="height: 100%;" />
                               <img v-else v-image="post.user.image" dir="users" size="Thum" style="height: 100%;">
                           </span>
                     </div>
                      <div class="col-15 margin-top-15 margin-left-6 littlesub">
                            <span v-if="post.user">{{post.user.user_name}}</span>
                      </div>
                      <div class="col-65">
                           <div class="clearfix">
                               <div class="float-left margin-top-11">
                                  <div class="pink-btn-now margin-left-10" v-show="post.type==2">　
                                      <span v-language="'Official shop'">公認ショップ</span>
                                  </div>
                               </div>
                                <div class="float-right text-right littlesub margin-top-15" v-date-front="post.created_at"></div>
                           </div>
                        </div>
                        <div class=" col-75  margin-left-7 mainfontsub text-pre" style="margin-top:-12px;">
{{ post.body }}
                         </div>
                         <div class="col-17"></div>
                             <div class="col-83 margin-top-3">
                                 <ImageScale :image="post.image" v-if="post.image" dir="posts" size="Big" style="width:90%;"></ImageScale>
                              </div>

                           <div class="col-17"></div>
                                 <div class=" share-placeleft col-50 margin-right-5 margin-top-10 hushtugpurple inline-block" v-for="category in post.categories" v-if="category.category">
                                     {{ category.category.sub_name}}
                                 </div>
                          </div>
                   <div class="margin-left-26 margin-top-3">
                  <div class="socialsmall share-placeleft2">
                <PostLikes :post="post"></PostLikes>
                  </div>
                 </div>
              </div>
               </div>
               <div class="titleline margin-top-2"></div>
       </div>
    </div>

</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import PostClass from "../http/PostClass";
    import PostLikes from "./layouts/PostLikes.vue";
    import ImageScale from "./layouts/ImageScale.vue";

    @Component({
        components: {
            PostLikes,
            ImageScale
        },
    })

    export default class extends Mixins<Base>(Base){

        public posts:any = []
        public keyword:string = ""

        public created() :void
        {
            this.scrollNavigation()
        }

        public loadNavigationReflash()
        {
            let $PostClass = new PostClass()
            $PostClass.page = 0
            this.posts = []
            $PostClass.getNow(this.getData.bind(this))
        }

        public loadNavigation()
        {
            let $PostClass = new PostClass()
            $PostClass.page = this.page
            $PostClass.getNow(this.getData.bind(this))
        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
            this.parent().setFooter(2)

        }

        /**
         * データ取得
         * @param result
         */
        public number:number = 0
        public getData(result:any)
        {
            for (let key in result.datas){
                if (result.datas[key].id){
                    this.posts.push(result.datas[key])
                }

                this.number++
            }

            this.posts = JSON.parse(JSON.stringify(this.posts))

        }

        /**
         * 検索
         */
        public onSubmit()
        {
            let $PostClass = new PostClass()
            $PostClass.getNow(this.getData.bind(this), this.keyword)
        }

        /**
         * 記事を選択
         */
        public onPost(eventHandle:any)
        {
            if (eventHandle.currentTarget.getAttribute("type") == 2){
                this.$router.push({name:"company", query:{target:eventHandle.currentTarget.getAttribute("targetCompany")}})
            }else{
                this.$router.push({name:"post_detail", query:{target:eventHandle.currentTarget.getAttribute("target")}})
            }
        }


    }


</script>
