// game.js

// Configuration constants
export const GAME_DURATION = 300; // 5 minutes in seconds
export const CARD_PAIRS = 8; // Total number of pairs in the game
export const FLIP_DELAY = 1000; // Delay before hiding unmatched cards (in milliseconds)

// Game state
let timeLeft = GAME_DURATION;
let timer = null;
let flippedCards = [];
let matchedPairs = 0;
let isGameLocked = false;

// Generate card image paths automatically
const generateCardImages = () => {
    const cardImages = [];
    for (let i = 1; i <= CARD_PAIRS; i++) {
        cardImages.push(`assets/img/card-${i}.png`);
    }
    return cardImages;
};

// Shuffle array function
const shuffleArray = (array) => {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
};

// Initialize the game board
export const initializeGame = () => {
    // Reset game state
    timeLeft = GAME_DURATION;
    flippedCards = [];
    matchedPairs = 0;
    isGameLocked = false;

    // Create pairs of cards with image paths
    const cardImages = generateCardImages();
    const cards = [...cardImages, ...cardImages];
    const shuffledCards = shuffleArray(cards);

    // Clear existing board
    const gameBoard = document.getElementById('game-board');
    gameBoard.innerHTML = '';

    // Create and add cards to the board
    shuffledCards.forEach((imagePath, index) => {
        const card = document.createElement('div');
        card.className = 'col';
        card.innerHTML = `
            <div class="card h-100 border" data-card-id="${index}" data-image="${imagePath}">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <div class="card-back p-4">❓</div>
                    <img src="${imagePath}" class="card-front d-none" alt="Card image">
                </div>
            </div>
        `;
        gameBoard.appendChild(card);
        card.addEventListener('click', () => handleCardClick(card));
    });

    // Start the timer
    startTimer();
};

// Handle card click
const handleCardClick = (card) => {
    if (isGameLocked || flippedCards.length >= 2) return;

    const cardElement = card.querySelector('.card');
    const cardBack = cardElement.querySelector('.card-back');
    const cardFront = cardElement.querySelector('.card-front');

    if (!cardBack.classList.contains('d-none')) {
        // Flip card
        cardBack.classList.add('d-none');
        cardFront.classList.remove('d-none');
        flippedCards.push(card);

        // Check for match when two cards are flipped
        if (flippedCards.length === 2) {
            isGameLocked = true;
            checkForMatch();
        }
    }
};

// Check if flipped cards match
const checkForMatch = () => {
    const [card1, card2] = flippedCards;
    const image1 = card1.querySelector('.card').dataset.image;
    const image2 = card2.querySelector('.card').dataset.image;

    if (image1 === image2) {
        // Cards match
        matchedPairs++;
        flippedCards = [];
        isGameLocked = false;

        // Check for game completion
        if (matchedPairs === CARD_PAIRS) {
            endGame(true);
        }
    } else {
        // Cards don't match - flip them back
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

// Timer functions
const startTimer = () => {
    timer = setInterval(() => {
        timeLeft--;
        updateTimerDisplay();
        updateProgressBar();

        if (timeLeft <= 0) {
            endGame(false);
        }
    }, 1000);
};

const updateTimerDisplay = () => {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    document.getElementById('timer').textContent =
        `Time: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
};

const updateProgressBar = () => {
    const progress = (timeLeft / GAME_DURATION) * 100;
    const progressBar = document.getElementById('progress-bar');
    progressBar.style.width = `${progress}%`;
};

// End game
const endGame = (isWin) => {
    clearInterval(timer);
    isGameLocked = true;

    setTimeout(() => {
        if (isWin) {
            alert('Congratulations! You won! 🎉');
        } else {
            alert('Time\'s up! Game Over! 😢');
        }

        if (confirm('Would you like to play again?')) {
            initializeGame();
        }
    }, 500);
};