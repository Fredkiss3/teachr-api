# ReactNative Teach'r Mobile App

Test technique demandé par Teach'r.

L'objectif du projet est de créer une application pour afficher les ressources ***Teach'r***


Sommaire: 
  * [I- Pré-requis](#i--pr--requis)
  * [II- Comment lancer le projet ?](#ii--comment-lancer-le-projet--)

## I- Pré-requis

Pour lancer le projet il faut :
- avoir `npm >= 12` ou `yarn` installé
- avoir `expo` installé sur votre téléphone (optionnel)
- [configurer votre environnement](https://reactnative.dev/docs/environment-setup) (pour lancer l'application android
utiliser sans expo) 

## II- Comment lancer le projet ?

### Avec Expo

Si vous avez expo installé sur votre téléphone, il vous faut :

1- Lancer le projet avec la commande :

```bash
# avec npm
npm start

# avec yarn
yarn start
```

Une page du navigateur va s'ouvrir à l'addresse: http://localhost:19002.

2- lancer l'application expo sur votre téléphone et scanner le code QR 
qui apparaît sur la page du navigateur.

### Sans Expo

Pour lancer l'application sans expo il faut : 

1- [configurer votre environnement](https://reactnative.dev/docs/environment-setup)

2- installer les dépendances :

```bash
# avec npm
npm i 

# avec yarn
yarn i
```

3- Connectez votre téléphone par câble usb (android ou ios) ou lancer un émulateur

4- Lancer l'application avec:

```bash
## Sur android
# avec npm
npm run android

# avec yarn
yarn run android

## Sur ios
# avec npm
npm run ios

# avec yarn
yarn run ios
```
