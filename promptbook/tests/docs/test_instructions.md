# Testplan - Promptbook instructies

### **Doel van de tests**

Het doel van de tests is om van de opgeschreven user stories, de functionaliteit goed te onderhouden en te testen.
Dit testplan bevat 10 testcases die aansluiten bij het doel van de applicatie, met inclusief daarbij de verwachte resultaten en alternatieve scenario's.
</br>
</br>

### **Het draaien van de tests**

Voordat de tests gedraaid kunnen worden, moeten de volgende stappen worden uitgevoerd:

1. **Zorg ervoor dat de meest recente versie van het project is ingesteld**

```bash
    composer update
```
<br>

2. **Maak (optioneel) een test database aan waarop de tests gedraaid kunnen worden**

```bash
    php artisan migrate --env=testing
```
<br>

3. **Voer de tests uit:**
    
    ```bash
        php artisan test --testsuite=custom-tests
    ```

    Hiermee draai je de 10 zelfgeschreven test cases van de applicatie.

    Voor specifiek testen alleen te draaien kun je ook de volgende commando's gebruiken:

    ```bash
        php artisan test --filter <testnaam>
    ```

    </br>

### **Test cases**

- **Case 1 - Registratie test** 

    1. Testscenario: De gebruiker kan zich registreren met een geldig e-mailadres en wachtwoord.
    2. Testdata: Een geldig gebruikersnaam, e-mailadres en wachtwoord.
    3. Verwachte resultaat: De gebruiker wordt geregistreerd en wordt doorgestuurd naar de homepagina.
    </br>
    </br>
    
- **Case 2 - Login test** 

    1. Testscenario: De gebruiker kan inloggen met een geldig e-mailadres en wachtwoord.
    2. Testdata: Een geldig e-mailadres en wachtwoord.
    3. Verwachte resultaat: De gebruiker wordt ingelogd en wordt doorgestuurd naar de homepagina.
    </br>
    </br>

- **Case 3 - Aanmaken van prompt** 

    1. Testscenario: De geregistreerde gebruiker kan een prompt aanmaken.
    2. Testdata: Een geldige titel, omschrijving, content en publiciteit 
    3. Verwachte resultaat: De gebruiker maakt een nieuwe prompt aan en wordt doorgestuurd naar zijn/haar overzichtspagina.
    </br>
    </br>

- **Case 4 - Favorieten op en prompt** 

    1. Testscenario: De geregistreerde gebruiker kan op een prompt favorieten. &#10084;
    2. Testdata: gebruikers id en prompt id.
    3. Verwachte resultaat: De prompt zijn favorieten aantal gaat omhoog en de gebruiker ziet zijn/haar &#10084; op de prompt.
    </br>
    </br>

- **Case 5 - Liken op een prompt** 

   1. Testscenario: De geregistreerde gebruiker kan op een prompt liken. &#128077;
    2. Testdata: gebruikers id en prompt id.
    3. Verwachte resultaat: De prompt zijn like aantal gaat omhoog en de gebruiker ziet zijn/haar &#128077; op de prompt.
    </br>
    </br>

- **Case 6 - Verwijderen van prompts** 

    1. Testscenario: De gebruiker kan zijn/haar eigen prompt verwijderen
    2. Testdata: Een geldig prompt id van de gebruiker
    3. Verwachte resultaat: De prompt van de gebruiker word verwijderd.
    </br>

- **Case 7 - Zoeken van prive prompts** 

    1. Testscenario: De gebruiker kan zoeken naar prompts met de optie om alleen prive prompts te zien.
    2. Testdata: Een geldige titel, publiciteit en prompt id
    3. Verwachte resultaat: De pagina toont alleen prompts met een prive publiciteit aan de gebruiker.
    </br>
    </br>

- **Case 8 - Zoeken naar algemene prompts** 

    1. Testscenario: De gebruiker kan door middel van een zoekbar zoeken naar algemene prompts.
    2. Testdata: Een geldige title en prompt id.
    3. Verwachte resultaat: De pagina toont alleen prompts die overeenkomen met de gebruikers zoektermen.
    </br>
    </br>

- **Case 9 - Aanpassen van prompt publiciteit** 

    1. Testscenario: De gebruiker kan zijn/haar eigen prompt zijn publiciteit aanpassen.
    2. Testdata: Een geldige prompt id en gebruikers id
    3. Verwachte resultaat: De gebruikers zijn/haar prompt zijn aangepast op hun publiciteit voor andere gebruikers
    </br>
    </br>

- **Case 10 - Aanpassingen maken aan bestaande prompts** 

    1. Testscenario: De gebruiker kan zijn/haar prompts aanpassen/updaten.
    2. Testdata: Een geldig prompt id, titel, omschrijving, content en publiciteit.
    3. Verwachte resultaat: De gebruiker zijn/haar prompt is aangepast en word daarnaa terug geleid naar zijn/haar overzichtspagina.
    </br>
    </br>




