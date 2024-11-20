# testplan inloggen

## Doel van de test
Het doel van deze test is om te verifiëren dat het aanmeldproces van nieuwe gebruikers correct werkt en dat gebruikers zich succesvol kunnen registreren zonder fouten of problemen. Dit zorgt ervoor dat nieuwe gebruikers gemakkelijk toegang krijgen tot de applicatie.


## testcases

### Case 1: Correct Aanmelden
Testscenario: De gebruiker vult het registratieformulier correct in op de aanmeldpagina en klikt op 'Registreer'.

Testdata: Naam: "John Doe", E-mail: "johndoe@example.com", Wachtwoord: "password123".

Verwacht resultaat: De gebruiker wordt succesvol geregistreerd, zijn data wordt opgeslagen in de database en hij wordt doorgestuurd naar de loginpagina.

### Case 2: Aanmelden met ontbrekende gegevens
Testscenario: De gebruiker probeert zich te registreren zonder een wachtwoord in te vullen.

Testdata: Naam: "John Doe", E-mail: "johndoe@example.com", Wachtwoord: "".

Verwacht resultaat: De applicatie toont een foutmelding dat het ontbrekende veld verplicht is.


### Case 4: Aanmelden met een reeds bestaand e-mailadres
Testscenario: De gebruiker probeert zich te registreren met een e-mailadres dat al in gebruik is.

Testdata: Naam: "John Doe", E-mail: "johndoe@example.com", Wachtwoord: "password123".

Verwacht resultaat: De applicatie toont een foutmelding dat het e-mailadres al geregistreerd is.