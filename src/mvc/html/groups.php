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
             icon: 'nf nf-fa-plus',
             action: 'insert',
             disabled: !!(source.is_dev && !source.is_admin)
           }]"
           :tr-class="trClass"
           :url="source.root + 'actions/groups'"
           :order="[{field: 'group', Dir: 'ASC'}]"
>
  <bbns-column title="<?=_('ID')?>"
               field="id"
               :hidden="true"
               :editable="false"
  ></bbns-column>
  <bbns-column title="<i class='nf nf-fa-users bbn-large'></i> <?=_('Name')?>"
               field="group"
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