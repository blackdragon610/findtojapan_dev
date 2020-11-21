<template>
    <div v-if="user" class="row padding-bottom-15">
        <div class="btn-circle-3d">
            <img v-image="user.image" v-if="user.image" dir="users" size="Thum" @click="onUser" :target="user.id" />
        </div>
        <span>{{ user.user_name }}</span>
        <p>{{ user.message }}</p>
        <p class="pink-btn-big flexiblebox text-center margin-right-8" style="margin-top: 5px; display:inline-block; font-size:10px;" v-language="'Certified Ambassador'" v-if="user.is_official">
           公認アンバサダー
        </p>
    </div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import Vue from "vue"


    @Component({
        //　プロパティを記述
        props: {
             user: {required: true},
        }

    })

    export default class extends Vue{
        public user:any

        public created()
        {


        }

        public onUser(eventHandle:any)
        {
            this.$router.push({name:"user", query:{"target":eventHandle.target.getAttribute("target")}})
        }


    }
</script>
