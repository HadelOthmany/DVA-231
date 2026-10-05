//header('Access-Control-Allow-Origin: *');


fetch('box7.php')
.then(response => response.json()) // Parse the JSON response
.then(data => {
    // Apply the background image to the .box7 element
    document.querySelector('.box7').style.backgroundImage = `url(${data.image_url})`;
})
.catch(error => console.error('Error fetching the image URL:', error));

fetch('box5.php')
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
        // Assuming there's an <h1> tag inside .box5 where you want to place the header text
        document.querySelector('.box5 h1').textContent = `${data.header_text}`;
        
        // If you want to update other parts of .box5 (for example, a content section)
        document.querySelector('.box5 p').textContent = data.content;

        const footerLinks = document.querySelectorAll('.box5-footer a');

        if (data.links && data.links.length > 0) {
            footerLinks.forEach((link, index) => {
                if (data.links[index]) {  // Check if there's a corresponding link
                    link.href = data.links[index].url;
                    link.textContent = data.links[index].text;
                } else {
                    // If there are not enough links in the data, hide the extra anchor tags
                    link.style.display = 'none';
                }
            });
        } else {
            // If no links exist, hide all anchor tags in .box5-footer
            footerLinks.forEach(link => link.style.display = 'none');
        }
    })
    fetch('hovbox.php')
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
       
        document.querySelector('#hover-text').textContent = data.hover_text;

        // Set blue_box_text inside the <p> with id "blue-box-text"
        document.querySelector('#blue-box-text').textContent = data.blue_box_text;
            // Set image_url as background image or <img> src
            document.querySelector('.hovbox').style.backgroundImage = `url(${data.image_url})`;
            
            
            document.querySelector('.hovbox').style.setProperty('--after-content', `"${data.content}"`);
       
    })
    fetch('white_box3.php')
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
        // Check if we have valid data
        
            // Set the header text inside the <p> element with the border
            document.querySelector('.white-box3 p').textContent = data.header_text;

            // Populate the list items
            const listElement = document.querySelector('.white-box3 ul.list');
            listElement.innerHTML = ''; // Clear any existing list items
            data.list_items.forEach(item => {
                const li = document.createElement('li');
                li.textContent = item;
                listElement.appendChild(li);
            });

            // Populate the links
            const linksContainer = document.querySelector('.white-box3 .box3-footer');
            linksContainer.innerHTML = ''; // Clear any existing links
            data.links.forEach(link => {
                const a = document.createElement('a');
                a.textContent = link.text;
                a.href = link.url;
                linksContainer.appendChild(a);
            });
       
    })
    fetch('news.php')
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
        const headlineElement = document.getElementById('headline');
        const blueBoxElement = document.querySelector('.blue-box');
        let currentIndex = 0;

        // Function to display the current news article
        function displayNews() {
            const newsItem = data[currentIndex];

            // Update headline and background image
            headlineElement.textContent = newsItem.content;
            blueBoxElement.textContent=newsItem.title;
            document.querySelector('.container3').style.backgroundImage = `url(${newsItem.imgurl})`;

            // Move to the next news item, wrapping around if necessary
            currentIndex = (currentIndex + 1) % data.length;
        }

        // Display the first news item immediately
        displayNews();

        // Set an interval to change news every 5 seconds
        setInterval(displayNews, 5000);
    })
    .catch(error => console.error('Error fetching news data:', error));


   // Listen for input changes in the search box
   document.getElementById('search').addEventListener('input', function() {
    let query = this.value.trim();
    if (query.length > 0) {
        fetchSuggestions(query);
    } else {
        document.getElementById('suggestions').style.display = 'none';
    }
});

// Fetch suggestions based on the user's query
async function fetchSuggestions(query) {
    try {
        let response = await fetch('search_suggestions.php?q=' + encodeURIComponent(query));
        
        if (response.ok) {
            let suggestions = await response.json();
            let suggestionBox = document.getElementById('suggestions');
            suggestionBox.innerHTML = ''; // Clear previous suggestions

            if (suggestions.length > 0) {
                suggestionBox.style.display = 'block';

                // Loop through each suggestion and add it to the suggestion box
                suggestions.forEach(item => {
                    let div = document.createElement('div');
                    div.className = 'suggestion-item';

                    // Create an anchor element for clickable link
                    let link = document.createElement('a');
                    link.href = item.url; // Use the constructed URL
                    link.innerHTML = item.title;
                    link.style.color = 'inherit'; 
                    link.style.border='none';
                    link.style.textDecoration = 'none'; 

                    div.appendChild(link);
                    suggestionBox.appendChild(div);
                });
            } else {
                suggestionBox.style.display = 'none';
            }
        }
    } catch (error) {
        console.error('Error fetching suggestions:', error);
    }
}

// Close suggestions when clicking outside the suggestion box or search box
document.addEventListener('click', function(event) {
    let searchBox = document.getElementById('search');
    let suggestionBox = document.getElementById('suggestions');
    if (!searchBox.contains(event.target) && !suggestionBox.contains(event.target)) {
        suggestionBox.style.display = 'none';
    }
});


    
    
    
