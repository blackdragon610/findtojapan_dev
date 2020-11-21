import Vue from 'vue'
import VueRouter from 'vue-router'

import Index from './components/Index.vue'
import Login from './components/Login.vue'
import Reminder from './components/Reminder.vue'
import Member from './components/Member.vue'

import Setting from "./components/Setting.vue";
import Find from './components/Find.vue'
import Now from './components/Now.vue'
import FindPost from './components/FindPost.vue'
import Join from './components/Join.vue'
import Mypage from './components/Mypage.vue'
import User from './components/User.vue'
import Company from './components/Company.vue'

import Area from './components/Area.vue'
import Category from './components/Category.vue'
import Purpose from './components/Purpose.vue'
import Result from './components/Result.vue'
import JoinContent from './components/JoinContent.vue'

import Account from "./components/setting/Account.vue";
import AccountEdit from "./components/setting/AccountEdit.vue";
import Profile from "./components/Profile.vue";
import Font from "./components/setting/Font.vue";
import Language from "./components/setting/Language.vue";
import Security from "./components/setting/Security.vue";
import Hamburger from "./components/layouts/Hamburger.vue";
import PostDetail from "./components/PostDetail.vue";
import Top from "./components/Top.vue";
import Map from "./components/Map.vue";
import Page from "./components/Page.vue";
import Question from "./components/Question.vue";
import QuestionDetail from "./components/QuestionDetail.vue";
import Howto from "./components/Howto.vue";
import ReminderEnd from "./components/ReminderEnd.vue";

Vue.use(VueRouter)

const routes = [
    {path: '/', name: 'index', component: Index},
    {path: '/login', name: 'login', component: Login},
    {path: '/reminder', name: 'reminder', component: Reminder},
    {path: '/reminder_end', name: 'reminder_end', component: ReminderEnd},
    {path: '/member', name: 'member', component: Member},

    //フッター
    {path: '/setting', name: 'setting', component: Setting},
    {path: '/top', name: 'top', component: Top},
    {path: '/find', name: 'find', component: Find},


    {path: '/now', name: 'now', component: Now},
    {path: '/findpost', name: 'findpost', component: FindPost},
    {path: '/mypage', name: 'mypage', component: Mypage},
    {path: '/user', name: 'user', component: User},
    {path: '/company', name: 'company', component: Company},
    {path: '/hamburger', name: 'hamburger', component: Hamburger},
    {path: '/page', name: 'page', component: Page},
    {path: '/question', name: 'question', component: Question},
    {path: '/question_detail', name: 'question_detail', component: QuestionDetail},
    {path: '/howto', name: 'howto', component: Howto},

    //マイメニュー関連
    {path: '/profile', name: 'profile', component: Profile},

    //イベント
    {path: '/join', name: 'join', component: Join},
    {path: '/join_content', name: 'join_content', component: JoinContent},


    //設定関連
    {path: '/account', name: 'account', component: Account},
    {path: '/account_edit', name: 'account_edit', component: AccountEdit},
    {path: '/security', name: 'security', component: Security},
    {path: '/font', name: 'font', component: Font},
    {path: '/language', name: 'language', component: Language},

    //検索系
    {path: '/map', name: 'map', component: Map},
    {path: '/area', name: 'area', component: Area},
    {path: '/category', name: 'category', component: Category},
    {path: '/purpose', name: 'purpose', component: Purpose},
    {path: '/result', name: 'result', component: Result},
    {path: '/joincontent', name: 'joincontent', component: JoinContent},
    {path: '/post_detail', name: 'post_detail', component: PostDetail},

]



const router = new VueRouter({
    mode: 'hash',
    //mode: 'history',
    //base: "./",
    routes
})


router.beforeEach((to, from, next) => {

    next()
})




export default router
