<bbn-table class="appui-usergroup-users-grid"
           :source="source.users"
           :info="true"
           ref="table"
           :pageable="true"
           :sortable="true"
           :filterable="true"
           :editable="true"
           :editor="$options.components.editor"
           :toolbar="$options.components.toolbar"
           :filter="[{
             field: source.arch.active,
             operator: 'eq',
             value: 1
           }]"
           :tr-class="trClass"
           :showable="true">
  <bbns-column title="<?=_("ID")?>"
               :field="source.arch.id"
               :hidden="true"
               :editable="false"
               :width="40"
               :filterable="false"/>
  <bbns-column title="<i class='nf nf-fa-user bbn-large'></i>"
               ftitle="<?=_("Name")?>"
               :field="source.arch.username"
               :width="250"
               :fixed="true"
               :render="renderUsername"/>
  <bbns-column title="<i class='nf nf-fa-link bbn-large'></i>"
               ftitle="<?=_("Session")?>"
               :source="connection"
               field="session"
               :render="renderSession"
               :width="120"
               cls="bbn-c"/>
  <bbns-column title="<i class='nf nf-fa-users bbn-large'></i>"
               ftitle="<?=_("Group")?>"
               :field="source.arch.id_group"
               :source="source.groups"
               :width="200"/>
  <bbns-column title="<i class='nf nf-fa-cogs bbn-large'></i>"
               ftitle="<?=_("Function")?>"
               :field="source.arch.fonction"
               :render="renderFonction"
               :width="200"/>
  <bbns-column title="<i class='nf nf-fa-sign_in bbn-large'></i>"
               ftitle="<?=_("Login")?>"
               :field="source.arch.login"
               :width="250"
               v-if="source.arch.login !== source.arch.email"/>
  <bbns-column title="<i class='nf nf-fa-at bbn-large'></i>"
               ftitle="<?=_("eMail")?>"
               :field="source.arch.email"
               type="email"
               :width="250"/>
  <bbns-column title="<i class='nf nf-fa-calendar bbn-xl'></i>"
               ftitle="<?=_("Last activity of the user")?>"
               field="last_activity"
               :editable="false"
               :filterable="false"
               :width="130"
               type="datetime"
               cls="bbn-c"
               :render="renderLastActivity"/>
  <bbns-column title="<i class='nf nf-fa-phone bbn-large'></i>"
               ftitle="<?=_("Phone")?>"
               :field="source.arch.phone"
               :width="120"
               :render="renderTel"/>
  <bbns-column title="<i class='nf nf-fae-palette_color bbn-large'></i>"
               ftitle="<?=_("Theme")?>"
               :field="source.arch.theme"
               default="default"
               :width="120"
               :source="themes"/>
  <bbns-column title="<?=_("Developer")?>"
               :field="source.arch.dev"
               :hidden="true"
               type="boolean"/>
  <bbns-column title="<?=_("Administrator")?>"
               :field="source.arch.admin"
               :hidden="true"
               type="boolean"/>
  <bbns-column title="<?=_("Active")?>"
               :field="source.arch.active"
               type="boolean"
               :editable="false"
               :hidden="true"
               :showable="false"
               :filterable="false"
               :width="80"/>
  <bbns-column ftitle="<?=_("Actions")?>"
               :editable="false"
               :sortable="false"
               :width="180"
               :buttons="getButtons"
               fixed="right"
               cls="bbn-c"/>
</bbn-table>

<script type="text/x-template" id="appui-usergroup-user-edit-form">
  <bbn-form :action="cp.root + 'actions/users/' + (source.row[cp.source.arch.id] ? 'update' : 'insert')"
            :source="source.row"
            @success="success"
            ref="form"
  >
    <div class="bbn-padded bbn-grid-fields">

      <label><?=_('Name')?></label>
      <bbn-input v-model="source.row[cp.source.arch.username]"
                 required="required"
      ></bbn-input>

      <label><?=_('Group')?></label>
      <bbn-dropdown :source="cp.source.groups"
                    v-model="source.row[cp.source.arch.id_group]"
      ></bbn-dropdown>
      <label><?=_('Function')?></label>
      <bbn-input v-model="source.row[cp.source.arch.fonction]"></bbn-input>

      <label v-if="cp.source.arch.login !== cp.source.arch.email"><?=_('Login')?></label>
      <bbn-input v-model="source.row[cp.source.arch.login]"
                 required="required"
                 v-if="cp.source.arch.login !== cp.source.arch.email"
      ></bbn-input>

      <label><?=_('eMail')?></label>
      <bbn-input v-model="source.row[cp.source.arch.email]"
                 type="email"
                 :required="isGroupReal"
      ></bbn-input>

      <label><?=_('Phone')?></label>
      <bbn-input v-model="source.row[cp.source.arch.phone]"
                 maxlength="10"
      ></bbn-input>

      <label><?=_('Theme')?></label>
      <bbn-dropdown :source="cp.themes"
                    v-model="source.row[cp.source.arch.theme]"
                    required="required"
      ></bbn-dropdown>

      <label v-if="cp.user.isAdmin"><?=_('Developer')?></label>
      <bbn-checkbox v-if="cp.user.isAdmin"
                    :novalue="0"
                    :value="1"
                    v-model="source.row[cp.source.arch.dev]"
      ></bbn-checkbox>

      <label v-if="cp.user.isAdmin"><?=_('Administrator')?></label>
      <bbn-checkbox v-if="cp.user.isAdmin"
                    :novalue="0"
                    :value="1"
                    v-model="source.row[cp.source.arch.admin]"
                    :disabled="adminDisabled"
      ></bbn-checkbox>
    </div>
  </bbn-form>
</script>