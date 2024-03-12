# Utiliser L'API 

types de requêtes:

GET, DELETE -> il suffit d'utiliser le lien directement, les paramètres sont passé dans le lien

POST, PUT -> ajouter à la requête du json contenant les paramètres demandés
(exemple {"id": 1, "temperature": 10}...)


L'API renvoie du JSON, utiliser json_decode() en php pour pouvoir utiliser la réponse



-------
## Measures

### Requête GET
* **/measures/get/all**
    - <u>Pas de paramètres</u>

    récupère tous les relevés

* **/measures/get/by_date**
    1. <u>*date*</u> -> la date du relevé
    2. <u>*sensor*</u> **OPTIONNEL** -> la sonde, si nulle, prend toutes les sondes

    récupère les relevés d'une date donnée.


* **/measures/get/last**
    1. <u>*sensor*</u> **OPTIONNEL** -> la sonde, si nulle, prend toutes les sondes
    2. <u>*n*</u> **OPTIONNEL** -> le nombre de relevés à récupérer, si nulle, prend tous les relevés

    récupère un nombre n de relevés triés par récenteté.


* **/measures/get/between_hours**
    1. <u>*date*</u>  -> la date des relevés, format "YYYY-MM-DD"
    2. <u>*begin*</u> -> heure basse, format "HH:MM:SS"
    3. <u>*end*</u>   -> heure haute, format "HH:MM:SS"
    
    récupère les relevés d'une date comprises entre deux heures données.


### Requête POST
* **/measures/insert**
    1. <u>*temperature*</u> -> temperature
    2. <u>*humidity*</u>    -> humidité
    3. <u>*pressure*</u>    -> pressure
    4. <u>*sensor*</u>      -> l'id de la sonde

    insert un nouveau relevé dans la date.

--------
## Sensor

### Requête GET
* **/sensor/get/all**
    1. <u>Pas de paramètres</u>

    récupère toutes les sondes.


* **/sensor/get/*id***
    1. <u>*id*</u> -> l'id de la sonde

    récupère les information d'une sonde selon son id. <br>
    **REMARQUE** ID est placé directement dans le liens: localhost:5000/sensor/get/1 suffit, pas besoin de faire localhost:5000/sensor/get?id=1


### Requête POST
* **/sensor/insert**
    1. <u>*date*</u> -> date de l'allumage, format "YYYY-MM-DD"
    2. <u>*time*</u> -> heure de l'allumage, format "HH:MM:SS"
    3. <u>*location*</u> **OPTIONNEL** -> le lieu de la sonde, un string
    
    insert une nouvelle sonde.


### Requête PUT
* **/sensor/update/*id***
    1. <u>*id*</u> -> id de la sonde
    2. <u>*date</u> **OPTIONNEL*** -> date de l'allumage, format "YYYY-MM-DD"
    3. <u>*time</u> **OPTIONNEL*** -> heure de l'allumage, format "HH:MM:SS"
    4. <u>*location*</u> **OPTIONNEL** -> le lieu de la sonde, un string
    
    met à jour les données d'une sonde selon son id. <br>
    **REMARQUE** ID est placé directement dans le liens: localhost:5000/sensor/get/1 suffit, pas besoin de faire localhost:5000/sensor/get?id=1


### Requête DELETE
* **/sensor/delete/*id***
    1. <u>*id*</u> -> id de la sonde à supprimer

    supprime une sonde <br>
    **REMARQUE** ID est placé directement dans le liens: localhost:5000/sensor/get/1 suffit, pas besoin de faire localhost:5000/sensor/get?id=1
