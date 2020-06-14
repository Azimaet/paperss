<template>
  <form class="form-registration" name="registration" method="post">
    <div class="form-group">
      <input
        type="text"
        id="registration_username"
        name="registration[username]"
        required="required"
        maxlength="255"
        placeholder="Nom d'utilisateur"
        class="form-control"
      />
    </div>
    <div class="form-group">
      <input
        type="email"
        id="registration_email"
        name="registration[email]"
        required="required"
        maxlength="255"
        placeholder="Adresse Email"
        class="form-control"
      />
    </div>
    <div class="form-group">
      <input
        type="password"
        id="registration_password"
        name="registration[password]"
        required="required"
        placeholder="Mot de passe"
        class="form-control"
      />
    </div>
    <div class="form-group">
      <input
        type="password"
        id="registration_confirm_password"
        name="registration[confirm_password]"
        required="required"
        placeholder="Répéter le mot de passe"
        class="form-control"
      />
    </div>

    <button type="submit" class="btn">Inscription</button>
    <input
      type="hidden"
      id="registration__token"
      name="registration[_token]"
      value="P-xlC5Bp8H3Qay76vJ7eQZT740xYlOxiSqwjTfn2TAs"
    />
  </form>
</template>

<script>
export default {
  data() {
    return {
      //
    };
  },
  components: {}
};
</script>


<!-- Css -->
<style>
.form-registration {
  font-family: "Open Sans", "Helvetica", "Arial", sans-serif;
  background-color: #000;
  text-align: center;
  margin: 0 auto;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 800px;
  height: 450px;
  text-align: center;
  display: flex;
  flex-direction: column;
  flex-wrap: nowrap;
  align-items: center;
  justify-content: space-between;
  color: white;
  padding: 40px 100px;
}

.form-registration > div {
  width: 100%;
}

.form-registration input {
  background: white;
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