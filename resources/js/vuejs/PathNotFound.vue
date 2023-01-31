<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>
                    Página não encontrada
                </h1>
            </div>
        </div>
        <div class="row py-5">
            <div class="col-12 text-center">
                <router-link :to="{name: 'list'}" class="btn btn-secondary"> Voltar para o início</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PathNotFound"
}
</script>

<style scoped>

</style>
