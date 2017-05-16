// Javascript document
/** @var window.appui */

var cont = $(".bbn-user-profile", ele).tabNav({
      autoload: false,
      baseURL: data.root + "profile/",
      list: [{
        url: "infos",
        title: "Informations",
        content: $("#bbn-tpl-user-info", ele).html(),
        static: 1
      }, {
        url: "password",
        title: "Mot de passe",
        content: $("#bbn-tpl-user-pass", ele).html(),
        static: 1
      }]
    });

kendo.bind(ele, {
  email: data.email,
  fonction: data.fonction,
  theme: data.theme,
  tel: data.tel,
  nom: data.nom,
  themes: [
    {
      "value": "uniform",
      "text": "Uniform"
    }, {
      "value": "black",
      "text": "Black"
    }, {
      "value": "blueopal",
      "text": "Blue Opal"
    }, {
      "value": "bootstrap",
      "text": "Bootstrap"
    }, {
      "value": "default",
      "text": "Default"
    }, {
      "value": "fiori",
      "text": "Fiori"
    }, {
      "value": "flat",
      "text": "Flat"
    }, {
      "value": "highcontrast",
      "text": "High Contrast"
    }, {
      "value": "material",
      "text": "Material"
    }, {
      "value": "materialblack",
      "text": "Material Black"
    }, {
      "value": "metro",
      "text": "Metro"
    }, {
      "value": "metroblack",
      "text": "Metro Black"
    }, {
      "value": "moonlight",
      "text": "Moonlight"
    }, {
      "value": "nova",
      "text": "Nova"
    }, {
      "value": "office365",
      "text": "Office 365"
    }, {
      "value": "silver",
      "text": "Silver"
    }
  ]
})