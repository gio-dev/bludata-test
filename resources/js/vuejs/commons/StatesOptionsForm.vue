<template>
    <option v-for="state in states" :value="state.id">{{ state.name }}</option>
</template>

<script>
export default {
    name: "StatesOptionsForm",
    data() {
        return {
            states:{
                id: '',
                name: '',
            }
        }
    },
    beforeMount(){
        this.getStates()
    },
    methods: {
        async getStates(){
            await this.axios.get('/api/states').then(response=>{
                this.states = response.data.data
            }).catch(error=>{
                console.log(error)
                this.states = []
            })
        },
    }
}
</script>

<style scoped>

</style>
