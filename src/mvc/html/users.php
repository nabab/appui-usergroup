
<bbn-table class="bbn-users-grid"
           ref="table"
           :source="source.users"
           :info="true"
           :pageable="true"
           :sortable="true"
           :filterable="true"
           :multifilter="true"
           :editable="true"
           :toolbar="[{
                     text: 'Nouveau user',
                     icon: 'fa fa-plus',
                     notext: false,
                     command: insert
                     }]"
           :editor="$options.components['edit-user-form']"
           :filter="[{ field: source.arch.active, operator: 'eq', value:1 }]"
>
  <bbn-column title="<?=_("ID")?>"
              field="source.arch.id"
              :hidden="true"
              :width="40"
  ></bbn-column>
  <bbn-column title="<?=_("Nom")?>"
              :field="source.arch.username"
              :width="250"
  ></bbn-column>
  <bbn-column title="<?=_("Fonctions")?>"
              :field="source.arch.fonctions"
              :width="250"
              :render="fonction_render"
  ></bbn-column>
  <bbn-column title="<?=_("Groupe")?>"
              :field="source.arch.id_group"
              :width="250"
              :source="source.groups"
  ></bbn-column>
  <bbn-column title="<?=_("eMail")?>"
              :field="source.arch.email"
              :width="200"
              :render="email_render"
  ></bbn-column>
  <bbn-column title="<i class='fa fa-calendar bbn-xl'></i>"
              ftitle="<?=_("Last activity from the user")?>"
              field="last_activity"
              :width="80"
              :render="date_render"
  ></bbn-column>
  <bbn-column title="<?=_("Tel")?>"
              :field="source.arch.tel"
              :width="100"
              :render="tel_render"
  ></bbn-column>
  <bbn-column title="<?=_("Theme")?>"
              :field="source.arch.theme"
              :width="80"
  ></bbn-column>
  <bbn-column title="<?=_("Actif")?>"
              :field="source.arch.active"
              type="boolean"
              :width="80"
  ></bbn-column>
  <bbn-column title="<?=_("Actions")?>"
              :width="120"
              :buttons="[{text: 'Edit', notext: true, command: edit , icon: 'fa fa-edit'},{text: 'Remove', notext: true, command: remove, icon: 'fa fa-close'}]"
  ></bbn-column>

</bbn-table>

<script type="text/x-template" id="edit-user-form">
  <bbn-form class="bbn-full-screen"
            :source="source.row"
            ref="form"
            confirm-leave="<?=_("Êtes-vous sûr de vouloir quitter ce formulaire sans enregistrer vos modifications?")?>"
            action="usergroup/actions/users"
            :buttons="['submit', 'cancel']"
            @success="success"
            @failure="failure"
  >
    <div class="bbn-lpadded bbn-grid-fields">
      <label><?=_("Nom")?></label>
      <bbn-input v-model="source.row.nom"></bbn-input>

      <label><?=_("Groupe")?></label>
      <bbn-dropdown v-model="source.row.id_group"
                    :source="group"></bbn-dropdown>

      <label><?=_("Email")?></label>
      <bbn-input v-model="source.row.email"></bbn-input>

      <label><?=_("Téléphone")?></label>
      <bbn-input v-model="source.row.tel"></bbn-input>


    </div>
  </bbn-form>

</script>