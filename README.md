### VOTAZIONE : 30

### JOB CONNECT
JOB CONNECT è una piattaforma che facilita l’incontro tra aziende e professionisti, aiutando le aziende a trovare i talenti giusti e i candidati a scoprire opportunità lavorative in linea con le proprie competenze.


00. Set stripe api key and config stmp service in the env
01. Set the env values

0. Eseguire i seguenti comandi dopo aver clonato la repository:

    cd <nome_progetto>
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan config:cache


1. Provare ad avviare il progetto con il comando

    php artisan serve

---- CONTROLLER e funzioni relative ----

ApplicationController
    1. index;
    2. show;
    3. shortlist;
    3. apply;
    4. store: crea una nuova prenotazione, validando prima i dati messi in input dall'utente, e poi rimanda alla pagina che
    mostra i dettagli sulla prenotazione;
    5. edit: carica tutte le stanze nella variable $rooms, che poi passa alla view di edit;


DashboardController
   1. __construct;
   2. index;
   


FileUploadController
   1. store


InfoPageController
   1. aboutUs
   2. privacy
   3. terms


JoblistingController
    1. index;
    2. show
    3. company
    

PostJobController
    1. __construct;
    2. index;
    3. create;
    4. store;
    5. edit;
    6. update;
    7. destroy.


SubscriptionController
    1. __construct;
    2. initiatePayment;
    3. paymentSuccess;
    4. cancel;

UserController
    1. createSeeker;
    2. createEmployer;
    3. storeSeeker;
    4. storeEmployer;
    5. profile;
    6. seekerProfile;
    7. update;
    8. jobApplied;
    9. uploadResume;
    
    
---- MODELLI e attributi ----

User:
    'name',
    'email',
    'password',
    'about',
    'profile_pic',
    'user_type',
    'resume',
    'user_trial',
    'billing_ends',
    'status',
    'plan',
    
    Relazione belongsToMany(Listing)
    Relazione hasMany(Listing)

Listing:
    'user_id',
    'title',
    'description',
    'roles',
    'slug',
    'job_type',
    'address',
    'salary',
    'application_deadline',
    'feature_image'

    Relazione belongsToMany(User)
    Relazione belongsTo(User)

Listing_User:   (Non è proprio un modello ma solo una tabella pivot tra Listing e User) 

   'listing_id'
   'user_id'
   'shortlisted'


 ---- REQUISITI MINIMI e ATTIVITA' ----

Requisiti minimi del progetto: 
1. [X] Gestione di più livelli di utenti: amministratori(recruiter/aziende), utenti(ricercatori di lavoro), ospiti ...
2. [X] Almeno una entità con CRUD completo --> annuncio di lavoro (Listing)
3. [X] Gestione della validazione dei dati inseriti --> validazione tramite le classe nela dir */Request dove definiamo delle regole a per tipo di richiesta 
4. [X] Almeno un inserimento o modifica di una entità sviluppato in AJAX --> modifica di un annuncio di lavoro (Job oppure Listing)

Attività da svolgere:

- [X] Creazione dell'idea, identificazione del problema da risolvere;

- [X] Definizione e analisi dei requisiti;

- [X] Progettazione del sistema 

-------- Prima fase -----------

- [X] Setting delle layouts;

- [X] Implementare homepage di Dorince;

- [X] Implementare Dashboard di Virgil;

- [X] Implementare Pagine informative(about, privacy and terms) di Marie Noel;


-------- Seconda fase ---------

- [X] Implementare la soscrizione via pagamento  di Marie Noel;

- [X] Implementare profili/accounts settings;

- [X] Implementare funzionalità degli annunci di lavoro;

- [X] Implementare candidarsi;

- [X] Aggiungere la modifica di un annuncio con AJAX;

- [X] Implementare la nav-bar della dashboard con Vue.js;

- [X] Tests;

- [X] BUGS FIX;

----------------------------------------------------------------

- [X] Presentazione progetto : 
    Virgil: Presentazione progetto, indice, problema, soluzione; 
    Dorince: servizi per professionisti, servizi per aziende;
    Marie Noel: monetizzazione, Cosa abbiamo utilizzato;
    Noi tutti: conclusioni, ringraziamenti.
--> Indicativamente 3:30 minuti a testa, 10 minuti totali.

- [X] Pensare a percorso guidato:
     
    1. Marie fa l'ospite [Site tour (home, registrazioni, privacy, about, terms)]
    2. Dorince fa il ricercatore di lavoro
    3. Virgil presenta il recruiter/azienda
 
    --> Indicativamente Circa 5 minuti a testa, 15 minuti totali.