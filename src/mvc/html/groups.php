<bbn-table class="appui-usergroup-groups-grid"
           :source="source.groups"
           ref="table"
           :info="true"
           :pageable="true"
           :sortable="true"
           :editable="true"
           :toolbar="[{
             text: '<?=_('Nouveau groupe')?>',
             icon: 'fa fa-plus',
             command: 'insert',
             disabled: !!(source.is_dev && !source.is_admin)
           }]"
           :tr-class="trClass"
           @saveItem="save"
           :order="[{field: source.arch.group, dir: 'ASC'}]"
>
  <bbn-column title="<?=_('ID')?>"
              :field="source.arch.id"
              :hidden="true"
              :editable="false"
  ></bbn-column>
  <bbn-column title="<i class='fa fa-group bbn-large'></i>"
              ftitle="<?=_('Nom')?>"
              :field="source.arch.group"
              :required="true"
  ></bbn-column>
  <bbn-column title="#"
              ftitle="<?=_('Utilisateurs')?>"
              field="num"
              :width="50"
              :editable="false"
              cls="bbn-c"
  ></bbn-column>
  <bbn-column field="source_id"
              :editable="false"
              :hidden="true"
  ></bbn-column>
  <bbn-column :editable="false"
              :sortable="false"
              :buttons="getButtons"
              :width="170"
              cls="bbn-c"
  ></bbn-column>
</bbn-table>