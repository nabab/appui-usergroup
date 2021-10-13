<!-- HTML Document -->
<bbn-router class="bbn-overlay bbn-user-profile"
            :autoload="false"
            :nav="true"
>
  <bbns-container url="profile"
           title="<?=_("Informations")?>"
           :static="true"
           :load="true"/>
  <bbns-container url="password"
           title="<?=_("Password")?>"
           :static="true"
           :load="true"/>
  <bbns-container v-if="hasNotifications"
                  url="notifications"
                  title="<?=_("Notifications")?>"
                  :static="true"
                  :load="true"
                  component="appui-notification-settings"/>
</bbn-router>