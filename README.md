## TempCRM

L'utente deve essere in grado di autenticarsi. (Nota, l'utente autenticato verrà considerato admin).

* L'utente deve essere in grado di creare Clienti
* L'utente deve essere in grado di creare Ordini ed associarli a Clienti. 
    * Quando un Ordine viene creato, viene automaticamente creato un Contratto associato al Cliente e all'Ordine.
* Durante la creazione e modifica di un Ordine, quest'ultimo potrà essere associato ad uno o più Tags già presenti nel sistema.
* Quando viene cancellato un Ordine, viene cancellato il Contratto
* Quando viene cancellato un Cliente, vengono cancellato tutti gli Ordini e tutti i Contratti appartenenti a quel Cliente.
* Tutte le cancellazioni devono essere recuperabili.
