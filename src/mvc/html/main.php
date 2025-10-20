<!-- HTML Document -->
<bbn-router class="bbn-overlay bbn-user-profile"
            :autoload="false"
            mode="tabs">
  <bbns-container url="profile"
           label="<?= _("Informations") ?>"
           :fixed="true"
           :load="true"/>
  <bbns-container url="password"
           label="<?= _("Password") ?>"
           :fixed="true"
           :load="true"/>
  <bbns-container v-if="hasNotifications"
                  url="notifications"
                  label="<?= _("Notifications") ?>"
                  :fixed="true"
                  :load="true"
                  component="appui-notification-settings"/>
</bbn-router>