// document.addEventListener("DOMContentLoaded", () => {
//     const gameBoard = document.querySelector("#game-board");
//     const timerDisplay = document.querySelector("#timer");
//     let cards = [];
//     let flippedCards = [];
//     let matches = 0;
//     const totalPairs = 8; // Adjust based on your game setup
//     let timer;
//
//     // Initialize the game
//     function initializeGame() {
//         // Generate card data (fetch from backend or use static data)
//         cards = Array.from({ length: totalPairs * 2 }, (_, i) => ({
//             id: i,
//             value: Math.floor(i / 2), // Pair values
//         }));
//
//         // Shuffle cards
//         cards.sort(() => Math.random() - 0.5);
//
//         // Render cards
//         renderCards();
//         startTimer(300); // 300 seconds = 5 minutes
//     }
//
//     // Render cards to the board
//     function renderCards() {
//         gameBoard.innerHTML = "";
//         cards.forEach((card) => {
//             const cardElement = document.createElement("div");
//             cardElement.classList.add("card");
//             cardElement.dataset.id = card.id;
//             cardElement.dataset.value = card.value;
//             cardElement.textContent = "?"; // Hidden value
//             gameBoard.appendChild(cardElement);
//
//             // Add click event
//             cardElement.addEventListener("click", handleCardClick);
//         });
//     }
//
//     // Handle card click
//     function handleCardClick(event) {
//         const card = event.target;
//
//         // Ignore already flipped or matched cards
//         if (card.classList.contains("flipped") || flippedCards.length === 2) {
//             return;
//         }
//
//         // Flip card
//         card.classList.add("flipped");
//         card.textContent = card.dataset.value; // Show value
//         flippedCards.push(card);
//
//         // Check match
//         if (flippedCards.length === 2) {
//             const [card1, card2] = flippedCards;
//             if (card1.dataset.value === card2.dataset.value) {
//                 matches++;
//                 flippedCards = [];
//                 if (matches === totalPairs) {
//                     clearInterval(timer);
//                     alert("You won!");
//                 }
//             } else {
//                 setTimeout(() => {
//                     card1.classList.remove("flipped");
//                     card1.textContent = "?";
//                     card2.classList.remove("flipped");
//                     card2.textContent = "?";
//                     flippedCards = [];
//                 }, 1000);
//             }
//         }
//     }
//
//     // Start timer
//     function startTimer(seconds) {
//         let remainingTime = seconds;
//         timer = setInterval(() => {
//             const minutes = Math.floor(remainingTime / 60)
//                 .toString()
//                 .padStart(2, "0");
//             const seconds = (remainingTime % 60).toString().padStart(2, "0");
//             timerDisplay.textContent = `Time: ${minutes}:${seconds}`;
//             if (--remainingTime < 0) {
//                 clearInterval(timer);
//                 alert("Time's up!");
//             }
//         }, 1000);
//     }
//
//     // Start the game
//     initializeGame();
// });
