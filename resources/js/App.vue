<template>
<div>

        <router-view/>
</div>

</template>
<script>
import Registration from './component/Registration';
import Login from './component/Login'
export default {
    components:{
        Registration,
        Login
    }
}
</script>
<style scoped>

</style>