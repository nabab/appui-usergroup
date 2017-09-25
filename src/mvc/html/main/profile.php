<bbn-form :data="data"
          class="bbn-lg"
          :action="source.root + 'actions/user'"
          @success="checkTheme"
          confirm="Blablabla"
          ref="form">
  <label class="bbn-form-label bbn-c" for="zjB159sxPxR82RHX9">
    Nom
  </label>
  <div class="bbn-form-field">
    <bbn-input name="nom" maxlength="35" id="zjB159sxPxR82RHX9" v-model="data.nom"></bbn-input>
  </div>

  <label class="bbn-form-label" for="ZtDf2jsC0IDl61eot">
    Adresse eMail
  </label>
  <div class="bbn-form-field">
    <bbn-input name="email" id="ZtDf2jsC0IDl61eot" type="email" v-model="data.email"></bbn-input>
  </div>
  <label class="bbn-form-label" for="PvrUPXO5R07i1udL033T76j7">
    Theme
  </label>
  <div class="bbn-form-field">
    <bbn-dropdown name="theme" id="PvrUPXO5R07i1udL033T76j7" :source="themes" v-model="data.theme"></bbn-dropdown>
  </div>

  <label class="bbn-form-label" for="OOaX3f111kmT1lm0">Tel.</label>
  <div class="bbn-form-field">
    <bbn-input maxlength="10" name="tel" id="OOaX3f111kmT1lm0" size="10" v-model="data.tel"></bbn-input>
  </div>

  <label class="bbn-form-label" for="u01QGWJR9NSgiJc3K26r94YjRZ2OX8">
    Fonction
  </label>
  <div class="bbn-form-field">
    <bbn-input name="fonction" id="u01QGWJR9NSgiJc3K26r94YjRZ2OX8" v-model="data.fonction"></bbn-input>
  </div>

  <!--div class="bbn-form-full">
  	<bbn-countdown target="2018-03-25"></bbn-countdown>
  </div-->
</bbn-form>