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

document.getElementById("en").addEventListener("click", () => handleLanChange("en"))
document.getElementById("de").addEventListener("click", () => handleLanChange("de"))
document.getElementById("tr").addEventListener("click", () => handleLanChange("tr"))
document.getElementById("ar").addEventListener("click", () => handleLanChange("ar"))

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
