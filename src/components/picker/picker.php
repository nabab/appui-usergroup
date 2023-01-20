<div :class="['appui-usergroup-picker', 'bbn-w-100', {'bbn-flex-height': scrollable}]">
  <div v-if="selectedPanel"
       class="bbn-hspadded bbn-top-spadded bbn-alt-background bbn-radius bbn-bottom-sspace">
    <div class="bbn-radius bbn-background bbn-s bbn-upper bbn-c bbn-secondary-text-alt bbn-b bbn-bottom-sspace"
         v-text="_('Current selected')"/>
    <div class="bbn-radius bbn-flex"
         style="flex-wrap: wrap !important">
      <span v-for="(v, i) in value"
            :class="['bbn-vmiddle', 'bbn-right-spadded', 'bbn-radius', 'bbn-background', 'bbn-bottom-sspace', {'bbn-right-space': !!value[i+1]}]">
        <bbn-initial :user-name="getUserName(v)"
                      width="1.2rem"
                      height="1.2rem"
                      font-size="0.7rem"
                      style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important"/>
        <span class="bbn-left-xsspace bbn-s bbn-unselectable"
              v-text="getUserName(v)"
              :title="getUserName(v)"/>
        <span class="bbn-left-xsspace bbn-unselectable">
          <i class="nf nf-fa-close bbn-p bbn-red"
             @click="del(v)"/>
        </span>
      </span>
    </div>
  </div>
  <div v-if="filterable"
       class="bbn-bottom-sspace">
    <bbn-input v-model="currentSearch"
               :button-right="currentSearch.length ? 'nf nf-fa-close' : 'nf nf-fa-search'"
               :action-right="clearSearch"
               :placeholder="_('Search')"
               class="bbn-w-100"/>
  </div>
  <div :class="{'bbn-flex-fill': scrollable}">
    <bbn-tree :source="source"
              uid="id"
              :selection="!!multi"
              @check="checkItem"
              @ready="setChecked"
              @uncheck="uncheckItem"
              @select="selectItem"
              @unselect="unselectItem"
              :scrollable="scrollable"
              ref="tree"
              :excludedSectionFilter="true"
              :quickFilter="currentSearch"/>
  </div>
</div>