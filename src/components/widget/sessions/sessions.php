<div class="bbn-w-100 bbn-hpadding bbn-top-padding">
  <div class="bbn-rel bbn-w-100" v-if="source && source.opened">
    <div class="bbn-w-100 bbn-header bbn-b bbn-spadding bbn-no-border-bottom"><?= _('OPENED') ?></div>
    <bbn-table class="bbn-w-100"
                :source="source.opened"
                :scrollable="false"
    >
      <bbns-column label="<?= _('Created') ?>"
                    field="creation"
                    type="datetime"
                    cls="bbn-c"
      ></bbns-column>
      <bbns-column label="<?= _('Last activity') ?>"
                    field="last_activity"
                    type="datetime"
                    cls="bbn-c"
      ></bbns-column>
    </bbn-table>
    <div class="bbn-top-space bbn-w-100 bbn-header bbn-b bbn-spadding bbn-no-border-bottom"><?= _('CLOSED') ?></div>
    <bbn-table class="bbn-w-100"
                :source="source.closed"
                :scrollable="false"
    >
      <bbns-column label="<?= _('Created') ?>"
                    field="creation"
                    type="datetime"
                    cls="bbn-c"
      ></bbns-column>
      <bbns-column label="<?= _('Last activity') ?>"
                    field="last_activity"
                    type="datetime"
                    cls="bbn-c"
      ></bbns-column>
    </bbn-table>
  </div>
</div>