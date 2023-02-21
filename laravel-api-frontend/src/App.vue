<script>
import axios from 'axios';
import HelloWorld from './components/HelloWorld.vue';

const API_URL = 'http://localhost:8000/api/';
const API_VER = 'v1/';
const API = API_URL + API_VER;

export default{
  components: {
    HelloWorld,
  },
  data(){
    return{
      movies: [],
      genres: [],
      tags: [],
    }
  },
  methods: {
    updateData() {
      axios.get(API + 'movie/all')
           .then(res => {
              const data = res.data;
              const success = data.success;
              const response = data.response;
              const movies = response.movies;
              const genres = response.genres;
              const tags = response.tags;
              if (success) {
                this.movies = movies;
                this.genres = genres;
                this.tags = tags;
              }
           })
           .catch(err => console.log);
    }
  },
  mounted(){
    this.updateData();
  }
}

</script>

<template>
  <h1>Movies</h1>
  <ul>
    <li v-for="(movie, index) in movies" :key="index">
      <h3>{{ movie.name }}</h3>
      <ul>
        <li>{{ movie.director }}</li>
        <li>{{ movie.prod_year }}</li>
        <li>{{ movie.expenses }}</li>
        <li>{{ movie.cashout }}</li>
      </ul>
    </li>
  </ul>
</template>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
