<div class="bbn-middle bbn-full-screen appui-user-profile-form">
  <div style="width: 600px; height: 350px">
    <bbn-form :source="data"
              class="bbn-lg k-widget"
              :action="source.root + 'actions/user'"
              @success="checkTheme"
              ref="form"
    >
      <div class="bbn-full-screen bbn-middle">
        <div class="bbn-grid-fields bbn-padded bbn-c" style="grid-template-columns: auto 300px">
          <label><?=_('Username')?></label>
          <bbn-input class="k-large" maxlength="35" v-model="data[source.schema.username]"></bbn-input>

          <label><?=_('eMail address')?></label>
          <bbn-input class="k-large" type="email" v-model="data[source.schema.email]"></bbn-input>

          <label><?=_('Theme')?></label>
          <bbn-dropdown class="k-large" :source="themes" v-model="data[source.schema.theme]"></bbn-dropdown>

          <label><?=_('Tel.')?></label>
          <bbn-input maxlength="10" class="k-large" size="10" v-model="data[source.schema.tel]"></bbn-input>

          <label><?=_('Function')?></label>
          <bbn-input class="k-large" v-model="data[source.schema.fonction]"></bbn-input>
        </div>

      <!--div class="bbn-form-full">
        <bbn-countdown target="2018-03-25"></bbn-countdown>
      </div-->
      </div>
    </bbn-form>
  </div>
</div>