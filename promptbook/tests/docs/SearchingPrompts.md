### Testplan Prompt Zoeken
Doel van de test
Het doel van deze test is om de functionaliteit voor het zoeken van prompts te testen, zodat deze werkt zoals bedoeld.

## User Story
Deze test hoort bij user story #11.

### TESTCASE 1:
Testscenario: Gebruiker kan prompts zoeken op titel.

Testgegevens: Maak een geauthenticeerde gebruiker en verschillende prompts met specifieke titels.

Verwachte Resultaat: De gebruiker kan prompts met de specifieke zoekterm vinden. De zoekresultaten moeten de prompts bevatten die overeenkomen met de zoekterm.

### TESTCASE 2:
Testscenario: Zoeken met geen overeenkomsten retourneert geen resultaten.

Testgegevens: Maak een geauthenticeerde gebruiker en verschillende prompts. Voer een zoekopdracht uit met een term die niet overeenkomt met de bestaande titels.

Verwachte Resultaat: De zoekopdracht moet geen resultaten retourneren en de gebruiker moet een bericht zien dat er geen prompts zijn gevonden.

### TESTCASE 3:
Testscenario: Lege zoekopdracht retourneert alle prompts.

Testgegevens: Maak een geauthenticeerde gebruiker en verschillende prompts.

Verwachte Resultaat: Bij een lege zoekopdracht moeten alle beschikbare prompts worden weergegeven.

### TESTCASE 4:
Testscenario: Gebruiker kan geen private prompts van andere gebruikers zoeken.

Testgegevens: Maak een geauthenticeerde gebruiker en verschillende prompts, waarvan enkele privé zijn en behoren tot andere gebruikers.

Verwachte Resultaat: De gebruiker mag de private prompts van andere gebruikers niet zien in de zoekresultaten. Alleen publieke prompts en eigen prompts moeten zichtbaar zijn.