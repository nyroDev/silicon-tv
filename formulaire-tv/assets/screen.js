var displayTime = 20;

var body = document.querySelector('body'),
    main = document.querySelector('main'),
    articles = document.querySelectorAll('article'),
    articlesNb = articles.length,
    curShown = 0,
    nextShown,
    state;

if ('serviceWorker' in navigator && body.dataset.sw) {
    navigator.serviceWorker.register(body.dataset.sw, {
      scope: '/screen/'
    }).then(function(reg) {
        console.log('service worker ready');
    });
}

// Start by shuffling all articles
for (var i = articlesNb; i >= 0; i--) {
    main.appendChild(main.children[Math.random() * i | 0]);
}

// Get it back again shuffled
articles = document.querySelectorAll('article');

// Show the first one
articles[curShown].classList.add('shown');

// Prepare all events listener
body.addEventListener('transitionend', function() {
    if (state === 'start') {
        requestAnimationFrame(function() {
            // Select the nextOne
            nextShown = curShown + 1;
            if (nextShown === articlesNb) {
                nextShown = 0;
            }
            // Prepare the next one in reverse side
            articles[nextShown].classList.add('nextShown');
            articles[nextShown].classList.add('shown');

            main.classList.add('anim');
        });
    } else {
        // Start a new display
        display();
    }
});

main.addEventListener('transitionend', function(event) {
    event.stopPropagation();
    if (state === 'end') {
        return;
    }
    requestAnimationFrame(function() {
        // Rotate animation is done, swipe article and zoom again

        state = 'end';
        main.classList.add('noAnim');
        main.classList.remove('anim');

        articles[curShown].classList.remove('shown');
        articles[nextShown].classList.remove('nextShown');
        curShown = nextShown;

        requestAnimationFrame(function() {
            main.classList.remove('noAnim');

            // Zoom body again
            body.classList.remove('anim');
        });
    });
});

function display() {
    setTimeout(function() {
        requestAnimationFrame(function() {
            state = 'start';
            body.classList.add('anim');
        });
    }, displayTime * 1000);
}

// Start display
display();
