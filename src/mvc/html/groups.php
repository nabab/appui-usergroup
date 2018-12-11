<bbn-table class="appui-usergroup-groups-grid"
           :source="source.groups"
           ref="table"
           :info="true"
           :pageable="true"
           :sortable="true"
           :editable="true"
           :showable="true"
           :toolbar="[{
             text: '<?=_('New group')?>',
             icon: 'fas fa-plus',
             command: 'insert',
             disabled: !!(source.is_dev && !source.is_admin)
           }]"
           :tr-class="trClass"
           :url="source.root + 'actions/groups'"
           :order="[{field: source.arch.group, dir: 'ASC'}]"
>
  <bbns-column title="<?=_('ID')?>"
               :field="source.arch.id"
               :hidden="true"
               :editable="false"
  ></bbns-column>
  <bbns-column title="<i class='fas fa-users bbn-large'></i>"
               ftitle="<?=_('Name')?>"
               :field="source.arch.group"
               :required="true"
  ></bbns-column>
  <bbns-column title="#"
               ftitle="<?=_('Users')?>"
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