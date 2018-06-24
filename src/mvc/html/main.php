<!-- HTML Document -->
<bbn-tabnav class="bbn-user-profile" :autoload="false">
  <bbns-tab url="profile"
           title="<?=_("Informations")?>"
           :static="true"
           :load="true"
  ></bbns-tab>
  <bbns-tab url="password"
           title="<?=_("Mot de passe")?>"
           :static="true"
           :load="true"
  ></bbns-tab>
</bbn-tabnav>