<!-- HTML Document -->
<bbn-tabnav class="bbn-user-profile" :autoload="false">
  <bbn-tab url="profile"
           title="<?=_("Informations")?>"
           :static="true"
           :load="true"
  ></bbn-tab>
  <bbn-tab url="password"
           title="<?=_("Mot de passe")?>"
           :static="true"
           :load="true"
  ></bbn-tab>
</bbn-tabnav>