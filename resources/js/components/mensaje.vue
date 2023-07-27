<template>
    <v-snackbar
      :value="show"
      top     
      timeout="3000"
      :color="color"
      text
    >
      {{msg}}
    </v-snackbar>
</template>

<script>
import axios from 'axios'
export default{
    name:'mensaje',
    data(){
        return{
            msg:'error',
            show:false,
            color:""
        }
    },
    mounted(){
        // Response interceptor
        axios.interceptors.response.use(response => {
            if (response.status == 200){
                this.msg=response.data.message
                this.show=true;
                this.color = "green"
            }
        }  , error => {
            const { status } = error.response
            const  message = error.response.data.message    

            if (status == 405){
                this.msg=message
                this.show=true;
                this.color = "error"

            }
            if (status == 422){
                this.msg=message
                this.color = "error"
                this.show=true;
            }
            setTimeout(() => {
                this.show = false;
            }, 3000); 
            return Promise.reject(error)
        })
    },    

}
</script>