<template>
  <!-- Research Form -->
    <div class="grid">
        <form class="form-research col-6-center" action="/login" method="post">
            <h2>Research Board by Tags</h2>
            <div class="form-group">
            <input class="form-control" placeholder="Research Board" type="text" />
            </div>

        <!--     <BtnResearch></BtnResearch> -->
        </form>
    </div>
</template>

<script>

export default {
  data() {
    return {
        //
    };
  },
  props: {
      //
  },
  components: {

  }
};
</script>


<!-- Css -->
<style>
.form-research {
  font-family: "Open Sans", "Helvetica", "Arial", sans-serif;
  text-align: center;
  margin: 0 auto;
  text-align: center;
  color: white;
  padding: 40px;
}

.form-research > * {
  margin: 20px 0;
}

.form-group {
  width: 100%;
}

.form-control {
  background-color: #fff;
  color: #333333;
  line-height: 1.2;
  font-size: 18px;
  display: block;
  width: 100%;
  height: 60px;
  padding: 0 20px;
  outline: none;
  border: none;
}
</style>