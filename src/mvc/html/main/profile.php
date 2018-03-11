<div class="bbn-middle bbn-full-screen appui-user-profile-form">
  <div style="width: 600px; height: 350px">
    <bbn-form :source="data"
              class="bbn-lg k-widget"
              :action="source.root + 'actions/user'"
              @success="checkTheme"
              ref="form">
      <div class="bbn-full-screen bbn-middle">
        <div class="bbn-grid-fields bbn-padded bbn-c" style="grid-template-columns: auto 300px">
          <label class="bbn-form-label" for="zjB159sxPxR82RHX9">
            Nom
          </label>
          <bbn-input class="k-large" name="nom" maxlength="35" id="zjB159sxPxR82RHX9" v-model="data.nom"></bbn-input>

          <label class="bbn-form-label" for="ZtDf2jsC0IDl61eot">
            Adresse eMail
          </label>
          <bbn-input class="k-large" name="email" id="ZtDf2jsC0IDl61eot" type="email" v-model="data.email"></bbn-input>

          <label class="bbn-form-label" for="PvrUPXO5R07i1udL033T76j7">
            Theme
          </label>
          <bbn-dropdown class="k-large" name="theme" id="PvrUPXO5R07i1udL033T76j7" :source="themes" v-model="data.theme"></bbn-dropdown>

          <label class="bbn-form-label" for="OOaX3f111kmT1lm0">Tel.</label>
          <bbn-input maxlength="10" class="k-large" name="tel" id="OOaX3f111kmT1lm0" size="10" v-model="data.tel"></bbn-input>

          <label class="bbn-form-label" for="u01QGWJR9NSgiJc3K26r94YjRZ2OX8">
            Fonction
          </label>
          <bbn-input class="k-large" name="fonction" id="u01QGWJR9NSgiJc3K26r94YjRZ2OX8" v-model="data.fonction"></bbn-input>
        </div>

      <!--div class="bbn-form-full">
        <bbn-countdown target="2018-03-25"></bbn-countdown>
      </div-->
      </div>
    </bbn-form>
  </div>
</div>