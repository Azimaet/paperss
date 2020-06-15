<template>
  <main>
    <FormAuthentication v-bind:contextForm="contextForm"></FormAuthentication>
  </main>
</template>


<script>
import FormAuthentication from "../organisms/FormAuthentication";

export default {
  data() {
    return {
      contextForm: "login"
    };
  },
  components: {
    FormAuthentication
  }
};
</script>


<!-- Css -->
<style>
</style>