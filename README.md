wasserzeichen
=============

Wasserzeichen Modul für Oxid

1. Dateien kopieren
2. Wasserzeichen unter /out/pictures/watermark/wz.png ablegen
3. ggf. in der Datei /core/utils/watermark.php Zeile 19
" if ( substr_count($sTarget, "600_600_75") > 0 || substr_count($sTarget, "250_200_75") > 0)"
den Fett markierten Bereich an die Ordner aus "/out/pictures/generated/product/1/" anpassen bzw. erweitern für die Bilder, die ein Wasserzeichen haben sollen.
4. den Inhalt vom generated Ornder löschen
5. /out/pictures/watermark/ muss kompletten Schreib- und Lesezugriff haben (777) da hier die Originalbilder mit Wasserzeichen abgelegt werden, bevor sie Größe angepasst wird.

Fertig.
