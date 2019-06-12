<div class="bbn-middle bbn-overlay appui-user-profile-form">
  <bbn-form :source="data"
            style="width: 600px; height: 350px"
            class="bbn-lg bbn-widget "
            :action="source.root + 'actions/user'"
            @success="checkTheme"
            ref="form"
  >
    <div class="bbn-overlay bbn-middle">
      <div class="bbn-grid-fields bbn-padded bbn-c" style="grid-template-columns: auto 300px">
        <label><?=_('Username')?></label>
        <bbn-input class="bbn-medium" maxlength="35" v-model="data[source.schema.username]"></bbn-input>

        <label><?=_('eMail address')?></label>
        <bbn-input class="bbn-medium" type="email" v-model="data[source.schema.email]"></bbn-input>

        <label><?=_('Theme')?></label>
        <bbn-dropdown class="bbn-medium" :source="themes" v-model="data[source.schema.theme]"></bbn-dropdown>

        <label><?=_('Tel.')?></label>
        <bbn-input maxlength="10" class="bbn-medium" v-model="data[source.schema.tel]"></bbn-input>

        <label><?=_('Function')?></label>
        <bbn-input class="bbn-medium" v-model="data[source.schema.fonction]"></bbn-input>
      </div>

    <!--div class="bbn-form-full">
      <bbn-countdown target="2018-03-25"></bbn-countdown>
    </div-->
    </div>
  </bbn-form>
</div>