<?php
$cookie = $ctrl->getCookie();
$locale = $cookie['locale'] ?? BBN_LANG;
$ctrl->addData(['locale' => $locale])->combo(_("My profile"), true);
