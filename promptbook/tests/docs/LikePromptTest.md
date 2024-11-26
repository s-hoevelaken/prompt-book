# testplan Prompt liken

## doel van de test
Het doel van deze test is om de functionaliteit het liken van prompts werkt zoals bedoeld. 

## user story
deze test hoort bij user story #22

### TESTCASE 1:
Testscenario: Geauthenticeerde gebruiker kan een prompt liken.

Testgegevens: Maak een geauthenticeerde gebruiker en een prompt.

Verwachte Resultaat: De gebruiker kan de prompt succesvol liken, en er wordt een nieuwe vermelding gemaakt in de likes-tabel met de gebruikers-ID en prompt-ID.

### TESTCASE 2:
Testscenario: Geauthenticeerde gebruiker kan een like ongedaan maken.

Testgegevens: Maak een geauthenticeerde gebruiker en een prompt. De gebruiker liked aanvankelijk de prompt.

Verwachte Resultaat: De gebruiker kan de like succesvol ongedaan maken, en de vermelding in de likes-tabel wordt verwijderd uit de database.

### TESTCASE 3:
Testscenario: Niet-geauthenticeerde gebruiker kan geen prompt liken.

Testgegevens: Maak een prompt zonder een gebruiker te authenticeren.

Verwachte Resultaat: De poging om een prompt te liken moet mislukken met een 401 Unauthorized-status of een 302 Redirect. De vermelding in de likes-tabel
moet niet worden aangemaakt in de database.