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
           button-mode="menu"
           :tr-class="trClass"
           :showable="true">
  <bbns-column :editable="false"
               :sortable="false"
               :fixed="true"
               :width="30"
               :max-width="30"
               label=" "
               :buttons="getButtons"
               cls="bbn-c"/>
  <bbns-column label="<?= _("ID") ?>"
               :field="source.arch.id"
               :invisible="true"
               :editable="false"
               type="uid"
               :width="40"
               :fixed="true"
               :filterable="false"/>
  <bbns-column label="<i class='nf nf-fa-user bbn-large'></i>"
               flabel="<?= _("Name") ?>"
               :field="source.arch.username"
               :width="250"
               :fixed="true"
               :render="renderUsername"/>
  <bbns-column label="<i class='nf nf-fa-link bbn-large'></i>"
               flabel="<?= _("Session") ?>"
               :source="connection"
               field="session"
               :render="renderSession"
               :width="120"
               cls="bbn-c"/>
  <bbns-column label="<i class='nf nf-fa-users bbn-large'></i>"
               flabel="<?= _("Group") ?>"
               :field="source.arch.id_group"
               :source="source.groups"
               :width="200"/>
  <bbns-column label="<i class='nf nf-fa-cogs bbn-large'></i>"
               flabel="<?= _("Function") ?>"
               :field="source.arch.fonction"
               :render="renderFonction"
               :width="200"/>
  <bbns-column label="<i class='nf nf-fa-sign_in bbn-large'></i>"
               flabel="<?= _("Login") ?>"
               :field="source.arch.login"
               :width="250"
               v-if="source.arch.login !== source.arch.email"/>
  <bbns-column label="<i class='nf nf-fa-at bbn-large'></i>"
               flabel="<?= _("eMail") ?>"
               :field="source.arch.email"
               type="email"
               :width="250"/>
  <bbns-column label="<i class='nf nf-fa-calendar bbn-xl'></i>"
               flabel="<?= _("Last activity of the user") ?>"
               field="last_activity"
               :editable="false"
               :filterable="false"
               :width="130"
               type="datetime"
               cls="bbn-c"
               :render="renderLastActivity"/>
  <bbns-column label="<i class='nf nf-fa-phone bbn-large'></i>"
               flabel="<?= _("Phone") ?>"
               :field="source.arch.phone"
               :width="120"
               :render="renderTel"
               type="tel"/>
  <bbns-column label="<i class='nf nf-fae-palette_color bbn-large'></i>"
               flabel="<?= _("Theme") ?>"
               :field="source.arch.theme"
               default="default"
               :width="120"
               :source="themes"/>
  <bbns-column label="<?= _("Developer") ?>"
               :field="source.arch.dev"
               :invisible="true"
               type="boolean"/>
  <bbns-column label="<?= _("Administrator") ?>"
               :field="source.arch.admin"
               :invisible="true"
               type="boolean"/>
  <bbns-column label="<?= _("Active") ?>"
               :field="source.arch.active"
               type="boolean"
               :editable="false"
               :invisible="true"
               :showable="false"
               :filterable="false"
               :width="80"/>
</bbn-table>

<script type="text/x-template"
        id="appui-usergroup-user-edit-form">
  <bbn-form :action="cp.root + 'actions/users/' + (source.row[cp.source.arch.id] ? 'update' : 'insert')"
            :source="source.row"
            @success="success"
            ref="form">
    <div class="bbn-padding bbn-grid-fields">

      <label><?= _('Name') ?></label>
      <bbn-input bbn-model="source.row[cp.source.arch.username]"
                 required="required"/>

      <label><?= _('Group') ?></label>
      <bbn-dropdown :source="cp.source.groups"
                    bbn-model="source.row[cp.source.arch.id_group]"/>

      <label><?= _('Function') ?></label>
      <bbn-input bbn-model="source.row[cp.source.arch.fonction]"/>

      <label bbn-if="cp.source.arch.login !== cp.source.arch.email"><?= _('Login') ?></label>
      <bbn-input bbn-if="cp.source.arch.login !== cp.source.arch.email"
                 bbn-model="source.row[cp.source.arch.login]"
                 required="required"/>

      <label><?= _('eMail') ?></label>
      <bbn-input bbn-model="source.row[cp.source.arch.email]"
                 type="email"
                 :required="isGroupReal"/>

      <label><?= _('Phone') ?></label>
      <bbn-phone bbn-model="source.row[cp.source.arch.phone]"/>

      <label><?= _('Theme') ?></label>
      <bbn-dropdown :source="cp.themes"
                    bbn-model="source.row[cp.source.arch.theme]"
                    source-value="code"
                    required="required"/>

      <label bbn-if="cp.user.isAdmin"><?= _('Developer') ?></label>
      <bbn-checkbox bbn-if="cp.user.isAdmin"
                    :novalue="0"
                    :value="1"
                    bbn-model="source.row[cp.source.arch.dev]"/>

      <label bbn-if="cp.user.isAdmin"><?= _('Administrator') ?></label>
      <bbn-checkbox bbn-if="cp.user.isAdmin"
                    :novalue="0"
                    :value="1"
                    bbn-model="source.row[cp.source.arch.admin]"
                    :disabled="adminDisabled"/>
    </div>
  </bbn-form>
</script>