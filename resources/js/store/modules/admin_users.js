import axios from "axios";
import Form from "vform";

export const state = {
  users: [],
  usersDup: [],
  loading: true,
  dialogAdd: false,
};

export const getters = {
};

export const mutations = {
  asignUsers(state, newData) {
    state.users = newData;
    state.usersDup = [...state.users];
    // state.formAdd.reset();
    state.loading = false;
  },
  addUserDup(state, newData) {
    state.usersDup.push(newData);
  },
  closeAdd(state) {
    state.formAdd.reset();
  },
};

export const actions = {
  getUsers({ commit }) {
    axios.get("/api/all-users").then(response => {
      commit("asignUsers", response.data);
    });
  },
  addUser({ commit }, postData) {
    postData.post("/api/add-users").then(response => {
      commit("addUserDup", response.data);
      postData.reset()
      // commit("closeAdd")
    });
  },
  closeAdd({commit}){
    commit("closeAdd")
  },
};
