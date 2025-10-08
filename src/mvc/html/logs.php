<!-- HTML Document -->

<bbn-table :source="root + 'logs'"
           :pageable="true"
           :filterable="true"
           :sortable="true"
           :order="[{field: 'time', dir: 'DESC'}]">
  <bbns-column field="id_user"
               label="<?= _("User") ?>"
               :source="appui.users"/>
  <bbns-column field="time"
               label="<?= _("Time") ?>"
               type="datetime"/>
  <bbns-column field="path"
               label="<?= _("Path") ?>"/>
  <bbns-column field="params"
               label="<?= _("Parameters") ?>"/>
  <bbns-column field="post"
               label="<?= _("Posted variables") ?>"
               :render="renderPost"/>
  <bbns-column field="referer"
               label="<?= _("Referer") ?>"/>
  <bbns-column field="error"
               label="<?= _("Error") ?>"/>
</bbn-table>
