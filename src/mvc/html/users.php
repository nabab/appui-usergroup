<bbn-table class="appui-usergroup-users-grid"
           :source="source.users"
           :info="true"
           ref="table"
           :pageable="true"
           :sortable="true"
           :filterable="true"
           :editable="true"
           :editor="$options.components['appui-usergroup-user-edit-form']"
           :toolbar="[{
             text: '<?=_('Nouveau user')?>',
             icon: 'fas fa-user-plus',
             command: insert,
             disabled: !!(user.isDev && !user.isAdmin)
           }]"
           :filter="[{
             field: source.arch.active,
             operator: 'eq',
             value: 1
           }]"
           :tr-class="trClass"
>
  <bbns-column title="<?=_("ID")?>"
               :field="source.arch.id"
               :hidden="true"
               :editable="false"
               :width="40"
               :filterable="false"
  ></bbns-column>
  <bbns-column title="<i class='fas fa-user bbn-large'></i>"
               ftitle="<?=_("Nom")?>"
               :field="source.arch.username"
               :width="250"
  ></bbns-column>
  <bbns-column title="<i class='fas fa-users bbn-large'></i>"
               ftitle="<?=_("Groupe")?>"
               :field="source.arch.id_group"
               :source="source.groups"
               :width="200"
  ></bbns-column>
  <bbns-column title="<i class='fas fa-cogs bbn-large'></i>"
               ftitle="<?=_("Fonction")?>"
               :field="source.arch.fonction"
               :render="renderFonction"
               :width="200"
  ></bbns-column>
  <bbns-column title="<i class='fas fa-sign-in-alt bbn-large'></i>"
               ftitle="<?=_("Login")?>"
               :field="source.arch.login"
               :width="250"
               v-if="source.arch.login !== source.arch.email"
  ></bbns-column>
  <bbns-column title="<i class='fas fa-at bbn-large'></i>"
               ftitle="<?=_("eMail")?>"
               :field="source.arch.email"
               type="email"
               :width="250"
  ></bbns-column>
  <bbns-column title="<i class='far fa-calendar-alt bbn-xl'></i>"
               ftitle="<?=_("Dernière activité de l'utilisateur")?>"
               field="last_activity"
               :editable="false"
               :filterable="false"
               :width="120"
               type="date"
               cls="bbn-c"
  ></bbns-column>
  <bbns-column title="<i class='fas fa-phone bbn-large'></i>"
               ftitle="<?=_("Téléphone")?>"
               :field="source.arch.tel"
               :width="120"
               :render="renderTel"
  ></bbns-column>
  <bbns-column title="<i class='fas fa-palette bbn-large'></i>"
               ftitle="<?=_("Thème")?>"
               :field="source.arch.theme"
               :width="120"
               :source="themes"
  ></bbns-column>
  <bbns-column title="<?=_("Développeur")?>"
               :field="source.arch.dev"
               :hidden="true"
               type="boolean"
  ></bbns-column>
  <bbns-column title="<?=_("Administrateur")?>"
               :field="source.arch.admin"
               :hidden="true"
               type="boolean"
  ></bbns-column>
  <bbns-column title="<?=_("Actif")?>"
               :field="source.arch.active"
               type="boolean"
               :editable="false"
               :hidden="true"
               :showable="false"
               :filterable="false"
               :width="80"
  ></bbns-column>
  <bbns-column ftitle="<?=_("Actions")?>"
               :editable="false"
               :sortable="false"
               :width="130"
               :buttons="getButtons"
               cls="bbn-c"
               fixed="right"
  ></bbns-column>
</bbn-table>

<script type="text/x-template" id="appui-usergroup-user-edit-form">
  <bbn-form class="bbn-full-screen"
            :action="cp.root + 'actions/users/' + (source.row[cp.source.arch.id] ? 'update' : 'insert')"
            :source="source.row"
            @success="success"
            ref="form"
  >
    <div class="bbn-padded bbn-grid-fields">
      <label><?=_('Nom')?></label>
      <bbn-input v-model="source.row[cp.source.arch.username]"
                 required="required"
      ></bbn-input>
      <label><?=_('Groupe')?></label>
      <bbn-dropdown :source="cp.source.groups"
                    v-model="source.row[cp.source.arch.id_group]"
      ></bbn-dropdown>
      <label><?=_('Fonction')?></label>
      <bbn-input v-model="source.row[cp.source.arch.fonction]"></bbn-input>
      <label v-if="cp.source.arch.login !== cp.source.arch.email"><?=_('Login')?></label>
      <bbn-input v-model="source.row[cp.source.arch.login]"
                 required="required"
                 v-if="cp.source.arch.login !== cp.source.arch.email"
      ></bbn-input>
      <label><?=_('eMail')?></label>
      <bbn-input v-model="source.row[cp.source.arch.email]"
                 type="email"
                 required="required"
      ></bbn-input>
      <label><?=_('Téléphone')?></label>
      <bbn-input v-model="source.row[cp.source.arch.tel]"
                 maxlength="10"
      ></bbn-input>
      <label><?=_('Thème')?></label>
      <bbn-dropdown :source="cp.themes"
                    v-model="source.row[cp.source.arch.theme]"
                    required="required"
      ></bbn-dropdown>
      <label v-if="cp.user.isAdmin"><?=_('Développeur')?></label>
      <bbn-checkbox v-if="cp.user.isAdmin"
                    :novalue="0"
                    :value="1"
                    v-model="source.row[cp.source.arch.dev]"
      ></bbn-checkbox>
      <label v-if="cp.user.isAdmin"><?=_('Administrateur')?></label>
      <bbn-checkbox v-if="cp.user.isAdmin"
                    :novalue="0"
                    :value="1"
                    v-model="source.row[cp.source.arch.admin]"
                    :disabled="adminDisabled"
      ></bbn-checkbox>
    </div>
  </bbn-form>
</script>