<!-- HTML Document -->
<bbn-tabnav class="bbn-user-profile" :autoload="false">
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
</bbn-tabnav>