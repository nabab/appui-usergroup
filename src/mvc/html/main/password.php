<!-- HTML Document -->
<div class="bbn-middle bbn-full-screen appui-user-profile-form">
  <div style="width: 500px; height: 250px">
    <bbn-form method="post"
              :source="data"
              class="bbn-lg k-widget bbn-middle"
              :action="root + 'actions/user'"
              :success="success"
              :validation="validForm">
      <div class="bbn-full-screen bbn-middle">
        <div class="bbn-grid-fields bbn-padded bbn-c">
          <label for="E4TaZKccHws1gctn">
            Mot de passe actuel
          </label>
          <div>
            <bbn-input name="current_pass"
                       maxlength="35"
                       id="E4TaZKccHws1gctn"
                       type="password"
                       v-model="data.current_pass"
                       >
            </bbn-input>
          </div>

          <label for="qZ9TmHdHa7uV3y0XE">
            Nouveau mot de passe
          </label>
          <div>
            <bbn-input name="pass1"
                       v-model="data.pass1"
                       maxlength="35"
                       id="qZ9TmHdHa7uV3y0XE"
                       type="password"
                       >
            </bbn-input>
          </div>

          <label for="FL1cE8e2uICcfEug44Gemf98g0Z">
            Confirmer le mot de passe
          </label>
          <div>
            <bbn-input name="pass2"
                       v-model="data.pass2"
                       maxlength="35"
                       id="FL1cE8e2uICcfEug44Gemf98g0Z"
                       type="password"
                       >
            </bbn-input>
          </div>
        </div>
      </div>
    </bbn-form>
  </div>
</div>