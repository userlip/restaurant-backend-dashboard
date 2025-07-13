import {
  Livewire,
  Alpine,
} from '../../vendor/livewire/livewire/dist/livewire.esm'

import Tooltip from '@ryangjchandler/alpine-tooltip'

Alpine.plugin(Tooltip)

Livewire.start()

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
  if (drawerButton) {
    drawerButton.addEventListener("click", openDrawer)
  }
}

function initializeCloseButton() {
  const closeButton = document.getElementById("close-drawer")
  if (closeButton) {
    closeButton.addEventListener("click", closeDrawer)
  }
}

function initializeLanguageButton() {
  const languageButton = document.querySelector('.language-selected')
  if (languageButton) {
    languageButton.addEventListener("click", openDrawer)
  }
}

function initialize() {
  initializeDrawerButton()
  initializeCloseButton()
  initializeLanguageButton()
}

function getUserLang() {
  return document.querySelector('.language-selected').dataset.language || "de"
}

function handleLanChange(lang) {
  localStorage.setItem("eatweb-lang", lang)
  document.querySelectorAll("[data-lang]").forEach(btn => {
    if (btn.dataset.lang === lang) {
      btn.classList.add("bg-[#FC1919]")
      btn.classList.add("text-white")
    } else {
      btn.classList.remove("bg-[#FC1919]")
      btn.classList.remove("text-white")
    }
  })
}

// Language button event listeners - wrapped in DOMContentLoaded to ensure elements exist
document.addEventListener("DOMContentLoaded", () => {
  const enBtn = document.getElementById("en")
  const deBtn = document.getElementById("de")
  const trBtn = document.getElementById("tr")
  const arBtn = document.getElementById("ar")
  
  if (enBtn) enBtn.addEventListener("click", () => handleLanChange("en"))
  if (deBtn) deBtn.addEventListener("click", () => handleLanChange("de"))
  if (trBtn) trBtn.addEventListener("click", () => handleLanChange("tr"))
  if (arBtn) arBtn.addEventListener("click", () => handleLanChange("ar"))
})

document.addEventListener("DOMContentLoaded", initialize)
document.addEventListener("DOMContentLoaded", () => {
  const lang = getUserLang()
  document.querySelectorAll("[data-lang]").forEach(btn => {
    if (btn.dataset.lang === lang) {
      btn.classList.add("text-white")
      btn.classList.add("bg-[#FC1919]")
    }
  })
})
