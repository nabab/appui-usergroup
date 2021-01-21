<!-- HTML Document -->
<bbn-router class="bbn-user-profile"
            :autoload="false"
            :nav="true"
>
  <bbns-container url="profile"
           title="<?=_("Informations")?>"
           :static="true"
           :load="true"
  ></bbns-container>
  <bbns-container url="password"
           title="<?=_("Password")?>"
           :static="true"
           :load="true"
  ></bbns-container>
  <bbns-container v-if="hasNotifications"
                  url="notifications"
                  title="<?=_("Notifications")?>"
                  :static="true"
                  :load="true"
                  component="appui-notification-settings"
  ></bbns-container>
</bbn-router>