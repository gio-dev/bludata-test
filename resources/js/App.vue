<template>
    <main>
        <Header />
        <div class="container mt-5">
            <router-view></router-view>
        </div>
        <Footer />
    </main>
</template>
<script>
import Header from "./vuejs/commons/Header";
import Footer from "./vuejs/commons/Footer";
export default {
    components:{
        Header,
        Footer
    }
}
</script>
<style>
    body{
        height: 100%;
    }
    .loader {
        position: absolute;

        background-color: rgba(250,250,250,.7);
        width: 100%;
        height: 100%;
    }
    .loader-content{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

</style>
