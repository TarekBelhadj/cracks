# Cracks

Framework de tests de failles dans le contexte du module "Projet Cybersécurité".

## Mise en garde

> [!Caution]
> L'objectif de ce projet est de donner un contexte
> d'exploitation de failles de sécurité.
> Il est donc logiquement bourré de failles de sécurité,
> et ne doit sans aucun prétexte être utilisé dans un contexte réel.

## Objectif de l'outil

L'objectif de l'outil fictif est de permettre
l'échange de "blagues foireuses" ou "cracks".

Des personnes inscrites peuvent ajouter des "cracks"
ou voter sur les cracks.

Des personnes non-inscrites ne peuvent que visualiser les cracks,
s'inscrire ou se connecter.

## Partie 1 : audit

La première partie concerne l'audit de sécurité.
Vous devez tester les différentes failles de sécurité potentielles,
les référencer, et les reporter de votre coté.

### 1.1 : Fork

Pour commencer, réalisez un fork du dépôt.
A partir de ce fork,
réalisez l'installation de l'outil.

Ensuite, dans votre fork, activez les outils Github d'issues.

### 1.2 : Report

Chaque faille référencée devra être répertoriée
comme étant une "issue" de libellé "security".

Pour chaque faille, vous devez fournir le processus exact de reproduction
et ce que ça implique.
L'usage d'outils automatisés et de suites complètes de pentesting est interdit.

## Partie 2 : correction

Pour chaque faille, proposez et implémentez une correction.

L'usage de frameworks et librairies externes est interdit.

## Partie 3 : Red vs Blue

Echangez avec les autres équipes pour tester leurs corrections,
et vice-versa.
