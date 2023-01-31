<template>
    <div class="row">
        <div class="col-12 pb-3 pb-lg-5">
            <h2 class="text-center">Lista de Empresas</h2>
        </div>

        <div class="col-12 position-relative">
            <div v-show="loading"  class="loader">
                <div class="loader-content">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            <tbody>
                <tr v-for="company in companies" :key="company.identify">

                    <td>{{ company.uf }}</td>
                    <td>{{ company.name }}</td>
                    <td>{{ company.cnpj }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'company-providers', params: { idcompany: company.identify }}" class="btn btn-info">Fornecedores</router-link>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "ListAllCompanies",
    data() {
        return {
            loading: true,
            companies: {}
        }
    },
    mounted(){
        this.getProducts()
    },
    methods: {
        async getProducts(){
            await this.axios.get('/api/company/').then(response=>{

                this.companies = response.data.data;
                this.loading = false
            }).catch(error=>{
                let errors = error.response.data.errors;
                if(errors){
                    for (let field of Object.keys(errors)) {
                        this.$toast.error(errors[field][0])
                    }
                } else if(error.response.data.message) {
                    this.$toast.error(error.response.data.message);
                }
                this.products = []
                this.loading = false
            })
        }
    }
}
</script>

<style scoped>

</style>
