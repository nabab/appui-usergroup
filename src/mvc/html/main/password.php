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
          <label><?=_('Current password')?></label>
          <div>
            <bbn-input maxlength="35"
                       type="password"
                       v-model="data.current_pass"
            ></bbn-input>
          </div>

          <label><?=_('New password')?></label>
          <div>
            <bbn-input v-model="data.pass1"
                       maxlength="35"
                       type="password"
            ></bbn-input>
          </div>

          <label><?=_('Confirm password')?></label>
          <div>
            <bbn-input v-model="data.pass2"
                       maxlength="35"
                       type="password"
            ></bbn-input>
          </div>
        </div>
      </div>
    </bbn-form>
  </div>
</div>