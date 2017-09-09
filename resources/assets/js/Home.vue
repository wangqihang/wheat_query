<template>
    <div>
        this is index.vue!<br>
        <span v-for="item in items">{{ item.id+"<=>"+item.name }}<br></span>
    </div>
</template>
<style scoped>

</style>
<script type="text/ecmascript-6">
    export default {
        data(){
            return {
                items: [{
                    id:0,
                    name:'zhangsan',
                },{
                    id:1,
                    name:'lisi',
                },{
                    id:2,
                    name:'wangwu',
                },{
                    id:3,
                    name:'zhaoliu',
                }],
            }
        },
        computed: {},
        methods: {

        },
        mounted() {
            console.log(this.data)
        },
    }
</script>
