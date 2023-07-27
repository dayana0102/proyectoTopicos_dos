 <template>
    <v-container fluid class="fill-height main">
        <v-container  fill-height align-center justify-center >
            <div class="row justify-content-center text-center" style="background-color: #fff; width: 980px;" > 
                <div class="justify-content-center " style="width: 550px; ">
                    <div style=" margin: 50px; "> 
                        <div class="conten-log " style="margin-left:75px; margin-bottom: 90px;"   >
                            <v-img src="img/u.png" max-width="55px" max-height="55px" class="log" style="float: left;"></v-img>
                            <div class="name-log">
                                UNIVERSIDAD NACIONAL <br> <span class="name-log-2"> DANIEL ALCIDES CARRION</span> 
                            </div>
                        </div>          
                        <div class="tittle-404 mb-4">
                            {{ $t("page_not_found") }}
                        </div>  
                        <div style=" margin-top: 40px; margin-bottom: 60px; font-size: 16px;">
                            Lo sentimos, la página que estás buscando no existe. 
                        </div> 
        
                        <div class="links">
                            <router-link :to="{ name: 'login' }" class="btn-go-home">
                                {{ $t("go_home") }}
                            </router-link>
                        </div>
                    </div>
                </div>
        
                <div class="justify-content-right" >
                    <div style="float: right; ">
                        <v-img style=" margin:20px;" width="560" src="/img/1.svg" />
                    </div>
                </div>
            </div>
          </v-container>
        </v-container>
      </template>
      
      <script>
      export default {
        layout: "basic",
        name: "NotFound",
      };
      
      </script>
     
     <style>
     .tittle-404 {
       font-family: 'Poppins', sans-serif;
       font-size: 40px;
       font-weight: bold;
       background:-webkit-linear-gradient(-45deg, #407BFF,#3565D0, #1B2735);
       -webkit-background-clip: text;
       background-size: 200% 200%;
       -webkit-text-fill-color: transparent;
       animation: gradientAnimation 5s ease infinite;
     }
     
     .conten-log {
         display: flex;
         padding-top: 20px;
     
       }
       
       .name-log {
         font-family: 'Montserrat', sans-serif;
         font-weight: 900;
         margin-left: 10px;
         padding-top: 15px;
         color: black;
         /* font-size: 15px; */
         font-size: clamp(0.75rem, 0.5156rem + 0.75vw, 0.9375rem);
         font-weight: bold;
         text-align: left;
       }
     
     
     .btn-go-home{
         position: relative;
         z-index: 200;
         margin: 15px auto;
         width: 100px;
         padding: 10px 15px;
         border: 1px solid #3565D0;
         border-radius: 100px;
         font-weight: 400;
         display: block;
         color: white;
         text-align: center;
         text-decoration: none;
         letter-spacing : 2px;
         font-size: 11px;
         
         -webkit-transition: all 0.3s ease-in;
         -moz-transition: all 0.3s ease-in;
         -ms-transition: all 0.3s ease-in;
         -o-transition: all 0.3s ease-in;
         transition: all 0.3s ease-in;
     }
     
     .btn-go-home:hover{
         background-color: #3565D0;
         color: #fff;
         transform: scale(1.05);
         box-shadow: 0px 20px 20px rgba(0,0,0,0.1);
     }
     
     
     </style>
     
<style scoped>
.main {
  background-image: linear-gradient(rgba(11, 28, 61, 0.9), rgba(0, 0, 0, 0.4)), url("../../../../public/img/fondo-home.jpg") ;
  background-position: center;
  background-size: cover;
}

.img {
  height: 7.5rem;
  width: 7.5rem;
  padding: 0.5rem;
}
</style>