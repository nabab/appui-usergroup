<bbn-table class="appui-usergroup-groups-grid"
           :source="source.groups"
           ref="table"
           :info="true"
           :pageable="true"
           :sortable="true"
           :editable="hasDashboard || hasMenu ? 'popup' : true"
           :editor="hasDashboard || hasMenu ? $options.components.form : false"
           :showable="true"
           :toolbar="[{
             text: '<?= _('New group') ?>',
             icon: 'nf nf-fa-plus',
             action: 'insert',
             disabled: !source.permissions.insert
           }]"
           :tr-class="trClass"
           :url="source.root + 'actions/groups'"
           :order="[{field: source.arch.groups.group, dir: 'ASC'}]"
>
  <bbns-column label="<?= _('ID') ?>"
               :field="source.arch.groups.id"
               :hidden="true"
               :editable="false"
  ></bbns-column>
  <bbns-column field="default_menu"
               v-if="hasMenu"
               :hidden="true"
  ></bbns-column>
  <bbns-column field="default_dashboard"
               v-if="hasDashboard"
               :hidden="true"
  ></bbns-column>
  <bbns-column label="<i class='nf nf-fa-users bbn-large'></i> <?= _('Name') ?>"
               :field="source.arch.groups.group"
               :required="true"
  ></bbns-column>
  <bbns-column label="<?= _('Unique code') ?>"
               :width="150"
               max-width="40%"
               :field="source.arch.groups.code"
               :required="true"
  ></bbns-column>
  <bbns-column label="#"
               flabel="<?= _('Users') ?>"
               field="num"
               :width="50"
               :editable="false"
               cls="bbn-c"
  ></bbns-column>
  <bbns-column field="source_id"
               :editable="false"
               :hidden="true"
  ></bbns-column>
  <bbns-column :sortable="false"
               :buttons="getButtons"
               :width="170"
               cls="bbn-c"
  ></bbns-column>
</bbn-table>