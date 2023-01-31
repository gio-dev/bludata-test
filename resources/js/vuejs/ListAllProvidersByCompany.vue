<template>
    <div class="row">
        <div class="col-12 pb-3 pb-lg-5">
            <h2 class="text-center">Lista de Fornecedores da Empresa <span>{{ company.name }}</span></h2>
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
                        <th>Empresa</th>
                        <th>Nome</th>
                        <th>CPF ou CNPJ</th>
                        <th>Data de Criação</th>
                        <th>Telefones</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            <tbody>
                <tr v-for="provider in company.providers" :key="provider.identify">

                    <td>{{ company.name }}</td>
                    <td>{{ provider.name }}</td>
                    <td>{{ provider.cpf_cnpj }}</td>
                    <td>{{ provider.created_at }}</td>
                    <td>
                      <div  v-for="phone in provider.phones" :key="phone.id">
                        <span class="list-group-item">{{ phone.phone }}</span>
                      </div>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
<!--                            <router-link :to="{name: 'company-edit', params: { id: company.identify }}" class="btn btn-success">Edit</router-link>-->
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
    name: "ListAllProvidersByCompany",
    data() {
        return {
            loading: true,
            company: {},
        }
    },
    mounted(){
        this.getCompany()
    },
    methods: {
        async getCompany(){
            await this.axios.get('/api/company/'+this.$route.params.idcompany).then(response=>{

                this.company = response.data.data;
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
