<bbn-context tag="div"
             class="bbn-block"
             v-if="source.id"
             :source="userMenu">
  <bbn-initial font-size="2rem" :user-name="source.name"/>
  <div style="position: absolute; bottom: -0.4rem; right: -0.4rem; border: #CCC 1px solid; width: 1.1rem; height: 1.1rem"
       class="bbn-bg-white bbn-black bbn-middle">
    <i class="nf nf-fa-bars bbn-xs"/>
  </div>
</bbn-context>
