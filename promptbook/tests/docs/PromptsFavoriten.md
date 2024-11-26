# Testplan Prompt Favoriten
## Doel van de test
Het doel van deze test is om de functionaliteit voor het favorieten van prompts te testen, zodat deze werkt zoals bedoeld.

## User Story
Deze test hoort bij user story #23.

### TESTCASE 1:
Testscenario: Geauthenticeerde gebruiker kan een prompt favorieten.

Testgegevens: Maak een geauthenticeerde gebruiker en een prompt.

Verwachte Resultaat: De gebruiker kan de prompt succesvol als favoriet markeren, en er wordt een nieuwe vermelding gemaakt in de favorieten-tabel met de gebruikers-ID en prompt-ID.

### TESTCASE 2:
Testscenario: Geauthenticeerde gebruiker kan een prompt ont-favorieten.

Testgegevens: Maak een geauthenticeerde gebruiker en een prompt. De gebruiker markeert de prompt aanvankelijk als favoriet.

Verwachte Resultaat: De gebruiker kan de prompt succesvol ont-favorieten, en de vermelding in de favorieten-tabel wordt verwijderd uit de database.

### TESTCASE 3:
Testscenario: Niet-geauthenticeerde gebruiker kan geen prompt favorieten.

Testgegevens: Maak een prompt zonder een gebruiker te authenticeren.

Verwachte Resultaat: De poging om een prompt als favoriet te markeren moet mislukken met een 401 Unauthorized-status of een 302 Redirect. De vermelding in de favorieten-tabel moet niet worden aangemaakt in de database.

