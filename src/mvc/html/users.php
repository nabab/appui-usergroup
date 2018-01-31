<bbn-table class="bbn-users-grid"
           :source="source.users"
           :info="true"
           :url="source.root + '/users'"
           :pageable="true"
           :sortable="true"
           :filterable="true"
           :multifilter="true"
           editable="popup"
           :toolbar="[{
                     text: 'Nouveau user',
                     icon: 'fa fa-plus',
                     notext: false,
                     command: insert
                     }]"
           :filter="[{ field: source.arch.active, operator: 'eq', value:1 }]"
           :tr-class="trClass"
           >
  <bbn-column title="<?=_("ID")?>"
              :field="source.arch.id"
              :hidden="true"
              :editable="false"
              :width="40"
              ></bbn-column>
  <bbn-column title="<?=_("Nom")?>"
              :field="source.arch.username"
              :width="250"
              ></bbn-column>
  <bbn-column title="<?=_("Fonctions")?>"
              :field="source.arch.fonctions"
              :render="fonction_render"
              ></bbn-column>
  <bbn-column title="<?=_("Groupe")?>"
              :field="source.arch.id_group"
              :source="source.groups"
              ></bbn-column>
  <bbn-column title="<?=_("eMail")?>"
              :field="source.arch.email"
              type="email"
              ></bbn-column>
  <bbn-column title="<?=_("Admin")?>"
              :field="source.arch.admin"
              :hidden="true"
              type="boolean"
              ></bbn-column>
  <bbn-column title="<i class='fa fa-calendar bbn-xl'></i>"
              ftitle="<?=_("Last activity from the user")?>"
              field="last_activity"
              :editable="false"
              :width="120"
              type="date"
              ></bbn-column>
  <bbn-column title="<?=_("Tel")?>"
              :field="source.arch.tel"
              :width="100"
              :render="tel_render"
              ></bbn-column>
  <bbn-column title="<?=_("Theme")?>"
              :field="source.arch.theme"
              :width="80"
              :source="$root.themes"
              ></bbn-column>
  <bbn-column title="<?=_("Actif")?>"
              :field="source.arch.active"
              type="boolean"
              :editable="false"
              :hidden="true"
              :width="80"
              ></bbn-column>
  <bbn-column title="<?=_("Actions")?>"
              :width="80"
              :buttons="[{text: 'Edit', notext: true, command: edit , icon: 'fa fa-edit'},{text: 'Remove', notext: true, command: remove, icon: 'fa fa-close'}]"
              ></bbn-column>

</bbn-table>