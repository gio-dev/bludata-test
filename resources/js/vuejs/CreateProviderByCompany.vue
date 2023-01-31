<template>
  <h2 class="text-center">Cadastrar Fornecedor</h2>
  <form class="form" action="" @submit.prevent="submitForm">
    <div class="row">
      <div class="col-12 col-md-6 my-2">
        <label class="form-label" for="company_id">Empresa</label>
        <select name="company_id" required class="form-control" id="company_id" v-model="company.company_id">
          <option disabled value="">Selecione a empresa</option>
          <CompaniesOptionsForm />
        </select>
      </div>
      <div class="col-12 col-md-6 my-2">
        <label class="form-label" for="name">Nome</label>
        <input type="text" required name="name" class="form-control" id="name" v-model="company.name">
      </div>
      <div class="col-12 col-md-4 my-2">
        <label class="form-label" for="document">CPF/CNPJ</label>
        <input type="text" required name="document" id="document"
               @blur="cpfcnpjCheck($event)" class="form-control"
               v-mask="['###.###.###-##','##.###.###/####-##']" v-model="company.document">

      </div>

      <div class="col-12 col-md-4 my-2">
        <label class="form-label" for="birthdate" id="lbirthdate">Data de Nascimento</label>
        <input type="date" name="birthdate" id="birthdate" class="form-control"
               @blur="birthCheck()" required v-model="company.birthdate">

      </div>
      <div class="col-12 col-md-4 my-2" id="rg-block">
        <label class="form-label" for="rg">RG</label>
        <input type="text" required  name="rg" class="form-control" id="rg" v-model="company.rg">
      </div>
        <div
            v-for="(input, index) in company.phones"
            :key="`phoneInput-${index}`"
            class="col-12 col-md-6 my-2"
        >
          <label class="form-label">Telefone</label>
          <div class="input-group">
              <input
                type="text"
                class="form-control"
                v-model="input.value"
                :key="index"
                @blur="checkPhones($event)"
                v-mask="'(##) #####-####'"
              />
              <button class="btn btn-outline-primary" @click="addField()" type="button">Adicionar</button>
              <button class="btn btn-outline-danger" v-show="company.phones.length > 1" @click="removeField(index, company.phones)" type="button">Remover</button>
          </div>
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
import CompaniesOptionsForm from "./commons/CompaniesOptionsForm";
import {mask} from 'vue-the-mask';
export default {
  name: "CreateCompany",
  components: {
    CompaniesOptionsForm,
    mask
  },
  data() {
    return {
      submitted: false,
      company: {
        name: '',
        document: '',
        model: 'F',
        birthdate: '',
        rg: '',
        company_id: '',
        phones: [{ value: "" }],
        _method: 'post'
      }
    }
  },
  methods: {
    async submitForm(){

      if(this.checkRules(true)){
        this.submitted = true;
        await this.axios.post('/api/provider/', this.company).then(response=>{
          console.log(response.message)
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
    changeClassForm(option){
      var bdayEl = document.getElementById('birthdate');
      var rgblock = document.getElementById('rg-block');
      var rg = document.getElementById('rg');
      var cpfCnpj = document.getElementById('document');
      if(option == "add"){
        bdayEl.required = true;
        bdayEl.closest('.col-12').classList.remove('col-md-6')
        bdayEl.closest('.col-12').classList.add('col-md-4')
        cpfCnpj.closest('.col-12').classList.remove('col-md-6')
        cpfCnpj.closest('.col-12').classList.add('col-md-4')
        rgblock.classList.remove('d-none');
        rg.required = true;
      } else {
        bdayEl.required = false;
        bdayEl.closest('.col-12').classList.remove('col-md-4')
        bdayEl.closest('.col-12').classList.add('col-md-6')
        cpfCnpj.closest('.col-12').classList.remove('col-md-4')
        cpfCnpj.closest('.col-12').classList.add('col-md-6')
        rgblock.classList.add('d-none');
        rg.required = false;
      }
    },
    cpfcnpjCheck(e, showMessage = false){
      var value;
      var el;
      var model = document.getElementById('model');
      var bday = document.getElementById('lbirthdate');

      if(e.target === undefined){
        el = e;
        value = el.value.replace(/[^\d]+/g,'');
      } else {
        el = e.target;
        value = el.value.replace(/[^\d]+/g,'');
      }

      if(value.length < 1) {
        this.company.model = "F"
        bday.innerHTML = "Data de Nascimento";
        this.changeClassForm('add');
        el.classList.remove('invalid')
        return false;
      }

      if(value.length < 11) {
        this.company.model = "F"
        bday.innerHTML = "Data de Nascimento"
        this.changeClassForm('add');
        el.classList.add('invalid');
        if(showMessage)
          this.$toast.error('CPF/CNPJ Inválido');
        return false;
      } else if(value.length > 14){
        this.company.model = "J"
        this.changeClassForm('');
        bday.innerHTML = "Data de Nascimento do Responsável"
        el.classList.add('invalid');
        if(showMessage)
          this.$toast.error('CPF/CNPJ Inválido');
        return false;
      } else if(value.length == 11 && !this.cpfValidate(value)){
        this.company.model = "F"
        bday.innerHTML = "Data de Nascimento"
        this.changeClassForm('add');
        el.classList.add('invalid');
        if(showMessage)
          this.$toast.error('CPF/CNPJ Inválido');
        return false;
      } else if(value.length > 11 && value.length <= 14 && !this.cnpjValidate(value)){
        this.company.model = "J"
        this.changeClassForm('');
        bday.innerHTML = "Data de Nascimento do Responsável"
        el.classList.add('invalid');
        if(showMessage)
          this.$toast.error('CPF/CNPJ Inválido');
        return false;
      } else {
        if(value.length == 14){
          this.company.model = "J"
          this.changeClassForm('');
          bday.innerHTML = "Data de Nascimento do Responsável"
        } else if(value.length == 11){
          this.company.model = "F"
          this.changeClassForm('add');
          bday.innerHTML = "Data de Nascimento"
        }
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
      var add = 0;
      var rev;
      var i;
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
    },
    birthCheck(showMessage = false){

      // Create a date variable which stores the current day at 00:00 local time.
      let today = new Date();
      today.setHours(0,0,0,0);
      let birthdateEl =  document.getElementById("birthdate")
      // Parse the provided date in the default YYYY-MM-DD format.
      let birthdate = new Date(birthdateEl.value);

      if(!birthdateEl.required){
        return true;
      }

      if(birthdateEl.value.length < 1) {
        birthdateEl.classList.remove('invalid')
        if(showMessage){
          this.$toast.error('Data de Nscimento Inválida');
        }
        return false;
      }
      // Check whether the provided date is equal to or less than the current date.
      if (birthdate <= today) {
        birthdateEl.classList.remove('invalid')
        return true;
      } else {
        birthdateEl.classList.add('invalid');
        if(showMessage){
          this.$toast.error('Data de Nscimento Inválida');
        }
        return false;
      }

    },
    checkRules(showMessage = false){
      let company = document.getElementById('company_id');
      let model = document.getElementById('model');
      let rg = document.getElementById('rg');
      var option = company.options[company.selectedIndex];

      if(!this.cpfcnpjCheck(document.getElementById('document'), true)){
        return false;
      }

      if(model == "F"){
        if(option.value != ""){
          if(option.dataset.uf == "PR"){
            if(this.checkIdade() < 18) {
              if (showMessage)
                this.$toast.error('Não é permitido cadastro de fornecedores para empresas do paraná pessoa física menor de idade');
              return false;
            }
          }
        } else {
          if(showMessage)
            this.$toast.error('A Seleção da empresa é obrigatório');
          return false;
        }
        if(!this.birthCheck() || !rg.value){
          if(showMessage)
            this.$toast.error('Não é permitido cadastro de fornecedores pessoa física sem fornecer a data de nascimento e RG');
          return false;
        }
      }
      if(!this.birthCheck(true)){
        return false;
      }
      if(!this.checkPhones()){
        this.$toast.error('Verifique os telefones');
        return false;
      }
      return true;
    },
    checkIdade(){
      let today = new Date();
      today.setHours(0,0,0,0);
      let birthdateEl =  document.getElementById("birthdate")

      if(birthdateEl.value.length < 1){

        return 0;
      }
      // Parse the provided date in the default YYYY-MM-DD format.
      let birthdate = new Date(birthdateEl.value);

      var diff = today.getFullYear() - birthdate.getFullYear();
      if ( new Date(today.getFullYear(), today.getMonth(), today.getDate()) <
          new Date(today.getFullYear(), birthdate.getMonth(), birthdate.getDate()) ) {
        diff--;
      }

      return diff;
    },
    checkPhoneData(telefone){

      telefone = telefone.replace(/\D/g, '');

      if (!(telefone.length >= 10 && telefone.length <= 11)) return false;

      if (telefone.length == 11 && parseInt(telefone.substring(2, 3)) != 9) return false;

      for (var n = 0; n < 10; n++) {
        if (telefone == new Array(11).join(n) || telefone == new Array(12).join(n)) return false;
      }

      var codigosDDD = [11, 12, 13, 14, 15, 16, 17, 18, 19,
        21, 22, 24, 27, 28, 31, 32, 33, 34,
        35, 37, 38, 41, 42, 43, 44, 45, 46,
        47, 48, 49, 51, 53, 54, 55, 61, 62,
        64, 63, 65, 66, 67, 68, 69, 71, 73,
        74, 75, 77, 79, 81, 82, 83, 84, 85,
        86, 87, 88, 89, 91, 92, 93, 94, 95,
        96, 97, 98, 99];

      if (codigosDDD.indexOf(parseInt(telefone.substring(0, 2))) == -1) return false;

      if (telefone.length == 10 && [2, 3, 4, 5, 7].indexOf(parseInt(telefone.substring(2, 3))) == -1) return false;

      //se passar por todas as validações acima, então está tudo certo
      return true;

    },
    checkPhones(el = null){
      if(el){
        if(!this.checkPhoneData(el.target.value)){
          el.target.classList.add('invalid')
          return false;
        } else {
          el.target.classList.remove('invalid')
          return true;
        }
      } else {
        var els = document.getElementsByName('phones[]');
        var ret = true;
        var self = this;
        els.forEach(function (el, index){
          if(!self.checkPhoneData(el.value)){
            el.classList.add('invalid');
            ret = false;
          }
        });
        return ret;
      }
    },
    addField(value, fieldType) {
      this.company.phones.push({ value: "" });
    },
    removeField(index, fieldType) {
      fieldType.splice(index, 1);
    },
  }
}
</script>

<style scoped>
  input.invalid, select.invalid {
    border-color: red;
  }
</style>
