
import { saveGameTime } from './services/saveState.js';
import { CARD_PAIRS, GAME_DURATION, FLIP_DELAY } from './components/shared/constant.js';
import {showModal} from "./components/shared/modal.js";

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


// after encountering issues with the game state, now it'll reset.
export const resetGameState = () => {
    timeLeft = GAME_DURATION;
    timer = null;
    flippedCards = [];
    matchedPairs = 0;
    isGameLocked = false;
};

// this function uses some math algorithm to shuffle the array (AI)
export const shuffleArray = (array) => {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
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

// the function i made originally didnt work with animations, reworked with AI
export const handleCardClick = (cardsContainer) => {
    // Get the actual card element from the container
    const cardsElement = cardsContainer.classList.contains('cards')
        ? cardsContainer
        : cardsContainer.querySelector('.cards');

    if (isGameLocked ||
        cardsElement.classList.contains('flipped') ||
        cardsElement.classList.contains('matched')) return;

    cardsElement.classList.add('flipped');
    flippedCards.push(cardsElement);

    if (flippedCards.length === 2) {
        isGameLocked = true;
        checkForMatch();
    }
};

// same here, this one had to be modified with AI to work with the function above
const checkForMatch = () => {
    const [firstCard, secondCard] = flippedCards;
    const image1 = firstCard.dataset.image;
    const image2 = secondCard.dataset.image;

    if (image1 === image2) {
        matchedPairs++;
        // Keep cards flipped and mark as matched
        firstCard.classList.add('matched');
        secondCard.classList.add('matched');
        flippedCards = [];
        isGameLocked = false;

        if (matchedPairs === CARD_PAIRS) {
            endGame(true);
        }
    } else {
        setTimeout(() => {
            firstCard.classList.remove('flipped');
            secondCard.classList.remove('flipped');
            flippedCards = [];
            isGameLocked = false;
        }, FLIP_DELAY);
    }
};

const updateTimerDisplay = () => {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    document.querySelector('#timer').textContent =
        `Time: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
};

const updateProgressBar = () => {
    const progress = (timeLeft / GAME_DURATION) * 100;
    const progressBar = document.querySelector('#progress-bar');
    progressBar.style.width = `${progress}%`;
};


const endGame = async (isWin) => {
    clearInterval(timer);
    isGameLocked = true;

    const startGameBtn = document.querySelector('#start-game-btn');
    startGameBtn.disabled = false;

    if(isWin) {
    const timeSpent = GAME_DURATION - timeLeft;
        await saveGameTime(timeSpent);
        showModal('Congratulations! You won the game!');
    } else {
        showModal('Time is up! Game over!');
    }
};

