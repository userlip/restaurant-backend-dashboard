import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs'

const swiper = new Swiper('.swiper-container', {
  slidesPerView: "auto",
  centeredSlides: true,
  spaceBetween: 21,
  pagination: {
    el: '.swiper-pagination',
    type: "progressbar"
  },
  initialSlide: 1,
  autoplay: {
    delay: 2500
  }
})

function handleSwipeNext() {
  const nextButton = document.getElementById("next-button")
  nextButton.addEventListener("click", () => {
    swiper.slideNext()
  })
}

function handleSwipePrev() {
  const prevButton = document.getElementById("prev-button")
  prevButton.addEventListener("click", () => {
    swiper.slidePrev()
  })
}

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
  handleSwipeNext()
  handleSwipePrev()
})
