import axios from "axios"
import Form from "vform"

export const state = {
  paneles: [
    //CURSOS: 1 - PERSONAL: 2
    { id: 1, name: "Algoritmos", type: 1 },
    { id: 2, name: "Calculo Diferencial", type: 1 },
    { id: 3, name: "Matemática Básica", type: 1 },
    { id: 4, name: "Comunicación Oral y Escrita", type: 1 },
    { id: 5, name: "Matemática Superior", type: 1 },
    { id: 6, name: "Fisica General", type: 1 }
  ],
  paneles_view:[],
  form: new Form({
    name:""
  })
};

export const mutations = {
  cambiar(state) {
    state.hola = "como estas";
  },
  asignPanels(state, newData) {
    state.paneles = newData
  },
  duplicarPaneles(state, newData){
    state.paneles_view = [...newData]
  },
  addPanelsView(state, newData){
    state.paneles.push({id: state.paneles.length + 1,name: newData, type:2})
    state.form.name =""
  }
};

export const actions = {
  addPanel({ commit }){
    // state.form.post("/api/add-pandel-escuela").then( () => {
      commit("addPanelsView", state.form.name)
    // })
    // this.$refs.table.blur();
  },
  // getPaneles({commit}){
  //   axios.get().then(response => {
  //     commit("asignPanels", response.data);
  //     commit("duplicarPaneles", response.data);
  //   }).catch(error => {

  //   })
  // }

//   getPanels({ commit} ){
//     axios.get()
//   }
};
