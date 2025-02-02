import {generateCardImages, shuffleArray, handleCardClick, startTimer, resetGameState} from './game.js';
export const initializeGame = () => {
    document.querySelector('#timer').classList.remove('d-none');
    document.querySelector('#progress').classList.remove('d-none');
    resetGameState();
    const cardImages = generateCardImages();
    const cards = [...cardImages, ...cardImages];
    const shuffledCards = shuffleArray(cards);

    const gameBoard = document.querySelector('#game-board');
    gameBoard.innerHTML = '';

    shuffledCards.forEach((imagePath, index) => {
        const cardsContainer = document.createElement('div');
        cardsContainer.innerHTML = `
        <div class="cards" data-card-id="${index}" data-image="${imagePath}">
            <div class="cards-inner">
                <div class="cards-back">
                    <img src="assets/img/card-cover.png" alt="Card back">
                </div>
                <div class="cards-front">
                    <img src="${imagePath}" alt="Card image">
                </div>
            </div>
        </div>
    `;
        const cardsElement = cardsContainer.querySelector('.cards');

        cardsElement.addEventListener('click', () => {
            handleCardClick(cardsElement);
        });

            // the part that handles animations was also reworked with AI
        gameBoard.appendChild(cardsContainer);
    });

    startTimer();
};
