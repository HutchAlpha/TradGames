<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TradGames</title>
    <link href="Css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="Image/icon.jpeg">

</head>
<body>
    <div class="container">
        <img class="icon" src="Image/icon.jpeg" alt="LogoOfficiel" id="LogoOfficiel">
        <div class="header">
            <p>Le but du jeu : Traduire les phrases indiquées pour gagner des points</p>
        </div>
        <div class="game-area">
            <div class="flags">
                <img src="Image/anglais.jpg" alt="Anglais" id="english-flag">
                <button onclick="swapLanguages()">↔️</button>
                <img src="Image/france.jpg" alt="Français" id="french-flag">
            </div>
            <div class="middle">
                <div class="phrase" id="phrase">Cliquez sur 'Démarrer' pour commencer</div>
                <div class="input-area">
                    <input type="text" id="translation" placeholder="Traduisez ici..." disabled>
                </div>
                <div class="buttons">
                    <button onclick="startGame()" id="start-button">Démarrer</button>
                    <button onclick="checkTranslation()" disabled id="validate-button">Valider</button>
                </div>
                <div class="score-container">
                    <p>Score: <span id="score">0</span></p>
                </div>      
            </div>
        </div>
    </div>

    <script src="contenue.js"></script>
    <script>
        let currentLanguage = 'english';
        let currentPhraseIndex = 0;

        function swapLanguages() {
            currentLanguage = currentLanguage === 'english' ? 'french' : 'english';
            updatePhrase();

            // Inverser les images
            const frenchFlag = document.getElementById('french-flag');
            const englishFlag = document.getElementById('english-flag');

            if (currentLanguage === 'french') {
                frenchFlag.src = 'Image/anglais.jpg';
                frenchFlag.alt = 'Anglais';
                englishFlag.src = 'Image/france.jpg';
                englishFlag.alt = 'Français';
            } else {
                frenchFlag.src = 'Image/france.jpg';
                frenchFlag.alt = 'Français';
                englishFlag.src = 'Image/anglais.jpg';
                englishFlag.alt = 'Anglais';
            }
        }
        let score = 0;
let combo = 1;

function startGame() {
    currentPhraseIndex = Math.floor(Math.random() * phrases.length);
    updatePhrase();
    document.getElementById('translation').disabled = false;
    document.getElementById('validate-button').disabled = false;
    document.getElementById('translation').value = '';
    document.getElementById('start-button').style.display = 'none';
}

function updatePhrase() {
    const phraseElement = document.getElementById('phrase');
    const translationInput = document.getElementById('translation');
    const phrase = phrases[currentPhraseIndex];

    if (currentLanguage === 'english') {
        phraseElement.textContent = phrase.english;
        translationInput.placeholder = "Traduisez ici...";
    } else {
        phraseElement.textContent = phrase.french;
        translationInput.placeholder = "Translate here...";
    }
}

function checkTranslation() {
    const translationInput = document.getElementById('translation').value.trim();
    const correctTranslation = currentLanguage === 'english' ? phrases[currentPhraseIndex].french : phrases[currentPhraseIndex].english;

    if (translationInput.toLowerCase() === correctTranslation.toLowerCase()) {
        alert('Correct! Bonne réponse!');
        score += combo; // Ajoutez le score avec le combo actuel
        combo *= 2; // Doublez le combo
    } else {
        alert(`Incorrect! La bonne réponse est : ${correctTranslation}`);
        combo = 1; // Réinitialisez le combo à 1 en cas d'erreur
    }
    document.getElementById('score').textContent = score; // Mettez à jour l'affichage du score
    startGame();
}

document.addEventListener('DOMContentLoaded', () => {
    updatePhrase();
});
    </script>
</body>
</html>