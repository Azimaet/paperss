<template>
  <main class="grid-center">
    <div class="col-9">
      <FormResearch></FormResearch>
      <div class="grid-spaceBetween">
        <PaperssHelper></PaperssHelper>
        <HallOfFame></HallOfFame>
      </div>
    </div>
  </main>
</template>


<script>
import FormResearch from "../organisms/FormResearch";
import PaperssHelper from "../organisms/PaperssHelper";
import HallOfFame from "../organisms/HallOfFame";

export default {
  data() {
    return {
      //
    };
  },
  components: {
    FormResearch,
    PaperssHelper,
    HallOfFame
  }
};
</script>


<!-- Css -->
<style>
</style>