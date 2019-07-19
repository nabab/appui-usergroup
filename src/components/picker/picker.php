<bbn-tree :source="source"
          uid="id"
          :checkable="!!multi"
          class="bbn-overlay"
          @check="checkItem"
          @uncheck="uncheckItem"
          @select="selectItem"
          ref="tree"
></bbn-tree>
