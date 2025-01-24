import { generateCardImages, shuffleArray, handleCardClick, startTimer} from './game.js';''
import { GAME_DURATION, CARD_PAIRS, FLIP_DELAY } from './shared/constant.js';
export const initializeGame = () => {
    let timeLeft = GAME_DURATION; // Countdown timer in seconds
    let timer = null; // Reference to the interval timer
    let flippedCards = []; // Stores the currently flipped cards
    let matchedPairs = 0; // Tracks the number of matched pairs
    let isGameLocked = false; // Locks the game board to prevent actions during animations

    // Reset game state
    timeLeft = GAME_DURATION;
    flippedCards = [];
    matchedPairs = 0;
    isGameLocked = false;

    // Generate card images and shuffle them
    const cardImages = generateCardImages();
    const cards = [...cardImages, ...cardImages]; // Duplicate images for pairs
    const shuffledCards = shuffleArray(cards);

    // Clear the game board
    const gameBoard = document.querySelector('#game-board');
    gameBoard.innerHTML = '';

    // Create and add card elements to the board
    shuffledCards.forEach((imagePath, index) => {
        const card = document.createElement('div');
        card.innerHTML = `
            <div class="card" data-card-id="${index}" data-image="${imagePath}">
                <div class=" align-items-center justify-content-center">
                    <div class="card-back">
                        <img src="assets/img/card-cover.png" alt="Card back">
                        </div>
                    <img src="${imagePath}" class="card-front d-none" alt="Card image"> <!-- Image side -->
                </div>
            </div>
        `;
        gameBoard.appendChild(card); // Add card to the board
        card.addEventListener('click', () => handleCardClick(card)); // Attach click event
    });

    // Start the game timer
    startTimer();
};
