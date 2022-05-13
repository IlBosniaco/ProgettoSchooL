<?php
    //fare 2 tabelle 
    //prima tabella --->ripetizioni che si offrono 

    /*
        SELECT u.nome, u.cognome, u.anno, u.sezione, u.indirizzo, u.email, u.numTelefono
        FROM utente u, lezioni l
        WHERE u.id=l.id_alunno
        AND l.id_ripetizione IN ( 
            SELECT l.id_ripetizione 
            FROM utente u, tutor t, materiatutor mt, materie m, lezioni l 
            WHERE u.id=t.id_utente AND t.id_utente=mt.idtutor AND m.id=mt.idmaterie AND mt.id_ripetizione=l.id_ripetizione AND u.id=2);

        u.id---> $_SESSION['id']
        //stampa le informazioni dell'utente a cui devo offrire ripetizioni

        //N.B magari faccio una union dove stampa anche le info sulla materia 




    */
    //seconda tabella ->ripetizioni che ho prenotato
  
    /*
        SELECT u.nome, u.cognome, u.anno, u.sezione, u.indirizzo, mt.descrizione, m.materia, mt.prezzi_ora, u.email, u.numTelefono 
        FROM utente u, tutor t, materiatutor mt, materie m, lezioni l 
        WHERE u.id=t.id_utente AND t.id_utente=mt.idtutor AND m.id=mt.idmaterie AND mt.id_ripetizione=l.id_ripetizione AND l.id_alunno=1;

        l.id_alunno= --->$_SESSION['id'] //ritorna tutte le ripetizioni dove il ripetente 'sono io'

    */
?>


