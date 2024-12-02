# Verbeteringsvoorstel van Promptbook Applicatie

(Opdracht 5)

Dit document bevat verbetervoorstellen voor de Promptbook applicatie, gebaseerd op de ervaringen tijdens het werkprocess en de testresultaten. Het doel is om zowel de planning beter uit te werken, de kwaliteit en onderhoudbaarheid van de applicatie te verbeteren.

---

## Overzicht van Verbetervoorstellen

1. [Gebruik van Livewire of Reguliere Controllers](#1-gebruik-van-livewire-of-reguliere-controllers)
2. [Betere Scheiding van Verantwoordelijkheden](#2-scheiding-van-verantwoordelijkheden)
3. [Code Herbruikbaarheid en Refactoring](#3-code-herbruikbaarheid-en-refactoring)

---

## 1. Gebruik van livewire of reguliere controllers?


### Huidige situatie:
- De logica voor het beheren van prompts is gedeeltelijk geïmplementeerd in Livewire controllers door mij en in reguliere Laravel controllers door mijn medestudent.

### Verbeterpunt:
- Het gebruik van Livewire of reguliere controllers moet worden afgestemd op de behoeften van het project en de voorkeuren van het team.

### Aanbevolen actie:
- Voer een teamoverleg over welke aanpak van libraries en frameworks het beste past bij de applicatie en de vaardigheden van het team om de
applicatie consistent en overzichtelijk te houden.

---


## 2. Betere scheiding van verantwoordelijkheden

### Huidige situatie:
- Testing logica is vermengd met view-logica in Livewire componenten en routes.

### Verbeterpunt:
- Scheid de verantwoordelijkheden van de verschillende onderdelen van de applicatie om de code beter te structureren en te testen.

### Aanbevolen actie:
- Refactor Livewire componenten om logica te verplaatsen naar services of model-methoden, en zet view-specifieke logica om in Blade templates aan apparte directories.

---

## 3. Code herbruikbaarheid en refactoring

### Huidige situatie:
- Herhaalde logica, zoals het ophalen van gebruikersvoorkeuren, wordt op meerdere plaatsen geïmplementeerd.

### Verbeterpunt:
- Verminder code duplicatie door helperfuncties of services te gebruiken.

### Aanbevolen actie:
- Identificeer herhalende patronen en verplaats deze naar gespecialiseerde helpers of service classes.

---

## Conclusie

Deze verbetervoorstellen zijn opgesteld om de samenwerking, de consistentie van de codebase, en de testdekking van de Promptbook applicatie te verbeteren. Door deze punten te implementeren, kunnen we de kwaliteit en onderhoudbaarheid van het project verbeteren.
