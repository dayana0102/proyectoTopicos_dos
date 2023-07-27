import axios from "axios"

export const state = {
  loader:true,
  paneles:[],

  personales: [],
  cursos:[],

  infopanel:null,
};
export const getters = {
    loader: state => state.loader,
    paneles: state => state.paneles,

    infopanel:state=>state.infopanel,
}

export const mutations = {
  setPaneles(state,datos) {
    state.paneles =datos ;
    state.loader=false;
    
    state.personales = []
    state.cursos = []
    state.paneles.forEach(ele => {
      if(ele.tipo == 1){
        state.cursos.push(ele);
      } else {
        state.personales.push(ele);
      }
    });
  },

  setInfopanel(state,dato){
    state.infopanel=dato;
  },

};


export const actions = {
  getpaneles({ commit }){
    axios.get('/api/get-paneles-user').then(response=>{
        commit('setPaneles',response.data);
    }).catch(error=>{
        commit('setPaneles',[]);
    })
  },

  getinfopanel({ commit },{id}){
    axios.get('/api/get-info-panel/'+id).then(response=>{
        commit('setInfopanel',response.data);
    }).catch(error=>{
        commit('setInfopanel',null);
    })
  },

};
