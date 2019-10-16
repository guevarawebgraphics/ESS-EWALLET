<template>
    <div id="editservicetype">
         <h1> Edit Service Type {{id_value}}</h1>
    </div>
</template>

<script>
export default {
data(){
    return{
        id_value : this.$route.params.id
    }
    
},
methods : {
    
}



}
</script>

<style>

</style>