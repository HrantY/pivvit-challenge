<template>
    <div class="container">
        <div class="row justify-content-center">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            this.axios
        }
    }
</script>
