<div class="bbn-overlay appui-usergroup-permissions bbn-padded">
  <bbn-tree :source="opt_root + '/permissions'"
            uid="id"
            :root="source.perm_root"
            :map="treeMapper"
            ref="permsList"
            class="appui-usergroup-permissions-list"
            :selection="true"
            @check="setPerm"
            @uncheck="unsetPerm"
            @beforeLoad="getPerms"
  ></bbn-tree>
</div>
