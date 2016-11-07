<div class="appui-user-profile"></div>

<script type="text/html" id="appui-tpl-user-info">
  <form method="post">
    <fieldset class="appui-section">
      <legend>Mes informations</legend>
      
      <label class="appui-form-label" for="zjB159sxPxR82RHX9">
        Nom
      </label>
      <div class="appui-form-field">
        <input class="k-textbox" name="nom" maxlength="35" id="zjB159sxPxR82RHX9" data-bind="value: nom">
      </div>

      <label class="appui-form-label" for="ZtDf2jsC0IDl61eot">
        Adresse eMail
      </label>
      <div class="appui-form-field">
        <input class="k-textbox" name="email" maxlength="100" id="ZtDf2jsC0IDl61eot" type="email" data-bind="value: email">
      </div>

      <label class="appui-form-label" for="PvrUPXO5R07i1udL033T76j7">
        Theme
      </label>
      <div class="appui-form-field">
        <input name="theme" value="black" id="PvrUPXO5R07i1udL033T76j7" data-role="dropdownlist" data-bind="source: themes, value: theme" data-text-field="text" data-value-field="value">
      </div>

      <label class="appui-form-label" for="OOaX3f111kmT1lm0">Tel.</label>
      <div class="appui-form-field">
        <input class="k-textbox" maxlength="10" name="tel" id="OOaX3f111kmT1lm0" size="10" type="text" data-bind="value: tel">
      </div>

      <label class="appui-form-label" for="u01QGWJR9NSgiJc3K26r94YjRZ2OX8">
        Fonction
      </label>
      <div class="appui-form-field">
        <input class="k-textbox" name="fonction" id="u01QGWJR9NSgiJc3K26r94YjRZ2OX8" type="text" data-bind="value: fonction">
      </div>

      <label class="appui-form-label"> </label>
      <div class="appui-form-field">
        <button class="k-button" id="UQ9Fj3bm4pdh1kG5" type="submit">
          Enregistrer
        </button>
      </div>
    </fieldset>
  </form>
</script>

<script type="text/html" id="appui-tpl-user-pass">
  <form method="post">
    <fieldset class="appui-section">
      <legend>Mon mot de passe</legend>

      <label class="appui-form-label" for="E4TaZKccHws1gctn">
        Mot de passe actuel
      </label>
      <div class="appui-form-field">
        <input class="k-textbox" name="current_pass" maxlength="35" id="E4TaZKccHws1gctn" type="password">
      </div>

      <label class="appui-form-label" for="qZ9TmHdHa7uV3y0XE">
        Nouveau mot de passe
      </label>
      <div class="appui-form-field">
        <input class="k-textbox" name="current_pass" maxlength="35" id="qZ9TmHdHa7uV3y0XE" type="password">
      </div>

      <label class="appui-form-label" for="FL1cE8e2uICcfEug44Gemf98g0Z">
        Confirmer le mot de passe
      </label>
      <div class="appui-form-field">
        <input class="k-textbox" name="current_pass" maxlength="35" id="FL1cE8e2uICcfEug44Gemf98g0Z" type="password">
      </div>

      <label class="appui-form-label"> </label>
      <div class="appui-form-field">
        <button class="k-button" id="UQ9Fj3bm4pdh1kG5" type="submit">
          Enregistrer
        </button>
      </div>
    </fieldset>
  </form>
</script>