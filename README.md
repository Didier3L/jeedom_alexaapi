# jeedom_alexaapi

Pour installer manuellement ce plugin, en ligne de commande :

cd /var/www/html/plugins

git clone https://github.com/sigalou/jeedom_alexaapi

mv jeedom_alexaapi alexaapi

chown -R www-data:www-data alexaapi

Puis allez dans Jeedom / Plugins / Gestion des plugins

Allez sur Alexa-API

Activer le.


Installer les d�pendances

Allez sur Lancer la g�n�ration pour g�n�rer le Cookie Amazon, il suffit de suivre les �tapes.

Pour l'instant, le d�veloppement est arriv� � ce point.
A ce stade, une fois le Cookie g�n�r�, et le d�mon lanc�, vous pouvez tester dans votre navigateur avec une commande du genre :

http://VOTREIP:3456/speak?device=VOTREDEVICE&text=coucou 
