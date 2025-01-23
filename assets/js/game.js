// Game configuration constants
export const GAME_DURATION = 300; // time replaced to 10 seconds for debugging purposes
export const CARD_PAIRS = 8; // Total number of unique card pairs to match
export const FLIP_DELAY = 1000; // Delay in milliseconds before flipping unmatched cards back


export const initializeGame = () => {
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





// Game state variables
let timeLeft = GAME_DURATION; // Countdown timer in seconds
let timer = null; // Reference to the interval timer
let flippedCards = []; // Stores the currently flipped cards
let matchedPairs = 0; // Tracks the number of matched pairs
export let isGameLocked = false; // Locks the game board to prevent actions during animations

// Function to generate card image paths
const generateCardImages = () => {
    const cardImages = [];
    for (let i = 1; i <= CARD_PAIRS; i++) {
        cardImages.push(`assets/img/card-${i}.png`); // Add paths for each card image
    }
    return cardImages;
};

// Function to shuffle an array using the Fisher-Yates algorithm
const shuffleArray = (array) => {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1)); // Random index
        [array[i], array[j]] = [array[j], array[i]]; // Swap elements
    }
    return array;
};

// Initializes the game board and resets the state

// Handles the logic when a card is clicked
const handleCardClick = (card) => {
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
const checkForMatch = () => {
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
const startTimer = () => {
    timer = setInterval(() => {
        timeLeft--; // Decrease time
        updateTimerDisplay(); // Update displayed time
        updateProgressBar(); // Update progress bar

        if (timeLeft <= 0) { // If time runs out
            endGame(false); // End the game with a loss
        }
    }, 1000); // Update every second
};

// Updates the time display
const updateTimerDisplay = () => {
    const minutes = Math.floor(timeLeft / 60); // Calculate minutes
    const seconds = timeLeft % 60; // Calculate remaining seconds
    document.querySelector('#timer').textContent =
        `Time: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
};

// Updates the progress bar to reflect remaining time
const updateProgressBar = () => {
    const progress = (timeLeft / GAME_DURATION) * 100; // Calculate percentage
    const progressBar = document.querySelector('#progress-bar');
    progressBar.style.width = `${progress}%`; // Adjust width of the progress bar
};

// Ends the game and shows a message
const endGame = (isWin) => {

    const startGameBtn = document.querySelector('#start-game-btn');

    clearInterval(timer); // Stop the timer
    isGameLocked = true; // Lock the game board

    if(isGameLocked === true) {
        startGameBtn.disabled = false;
    }



    alert(isWin ? 'Congratulations! You won!' : 'Game over! You lost!'); // Show win/loss message

};
