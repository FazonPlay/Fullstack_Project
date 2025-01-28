
import { saveGameTime } from './services/saveState.js';
import { CARD_PAIRS, GAME_DURATION, FLIP_DELAY } from './components/shared/constant.js';

let timeLeft = GAME_DURATION;
let timer = null;
let flippedCards = [];
let matchedPairs = 0;
let isGameLocked = false;


export const generateCardImages = () => {
    const cardImages = [];
    for (let i = 1; i <= CARD_PAIRS; i++) {
        cardImages.push(`assets/img/card-${i}.png`);
    }
    return cardImages;
};

export const resetGameState = () => {
    timeLeft = GAME_DURATION;
    timer = null;
    flippedCards = [];
    matchedPairs = 0;
    isGameLocked = false;
};



export const shuffleArray = (array) => {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1)); // Random index
        [array[i], array[j]] = [array[j], array[i]]; // Swap elements
    }
    return array;
};


export const handleCardClick = (card) => {
    if (isGameLocked || flippedCards.length >= 2) return;

    const cardElement = card.querySelector('.card');
    const cardBack = cardElement.querySelector('.card-back');
    const cardFront = cardElement.querySelector('.card-front');

    if (!cardBack.classList.contains('d-none')) {
        cardBack.classList.add('d-none');
        cardFront.classList.remove('d-none');
        flippedCards.push(card);

        if (flippedCards.length === 2) {
            isGameLocked = true;
            checkForMatch();
        }
    }
};

export const checkForMatch = () => {
    const [card1, card2] = flippedCards;
    const image1 = card1.querySelector('.card').dataset.image;
    const image2 = card2.querySelector('.card').dataset.image;

    if (image1 === image2) {
        matchedPairs++;
        flippedCards = [];
        isGameLocked = false;

        if (matchedPairs === CARD_PAIRS) {
            endGame(true);
        }
    } else {
        setTimeout(() => {
            card1.querySelector('.card-back').classList.remove('d-none');
            card1.querySelector('.card-front').classList.add('d-none');
            card2.querySelector('.card-back').classList.remove('d-none');
            card2.querySelector('.card-front').classList.add('d-none');
            flippedCards = [];
            isGameLocked = false;
        }, FLIP_DELAY);
    }
};

export const startTimer = () => {
    clearInterval(timer);
    timer = setInterval(() => {
        timeLeft--;
        updateTimerDisplay();
        updateProgressBar();

        if (timeLeft <= 0) {
            endGame(false);
        }
    }, 1000);
};

export const updateTimerDisplay = () => {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    document.querySelector('#timer').textContent =
        `Time: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
};

export const updateProgressBar = () => {
    const progress = (timeLeft / GAME_DURATION) * 100;
    const progressBar = document.querySelector('#progress-bar');
    progressBar.style.width = `${progress}%`;
};


export const endGame = async (isWin) => {
    clearInterval(timer);
    isGameLocked = true;

    const startGameBtn = document.querySelector('#start-game-btn');
    startGameBtn.disabled = false;

    if(isWin) {
    const timeSpent = GAME_DURATION - timeLeft;
        await saveGameTime(timeSpent);
        alert('Congratulations! You won the game!');
    } else {
        alert('Time is up! Game over!');
    }
};

