function openDrawer() {
  const drawer = document.getElementById("drawer")

  drawer.classList.remove("-translate-y-[150dvh]")
  drawer.classList.add("translate-y-0")
}

function closeDrawer() {
  const drawer = document.getElementById("drawer")

  drawer.classList.add("-translate-y-[150dvh]")
  drawer.classList.remove("translate-y-0")
}

function initializeDrawerButton() {
  const drawerButton = document.getElementById("drawer-button")
  drawerButton.addEventListener("click", openDrawer)
}

function initializeCloseButton() {
  const closeButton = document.getElementById("close-drawer")
  closeButton.addEventListener("click", closeDrawer)
}

function initialize() {
  initializeDrawerButton()
  initializeCloseButton()
}

function handleButtonScroll() {
  const buttons = document.querySelectorAll('[id^="button-"]');

  buttons.forEach(button => {
    button.addEventListener("click", () => {
      closeDrawer()
      const section = button.id.split("-")[1]
      const element = document.getElementById(section)
      element.scrollIntoView({ behavior: "smooth" })
      history.pushState(null, null, `#${section}`)
    })
  })
}

document.addEventListener("DOMContentLoaded", () => {
  initialize()
  handleButtonScroll()
})
