<div class="bbn-block bbn-p bbn-right-margin">
  <bbn-context tag="div"
              class="bbn-block"
              v-if="source.id"
              :source="userMenu">
    <bbn-initial :font-size="isMobile ? '1.5rem' : '2rem'"
                :user-name="source.name"
                :default-size="isMobile ? 24 : 36"/>
    <div :style="{
      position: 'absolute',
      bottom: '-0.4rem',
      right: '-0.4rem',
      border: '#CCC 1px solid',
      width: isMobile ? '0.8rem' : '1.1rem',
      height: isMobile ? '0.8rem' : '1.1rem'
    }"
        class="bbn-bg-white bbn-black bbn-middle">
      <i class="nf nf-fa-bars bbn-xs"/>
    </div>
  </bbn-context>
</div>
