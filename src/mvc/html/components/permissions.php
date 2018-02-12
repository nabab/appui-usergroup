<div class="bbn-full-screen appui-usergroup-permissions">
  <bbn-tree :source="source.opt_url + '/permissions'"
            uid="id"
            :root="source.perm_root"
            :map="treeMapper"
            @select="permissionSelect"
            ref="permsList"
            class="appui-usergroup-permissions-list"
            :checkable="true"
  ></bbn-tree>
</div>
