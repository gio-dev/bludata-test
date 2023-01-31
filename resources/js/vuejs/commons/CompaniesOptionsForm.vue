<template>
    <option v-for="companie in companies" :data-uf="companie.uf" :value="companie.identify">{{ companie.name }}</option>
</template>

<script>
export default {
    name: "CompaniesOptionsForm",
    data() {
        return {
            companies:{
                identify: '',
                name: '',
                uf: '',
            }
        }
    },
    beforeMount(){
        this.getCompanies()
    },
    methods: {
        async getCompanies(){
            await this.axios.get('/api/company').then(response=>{
                this.companies = response.data.data
            }).catch(error=>{
                console.log(error)
                this.companies = []
            })
        },
    }
}
</script>

<style scoped>

</style>
