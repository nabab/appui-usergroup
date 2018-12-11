<!-- HTML Document -->
<bbn-tabnav class="bbn-user-profile" :autoload="false">
  <bbns-tab url="profile"
           title="<?=_("Informations")?>"
           :static="true"
           :load="true"
  ></bbns-tab>
  <bbns-tab url="password"
           title="<?=_("Password")?>"
           :static="true"
           :load="true"
  ></bbns-tab>
</bbn-tabnav>