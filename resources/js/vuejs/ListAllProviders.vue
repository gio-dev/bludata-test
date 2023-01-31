<template>
    <div class="row">
        <div class="col-12 pb-3 pb-lg-5">
            <h2 class="text-center">Lista de Fornecedores</h2>
        </div>
        <div class="col-12 pb-3 pb-lg-5">
          <h4 class="text-center">Filtros</h4>
        </div>
        <div class="col-12 pb-3 pb-lg-5">
          <form name="filters" class="form" @submit.prevent="getProviders">
            <div class="row">
              <div class="col-12 col-md-3" >
                <input type="text" name="search" class="form-control" placeholder="Pesquise o Nome ou CPF/CNPJ"
                       v-model="filters.search">
              </div>
              <div class="col-12 col-md-3" >
                <input type="datetime-local" name="created_at_greater" class="form-control" placeholder="Cadastrado de..."
                       v-model="filters.createdatgreater">
              </div>
              <div class="col-12 col-md-3" >
                <input type="datetime-local" name="created_at_less" class="form-control" placeholder="Cadastrado até..."
                       v-model="filters.createdatless">
              </div>
              <div class="col-12 col-md-3 d-grid" >
                <button type="submit" :disabled="submitted" class="btn btn-info btn-block">
                  <span v-show="submitted" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Filtrar
                </button>
              </div>
            </div>
          </form>
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
                    </tr>
                </thead>
            <tbody>
                <tr v-for="provider in providers" :key="provider.identify">

                    <td>{{ provider.company.name }}</td>
                    <td>{{ provider.name }}</td>
                    <td>{{ provider.cpf_cnpj }}</td>
                    <td>{{ provider.created_at }}</td>
                    <td>
                      <div  v-for="phone in provider.phones" :key="phone.id">
                        <span class="list-group-item">{{ phone.phone }}</span>
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
    name: "ListAllProviders",
    data() {
        return {
            loading: true,
            submitted: false,
            providers: [],
            filters: {
              search: "",
              createdatgreater: "",
              createdatless: "",
            }
        }
    },
    mounted(){
        this.getProviders()
    },
    methods: {
        async getProviders(){
            this.loading = true
            this.submitted = true
            console.log(this.filters);
            await this.axios.get('/api/provider', {
              params: this.filters
            }).then(response=>{
                this.providers = response.data.data;
                this.loading = false
                this.submitted = false
            }).catch(error=>{
                let errors = error.response.data.errors;
                if(errors){
                    for (let field of Object.keys(errors)) {
                        this.$toast.error(errors[field][0])
                    }
                } else if(error.response.data.message) {
                    this.$toast.error(error.response.data.message);
                }
                this.providers = []
                this.loading = false
              this.submitted = false
            })
        }
    }
}
</script>

<style scoped>

</style>
