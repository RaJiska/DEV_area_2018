
# DEV_area_2018


## Lancer les services

1. **Cloner** le repository

2. `docker-compose build && docker-compose up -d`

## Routes API

Url index: http://localhost:8080

GET **/about.json**

> Liste les services / actions / réaction.
> #### Header
> - 
> #### Paramètres
>  -

GET **/user**
> Connecte un utilisateur.
> #### Header
> -
> #### Paramètres
>  - login (string)
>  - pass (string)

POST **/user**
> Enregistre un utilisateur.
> #### Header
> -
> #### Paramètres
>  - login (string)
>  - pass (string)

GET **/token**
> Renvoie le token d'accès d'un utilisateur pour un service donné.
> #### Header
> - Authorization: Bearer ..(area access token)
> #### Paramètres
>  - login (string)
>  - service (string)

POST **/token**
> Enregistre le token d'accès d'un utilisateur pour un service donné .
> #### Header
> - Authorization: Bearer ..(area access token)
> #### Paramètres
>  -  service (string)
>  - service_token (string)
>  - service_token_secret (string) (optional)

POST **/trigger**
> Ajoute un trigger pour l'utilisateur.
> #### Header
> - Authorization: Bearer ..(area access token)
> #### Paramètres
>  - action_service (string)
>  - reaction_service (string)
>  - action (string)
>  - reaction (string)
>  - action_params (base64 separated with ';') (optional)
>  - reaction_params (base64 separated with ';') (optional)
>
> Exemple action_params: 
> curl -X POST 'http://localhost:8080/trigger' --data 'action_service=imgur&reaction_service=github&action=new_comment&reaction=star_repo&action_params=UkN0aWpVRQ==;MTU1MTgwOTkzMw==&reaction_params=UmFKaXNrYQ==;REVWX2FyZWFfMjAxOA==


## Contributeurs

Sarah Godard
Doriann Corlouer
Quentin Santos
Kévin Severin
Cédric Ogire
Kévin Bidet




