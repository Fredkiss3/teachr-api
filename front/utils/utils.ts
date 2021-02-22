
export interface TeachrType {
    prenom: string,
    formation: string,
    description: string
}

export const getData = (): Array<TeachrType> => {
    return [
        {
            prenom: "Pierre du Parc de Locmaria",
            formation: "Université Paris Dauphine",
            description: "Calme et patient, je sais m'adapter à l'élève et comprendre sa méthode d'apprentissage afin de l'aider à progresser au mieux."
        },
        {
            prenom: "Jean Marc du Pontavic",
            formation: "Université de Rennes1",
            description: "Généralement, on utilise un texte en faux latin le Lorem ipsum ou Lipsum, qui permet donc de faire office de texte d'attente."
        },
        {
            prenom: "Marie Sue",
            formation: "ECV Digital",
            description: "L'avantage de le mettre en latin est que l'opérateur sait au premier coup d'oeil que la page contenant ce texte n'est pas valide."
        },
        {
            prenom: "François Copé du Mouton",
            formation: "Université de Rennes2",
            description: "Ce texte a pour autre avantage d'utiliser des mots de longueur variable, essayant de simuler une occupation normale."
        },
        {
            prenom: "Jarvis de IRON MAN",
            formation: "Université de Rennes1",
            description: "La méthode simpliste consistant à copier-coller un court texte plusieurs fois."
        },
        {
            prenom: "Calipto de Plutonasq",
            formation: "ECV Digital",
            description: "A l'inconvénient de ne pas permettre une juste appréciation typographique du résultat final."
        },
        {
            prenom: "Gandalf du Seigneur des anneaux",
            formation: "Université Paris Dauphine",
            description: "Il circule des centaines de versions différentes du Lorem, mais ce texte aurait originellement été tiré de l'ouvrage de Cicéron,"
        },
        {
            prenom: "François Héléoptère",
            formation: "Université de Nantes",
            description: "De Finibus Bonorum et Malorum (Liber Primus, 32), texte populaire à cette époque, dont l'une des premières phrases est :"
        },
        {
            prenom: "EREN Jeager de Paradis",
            formation: "Les Bataillon d'exploration",
            description: "« Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit... »"
        },
        {
            prenom: "Falco de Mahr",
            formation: "Ecole armée de Mahr",
            description: " (« Il n'existe personne qui aime la souffrance pour elle-même, ni qui la recherche ni qui la veuille pour ce qu'elle est... »)."
        },
    ]
};