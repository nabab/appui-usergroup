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
</bbn-router>