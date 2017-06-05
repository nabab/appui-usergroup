<bbn-tabnav class="bbn-user-profile" :autoload="false">
  <bbn-tab url="infos" title="<?=_("Informations")?>" :static="true">
    <form method="post">
      <fieldset class="bbn-section">
        <legend>Mes informations</legend>

        <label class="bbn-form-label" for="zjB159sxPxR82RHX9">
          Nom
        </label>
        <div class="bbn-form-field">
          <bbn-input name="nom" maxlength="35" id="zjB159sxPxR82RHX9" v-model="nom"></bbn-input>
        </div>

        <label class="bbn-form-label" for="ZtDf2jsC0IDl61eot">
          Adresse eMail
        </label>
        <div class="bbn-form-field">
          <bbn-input name="email" id="ZtDf2jsC0IDl61eot" type="email" v-model="email"></bbn-input>
        </div>
        <label class="bbn-form-label" for="PvrUPXO5R07i1udL033T76j7">
          Theme
        </label>
        <div class="bbn-form-field">
          <bbn-dropdown name="theme" id="PvrUPXO5R07i1udL033T76j7" :source="themes" v-model="theme"></bbn-dropdown>
        </div>

        <label class="bbn-form-label" for="OOaX3f111kmT1lm0">Tel.</label>
        <div class="bbn-form-field">
          <bbn-input maxlength="10" name="tel" id="OOaX3f111kmT1lm0" size="10" v-model="tel"></bbn-input>
        </div>

        <label class="bbn-form-label" for="u01QGWJR9NSgiJc3K26r94YjRZ2OX8">
          Fonction
        </label>
        <div class="bbn-form-field">
          <bbn-input name="fonction" id="u01QGWJR9NSgiJc3K26r94YjRZ2OX8" v-model="fonction"></bbn-input>
        </div>

        <label class="bbn-form-label"> </label>
        <div class="bbn-form-field">
          <bbn-button type="submit">
            Enregistrer
          </bbn-button>
        </div>
      </fieldset>
    </form>
  </bbn-tab>
  <bbn-tab url="password" title="<?=_("Mot de passe")?>" :static="true">
    <form method="post">
      <fieldset class="bbn-section">
        <legend>Mon mot de passe</legend>

        <label class="bbn-form-label" for="E4TaZKccHws1gctn">
          Mot de passe actuel
        </label>
        <div class="bbn-form-field">
          <input class="k-textbox" name="current_pass" maxlength="35" id="E4TaZKccHws1gctn" type="password">
        </div>

        <label class="bbn-form-label" for="qZ9TmHdHa7uV3y0XE">
          Nouveau mot de passe
        </label>
        <div class="bbn-form-field">
          <input class="k-textbox" name="current_pass" maxlength="35" id="qZ9TmHdHa7uV3y0XE" type="password">
        </div>

        <label class="bbn-form-label" for="FL1cE8e2uICcfEug44Gemf98g0Z">
          Confirmer le mot de passe
        </label>
        <div class="bbn-form-field">
          <input class="k-textbox" name="current_pass" maxlength="35" id="FL1cE8e2uICcfEug44Gemf98g0Z" type="password">
        </div>

        <label class="bbn-form-label"> </label>
        <div class="bbn-form-field">
          <button class="k-button" id="UQ9Fj3bm4pdh1kG5" type="submit">
            Enregistrer
          </button>
        </div>
      </fieldset>
    </form>
  </bbn-tab>
</bbn-tabnav>


