<div class="bbn-w-100 bbn-hpadded bbn-top-padded">
  <div class="bbn-rel bbn-w-100">
    <div class="bbn-w-100 bbn-header bbn-b bbn-spadded bbn-no-border-bottom"><?=_('OPENED')?></div>
    <bbn-table class="bbn-w-100"
                :source="source.opened"
                :scrollable="false"
    >
      <bbns-column title="<?=_('Created')?>"
                    field="creation"
                    type="datetime"
                    cls="bbn-c"
      ></bbns-column>
      <bbns-column title="<?=_('Last activity')?>"
                    field="last_activity"
                    type="datetime"
                    cls="bbn-c"
      ></bbns-column>
    </bbn-table>
    <div class="bbn-top-space bbn-w-100 bbn-header bbn-b bbn-spadded bbn-no-border-bottom"><?=_('CLOSED')?></div>
    <bbn-table class="bbn-w-100"
                :source="source.closed"
                :scrollable="false"
    >
      <bbns-column title="<?=_('Created')?>"
                    field="creation"
                    type="datetime"
                    cls="bbn-c"
      ></bbns-column>
      <bbns-column title="<?=_('Last activity')?>"
                    field="last_activity"
                    type="datetime"
                    cls="bbn-c"
      ></bbns-column>
    </bbn-table>
  </div>
</div>