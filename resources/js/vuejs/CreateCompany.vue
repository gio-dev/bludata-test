<template>
  <h2 class="text-center">Cadastrar empresa</h2>
  <form class="form" action="" @submit.prevent="submitForm">
    <div class="row">
      <div class="col-12 my-2">
        <label class="form-label" for="name">Nome</label>
        <input type="text" required name="name" class="form-control" v-model="company.name">
      </div>
      <div class="col-12 col-md-6 my-2">
        <label class="form-label" for="cnpj">CNPJ</label>
        <input type="text" required name="cnpj" id="cnpj"
               @blur="cnpjCheck($event)" class="form-control"
               v-mask="'##.###.###/####-##'" v-model="company.document">

      </div>
      <div class="col-12 col-md-6 my-2">
        <label class="form-label" for="estado">Estado</label>
        <select name="estado" required class="form-control" v-model="company.state_id">
          <option disabled value="">Selecione um Estado</option>
          <StatesOptionsForm />
        </select>
      </div>
      <div class="col-12 my-2 text-center">
        <button type="submit" :disabled="submitted" class="btn btn-success">
          <span v-show="submitted" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Salvar
        </button>
      </div>
    </div>
  </form>
</template>

<script>
import StatesOptionsForm from "./commons/StatesOptionsForm";
import {mask} from 'vue-the-mask';
export default {
  name: "CreateCompany",
  components: {
    StatesOptionsForm,
    mask
  },
  data() {
    return {
      submitted: false,
      company: {
        name: '',
        document: '',
        state_id: '',
        model: 'J',
        _method: 'post'
      }
    }
  },
  methods: {
    async submitForm(){
      if(this.cnpjCheck(document.getElementById('cnpj'))){
        this.submitted = true;
        await this.axios.post('/api/company/', this.company).then(response=>{
          this.$toast.success(response.data.message)
          this.$router.push({name:"listCompanies"})
        }).catch(error=>{
          let errors = error.response.data.errors;
          if(errors){
            for (let field of Object.keys(errors)) {
              this.$toast.error(errors[field][0])
            }
          } else if(error.response.data.message) {
            this.$toast.error(error.response.data.message);
          }
          this.submitted = false;
        })
      }
    },
    cnpjCheck(e){
      var value;
      var el;
      if(e.target === undefined){
        el = e;
        value = el.value.replace(/[^\d]+/g,'');
      } else {
        el = e.target;
        value = el.value.replace(/[^\d]+/g,'');
      }


      if(value.length < 14 || value.length > 14 || !this.cnpjValidate(value)){
        //e.target.value = '';
        el.classList.add('invalid');
        return false;
      } else {
        el.classList.remove('invalid')
        return true;
      }
    },
    cpfValidate(cpf){
      cpf = cpf.replace(/[^\d]+/g,'');
      if(cpf == '') return false;
      // Elimina CPFs invalidos conhecidos
      if (cpf.length != 11 ||
          cpf == "00000000000" ||
          cpf == "11111111111" ||
          cpf == "22222222222" ||
          cpf == "33333333333" ||
          cpf == "44444444444" ||
          cpf == "55555555555" ||
          cpf == "66666666666" ||
          cpf == "77777777777" ||
          cpf == "88888888888" ||
          cpf == "99999999999")
        return false;
      // Valida 1o digito
      add = 0;
      for (i=0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
      rev = 11 - (add % 11);
      if (rev == 10 || rev == 11)
        rev = 0;
      if (rev != parseInt(cpf.charAt(9)))
        return false;
      // Valida 2o digito
      add = 0;
      for (i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
      rev = 11 - (add % 11);
      if (rev == 10 || rev == 11)
        rev = 0;
      if (rev != parseInt(cpf.charAt(10)))
        return false;
      return true;
    },
    cnpjValidate(cnpj){
      cnpj = cnpj.replace(/[^\d]+/g,'');

      if(cnpj == '') return false;

      if (cnpj.length != 14)
        return false;

      // Elimina CNPJs invalidos conhecidos
      if (cnpj == "00000000000000" ||
          cnpj == "11111111111111" ||
          cnpj == "22222222222222" ||
          cnpj == "33333333333333" ||
          cnpj == "44444444444444" ||
          cnpj == "55555555555555" ||
          cnpj == "66666666666666" ||
          cnpj == "77777777777777" ||
          cnpj == "88888888888888" ||
          cnpj == "99999999999999")
        return false;

      // Valida DVs
      var tamanho = cnpj.length - 2
      var numeros = cnpj.substring(0,tamanho);
      var digitos = cnpj.substring(tamanho);
      var soma = 0;
      var i = 0;
      var pos = tamanho - 7;
      for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
          pos = 9;
      }
      var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
      if (resultado != digitos.charAt(0))
        return false;

      tamanho = tamanho + 1;
      numeros = cnpj.substring(0,tamanho);
      soma = 0;
      pos = tamanho - 7;
      for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
          pos = 9;
      }
      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
      if (resultado != digitos.charAt(1))
        return false;

      return true;
    }
  }
}
</script>

<style scoped>
  input.invalid, select.invalid {
    border-color: red;
  }
</style>
