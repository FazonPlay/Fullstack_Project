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
        const card = document.createElement('div');
        card.innerHTML = `
            <div class="card" data-card-id="${index}" data-image="${imagePath}">
                <div class=" align-items-center justify-content-center">
                    <div class="card-back">
                        <img src="assets/img/card-cover.png" alt="Card back">
                        </div>
                    <img src="${imagePath}" class="card-front d-none" alt="Card image"> 
                </div>
            </div>
        `;
        gameBoard.appendChild(card);
        card.addEventListener('click', () => handleCardClick(card));
    });

    startTimer();
};
