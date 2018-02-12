<div class="bbn-full-screen appui-usergroup-permissions bbn-padded">
  <bbn-tree :source="source.opt_url + '/permissions'"
            uid="id"
            :root="source.perm_root"
            :map="treeMapper"
            ref="permsList"
            class="appui-usergroup-permissions-list"
            :checkable="true"
            @check="setPerm"
            @uncheck="unsetPerm"
            @beforeLoad="getPerms"
  ></bbn-tree>
</div>
