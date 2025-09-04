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
             label: '<?= _('New group') ?>',
             icon: 'nf nf-fa-plus',
             action: 'insert',
             disabled: !source.permissions.insert
           }]"
           :tr-class="trClass"
           :url="source.root + 'actions/groups'"
           :order="[{field: source.arch.groups.group, dir: 'ASC'}]">
  <bbns-column label="<?= _('ID') ?>"
               :field="source.arch.groups.id"
               :invisible="true"
               :editable="false"/>
  <bbns-column bbn-if="hasMenu"
               field="default_menu"
               :invisible="true"/>
  <bbns-column bbn-if="hasDashboard"
               field="default_dashboard"
               :invisible="true"/>
  <bbns-column label="<?= _('Name') ?>"
               :field="source.arch.groups.group"
               :required="true"/>
  <bbns-column label="<?= _('Unique code') ?>"
               :width="150"
               max-width="40%"
               :field="source.arch.groups.code"
               :required="true"/>
  <bbns-column label="#"
               flabel="<?= _('Users') ?>"
               field="num"
               :width="50"
               :editable="false"
               cls="bbn-c"/>
  <bbns-column field="source_id"
               :editable="false"
               :invisible="true"/>
  <bbns-column :sortable="false"
               :buttons="getButtons"
               :width="130"
               cls="bbn-c"/>
</bbn-table>