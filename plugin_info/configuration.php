<?php
if (!isConnect())
{
  include_file('desktop', '404', 'php');
  die();
}
/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

//print $_GET['plugin'];
//print $_GET['configure'];
require_once dirname(__FILE__) . '/../../../core/php/core.inc.php';

include_file('core', 'authentification', 'php');
include_file('desktop', 'alexaapi', 'js', 'alexaapi');


?>

<legend><i class="icon divers-triangular42"></i> {{Génération manuelle du cookie Amazon}}</legend>

		<?php
//On va tester si les d�pendances sont install�es
		if (!(is_dir(realpath(dirname(__FILE__) . '/../resources/node_modules'))))
		{
		print "<B>Dépendances non présentes, génération manuelle du cookie Amazon impossible !!</B>";	
		print "<br><small>Le dossier <I>".dirname(__FILE__) . "/../resources/node_modules</I> est introuvable</small>";	
		}
else
		{
		?>
				<center><a class="btn btn-success btn-sm bt_startDeamonCookie" href="http://<?php print config::byKey('internalAddr')?>:3457" onclick="open('http://<?php print config::byKey('internalAddr')?>:3457', 'Popup', 'scrollbars=1,resizable=1,height=560,width=770'); return false;" >Identifiez-vous sur Amazon pour créer le cookie d'identification</a>
				<a class="btn btn-success btn-sm bt_identificationCookie"><i class="fa fa-clock-o"></i> Patientez quelques secondes que le cookie se charge. Dès que "<B>Configuration</B>" du Démon devient <B>OK</B> (<I>c'est que le cookie est présent</I>), Lancez le Démon avec le bouton <B>(Re)Démarrer</B></a><br><small>(Si vous obtenez le message <B>La connexion a échoué</B>, cliquez sur <B>Réessayer</B> dans la fenetre Popup.</small></center>

		<?php
		}
?>
<script>
  var timeout_refreshDeamonCookieInfo = null;
  $('.bt_stopDeamonCookie').hide();
  $('.bt_identificationCookie').hide();
  $('.bt_identificationCookie2').hide();

  // On appuie sur Le lancement du serveur... on lance "deamonCookieStart" via action=deamonCookieStart dans alexaapi.ajax.php
  $('.bt_startDeamonCookie').on('click',function()
  {
    clearTimeout(timeout_refreshDeamonInfo);
    jeedom.plugin.deamonCookieStart(
    {
      id : plugin_id,
      forceRestart: 1,
      error: function (error)
      {
        $('#div_alert').showAlert({message: error.message, level: 'danger'});
        refreshDeamonInfo();
        timeout_refreshDeamonInfo = setTimeout(refreshDeamonInfo, 5000);
      },
      success:function(){
        refreshDeamonInfo();
        //$('.deamonCookieState').empty().append('<span class="label label-success" style="font-size:1em;">{{OK}}</span>');
        $('.bt_startDeamonCookie').hide();
        //$('.bt_stopDeamonCookie').show();
        $('.bt_identificationCookie').show();
        //$('.bt_identificationCookie2').show();
        timeout_refreshDeamonInfo = setTimeout(refreshDeamonInfo, 5000);
      }
    });
  });

  $('.bt_stopDeamonCookie').on('click',function()
  {
    clearTimeout(timeout_refreshDeamonInfo);
    jeedom.plugin.deamonCookieStop(
    {
      id : plugin_id,
      error: function (error)
      {
        $('#div_alert').showAlert({message: error.message, level: 'danger'});
        refreshDeamonInfo();
        timeout_refreshDeamonCookieInfo = setTimeout(refreshDeamonInfo, 5000);
      },
      success:function()
      {
        refreshDeamonInfo();
        $('.deamonCookieState').empty().append('<span class="label label-danger" style="font-size:1em;">{{NOK}}</span>');
        $('.bt_startDeamonCookie').show();
        $('.bt_stopDeamonCookie').hide();
        $('.bt_identificationCookie').hide();
        timeout_refreshDeamonInfo = setTimeout(refreshDeamonInfo, 5000);
      }
    });
  });

  $('.bt_identificationCookie').on('click',function()
  {
  });

</script>