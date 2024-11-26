# Testplan Prompt Removal
## Doel van de test
Het doel van deze test is om de functionaliteit voor het verwijderen van prompts te testen, zodat deze werkt zoals bedoeld.

## User Story
Deze test hoort bij user story #6.

### TESTCASE 1:
Testscenario: Geauthenticeerde gebruiker kan zijn eigen prompt verwijderen.

Testgegevens: Maak een geauthenticeerde gebruiker en een prompt die aan deze gebruiker toebehoort.

Verwachte Resultaat: De prompt wordt succesvol verwijderd uit de database en alle bijbehorende records worden ook netjes opgeruimd.

### TESTCASE 2:
Testscenario: Geauthenticeerde gebruiker kan geen prompt verwijderen die door een andere gebruiker is aangemaakt.

Testgegevens: Maak twee gebruikers, user1 en user2. Laat user1 een prompt aanmaken.

Verwachte Resultaat: Wanneer user2 probeert om de prompt te verwijderen, moet het systeem een 403 Forbidden-reactie teruggeven. De prompt moet in de database blijven staan.

### TESTCASE 3:
Testscenario: Niet-geauthenticeerde gebruiker kan geen prompt verwijderen.

Testgegevens: Maak een prompt zonder een gebruiker te authenticeren.

Verwachte Resultaat: Wanneer een niet-geauthenticeerde gebruiker probeert om de prompt te verwijderen, moet het systeem een 401 Unauthorized- of 302 Redirect-reactie teruggeven. De prompt moet in de database blijven staan.

