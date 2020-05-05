<template>
    <div id="dashboard">
        <h1>Esto es el Tablero!</h1>
        <h2>Aqui prodra ver algunos de los datos con los que se registro</h2>
        <p v-if="email">Tu email: {{ email }}</p>
        <p v-if="age">Tu edad: {{ age }}</p>
        <p v-if="country">Tu pais: {{ country }}</p>
    </div>
</template>

<script>
  import axios from 'axios';

    export default {
        computed: {
            email() {
                return !this.$store.getters.user ? false : this.$store.getters.user.email
            },
            age() {
                return !this.$store.getters.user ? false : this.$store.getters.user.age
            },
            country() {
                return !this.$store.getters.user ? false : this.$store.getters.user.country
            }
        },
        created() {
            this.$store.dispatch('fetchUser')
        }
    }
</script>

<style scoped>
  h1, p, h2 {
    text-align: center;
  }

  p {
    color: red;
  }
</style>