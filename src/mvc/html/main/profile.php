<div class="bbn-middle bbn-overlay appui-user-profile-form">
  <bbn-form :source="data"
            style="width: 100%; max-width: 600px"
            class="bbn-lg bbn-widget "
            :action="source.root + 'actions/user'"
            @success="checkChanges"
            ref="form">
    <div class="bbn-middle">
      <div class="bbn-grid-fields bbn-padded bbn-c bbn-nowrap" style="grid-template-columns: auto 300px">
        <label>
          <?= _('Username') ?>
        </label>
        <bbn-input class="bbn-medium"
                   maxlength="35"
                   v-model="data[source.schema.username]"/>

        <label>
          <?= _('eMail address') ?>
        </label>
        <bbn-input class="bbn-medium"
                   type="email"
                   v-model="data[source.schema.email]"/>

        <label v-if="source.schema.theme !== undefined">
          <?= _('Theme') ?>
        </label>
        <bbn-dropdown v-if="source.schema.theme !== undefined"
                      class="bbn-medium"
                      :source="themes"
                      source-value="code"
                      v-model="data[source.schema.theme]"/>

        <label v-if="source.languages && source.languages.length > 1">
          <?= _('Language') ?>
        </label>
        <bbn-dropdown v-if="source.languages && source.languages.length > 1"
                      class="bbn-medium"
                      :source="source.languages"
                      source-value="code"
                      v-model="data[source.schema.language]"/>

        <label v-if="source.schema.phone !== undefined">
          <?= _('Phone') ?>
        </label>
        <bbn-input v-if="source.schema.phone !== undefined"
                   maxlength="10"
                   class="bbn-medium"
                   v-model="data[source.schema.phone]"/>

        <label v-if="source.schema.function !== undefined">
          <?= _('Function') ?>
        </label>
        <bbn-input v-if="source.schema.function !== undefined"
                   class="bbn-medium"
                   v-model="data[source.schema.function]"/>
      </div>

    <!--div class="bbn-form-full">
      <bbn-countdown target="2018-03-25"></bbn-countdown>
    </div-->
    </div>
  </bbn-form>
</div>