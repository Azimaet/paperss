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
      contextForm: "register"
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