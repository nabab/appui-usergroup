<!-- HTML Document -->

<div class="bbn-overlay bbn-flex-height">
  <div class="bbn-padding bbn-c">
    <h1>Permissions cleaning</h1>
    <div class="bbn-w-100">
      <bbn-button @click="launch"> <?= _("Launch cleaner") ?></bbn-button>
    </div>
  </div>
  <div class="bbn-w-100 bbn-flex-fill">
    <bbn-table bbn-if="results?.length"
               :source="results">
      <bbns-column field="publicPath"
                   :label="_('Public path')"/>
      <bbns-column field="numPermissions"
                   :label="_('#Perm')"
                   :width="60"
                   type="number"
                   :flabel="_('Number of active permissions')"/>
      <bbns-column field="numReferences"
                   :label="_('#Refs')"
                   :width="60"
                   type="number"
                   :flabel="_('Number of references in the project')"/>
      <bbns-column field="numPermissions"
                   :label="_('Exists')"
                   :width="60"
                   type="boolean"
                   :flabel="_('Whether or not a corresponding file exists')"/>
    </bbn-table>
  </div>
</div>

