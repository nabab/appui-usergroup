// Javascript document
/** @var window.appui */

$(".appui-user-profile", ele).tabNav({
  autoload: false,
  list: [{
    url: "infos",
    title: "Informations",
    content: $("#appui-tpl-user-info", ele).html(),
    static: 1
  }, {
    url: "password",
    title: "Mot de passe",
    content: $("#appui-tpl-user-pass", ele).html(),
    static: 1
  }]
})