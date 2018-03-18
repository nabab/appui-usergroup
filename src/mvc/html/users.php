<bbn-table class="appui-usergroup-users-grid"
           :source="source.users"
           :data="{
             root: source.root,
             arch: source.arch,
             groups: source.groups,
             is_dev: source.is_dev,
             is_admin: source.is_admin
           }"
           :info="true"
           ref="table"
           :pageable="true"
           :sortable="true"
           :filterable="true"
           :editable="true"
           :editor="$options.components['appui-usergroup-user-edit-form']"
           :toolbar="[{
             text: '<?=_('Nouveau user')?>',
             icon: 'fa fa-user-plus',
             command: insert,
             disabled: !!(source.is_dev && !source.is_admin)
           }]"
           :filter="[{
             field: source.arch.active,
             operator: 'eq',
             value: 1
           }]"
           :tr-class="trClass"
>
  <bbn-column title="<?=_("ID")?>"
              :field="source.arch.id"
              :hidden="true"
              :editable="false"
              :width="40"
              :filterable="false"
  ></bbn-column>
  <bbn-column title="<i class='fa fa-user bbn-large'></i>"
              ftitle="<?=_("Nom")?>"
              :field="source.arch.username"
              :width="250"
  ></bbn-column>
  <bbn-column title="<i class='fa fa-cogs bbn-large'></i>"
              ftitle="<?=_("Fonction")?>"
              :field="source.arch.fonction"
              :render="renderFonction"
  ></bbn-column>
  <bbn-column title="<i class='fa fa-group bbn-large'></i>"
              ftitle="<?=_("Groupe")?>"
              :field="source.arch.id_group"
              :source="source.groups"
  ></bbn-column>
  <bbn-column title="<i class='fa fa-at bbn-large'></i>"
              ftitle="<?=_("eMail")?>"
              :field="source.arch.email"
              type="email"
  ></bbn-column>
  <bbn-column title="<?=_("Dev")?>"
              :field="source.arch.dev"
              :hidden="true"
              type="boolean"
  ></bbn-column>
  <bbn-column title="<i class='fa fa-calendar bbn-xl'></i>"
              ftitle="<?=_("Dernière activité de l'utilisateur")?>"
              field="last_activity"
              :editable="false"
              :filterable="false"
              :width="120"
              type="date"
  ></bbn-column>
  <bbn-column title="<i class='fa fa-phone bbn-large'></i>"
              ftitle="<?=_("Téléphone")?>"
              :field="source.arch.tel"
              :width="100"
              :render="renderTel"
  ></bbn-column>
  <bbn-column title="<i class='fa fa-desktop bbn-large'></i>"
              ftitle="<?=_("Thème")?>"
              :field="source.arch.theme"
              :width="80"
              :source="$root.themes"
  ></bbn-column>
  <bbn-column title="<?=_("Actif")?>"
              :field="source.arch.active"
              type="boolean"
              :editable="false"
              :hidden="true"
              :showable="false"
              :filterable="false"
              :width="80"
  ></bbn-column>
  <bbn-column ftitle="<?=_("Actions")?>"
              :editable="false"
              :sortable="false"
              :width="140"
              :buttons="getButtons"
              cls="bbn-c"
  ></bbn-column>
</bbn-table>

<script type="text/x-template" id="appui-usergroup-user-edit-form">
  <bbn-form class="bbn-full-screen"
            :action="source.data.root + 'actions/users/' + (source.row[source.data.arch.id] ? 'update' : 'insert')"
            :source="source.row"
            @success="success"
            ref="form"
  >
    <div class="bbn-padded bbn-grid-fields">
      <div><?=_('Nom')?></div>
      <bbn-input v-model="source.row[source.data.arch.username]"
                 required="required"
      ></bbn-input>
      <div><?=_('Fonction')?></div>
      <bbn-input v-model="source.row[source.data.arch.fonction]"></bbn-input>
      <div><?=_('Groupe')?></div>
      <div>
        <bbn-dropdown :source="source.data.groups"
                      v-model="source.row[source.data.arch.id_group]"
                      class="bbn-w-50"
        ></bbn-dropdown>
      </div>
      <div><?=_('eMail')?></div>
      <bbn-input v-model="source.row[source.data.arch.email]"
                 type="email"
                 required="required"
      ></bbn-input>
      <div><?=_('Téléphone')?></div>
      <bbn-input v-model="source.row[source.data.arch.tel]"
                 maxlength="10"
      ></bbn-input>
      <div><?=_('Thème')?></div>
      <div>
        <bbn-dropdown :source="themes"
                      v-model="source.row[source.data.arch.theme]"
                      required="required"
                      class="bbn-w-50"
        ></bbn-dropdown>
      </div>
      <div v-if="source.data.is_admin"><?=_('Développeur')?></div>
      <bbn-checkbox v-if="source.data.is_admin"
                    :novalue="0"
                    :value="1"
                    v-model="source.row[source.data.arch.dev]"
      ></bbn-checkbox>
      <div v-if="source.data.is_admin"><?=_('Administrateur')?></div>
      <bbn-checkbox v-if="source.data.is_admin"
                    :novalue="0"
                    :value="1"
                    v-model="source.row[source.data.arch.admin]"
                    :disabled="adminDisabled"
      ></bbn-checkbox>
    </div>
  </bbn-form>
</script>