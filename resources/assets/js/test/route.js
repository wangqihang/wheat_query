import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

export default new VueRouter({
    saveScrollPosition: true,
    routes: [
        {
            name: "test",
            path: '/',
            component: resolve =>void(require(['./test.vue'], resolve))
        }
    ]
})