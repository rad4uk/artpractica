<template>
    <a href="#" class="nav-link" @click="this.logout()">
        <slot name="icon"></slot>
        <p>Выйти</p>
    </a>
</template>

<script>
export default {
    name: "LogoutComponent",
    methods: {
         logout(){
             axios.post('/logout',[])
                .then(res => {
                    if(res.status === 204){
                        window.location.href = '/';
                    }
                    console.log(res)
                })
                .catch(error => {
                    console.log(error)
                })
        }
    },

}
</script>

<style scoped>
p{
    margin: 0;
}
</style>
