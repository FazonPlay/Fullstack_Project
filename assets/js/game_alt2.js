// // these are all the constants and variables that are used in the game
//
// export const GAME_DURATION = 300;
// export const CARD_PAIRS = 8;
// export const FLIP_DELAY = 1000;
//
// let timeLeft = GAME_DURATION;
// let timer = null;
// let flippedCards = [];
// let matchedPairs = 0;
// let isGameLocked = false;
//
//
// const generateCardImages = () => {
//     const cardImages = [];
//     for (let i = 1; i <= CARD_PAIRS; i++) {
//         cardImages.push(`assets/img/card-${i}.png`);
//     }
//     return cardImages;
// }
//
// const shuffleArray = (array) => {
//     for (let i = array.length - 1; i > 0; i--) {
//         const j = Math.floor(Math.random() * (i + 1));
//         [array[i], array[j]] = [array[j], array[i]];
//     }
//     return array;
// }
//
// const checkForMatch = () => {
//
// const handleCardClick = (card) => {
//     if (isGameLocked || flippedCards.length >= 2) return;
//
//     const cardElement = card.querySelector('.card')
//     const cardBack = card.querySelector('.card-back');
//     const cardFront = card.querySelector('.card-front');
//
//     if(!cardBack.classlist.contains('d-none')) {
//
//     cardBack.classList.add('d-none');
//     cardFront.classList.remove('d-none');
//     flippedCards.push(card);
//
//     if (flippedCards.length === 2) {
//         isGameLocked = true;
//         checkForMatch();
//         }
//     }
// };
//
//
//
//
//
// export const initializeGame = () => {
//     // before the game starts, the game state is reset
//     timeLeft = GAME_DURATION;
//     flippedCards = [];
//     matchedPairs = 0;
//     isGameLocked = false;
//
//     // now the cards will be generated and shuffled
//
//     const cardImages = generateCardImages();
//     const cards = [...cardImages, ...cardImages];
//     const shuffledCards = shuffleArray(cards);
//
//     // clear the game board
//     const gameBoard = document.querySelector('#game-board');
//     gameBoard.innerHTML = '';
//
//     // create and add cards to the board
//     shuffledCards.forEach((imagePath, index) => {
//         const card = document.createElement('div');
//         card.className = 'col';
//         card.innerHTML = `
//             <div class="card h-100 border" data-card-id="${index}" data-image="${imagePath}">
//                 <div class="d-flex align-items-center justify-content-center h-100">
//                     <div class="card-back p-4">❓</div>
//                     <img src="${imagePath}" class="card-front d-none" alt="Card image"> <!-- Image side -->
//                 </div>
//             </div>
//         `;
//         gameBoard.appendChild(card);
//         card.addEventListener('click', () => handleCardClick(card));
//
//
//     });
//     startTimer();
// }
//
