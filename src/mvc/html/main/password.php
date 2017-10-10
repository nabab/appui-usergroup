<!-- HTML Document -->
<bbn-form method="post"
          :source="data"
          class="bbn-lg"
          :action="source.root + 'actions/user'"
          :successMessage="_('Your password has been updated successfully')"
          :validation="(d) => {return d.pass1 === d.pass2}"
          >
  <div class="bbn-grid-fields bbn-padded bbn-c">
    <label class="bbn-form-label bbn-c" for="E4TaZKccHws1gctn">
      Mot de passe actuel
    </label>
    <div class="bbn-form-field">
      <input class="k-textbox"
             name="current_pass"
             maxlength="35"
             id="E4TaZKccHws1gctn"
             type="password"
             v-model="data.current_pass"
             >
    </div>

    <label class="bbn-form-label" for="qZ9TmHdHa7uV3y0XE">
      Nouveau mot de passe
    </label>
    <div class="bbn-form-field">
      <input class="k-textbox"
             name="pass1"
             v-model="data.pass1"
             maxlength="35"
             id="qZ9TmHdHa7uV3y0XE"
             type="password"
             >
    </div>

    <label class="bbn-form-label" for="FL1cE8e2uICcfEug44Gemf98g0Z">
      Confirmer le mot de passe
    </label>
    <div class="bbn-form-field">
      <input class="k-textbox"
             name="pass2"
             v-model="data.pass2"
             maxlength="35"
             id="FL1cE8e2uICcfEug44Gemf98g0Z"
             type="password"
             >
    </div>
  </div>
</bbn-form>