<bbn-tree :source="source"
          uid="id"
          :checkable="!!multi"
          @check="checkItem"
          @uncheck="uncheckItem"
          @select="selectItem"
          ref="tree"
></bbn-tree>