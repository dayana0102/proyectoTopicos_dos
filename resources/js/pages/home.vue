<template>
  <div class="bg d-flex" style="overflow: hidden;">
    <div class="container-home d-flex mx-auto" style="height: 100%; width: 95%;">
        <div class="container-home-a d-flex align-center" style="height: 100%; width: 50%;">
          <div class="px-7">
            <div class="tittle-p">Gestor de tareas</div>
            <div class="text-2" style="color: #fff;">
              Organiza y coordina tus proyectos, equipos y herramientas en un solo lugar,
              facilitando la colaboración y el seguimiento, incluso cuando tus compañeros
              no estén conectados.
            </div>
            <div class="button--1">
              <v-btn 
              color="#1B2735"
                dark
                rounded
                to="/login"
                >
                Comienza ahora
              </v-btn>
              <!-- <v-btn
              color="#007DFE"
                dark
                rounded
                class="ma-2"
                outlined
                >
                INICIAR SESIÓN
              </v-btn> -->
            </div>
          </div>
        </div>
        <div class="container-home-b" style="height: 100%; width: 50%;">
        </div>
      </div>
    <!-- <v-row class="content--body">
      
      <v-col cols="12" md="6" transition-style="in:wipe:right">
        <div class="tittle-p">Gestor de tareas</div>
        <div class="text-2" style="color: #fff;">
          Organiza y coordina tus proyectos, equipos y herramientas en un solo lugar,
          facilitando la colaboración y el seguimiento, incluso cuando tus compañeros
          no estén conectados.
        </div>

        <div class="button--1">
          <v-btn 
          color="#1B2735"
            dark
            rounded
            to="/login"
            >
            Comienza ahora
          </v-btn>

          <v-btn
          color="#007DFE"
            dark
            rounded
            class="ma-2"
            outlined
            >
            INICIAR SESIÓN
          </v-btn>
        </div>
        <div>
      </div>
    </v-col>

      <v-col cols="12" md="6">
        
      </v-col>
    </v-row> -->
  </div>
  <!-- <v-img src="https://cdnl.iconscout.com/lottie/premium/thumb/task-management-4970038-4139003.gif" width="100%" max-width="550px"  class="img-f"></v-img> -->
</template>
<script>
export default{
  layout: "init",
  name: "home"
}
</script>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Source+Code+Pro:wght@300&display=swap');
  @import url('https://fonts.googleapis.com/css2? family= Poppins:wght@600 & family= Source+Code+Pro:wght@300 & display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Diphylleia&family=Poppins:wght@600&display=swap'); 
  @import url('https://fonts.googleapis.com/css2? family= Diphylleia & family= Poppins:wght@600 & family= Work+Sans:wght@300;400 & display=swap');


  @keyframes gradientAnimation {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }



.bg {
  margin: 0;
  padding: 0;
  /* background-color: #ffffff; */
  background-image: linear-gradient(rgba(11, 28, 61, 0.9), rgba(0, 0, 0, 0.4)), url("../../../public/img/fondo-home.jpg") ;
  background-position: center;
  background-size: cover;
  height: 100%;
  overflow: hidden;
  width: 100%;
  font-weight: 300;
  overflow: hidden;
}

.content-nav {
  
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-left: 5%;
  margin-right: 5%;
  margin-top: 1%;
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

.name-log-2 {
  font-family: 'Montserrat', sans-serif;
  /* font-size: 13px; */
  font-size: clamp(0.625rem, 0.3906rem + 0.75vw, 0.8125rem);
  padding-bottom: 0;
  font-weight: normal;
}

.content-nav-button {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  padding-right: 15px;
  /* font-family: 'Montserrat', sans-serif;
  font-weight: 900; */

}

.content--body{
  padding-left: 7%;
}

.tittle-p {
  font-family: 'Poppins', sans-serif;
/* font-family: 'Source Code Pro', monospace; */
  /* font-size: 70px; */
  font-size: clamp(4.0625rem, 3.6719rem + 1.25vw, 4.375rem);
  /* transition-property:;
  transition-duration: 2,5s;
  transition-timing-function: cubic-bezier(0.25, 0.1, 0.25, 1); */
  background:-webkit-linear-gradient(-45deg, #5d9ddc,#00e1fe, #5690d2);
  -webkit-background-clip: text;
  background-size: 200% 200%;
  -webkit-text-fill-color: transparent;

  animation: gradientAnimation 5s ease infinite;

  
}

.text-2 {
  /* font-family: 'Glacial Indifference', sans-serif; */
 font-family: 'Work Sans', sans-serif;
  max-width: 500px;
  /* font-size: 17px; */
  font-size: clamp(0.8125rem, 0.5rem + 1vw, 1.0625rem);
  /* font-weight: 500; */
  margin-bottom: 30px;
  color:#1B2735;
  
}

.img-f{
  /* width: 100%;
  max-width: 480px; */
  float: right;
  margin: 20px 30px 0 20px;
  padding: 0;
}




@media screen and (max-width: 1200px) {
  /* Estilos para pantallas más pequeñas (hasta 960px) */
  .content-nav {
    align-items: center;
  }

  .conten-log {
    padding-top: 20px;
    justify-content: center;
  }

  .name-log {
    text-align: center;
  }

  .content-nav-button {
    justify-content: center;
    padding: 20px;
  }

  .tittle-p {
    padding-top: 80px;
    font-size: 50px;
  }


}


@media screen and (max-width: 960px)  {
  /* Estilos para pantallas más pequeñas (hasta 960px) */
  .content-nav {
    align-items: center;
  }

  .conten-log {
    padding-top: 20px;
    justify-content: center;
  }

  .name-log {
    text-align: center;
  }

  .tittle-p {
    padding-top: 30px;
    font-size: 45px;
    
  }
  .text-2{
    font-size: 13px;
    max-width: 380px;
    padding: 0;
    margin: 0;

  }

  .img-f{
    float: right;
    width: 350px;
    padding: 0;
  }

}


@media screen and (max-width: 820px) {
  /* Estilos para pantallas más pequeñas (hasta 960px) */
  .content-nav {
    flex-direction: column-reverse;
    align-items: center;
    padding:10px;

  }

  .conten-log {
    padding:0;
    justify-content: left;
  }
  .log{
    width: 50px;
  }

  .name-log {
    text-align: center;
  }

  .content-nav-button {
    justify-content: center;
    padding: 10px;
  }

  .content--body{
    flex-direction: column-reverse;
    justify-content: center;
  }  

  .tittle-p {
    padding-top:3%;
    font-size: 40px;
    text-align: center;
  }

  .text-2 {
    text-align: center;
    margin: 0;
    max-width: max-content;
    padding-right: 7%;
    padding-bottom: 2%;


  }
  .button--1{
    text-align: center;
    justify-content: center;
  }
  .img-f {
    float: none;
    margin: 0 auto; 
    text-align: center;
    justify-content: center;
    width: 200px;
    padding-top:20px ;
    
  }
  
}

</style>  
