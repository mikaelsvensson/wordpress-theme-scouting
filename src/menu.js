window.addEventListener('load', function (event) {
    const menuButton = document.querySelector('nav#site-menu-button button')
    const menuContent = document.querySelector('nav#site-menu')
    menuButton.addEventListener('click', function (event) {
        const isOpen = JSON.parse(menuButton.getAttribute('aria-expanded'))
        menuButton.setAttribute('aria-expanded', !isOpen)
        // menuContent.hidden = !menuContent.hidden
        menuContent.classList.toggle('expanded')

        // if (!menuContent.hidden) {
        //     menuContent.querySelector('a').focus()
        // }
    })
})