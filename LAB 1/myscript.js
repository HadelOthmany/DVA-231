const headlines = [
    "The chef is making pancakes for breakfast today!!",
    "Lunch menu will be here soon! Keep waiting",
    "Latest updates: Free drinks with all chef's special today"
];

const images = [
    "media/bancake.jpg", 
    "media/pudding.jpg", 
    "media/pasta.jpg"  
];

let currentHeadline = 0;

function changeHeadline() {
    // Get the headline element
    const headlineElement = document.getElementById('headline');
    const containerElement = document.querySelector('.container3');

    // Update the text content of the headline
    headlineElement.textContent = headlines[currentHeadline];

    // Update the background image of the container
    containerElement.style.backgroundImage = `url('${images[currentHeadline]}')`;

    // Move to the next headline and image
    currentHeadline = (currentHeadline + 1) % headlines.length;
}

// Change every 5 seconds
setInterval(changeHeadline, 5000);
