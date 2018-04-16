<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors','On');

include "engine/conf.php";
include "engine/util.php";	

define("EMAIL_ENABLED", "1");

sendMail("ooleg@inbox.lv","","Enduro mail testing","Sagatavojieties IELTS eksāmeniem ar mācību materiāliem, kurus radījuši pasaulē vadošie angļu valodas speciālisti. Materiālu izvēle ir ļoti plaša.

 
ROAD TO IELTS TIEŠSAISTĒ
‘Road to IELTS’ iekļauti klausīšanās, lasīšanas un rakstīšanas uzdevumi un testi, kas radīti, lai attīstītu jūsu valodas prasmes. Reģistrējoties eksāmenam, jūs saņemsiet pieejas kodus un varēsiet izmantot tiešsaistes pakalpojumus bez maksas. Šis piedāvājums ir pieejams tikai kandidātiem, kuri reģistrējas Online reģistrācijas sistēmā.
 
BEZMAKSAS IELTS SAGATAVOŠANAS TESTI
Gatavoties IELTS testam iespējams izmantojot bezmaksas mācību materiālus, kas pieejami Take IELTS mājas lapā. Testa materiāli ir izvietoti vairākās web lapās. Svarīgi katrā lapā pareizā secībā atbildēt uz visiem jautājumiem un izpildīt visus uzdevumus. Ja nevēlaties mācīties tiešsaistē, lejupielādējiet materiālus, kā arī tukšas atbilžu lapas un atbildes. Aplūkojiet bezmaksas IELTS sagatavošanas testus. 
 
GATAVOJIETIES IELTS LEARNING ENGLISH MĀJAS LAPĀ
IELTS sadaļā atrodami materiāli un padomi, kas palīdzēs gatavoties IELTS testa klausīšanās, runāšanās, lasīšanas un rakstīšanas moduļiem. Šajā lapā ir arī video sērija, kas veltīta tieši runāšanas modulim, kā arī tiešsaistes materiāli un sagatavošanas testi pārējiem trīs moduļiem. Aplūkojiet materiālus LearnEnglish mājas lapas IELTS sadaļā.
 
IELTS PADOMI NO CITIEM KANDIDĀTIEM
Šajā British Council video sērijā kandidāti stāsta par to, kā viņi gatavojušies IELTS testam un sniedz padomus, vadoties no pašu pieredzes.

OFICIĀLIE IELTS SAGATAVOŠANAS MATERIĀLI
IELTS sagatavošanas materiālus iespējams iegādāties Rīgā, GLOBUSS un Jāņa Rozes grāmatnīcās.");

?>