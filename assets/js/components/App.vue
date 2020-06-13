<template>
  <div>
    <Header></Header>
    <input type="text" v-model="test" />
    Salut {{ test }}
  </div>
</template>

<script>
import Header from "../organisms/Header";

export default {
  data() {
    return {
      test: "Maxou"
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