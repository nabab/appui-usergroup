<div :class="['bbn-overlay', 'bbn-padding', {'bbn-middle bbn-flex-column': !currentData && !isLoading}]">
  <div class="bbn-middle bbn-grid-sgap bbn-hpadding bbn-bottom-space">
    <div>
      <span><?=_("From")?></span>
      <bbn-datepicker bbn-model="currentStart"/>
    </div>
    <div>
      <span><?=_("To")?></span>
      <bbn-datepicker bbn-model="currentEnd"/>
    </div>
    <bbn-button @click="loadData"
                icon="nf nf-fa-check"
                label="<?=_("Load")?>"/>
  </div>
  <div bbn-if="currentData || isLoading"
       class="bbn-flex-height">
    <bbn-loader bbn-if="isLoading"/>
    <bbn-scroll bbn-else
                axis="y">
      <div class="bbn-grid-fields bbn-top-space"
            style="row-gap: 3rem">
        <div style="text-align: center;">
          <div><i class="nf nf-md-desktop_classic bbn-xxxxl"/></div>
          <div class="bbn-b bbn-lg"
                bbn-text="desktopDevices?.total"/>
        </div>
        <div>
          <template bbn-if="desktopDevices?.total">
            <div class="bbn-flex-width">
              <div class="bbn-c bbn-b bbn-primary-text-alt"
                    style="min-width: 4rem">
                <div><?=_("Browser")?></div>
                <div bbn-text="desktopDevices?.browser?.length"/>
              </div>
              <div class="bbn-flex-fill bbn-flex-wrap bbn-grid-gap bbn-left-space">
                <div bbn-for="browser in desktopDevices?.browser">
                  <div><span bbn-text="browser.name" class="bbn-secondary-text-alt bbn-b"/>: <span bbn-text="browser.total"/></div>
                  <div bbn-for="version in browser.version">
                    <div class="bbn-light"><span bbn-text="version.name"/>: <span bbn-text="version.total"/></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bbn-flex-width bbn-top-space">
              <div class="bbn-c bbn-b bbn-primary-text-alt"
                    style="min-width: 4rem">
                <div><?=_("OS")?></div>
                <div bbn-text="desktopDevices?.os?.length"/>
              </div>
              <div class="bbn-flex-fill bbn-flex-wrap bbn-grid-gap bbn-left-space">
                <div bbn-for="os in desktopDevices?.os">
                  <div><span bbn-text="os.name" class="bbn-secondary-text-alt bbn-b"/>: <span bbn-text="os.total"/></div>
                  <div bbn-for="version in os.version">
                    <div class="bbn-light"><span bbn-text="version.name"/>: <span bbn-text="version.total"/></div>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>
        <div style="text-align: center;">
          <div><i class="nf nf-fa-mobile_phone bbn-xxxxl"/></div>
          <div class="bbn-b bbn-lg"
                bbn-text="mobileDevices?.total"/>
        </div>
        <div>
          <template bbn-if="mobileDevices?.total">
            <div class="bbn-flex-width">
              <div class="bbn-c bbn-b bbn-primary-text-alt"
                    style="min-width: 4rem">
                <div><?=_("Browser")?></div>
                <div bbn-text="mobileDevices?.browser?.length"/>
              </div>
              <div class="bbn-flex-fill bbn-flex-wrap bbn-grid-gap bbn-left-space">
                <div bbn-for="browser in mobileDevices?.browser">
                  <div><span bbn-text="browser.name" class="bbn-secondary-text-alt bbn-b"/>: <span bbn-text="browser.total"/></div>
                  <div bbn-for="version in browser.version">
                    <div class="bbn-light"><span bbn-text="version.name"/>: <span bbn-text="version.total"/></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bbn-flex-width bbn-top-space">
              <div class="bbn-c bbn-b bbn-primary-text-alt"
                    style="min-width: 4rem">
                <div><?=_("OS")?></div>
                <div bbn-text="mobileDevices?.os?.length"/>
              </div>
              <div class="bbn-flex-fill bbn-flex-wrap bbn-grid-gap bbn-left-space">
                <div bbn-for="os in mobileDevices?.os">
                  <div><span bbn-text="os.name" class="bbn-secondary-text-alt bbn-b"/>: <span bbn-text="os.total"/></div>
                  <div bbn-for="version in os.version">
                    <div class="bbn-light"><span bbn-text="version.name"/>: <span bbn-text="version.total"/></div>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>
        <div style="text-align: center;">
          <div><i class="nf nf-md-tablet_android bbn-xxxxl"/></div>
          <div class="bbn-b bbn-lg"
                bbn-text="tabletDevices?.total"/>
        </div>
        <div>
          <template bbn-if="tabletDevices?.total">
            <div class="bbn-flex-width">
              <div class="bbn-c bbn-b bbn-primary-text-alt"
                    style="min-width: 4rem">
                <div><?=_("Browser")?></div>
                <div bbn-text="tabletDevices?.browser?.length"/>
              </div>
              <div class="bbn-flex-fill bbn-flex-wrap bbn-grid-gap bbn-left-space">
                <div bbn-for="browser in tabletDevices?.browser">
                  <div><span bbn-text="browser.name" class="bbn-secondary-text-alt bbn-b"/>: <span bbn-text="browser.total"/></div>
                  <div bbn-for="version in browser.version">
                    <div class="bbn-light"><span bbn-text="version.name"/>: <span bbn-text="version.total"/></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bbn-flex-width bbn-top-space">
              <div class="bbn-c bbn-b bbn-primary-text-alt"
                    style="min-width: 4rem">
                <div><?=_("OS")?></div>
                <div bbn-text="tabletDevices?.os?.length"/>
              </div>
              <div class="bbn-flex-fill bbn-flex-wrap bbn-grid-gap bbn-left-space">
                <div bbn-for="os in tabletDevices?.os">
                  <div><span bbn-text="os.name" class="bbn-secondary-text-alt bbn-b"/>: <span bbn-text="os.total"/></div>
                  <div bbn-for="version in os.version">
                    <div class="bbn-light"><span bbn-text="version.name"/>: <span bbn-text="version.total"/></div>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>
      </div>
    </bbn-scroll>
  </div>
  <div bbn-else
       class="bbn-secondary-text-alt bbn-xl">
    <?=_("Select a date range")?>
  </div>
</div>