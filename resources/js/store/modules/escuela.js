import axios from "axios";
import Form from "vform";

export const state = {
  docentes: [],
  docentes_view: [],

  loading: false,

  paneles: [],
  paneles_view: [],

  dialogvuex: false
};

export const mutations = {
  buttonsLoading(state) {
    state.loading = !state.loading;
  },
  editDialog_Escuela(state) {
    state.dialogvuex = false;
  },

  // PANELES

  asignPanels(state, newData) {
    state.paneles = newData;
    state.paneles_view = [...newData];
  },
  addPanels(state, newData) {
    state.paneles_view.push(newData)
    state.dialogvuex = false;
  },

  // DOCENTES

  asignDocentes(state, newData) {
    state.docentes = newData;
    state.docentes_view = [...newData];
  },
  addDocentes(state, newData) {
    state.docentes_view.push(newData);
    state.dialogvuex = false;
  },
 
};

export const actions = {

  // PANELES

  getPaneles_escuela({commit}){
    axios.get('/api/obtener-cursos').then( res =>{
      commit('asignPanels', res.data)
    })
  },
  addPanel_escuela({ commit }, postData) {
    commit("buttonsLoading");
    postData.post('/api/add-pandel-escuela').then(res => {
      // commit('addPanels', res.data);
      commit("buttonsLoading");
      postData.reset();
    }).catch(error => {
        commit("buttonsLoading");
      })
  },
  editPanel_escuela({ commit }, postData) {
    commit("buttonsLoading");
    postData.post('/api/editar-curso').then(res => {
      // commit('addPanels', res.data);
      commit("buttonsLoading");
      commit('editDialog_Escuela')
      postData.reset();
    }).catch(error => {
        commit("buttonsLoading");
      })
  },
  changeEstado_panel({ commit }, item){
    axios.get('/api/cambiar-estado-panel/'+item.id).then(res => {
    }).catch(error => {
    })
  },

  // DOCENTES

  getDocentes_escuela({ commit }) {
    axios.get("/api/obtener-docentes").then(res => {
      commit("asignDocentes", res.data);

    });
  },
  addDocentes_escuela({ commit }, postData) {
    commit("buttonsLoading");
    postData.post("/api/agregar-docente").then(res => {
      commit("buttonsLoading");
      commit("addDocentes", res.data);
      postData.reset();
    }).catch(error => {
      commit("buttonsLoading");
     });
  },
  editDocentes_escuela({ commit }, postData) {
    commit("buttonsLoading");
    postData.post("/api/editar-docente").then(res => {
      commit("buttonsLoading");
      commit("editDialog_Escuela");
    }).catch(error => {
      commit("buttonsLoading");
    });
  }
};
