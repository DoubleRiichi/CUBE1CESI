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
    - Pas de paramètres

    récupère tous les relevés

* **/measures/get/by_date**
    - params :    *date* -> la date du relevé
                  *sensor* **OPTIONNEL** -> la sonde, si nulle, prend toutes les sondes

    récupère les relevés d'une date donnée.


* **/measures/get/last**
    - params :    *sensor* **OPTIONNEL** -> la sonde, si nulle, prend toutes les sondes
                  *n* **OPTIONNEL** -> le nombre de relevés à récupérer, si nulle, prend tous les relevés

    récupère un nombre n de relevés triés par récenteté.


* **/measures/get/between_hours**
    - params :    *date*  -> la date des relevés, format "YYYY-MM-DD"
                  *begin* -> heure basse, format "HH:MM:SS"
                  *end*   -> heure haute, format "HH:MM:SS"
    
    récupère les relevés d'une date comprises entre deux heures données.


### Requête POST
* **/measures/insert**
    - params :     *temperature* -> temperature
                   *humidity*    -> humidité
                   *pressure*    -> pressure
                   *sensor*      -> l'id de la sonde

    insert un nouveau relevé dans la date.

--------
## Sensor

### Requête GET
* **/sensor/get/all**
    - Pas de paramètres

    récupère toutes les sondes.


* **/sensor/get/*id***
    - params :     *id* -> l'id de la sonde

    récupère les information d'une sonde selon son id.
    **REMARQUE** ID est placé directement dans le liens: localhost:5000/sensor/get/1 suffit, pas besoin de faire localhost:5000/sensor/get?id=1


### Requête POST
* **/sensor/insert**
    - params :     *date* -> date de l'allumage, format "YYYY-MM-DD"
                   *time* -> heure de l'allumage, format "HH:MM:SS"
                   *location* **OPTIONNEL** -> le lieu de la sonde, un string
    
    insert une nouvelle sonde.


### Requête PUT
* **/sensor/update/*id***
    - params :     *id* -> id de la sonde
                   *date **OPTIONNEL*** -> date de l'allumage, format "YYYY-MM-DD"
                   *time **OPTIONNEL*** -> heure de l'allumage, format "HH:MM:SS"
                   *location* **OPTIONNEL** -> le lieu de la sonde, un string
    
    met à jour les données d'une sonde selon son id.
    **REMARQUE** ID est placé directement dans le liens: localhost:5000/sensor/get/1 suffit, pas besoin de faire localhost:5000/sensor/get?id=1


### Requête DELETE
* **/sensor/delete/*id***
    - params :     *id* -> id de la sonde à supprimer

    supprime une sonde
    **REMARQUE** ID est placé directement dans le liens: localhost:5000/sensor/get/1 suffit, pas besoin de faire localhost:5000/sensor/get?id=1
