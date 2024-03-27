<!-- HTML Document -->
<bbn-router class="bbn-overlay bbn-user-profile"
            :autoload="false"
            :nav="true">
  <bbns-container url="profile"
           title="<?= _("Informations") ?>"
           :fixed="true"
           :load="true"/>
  <bbns-container url="password"
           title="<?= _("Password") ?>"
           :fixed="true"
           :load="true"/>
  <bbns-container v-if="hasNotifications"
                  url="notifications"
                  title="<?= _("Notifications") ?>"
                  :fixed="true"
                  :load="true"
                  component="appui-notification-settings"/>
</bbn-router>