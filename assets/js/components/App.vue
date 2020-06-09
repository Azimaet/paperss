<template>
  <div>
    <Header></Header>
    <input type="text" v-model="user" />
    Salut {{ user }}
  </div>
</template>

<script>
import Header from "../organisms/Header";

export default {
  data() {
    return {
      user: "Maxou"
    };
  },
  components: {
    Header
  }
};
</script>

<style>
.center {
  text-align: center;
}
</style>