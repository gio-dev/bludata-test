<template>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Bludata Test</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item">
                    <router-link to="/" class="nav-link" >Home</router-link>
                </li>
                <li class="nav-item" >
                    <router-link to="/company" class="nav-link" >Nova Empresa</router-link>
                </li>
                <li class="nav-item" >
                  <router-link to="/providers" class="nav-link" >Novo Fornecedor</router-link>
                </li>
            </ul>
        </header>
    </div>
</template>

<script>
import {useRoute, useRouter} from "vue-router";
export default {
  name: "Header",
  // data() {
  //   return {
  //     ident: -1
  //   }
  // },
  mounted() {
    // var useRt = useRouter();
    // var self = this;
    // setTimeout(function (){
    //   var route = useRt.currentRoute.value;
    //   if(route.params.idcompany !== undefined) {
    //     self.atualizaValor(route.params.idcompany);
    //   }
    // },100)
  },
  methods: {
    // async atualizaValor(valor){
    //   this.ident = valor
    // }
  }
}
</script>

<style scoped>

</style>
