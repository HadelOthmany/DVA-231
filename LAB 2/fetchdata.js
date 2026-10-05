document.addEventListener('DOMContentLoaded', function () {
    let currentIndex = 0;
    function fetchDataAndUpdateContent() {
        fetch('http://localhost/Lab1fardig/data.php?nocache=' + new Date().getTime())
            .then(response => response.json()) // Parse the response as JSON
            .then(Lab1fardigdata => {
               
                const newsItem = Lab1fardigdata.news[currentIndex];

                
                const blueBoxElement = document.querySelector('.blue-box');
                if (blueBoxElement) {
                    blueBoxElement.textContent = newsItem.title;
                }

                
                const whiteBoxElement = document.querySelector('.white-box #headline');
                if (whiteBoxElement) {
                    whiteBoxElement.textContent = newsItem.content;
                }

                
                const container3Element = document.querySelector('.container3');
                if (container3Element) {
                    container3Element.style.backgroundImage = `url('${newsItem.imgurl}')`;
                }

                
                currentIndex = (currentIndex + 1) % Lab1fardigdata.news.length;

                        
                const hoverTextElement = document.getElementById('hover-text');
                if (hoverTextElement) {
                    hoverTextElement.textContent = Lab1fardigdata.hovbox.hover_text;
                }

                const blueBoxTextElement = document.getElementById('blue-box-text');
                if (blueBoxTextElement) {
                    blueBoxTextElement.textContent = Lab1fardigdata.hovbox.blue_box_text;
                }

                
                const hovboxElement = document.querySelector('.hovbox');
                if (hovboxElement) {
                    hovboxElement.style.backgroundImage = `url('${Lab1fardigdata.hovbox.image_url}')`;

                  
                    hovboxElement.style.setProperty('--after-content', `"${Lab1fardigdata.hovbox.content}"`);
                }

                
                const whiteBox3Element = document.querySelector('.white-box3');
                if (whiteBox3Element) {

                    const headerElement = whiteBox3Element.querySelector('p');
                    if (headerElement) {
                        headerElement.textContent = Lab1fardigdata.white_box3.header_text;
                    }
                    

                    const listElement = whiteBox3Element.querySelector('.list');
                    if (listElement) {
                        listElement.innerHTML = ''; 
                        Lab1fardigdata.white_box3.list_items.forEach(item => {
                            const li = document.createElement('li');
                            li.textContent = item;
                            listElement.appendChild(li);
                        });
                    }

                    
                    const footerElement = whiteBox3Element.querySelector('.box3-footer');
                    if (footerElement) {
                        footerElement.innerHTML = ''; // Rensa befintliga länkar
                        Lab1fardigdata.white_box3.links.forEach(link => {
                            const a = document.createElement('a');
                            a.href = link.url;
                            a.textContent = link.text;
                            footerElement.appendChild(a);
                        });
                    }
                }

                
                const box5Element = document.querySelector('.box5');
                if (box5Element) {
                   
                    const box5Header = box5Element.querySelector('h1');
                    if (box5Header) {
                        box5Header.textContent = Lab1fardigdata.box5.header_text;
                    }

                    
                    const box5Paragraph = box5Element.querySelector('p');
                    if (box5Paragraph) {
                        box5Paragraph.textContent = Lab1fardigdata.box5.content;
                    }

                    
                    const box5Footer = box5Element.querySelector('.box5-footer');
                    if (box5Footer) {
                        box5Footer.innerHTML = '';
                        Lab1fardigdata.box5.links.forEach(link => {
                            const a = document.createElement('a');
                            a.href = link.url;
                            a.textContent = link.text;
                            box5Footer.appendChild(a);
                        });
                    }
                }
                const box7Element = document.querySelector('.box7')
                if(box7Element) {
                    box7Element.style.backgroundImage = `url('${Lab1fardigdata.box7.image_url}')`;
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Fetch the data and update the content immediately when the page loads
    fetchDataAndUpdateContent();

    // Set an interval to update the content every 5 seconds
    setInterval(fetchDataAndUpdateContent, 5000);
});
