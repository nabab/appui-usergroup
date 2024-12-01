<div class="bbn-overlay appui-usergroup-permissions bbn-flex-height bbn-padding">
  <div v-if="!source.mode"
       class="bbn-vmiddle bbn-bottom-space bbn-flex-width">
    <bbn-dropdown :source="source.sources"
                  source-text="text"
                  :source-value="mode === 'access' ? 'rootAccess' : 'rootOptions'"
                  v-model="currentSource"
                  class="bbn-flex-fill bbn-right-space"/>
    <bbn-dropdown :source="modes"
                  class="bbn-narrow"
                  v-model="mode"/>
  </div>
  <div class="bbn-flex-fill">
    <bbn-tree :source="opt_root + '/permissions/tree'"
              uid="id"
              :data="{mode: mode}"
              :root="currentSource"
              :map="treeMapper"
              ref="permsList"
              class="appui-usergroup-permissions-list"
              :selection="true"
              @check="setPerm"
              @uncheck="unsetPerm"
              @beforeload="getPerms"/>
  </div>
</div>
