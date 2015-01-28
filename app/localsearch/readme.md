# localsearch


-------------------------------
## Html
<input id="localsearch" type="text" autocomplete="off" data-target="#snippets-list" data-target-scroll="#snippet-list-col">
data-target="#localsearch-list" <=== selecteur de la liste a filtrer

data-target-scroll="#localsearch-list-scroll" selecteur de la zone de scroll pour l'autoscroll
si il n'est pas définit le selecteur de la liste est choisit par defaut.
-------------------------------

## javascript

initialisation :
	$('#localsearch').localsearch({
		scrollPrev : 10 //par defaut
	});
-------------------------------



Filtre, ordonne et affiche une liste.

#1 filtre si le contenu de la liste en creant un regexp apartir du cotenue du champ text 
#2 calcule la pertinance des reponses en attribuant des points de pénalité entre chaque ecart de correspondance avec la regexp.

soit : 

	SEARCH 		= la recherche

	S1 			= le premier caractere de la recherche
	S2 			= me dernier caractere de la recherche

	LIST 		= la liste complete a filtrer
	RLIST		= la liste apres le filtre


- On attribut 0 pour chaque ligne de resultat positif

- On ne calcule les pénalités qu'entre le premier et le dernier caracères recherché.

- Si le premier caractere recherché ne correspont pas au premier caractère de l'element de la liste alors on sanctionne de 1pt de pénalité.

- 

On ordonne le resultat filtrer en fonction des points de pénalité
