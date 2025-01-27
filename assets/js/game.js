
import { saveGameTime } from './services/saveState.js';
import { CARD_PAIRS, GAME_DURATION, FLIP_DELAY } from './components/shared/constant.js';

// Game state variables
let timeLeft = GAME_DURATION; // Countdown timer in seconds
let timer = null; // Reference to the interval timer
let flippedCards = []; // Stores the currently flipped cards
let matchedPairs = 0; // Tracks the number of matched pairs
let isGameLocked = false; // Locks the game board to prevent actions during animations

// Function to generate card image paths
export const generateCardImages = () => {
    const cardImages = [];
    for (let i = 1; i <= CARD_PAIRS; i++) {
        cardImages.push(`assets/img/card-${i}.png`); // Add paths for each card image
    }
    return cardImages;
};

export const resetGameState = () => {
    timeLeft = GAME_DURATION; // Reset timer
    timer = null;             // Clear the timer reference
    flippedCards = [];        // Clear flipped cards
    matchedPairs = 0;         // Reset matched pairs count
    isGameLocked = false;     // Unlock the board
};



// Function to shuffle an array using the Fisher-Yates algorithm
export const shuffleArray = (array) => {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1)); // Random index
        [array[i], array[j]] = [array[j], array[i]]; // Swap elements
    }
    return array;
};

// Initializes the game board and resets the state

// Handles the logic when a card is clicked
export const handleCardClick = (card) => {
    if (isGameLocked || flippedCards.length >= 2) return; // Ignore clicks if locked or two cards are flipped

    const cardElement = card.querySelector('.card');
    const cardBack = cardElement.querySelector('.card-back');
    const cardFront = cardElement.querySelector('.card-front');

    if (!cardBack.classList.contains('d-none')) { // Ensure the card is not already flipped
        // Flip the card
        cardBack.classList.add('d-none');
        cardFront.classList.remove('d-none');
        flippedCards.push(card); // Add to flipped cards list

        if (flippedCards.length === 2) { // If two cards are flipped
            isGameLocked = true; // Lock the game board
            checkForMatch(); // Check if the cards match
        }
    }
};

// Checks if two flipped cards match
export const checkForMatch = () => {
    const [card1, card2] = flippedCards;
    const image1 = card1.querySelector('.card').dataset.image;
    const image2 = card2.querySelector('.card').dataset.image;

    if (image1 === image2) { // If the images match
        matchedPairs++; // Increment matched pairs count
        flippedCards = []; // Reset flipped cards
        isGameLocked = false; // Unlock the game board

        if (matchedPairs === CARD_PAIRS) { // Check if all pairs are matched
            endGame(true); // End the game with a win
        }
    } else {
        // If the images don't match, flip the cards back after a delay
        setTimeout(() => {
            card1.querySelector('.card-back').classList.remove('d-none');
            card1.querySelector('.card-front').classList.add('d-none');
            card2.querySelector('.card-back').classList.remove('d-none');
            card2.querySelector('.card-front').classList.add('d-none');
            flippedCards = []; // Reset flipped cards
            isGameLocked = false; // Unlock the game board
        }, FLIP_DELAY);
    }
};

// Starts the countdown timer
export const startTimer = () => {
    clearInterval(timer); // Prevent duplicate intervals
    timer = setInterval(() => {
        timeLeft--;
        updateTimerDisplay();
        updateProgressBar();

        if (timeLeft <= 0) {
            endGame(false);
        }
    }, 1000);
};

// Updates the time display
export const updateTimerDisplay = () => {
    const minutes = Math.floor(timeLeft / 60); // Calculate minutes
    const seconds = timeLeft % 60; // Calculate remaining seconds
    document.querySelector('#timer').textContent =
        `Time: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
};

// Updates the progress bar to reflect remaining time
export const updateProgressBar = () => {
    const progress = (timeLeft / GAME_DURATION) * 100; // Calculate percentage
    const progressBar = document.querySelector('#progress-bar');
    progressBar.style.width = `${progress}%`; // Adjust width of the progress bar
};


// Ends the game and shows a message
export const endGame = async (isWin) => {
    clearInterval(timer); // Stop the timer
    isGameLocked = true; // Lock the game board

    const startGameBtn = document.querySelector('#start-game-btn');
    startGameBtn.disabled = false; // Enable the start game button

    if(isWin) {
    const timeSpent = GAME_DURATION - timeLeft;
        await saveGameTime(timeSpent);
        alert('Congratulations! You won the game!');
    } else {
        alert('Time is up! Game over!');
    }
};

