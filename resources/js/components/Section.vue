<template>

</template>
<script>
    export default{
        data(){
            return{
                sections: [],
                section:{
                    id: '',
                    title: '',
                    body: '',
                },
                section_id: ''
            }
        },
        created(){
            this.fetchSections();
        },

        methods: {
            fetchSections(){
                fetch('api/sections').then(res => res.json()).then(res =>{
                    console.log(res.data);
                })
            }
        }
    }
</script>
