## Gitlab Repository Link

[PromptBook Deep Dive Repository](https://github.com/s-hoevelaken/prompt-book).

### Gekoppelde Commits aan user Stories

#### User Story 1: Gebruiker wil een pagina om prompts van anderen te bekijken

- **Commit:** [45b017f](https://github.com/s-hoevelaken/prompt-book/commit/45b017fbeef42845fd4f8a107e26855f40fe3fe6) - Homepagina heeft prompts als props om te gebruiken voor andere pagina's


#### User Story 4: Gebruiker wil eigen prompts kunnen aanmaken

- **Commit:** [a248b1e](https://github.com/s-hoevelaken/prompt-book/commit/a248b1ec0082e73430cbb4966a1b55b4a6c91a7f) - store functie met StorePromptRequest validatie


 #### User Story 7: Ontwikkelaar wilt prompts kunnen aanpassen via endpoint

- **Commit:** 
    - [3e8e766](https://github.com/s-hoevelaken/prompt-book/commit/3e8e76660a849f6897a72ece6f3c3f06c8019e2d) - Crud Model met api endpoint er naar toe
    - [907d5e3](https://github.com/s-hoevelaken/prompt-book/commit/907d5e322fb32475d8345ea869ab3c3d56b8e32f) - verwijder en aanpas knoppen op de view pagina
    - [d1e7762](https://github.com/s-hoevelaken/prompt-book/commit/d1e776221f67c5b003d4f135d7d28d54314104e3) - EditPromptRequest om aanpassingen te valideren

#### User Story 8: Gebruiker wilt mogelijkheden om publiciteit van zijn/haar prompt aan te passen

- **Commit:** 
    - [6a1b92e](https://github.com/s-hoevelaken/prompt-book/commit/6a1b92ec543d8b54a4dfa9047ad3e758a5236d2b) - Verifieer of publiciteit op openbaar of prive staat


#### User Story 22: Gebruiker wil interacties hebben met andere prompts

- **Commit:** 
    - [07245d1](https://github.com/s-hoevelaken/prompt-book/commit/07245d16ff925d1535af315cf8d77f0d74e8011f) - toggleLike functie om likes op te slaan

#### User Story 25: Gebruiker wil kunnen navigeren tussen webpagina's

- **Commit:** [d0c8092](https://github.com/s-hoevelaken/prompt-book/commit/d0c80927b7b2cfe8622ec469f2178ed880354c1f) - Feedpagina en Viewpagina geïmplementeerd met navbar links 
 - **Commit:** [55bc266](https://github.com/s-hoevelaken/prompt-book/commit/55bc2664ef1203357832466a18731083a8db6eb4) - Navbar custom styles met javascript voor animatie
 - **Commit:** [feee1fe](https://github.com/s-hoevelaken/prompt-book/commit/feee1fe1f8186ac63be7e86c888e919481fb9b76) - Filterknoppen voor discovery pagina met Livewire

#### Commits zonder specifieke User Story

- **Commit:**
    - [c52fdb4](https://github.com/s-hoevelaken/prompt-book/commit/c52fdb47299203ae7747c8b3e208930ac1414cd7) Icons voor homepagina cards
    - [309d2f6](https://github.com/s-hoevelaken/prompt-book/commit/309d2f605fc6cccebb738b419a6a3e372ab285ed) 
    Filter op de omschrijving van de prompt
    - [7af01dc](https://github.com/s-hoevelaken/prompt-book/commit/7af01dce16affe4e680549ea1efe1eb6cdf35dc9) 
    Authentication fixes voor de PromptController

Hier is een overzicht van de merge requests, gekoppeld aan de bijbehorende user stories:

### Overzicht van Merge Requests door Xander Poggenklaas

1. #### Feature/Livewire Component Snippets (!15)
    - **Beschrijving** Implementatie van Livewire met de Frontend
    - **User Story:**
        - Niet direct gekoppeld aan een user story maar wel toepasbaar bij **User Story 9** (Voorpagina custom styling)

2. #### Feat: Navbar styling (!21)
    - **Beschrijving** Navbar animatie gekoppeld aan de pagina
    - **User Story:**
        - Niet direct gekoppeld aan een user story maar wel toepasbaar bij **User Story 25** (Javascript/css animatie voor navbar)

3. #### Feature/Flashmessages implemented (!38)
    - **Beschrijving** Flashmessages bij de create pagina's
    - **User Story:** Ondersteunt **User Story 25** en commit [feee1fe](https://github.com/s-hoevelaken/prompt-book/commit/feee1fe1f8186ac63be7e86c888e919481fb9b76)
    
4. #### Feature/Likes, Hears en Comments (!39)
    - **Beschrijving** interacties met prompts op feedpagina
    - **User Story:** Ondersteunt **User Story 20** (Comment sectie toegevoegd onder prompts)
    

### Overzicht van Merge Requests door Stephan Hoevelaken

<!-- zet hier de merges -->

### Branch Merges Overzicht

#### Merged branches met Xanders als de Auteur:

1. **Feat: Frontend modifications** (!21)
2. **Feat: card section finished** (!28)
3. **Feature: Create prompts modifications** (!29)
4. **Feat: added the viewpage and feedpage to livewire** (!30)
5. **Feat: Testings** (!33)
6. **Feat: added CreatePromptTest and UpdatePromptTest files and have been tested** (!34)
7. **Feat: cards on homepage have been modified** (!36)
8. **Feat: Frontend modifications** (!37)
9. **Feature: feedpage has more filtering options and comment sections** (!38)
10. **Feature: implemented update and destroy feature** (!41)

#### Merged branches met Stephan als de Auteur:

<!-- zet hier de merges -->

### Screenshot van Merges

#### Xander:
<img src="./3.6 Versiebeheer/merges/Xander_merges.png" alt="Xander_merges" width="100%"/>

<br>

#### Stephan:
<img src="./3.6 Versiebeheer/merges/Stephan_merges.png" alt="Stephan_merges" width="100%"/>